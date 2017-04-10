<?php
/**
 * 对接以结算为主，此服务一般用在商城，用于接收结算发送的消息内容.
 */
use Workerman\Worker;
$cur_dir = dirname(__FILE__); 
chdir($cur_dir);
ini_set('memory_limit','10000M');
//RPC消息队列
define('AMQP_HOST', '192.168.177.154');
define('AMQP_PORT', 5672);
define('AMQP_USER', 'rabbit');
define('AMQP_PASS', '123456');
define('AMQP_VHOST', '/');
//If this is enabled you can see AMQP output on the CLI
define('AMQP_DEBUG', false);

require_once __DIR__ . '/../ThinkPHP/Library/Vendor/PhpAmqpLib/Autoloader/autoload.php';

use \Vendor\PhpAmqpLib\Connection\AMQPStreamConnection;



$consumer = new Worker();
// 慢任务，消费者的进程数可以开多一些
$consumer->count = 1;
/**
 * 进程启动阻塞式的从队列中读取数据并处理
 */
$consumer->closeTime = 0;
$consumer->onWorkerStart = function($consumer)
{
    $exchange = 'router';
    $queue = 'msgs';
    $consumerTag = 'consumer';
    $connection = new AMQPStreamConnection(AMQP_HOST, AMQP_PORT, AMQP_USER, AMQP_PASS, AMQP_VHOST);
    $channel = $connection->channel();
    /*
        The following code is the same both in the consumer and the producer.
        In this way we are sure we always have a queue to consume from and an
            exchange where to publish messages.
    */
    /*
        name: $queue
        passive: false
        durable: true // the queue will survive server restarts
        exclusive: false // the queue can be accessed in other channels
        auto_delete: false //the queue won't be deleted once the channel is closed.
    */
    $channel->queue_declare($queue, false, true, false, false);
    /*
        name: $exchange
        type: direct
        passive: false
        durable: true // the exchange will survive server restarts
        auto_delete: false //the exchange won't be deleted once the channel is closed.
    */
    $channel->exchange_declare($exchange, 'direct', false, true, false);
    $channel->queue_bind($queue, $exchange);
    
    /*
        queue: Queue from where to get the messages
        consumer_tag: Consumer identifier
        no_local: Don't receive messages published by this consumer.
        no_ack: Tells the server if the consumer will acknowledge the messages.
        exclusive: Request exclusive consumer access, meaning only this consumer can access the queue
        nowait:
        callback: A PHP Callback
    */
    $channel->basic_consume($queue, $consumerTag, false, false, false, false, 'process_message');

    register_shutdown_function('shutdown', $channel, $connection);
    /** 
    * 循环等待消息 
    * Loop as long as the channel has callbacks registered
    */
    while (count($channel->callbacks)) {
        $channel->wait();
    }
};

/** 关闭连接回调
 * @param \PhpAmqpLib\Channel\AMQPChannel $channel
 * @param \PhpAmqpLib\Connection\AbstractConnection $connection
 */
function shutdown($channel, $connection)
{
    $channel->close();
    $connection->close();
}


/** 消息回调函数
 * @param \PhpAmqpLib\Message\AMQPMessage $message
 */
function process_message($message)
{
    //获取消息内容
    $messbody =  $message->body;
    //解码
    $mess = json_decode(base64_decode($messbody), true);
    /*===mess===//
    ** Service : 当前系统服务名称 
    ** Method : 当前系统调用的方法
    ** Args : 当前系统方法中的参数
    */
    $res = run($mess['Service'],$mess['Method'],$mess['Args']);
    if($res !== true){
        echo  $res;
        return false;//必须return false 否则就被消费了
    }else{
        echo '成功！';
    }  
    $message->delivery_info['channel']->basic_ack($message->delivery_info['delivery_tag']);
    // Send a message with the string "quit" to cancel the consumer.
    if ($message->body === 'quit') {
        $message->delivery_info['channel']->basic_cancel($message->delivery_info['consumer_tag']);
    }
    }

/*执行推送服务
** 如果双方在同一台服务器上 那么tcp端口不能重复使用
** 比如说商城使用1236端口，结算可使用1237
*/
function run($class,$method,$para=array())
{   

	//由于与服务端通信都经过此地，所以$_SESSION和$_POST的东西都在这个地方传入；
	if(isset($para['data']['SESSION'])) return 'SESSION不能作为键';
 	if(isset($para['data']['POST'])) return 'POST不能作为键';
	$para['data']['SESSION']=(isset($_SESSION) && $_SESSION)?$_SESSION:null;
	$para['data']['POST']=$_POST?I('post.'):null;
    $client = stream_socket_client("tcp://127.0.0.1:1236", $err_no, $err_msg, 5);
    if(!$client)
    {
        exit($err_msg);
    }
    // 一个邮件任务
    $message = array(
        'class' => $class,
        'method' => $method,
        'args' => $para,
    );
    // 数据末尾加一个换行，使其符合Text协议。使用json编码
    $message = json_encode($message)."\n";
    $message = strlen($message)."\n".$message;
    // 向队列发送任务，让队列慢慢去执行
    fwrite($client, $message);
    // 队列返回的结果，这个结果是立即返回的
    $read=fread($client, 8192);
    fclose($client);
    return unserialize($read);
}


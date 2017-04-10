<?php
/**
 * 对接以结算为主，此服务一般用在结算，用于接收商城发送的RPC消息内容.
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
use \Vendor\PhpAmqpLib\Message\AMQPMessage;
use \Vendor\PhpAmqpLib\Message\MsgPublisher;



$consumer = new Worker();
// 慢任务，消费者的进程数可以开多一些
$consumer->count = 1;
/**
 * 进程启动阻塞式的从队列中读取数据并处理
 */
$consumer->closeTime = 0;
$consumer->onWorkerStart = function($consumer)
{
    //定义队列名称    
    $queue = 'rpc_queue';
    //开启连接
    $connection = new AMQPStreamConnection(AMQP_HOST, AMQP_PORT, AMQP_USER, AMQP_PASS, AMQP_VHOST);
    $channel = $connection->channel();
    $channel->queue_declare($queue, false, false, false, false);
    
    //echo " [x] Awaiting RPC requests\n";
    
    $callback = function($req) {
    	$messageBody = $req->body;//获取消息内容
    	//echo " [.] apiProcess(", $messageBody, ")\n";
    	$msg = new AMQPMessage(
    		(string) apiProcess($messageBody),
    		array('correlation_id' => $req->get('correlation_id'))
    		);
    	$req->delivery_info['channel']->basic_publish(
    		$msg, '', $req->get('reply_to'));
    	$req->delivery_info['channel']->basic_ack(
    		$req->delivery_info['delivery_tag']);
    };
    //限制：每次最多给一个消费者发送1条消息
    $channel->basic_qos(null, 1, null);
    $channel->basic_consume($queue, '', false, false, false, false, $callback);
    while(count($channel->callbacks)) {
        $channel->wait();
    }
    $channel->close();
    $connection->close();


};
//对接信息处理
function apiProcess($messbody) {
    //解码
    $mess = json_decode(base64_decode($messbody), true);
    
    /*===mess===//
    ** Service : 当前系统服务名称 
    ** Method : 当前系统调用的方法
    ** Args : 当前系统方法中的参数
    ** oppositeArg:对方系统参数
    */
    $res = run($mess['Service'],$mess['Method'],$mess['Args']);
    if(gettype($res)=='string'){
        return $res;
    }else{
        //需要另外推送给对方的消息重新编码再传输 (这个消息主体是对方在发送rpc消息时一并传过来的)
        $oppositeMessBody = base64_encode(json_encode($mess['oppositeArg']));
        //rpc消息回到处理成功后另外推送消息至对方
        $msgPublisher = new MsgPublisher();
        $msgPublisher->publisher($oppositeMessBody);
        return true;
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
    $client = stream_socket_client("tcp://127.0.0.1:1237", $err_no, $err_msg, 5);
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



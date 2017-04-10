<?php
namespace Vendor\PhpAmqpLib\Message;

use Vendor\PhpAmqpLib\Message\AMQPMessage;
use Vendor\PhpAmqpLib\Wire\GenericContent;
use Vendor\PhpAmqpLib\Connection\AMQPStreamConnection;
/**
 *  发送消息
 */
class MsgPublisher {
	/*处理成功后需要另外发送消息给对方
    ** $paraData
    ** Service : 当前系统服务名称 
    ** Method : 当前系统调用的方法
    ** Args : 当前系统方法中的参数
    */
    function publisher($paraData)
    {
        $exchange = 'router';
        $queue = 'msgs';
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
        /** 
        * 发布消息到消息队列 
        */ 
        $messageBody = $paraData;//消息主体
        $message = new AMQPMessage($messageBody, array('content_type' => 'text/plain', 'delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT));
        $channel->basic_publish($message, $exchange);
        $channel->close();
        $connection->close();

    }

}

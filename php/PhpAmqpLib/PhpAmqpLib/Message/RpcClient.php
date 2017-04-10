<?php
namespace Vendor\PhpAmqpLib\Message;

use Vendor\PhpAmqpLib\Message\AMQPMessage;
use Vendor\PhpAmqpLib\Wire\GenericContent;
use Vendor\PhpAmqpLib\Connection\AMQPStreamConnection;
/**
 * Remote procedure call (RPC)远程过程调用 发送消息
 */
class RpcClient {
	private $connection;
	private $channel;
	private $callback_queue;
	private $response;
	private $corr_id;
	public function __construct() {
		$this->connection = new AMQPStreamConnection(AMQP_HOST, AMQP_PORT, AMQP_USER, AMQP_PASS, AMQP_VHOST);
		$this->channel = $this->connection->channel();
		list($this->callback_queue, ,) = $this->channel->queue_declare(
			"", false, false, true, false);
		$this->channel->basic_consume(
			$this->callback_queue, '', false, false, false, false,
			array($this, 'on_response'));
	}
	public function on_response($rep) {
		if($rep->get('correlation_id') == $this->corr_id) {
			$this->response = $rep->body;
		}
	}
	public function call($n) {
		$this->response = null;
		$this->corr_id = uniqid();
		$msg = new AMQPMessage(
			(string) $n,
			array('correlation_id' => $this->corr_id,
			      'reply_to' => $this->callback_queue)
			);
		$this->channel->basic_publish($msg, '', 'rpc_queue');
		while(is_null($this->response)) {
            //echo " wait...\n";
			$this->channel->wait();
		}
		return $this->response;
	}
}

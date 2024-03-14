<?php

require_once __DIR__ . '/vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;

$host = 'localhost';
$port = 5672;
$user = 'guest';
$password = 'guest';
$connection = new AMQPStreamConnection($host, $port, $user, $password);
$channel = $connection->channel();

$channel->queue_declare('minha_fila');

$callback = function ($msg) {
    echo "Mensagem Recebida: '" . $msg->body . "'\n";
};

$queue = 'minha_fila';
$consumer_tag = '';
$no_local = false;
$no_ack = true;
$exclusive = false;
$nowait = false;
$channel->basic_consume($queue, $consumer_tag, $no_local, $no_ack, $exclusive, $nowait, $callback);

while ($channel->is_consuming()) {
    $channel->wait();
}

$channel->close();
$connection->close();


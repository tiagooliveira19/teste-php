<?php

require_once __DIR__ . '/vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

$host = 'localhost';
$port = 5672;
$user = 'guest';
$password = 'guest';
$connection = new AMQPStreamConnection($host, $port, $user, $password);
$channel = $connection->channel();

$channel->queue_declare('minha_fila');

$content = 'Primeira Mensagem!';
$msg = new AMQPMessage($content);

$exchange = '';
$routingKey = 'minha_fila';
$channel->basic_publish($msg, $exchange, $routingKey);

echo "Mensagem Enviada: '" . $content . "'\n";

$channel->close();
$connection->close();

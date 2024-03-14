<?php

require_once __DIR__ . '/vendor/autoload.php';

// Importação de classes
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

// Conexão para realizar comunicação com o RabbitMQ
$host = 'localhost';
$port = 5672;
$user = 'guest';
$password = 'guest';
$connection = new AMQPStreamConnection($host, $port, $user, $password);

// Criação de canal para comunicação
$channel = $connection->channel();

// Declaração de fila
$channel->queue_declare('minha_fila');

// Criação de mensagem
$content = 'Primeira Mensagem!';
$msg = new AMQPMessage($content);

// Publicação de mensagem enviando a mesma para a fila criada
$exchange = '';
$routingKey = 'minha_fila';
$channel->basic_publish($msg, $exchange, $routingKey);

echo "Mensagem Enviada: '" . $content . "'\n";

// Fechamento de canal e conexão
$channel->close();
$connection->close();

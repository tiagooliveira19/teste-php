<?php

require_once __DIR__ . '/vendor/autoload.php';

// Importação de classe
use PhpAmqpLib\Connection\AMQPStreamConnection;

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

// Criação de função responsável pelo processamento da mensagem
$callback = function ($msg) {
    echo "Mensagem Recebida: '" . $msg->body . "'\n";
};

// Criação de função de consumo básico, passando o nome da fila e função de processamento
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

// Fechamento de canal e conexão
$channel->close();
$connection->close();

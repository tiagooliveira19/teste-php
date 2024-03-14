<?php

/**
 * A interface Command declara um método para executar um comando.
 */
interface Command
{
    public function execute(): void;
}

/**
 * Alguns comandos podem implementar operações simples por conta própria.
 */
class SimpleCommand implements Command
{
    private $payload;

    public function __construct(string $payload)
    {
        $this->payload = $payload;
    }

    public function execute(): void
    {
        echo "<b>SimpleCommand:</b> See, I can do simple things like printing (" . $this->payload . ")<br>";
    }
}

/**
 * No entanto, alguns comandos podem delegar operações mais complexas a outros objetos, chamados "receivers."
 */
class ComplexCommand implements Command
{
    /**
     * @var Receiver
     */
    private $receiver;

    /**
     * Context data, required for launching the receiver's methods.
     */
    private $a;

    private $b;

    /**
     * Comandos complexos podem aceitar um ou vários objetos receptores junto com quaisquer dados de contexto por meio do construtor.
     */
    public function __construct(Receiver $receiver, string $a, string $b)
    {
        $this->receiver = $receiver;
        $this->a = $a;
        $this->b = $b;
    }

    /**
     * Os comandos podem ser delegados a qualquer método de um receptor.
     */
    public function execute(): void
    {
        echo "<b>ComplexCommand:</b> Complex stuff should be done by a receiver object.<br>";
        $this->receiver->doSomething($this->a);
        $this->receiver->doSomethingElse($this->b);
    }
}

/**
 * As classes Receiver contêm uma lógica de negócios importante. Sabem realizar
 * todo o tipo de operações associadas à execução de um pedido. Na verdade, qualquer classe pode servir como Receptora.
 */
class Receiver
{
    public function doSomething(string $a): void
    {
        echo "<b>Receiver:</b> Working on (" . $a . ".)<br>";
    }

    public function doSomethingElse(string $b): void
    {
        echo "<b>Receiver:</b> Also working on (" . $b . ".)<br>";
    }
}

/**
 * O Invoker está associado a um ou vários comandos. Ele envia uma solicitação ao comando.
 */
class Invoker
{
    /**
     * @var Command
     */
    private $onStart;

    /**
     * @var Command
     */
    private $onFinish;

    /**
     * Initialize commands.
     */
    public function setOnStart(Command $command): void
    {
        $this->onStart = $command;
    }

    public function setOnFinish(Command $command): void
    {
        $this->onFinish = $command;
    }

    /**
     * O Invoker não depende de comandos concretos ou classes receptoras. O Invoker passa uma solicitação para um receptor indiretamente, executando um comando.
     */
    public function doSomethingImportant(): void
    {
        echo "<b>Invoker:</b> Does anybody want something done before I begin?<br>";
        if ($this->onStart instanceof Command) {
            $this->onStart->execute();
        }

        echo "<b>Invoker:</b> ...doing something really important...<br>";

        echo "<b>Invoker:</b> Does anybody want something done after I finish?<br>";
        if ($this->onFinish instanceof Command) {
            $this->onFinish->execute();
        }
    }
}

/**
 * O código do cliente pode parametrizar um invocador com qualquer comando.
 */
$invoker = new Invoker();
$invoker->setOnStart(new SimpleCommand("Say Hi!"));
$receiver = new Receiver();
$invoker->setOnFinish(new ComplexCommand($receiver, "Send email", "Save report"));

$invoker->doSomethingImportant();

<?php

/* Questão 1 */
// Verifica se o número é primo
function checkPrime($number)
{
    if ($number == 1) {
        return false;
    }

    for ($i = 2; $i * $i <= $number; $i++) {
        if ($number % $i == 0) {
            return false;
        }
    }

    return true;
}

/*
    Método para iterar o loop de l a r
    Se o número atual for primo, soma o valor
*/
function primeSum($l, $r)
{
    $sum = 0;

    for ($i = $r; $i >= $l; $i--) {

        // Verifique se número é primo
        $isPrime = checkPrime($i);
        if ($isPrime) {

            // Soma o número primo
            $sum = $sum + $i;
        }
    }

    return $sum;
}

$l = $_GET['first-number'] ?? '';
$r = $_GET['second-number'] ?? '';

/* Questão 2 */
$tree = [12, 13, 15, 19, 24, 28, 39, 57, 59, 63, 67, 69, 74];

// Busca key do valor passado
function binarySearch(array $tree, $item)
{

    $start = 0;
    $end = count($tree) - 1;

    while ($start <= $end) {

        $middle = ceil(($start + $end) / 2);

        $guess = $tree[$middle];

        if ($guess == $item) {
            return $middle;
        }

        if ($guess > $item) {
            $end = $middle - 1;
        } else {
            $start = $middle + 1;
        }
    }

    return null;
}

$element = $_GET['element'] ?? '';

/* Questão 4 */
// Limpa campos imputados
function cleanInputs($login, $senha)
{
    // Função para limpar string, não são permitidos símbolos
    $cleanLogin = preg_replace('/[^[:alpha:]_]/', '', $login);

    // Função para limpar string, retira todos os caracteres especiais de uma variável
    $cleanSenha = preg_replace('/[^[:alnum:]_]/', '', $senha);

    $cleanInputs = '<b>Login:</b> ' . $cleanLogin . '<br>' . '<b>Senha:</b> ' . $cleanSenha . '<br>';

    return $cleanInputs;
}

$login = $_GET['login'] ?? '';
$senha = $_GET['senha'] ?? '';

// Um teste de or '1='1;
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Teste Dev Backend</title>

    <style>
        .m-15 {
            margin: 15px;
        }

        .d-flex {
            display: flex;
        }

        code {
            font-size: 1em !important;
        }

        a {
            text-decoration: none;
            color: inherit;
            font-weight: 600;
        }

        a:hover {
            opacity: 0.7;
            color: inherit;
        }
    </style>
</head>
<body>

<div class="container-fluid m-15">

    <h1>Respostas</h1>

    <div class="row mt-5">

        <h4>Questão 1</h4>

        <form class="d-flex" action="/index.php" method="get">

            <div class="col-md-2 mt-3">
                <label for="first-number" class="form-label">Primeiro Número</label>
                <input type="text" class="form-control" id="first-number" name="first-number" placeholder="Primeiro Número" required>
            </div>

            <div class="col-md-2 mt-3 ms-4">
                <label for="second-number" class="form-label">Segundo Número</label>
                <input type="text" class="form-control" id="second-number" name="second-number" placeholder="Segundo Número" required>
            </div>

            <div class="col-md-2 mt-3 ms-4" style="padding-top: 30px;">
                <button type="submit" class="btn btn-primary">Enviar</button>
                <button type="reset" class="btn btn-success clean-page">Limpar</button>
            </div>
        </form>

        <?php if (!empty($l) && !empty($r)) { ?>
            <span class="mt-3"><b>Soma de números primos no intervalo (<?php echo $l . '-' . $r; ?>):</b> <?php echo primeSum($l, $r); ?></span>
        <?php } ?>
    </div>

    <div class="row mt-5">

        <h4>Questão 2</h4>

        <div class="col-md-3 mt-3">
            <span><b>Array: </b> [12, 13, 15, 19, 24, 28, 39, 57, 59, 63, 67, 69, 74]</span>
        </div>

        <div class="col-md-2 mt-2 ms-2">
            <select class="form-control" id="array-element">
                <option value="">Selecione o Elemento</option>
                <option value="12">12</option>
                <option value="13">13</option>
                <option value="15">15</option>
                <option value="19">19</option>
                <option value="24">24</option>
                <option value="28">28</option>
                <option value="39">39</option>
                <option value="57">57</option>
                <option value="59">59</option>
                <option value="63">63</option>
                <option value="67">67</option>
                <option value="69">69</option>
                <option value="74">74</option>
            </select>
        </div>

        <div class="col-md-2 mt-2 ms-2">
            <button type="reset" class="btn btn-success clean-page">Limpar</button>
        </div>

        <?php if (!empty($element)) { ?>
            <span class="mt-3"><b>Elemento:</b> <?php echo $element; ?></span>
            <span class="mt-3"><b>ID (key) Elemento:</b> <?php echo binarySearch($tree, $element); ?></span>
        <?php } ?>
    </div>

    <div class="row mt-5">

        <h4>Questão 3</h4>

        <p class="mt-3">
            Implementação realizada na classe <code>Command</code>.<br>
            <a href="http://localhost/Command.php" target="_blank">Clique aqui para ver a saída...</a>
        </p>
    </div>

    <div class="row mt-5">

        <h4>Questão 4</h4>

        <form class="d-flex" action="/index.php" method="get">

            <div class="col-md-2 mt-3">
                <label for="login" class="form-label">Login</label>
                <input type="text" class="form-control" id="login" name="login" placeholder="Login" required>
            </div>

            <div class="col-md-2 mt-3 ms-4">
                <label for="senha" class="form-label">Senha</label>
                <input type="text" class="form-control" id="senha" name="senha" placeholder="Senha" required>
            </div>

            <div class="col-md-2 mt-3 ms-4" style="padding-top: 30px;">
                <button type="submit" class="btn btn-primary">Enviar</button>
                <button type="reset" class="btn btn-success clean-page">Limpar</button>
            </div>
        </form>

        <?php if (!empty($login) && !empty($senha)) { ?>
            <span class="mt-3">
                <b>Login Imputado:</b> <?php echo $login; ?><br>
                <b>Senha Imputada:</b> <?php echo $senha; ?><br>
            </span>

            <span class="mt-3">
                <?php echo cleanInputs($login, $senha); ?>
            </span>
        <?php } ?>
    </div>

    <div class="row mt-5 mb-5">

        <h4>Questão 5</h4>

        <h6 class="mt-3">Configurando RabbitMQ</h6>

        <p class="mt-3">
            Para realizar o teste da questão 5 é necessário ter o <code>Docker</code> em seu computador para realizar a instalção do <code>RabbitMQ</code>.<br>
            Rode o seguinte comando no seu terminal: <code>docker run -d --hostname my-rabbit --name rabbitmq -p 15672:15672 -p 5672:5672 rabbitmq:management-alpine</code>
        </p>

        <p>
            O <code>RabbitMQ</code> possui uma interface para gerenciamento, você pode acessar no endereço
            <a href="http://localhost:15672" target="_blank">http://localhost:15672</a>. Use <code>guest</code> como usuário e senha para realizar o login.
        </p>

        <h6 class="mt-3">Configurando PHP</h6>

        <p class="mt-3">
            Primeiro é necessário se certificar que o seu <code>PHP</code> possui as seguintes extensões <code>ext-bcmath, ext-sockets</code>.<br>
            Caso seja necessário habilita-las, basta descomentar a chamanda das mesmas no seu arquivo <code>php.ini</code>
        </p>

        <p>
            Após a instalação das extensões é necessário instalar a biblioteca utilizada para trabalhar com <code>AMQP</code> que é o protocolo utilizado pelo <code>RabbitMQ</code>.<br>
            Rode o seguinte comando no seu terminal: <code>composer require php-amqplib/php-amqplib</code>
        </p>

        <h6 class="mt-3">Testando o Script</h6>

        <p class="mt-3">
            O script de envio de mensagem foi implementado no arquivo <code>sender</code>.<br>
            Para executar o script, rode o seguinte comando no seu terminal: <code>php sender.php</code>
        </p>

        <p>
            Para ver a mensagem enviada, acesse o gerenciador do  <code>RabbitMQ</code> no endereço
            <a href="http://localhost:15672/#/queues" target="_blank">http://localhost:15672/#/queues</a>
        </p>

        <p>
            O script de processamento e consumo de mensagem foi implementado no arquivo <code>consumer</code>.<br>
            Para executar o script, rode o seguinte comando no seu terminal: <code>php consumer.php</code>
        </p>

        <p>
            Para ver se a mensagem foi consumida e não está mais na fila, acesse o gerenciador do  <code>RabbitMQ</code> no endereço
            <a href="http://localhost:15672/#/queues" target="_blank">http://localhost:15672/#/queues</a>
        </p>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>

    $(document).ready(function () {

        $('#array-element').change(function () {

            let element = $("#array-element option:selected").val();

            if (element) {
                window.location.href = 'http://localhost/?element=' + element;
            }
        });

        $('.clean-page').click(function () {
            window.location.href = 'http://localhost/';
        });
    });
</script>
</body>
</html>

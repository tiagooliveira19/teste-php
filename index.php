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

// echo 'Inicio: ' . $l . '<br>';
// echo 'Fim: ' . $r . '<br>';
// echo 'Soma de números primos no intervalo: ' . primeSum($l, $r) . '<br><br><br>';

/* Questão 2 */
$tree = [12, 13, 15, 19, 24, 28, 39, 57, 59, 63, 67, 69, 74];

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

// $element = 69;

// echo 'Array: [12, 13, 15, 19, 24, 28, 39, 57, 59, 63, 67, 69, 74]' . '<br>';
// echo 'Elemento: ' . $element . '<br>';
// echo 'ID (key) elemento: ' . binarySearch($tree, 69);

/* Questão 3 */
// echo '<h1>Questão 3</h1>';
// echo '<a href="http://localhost/Command.php" style="text-decoration: none; font-size: 25px;">Clique para ver a saída...</a>';

/* Questão 4 */
function cleanInputs($login, $senha)
{
    // Função para limpar string, não são permitidos símbolos
    $cleanLogin = preg_replace('/[^[:alpha:]_]/', '', $login);

    // Função para limpar string, retira todos os caracteres especiais de uma variável
    $cleanSenha = preg_replace('/[^[:alnum:]_]/', '', $senha);

    $cleanInputs = '<b>Login:</b> ' . $cleanLogin . '<br>' . '<b>Senha:</b> ' . $cleanSenha . '<br>';

    return $cleanInputs;
}

$login = "Um teste de or '1='1;";
$senha = "Um teste de or '1='1;";

// echo '<b>Login Inputado:</b> ' . $login . '<br>' . '<b>Senha Inputada:</b> ' . $senha . '<br><br>';
// echo cleanInputs($login, $senha);
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
                alert(element);
            }
        });
    });
</script>
</body>
</html>

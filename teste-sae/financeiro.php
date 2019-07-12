<?php
require 'banco.php';

$id = 0;

if (!empty($_GET['id'])) {
    $id = $_REQUEST['id'];

    $pdo = Banco::conectar();

    $sql = "SELECT SUM(valor)as 'valor' FROM poltrona WHERE status = 'A' AND id_espetaculo = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    $valor = $q->fetch(PDO::FETCH_ASSOC);
    $valor = $valor['valor'] = !empty($valor['valor']) ? number_format($valor['valor'], 2, ",", ".") : "0.00";

    unset($sql);

    $sql = "SELECT nome FROM espetaculo WHERE id = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    $nome = $q->fetch(PDO::FETCH_ASSOC);

    Banco::desconectar();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

    <head>
        <meta charset="utf-8">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <title>Valor da arrecadação do Espetáculo:<?= $nome['nome'] ?> </title>
    </head>

    <body>
        <div class="container">
            <div class="span10 offset1">
                <div class="row">
                    <div class="col-lg-12 ">
                        <br>
                        <h3 class="well">Valor da arrecadação do Espetáculo: <span class="badge badge-success"><?= strtoupper($nome['nome']) ?></span> </h3>
                    </div>
                </div>
                <div class="alert alert-success">R$ <?= $valor ?></div>
                <div class="form actions">
                    <a href="index.php" type="btn" class="btn btn-default">Voltar</a>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <!-- Latest compiled and minified JavaScript -->
        <script src="assets/js/bootstrap.min.js"></script>
    </body>

</html>

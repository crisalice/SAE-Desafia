<?php
require 'banco.php';

$id = 0;

if (!empty($_GET['id'])) {
    $id = $_REQUEST['id'];
}

if (!empty($_POST['id'])) {
    $id = $_POST['id'];

    $status = 'E';

    $pdo = Banco::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "UPDATE poltrona set status = ? WHERE id = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($status, $id));
    Banco::desconectar();
    header("Location: reserva.php?id=$id");
}
?>

<!DOCTYPE html>
<html lang="pt-br">

    <head>
        <meta charset="utf-8">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <title>Cancelar Reserva</title>
    </head>

    <body>
        <div class="container">
            <div class="span10 offset1">
                <div class="row">
                    <h3 class="well">Cancelar Reserva</h3>
                </div>
                <form class="form-horizontal" action="cancela_reserva.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $id; ?>" />
                    <div class="alert alert-danger"> Deseja cancelar a Reserva?
                    </div>
                    <div class="form actions">
                        <button type="submit" class="btn btn-danger">Sim</button>
                        <a href="index.php" type="btn" class="btn btn-default">Não</a>
                    </div>
                </form>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <!-- Latest compiled and minified JavaScript -->
        <script src="assets/js/bootstrap.min.js"></script>
    </body>

</html>
<?php
require 'banco.php';
$id = null;

if (!empty($_GET['id'])) {
    $id = $_REQUEST['id'];
}
if (!empty($_POST)) {

    require_once 'valida_reserva.php';

    //Inserindo no Banco:
    if ($validacao) {
        $pdo = Banco::conectar();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO poltrona (id_espetaculo, nome_reserva, status) VALUES(?,?,?)";
        $q = $pdo->prepare($sql);
        $q->execute(array($id_espetaculo, $nome, $status));
        Banco::desconectar();
    
        header("Location: reserva.php?id=$id");
    }
}

if (null == $id && empty($_POST)) {
    header("Location: index.php");
} else {
    $pdo = Banco::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM espetaculo where id = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    $data = $q->fetch(PDO::FETCH_ASSOC);

    // pegar reservados
    $sql = 'SELECT count(*) as "total" FROM poltrona WHERE status = "A" AND id_espetaculo = ?';
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    $reservados = $q->fetch(PDO::FETCH_ASSOC);

    // contar disponíveis
    $disponiveis = floatval($data['qtde_lugares']) - floatval($reservados['total']);

    Banco::desconectar();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

    <head>
        <meta charset="utf-8">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <title>Reservar poltrona</title>
    </head>

    <body>
        <div class="container">
            <div class="span10 offset1">
                <div class="card">
                    <div class="card-header">
                        <h3 class="well">Reservar poltrona</h3>
                    </div>
                    <div class="container">

                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Espetaculo</th>
                                    <th scope="col">Data</th>
                                    <th scope="col">Hora</th>
                                    <th scope="col">Total Lugares</th>
                                    <th scope="col">Disponíveis</th>
                                    <th scope="col">Reservados</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row"><?= $data['nome'] ?></th>
                                    <th scope="row"><?= date("d/m/Y", strtotime($data['data'])) ?></th>
                                    <th scope="row"><?= $data['hora'] ?></th>
                                    <th scope="row"><?= $data['qtde_lugares'] ?></th>
                                    <td><?= $disponiveis ?></td>
                                    <td><?= $reservados['total'] ?></td>
                            </tbody>
                        </table>

                        <br/>
                        <form class="form-horizontal" action="reserva.php" method="post">
                            <input type="hidden" name="id_espetaculo" value="<?= $id ?>">
                            <div class="control-group <?php echo!empty($nomeErro) ? 'error ' : ''; ?>">
                                <label class="control-label">Nome da Reserva</label>
                                <div class="controls">
                                    <input size="50" class="form-control" name="nome" type="text" placeholder="Nome Reserva" required="" value="<?php echo!empty($nome) ? $nome : ''; ?>">
                                    <?php if (!empty($nomeErro)): ?>
                                        <span class="help-inline"><?= $nomeErro ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="form-actions">
                                <br/>
                                <button type="submit" class="btn btn-success">Reservar</button>
                                <a href="index.php" type="btn" class="btn btn-default">Voltar</a>
                            </div>
                        </form>

                        <br/><br/>

                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Espetaculo</th>
                                    <th scope="col">Nome Reserva</th>
                                    <th scope="col">Data Reserva</th>
                                    <th scope="col">Ação</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $pdo = Banco::conectar();
                                $sql = 'SELECT * FROM poltrona WHERE status = "A" ORDER BY id DESC';

                                foreach ($pdo->query($sql)as $res):
                                    ?> 
                                    <tr>
                                        <td scope = "row"><?= $res['id_espetaculo']?></td>
                                        <td scope="row"><?= $res['nome_reserva'] ?></td>
                                        <td scope="row"><?= date("d/m/Y H:i:s", strtotime($res['criado_em'])) ?></td>
                                        <td scope="row"><a class="btn btn-danger" href="cancela_reserva.php?id=<?= $res['id'] ?>">Cancelar</a></td>
                                        
                                    </tr>
                                    <?php
                                endforeach;
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="assets/js/bootstrap.min.js"></script>
</body>

</html>

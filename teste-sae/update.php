<?php
require_once 'banco.php';

$id = null;
if (!empty($_GET['id'])) {
    $id = $_REQUEST['id'];
}

if (null == $id) {
    header("Location: index.php");
}

if (!empty($_POST)) {

    require_once 'valida.php';

    // update data
    if ($validacao) {
        $pdo = Banco::conectar();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE espetaculo  set nome = ?, data = ?, hora = ?, qtde_lugares = ? WHERE id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($nome, $data, $hora, $qtde, $id));
        Banco::desconectar();
        header("Location: index.php");
    }
} else {
    $pdo = Banco::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM espetaculo where id = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    $dados = $q->fetch(PDO::FETCH_ASSOC);

    $nome = $dados['nome'];
    $data = $dados['data'];
    $hora = $dados['hora'];
    $qtde = $dados['qtde_lugares'];

    Banco::desconectar();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

    <head>
        <meta charset="utf-8">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <title>Atualizar Espetaculo</title>
    </head>

    <body>
        <div class="container">

            <div class="span10 offset1">
                <div class="card">
                    <div class="card-header">
                        <h3 class="well"> Atualizar Espetaculo </h3>
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal" action="update.php?id=<?php echo $id ?>" method="post">

                            <div class="control-group <?php echo!empty($nomeErro) ? 'error' : ''; ?>">
                                <label class="control-label">Nome</label>
                                <div class="controls">
                                    <input name="nome" class="form-control" size="50" type="text" placeholder="Nome" value="<?php echo!empty($nome) ? $nome : ''; ?>">
                                    <?php if (!empty($nomeErro)): ?>
                                        <span class="help-inline"><?php echo $nomeErro; ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="control-group <?php echo!empty($dataErro) ? 'error' : ''; ?>">
                                <label class="control-label">Data</label>
                                <div class="controls">
                                    <input name="data" class="form-control" size="80" type="text" placeholder="Data" value="<?php echo!empty($data) ? date("d/m/Y", strtotime($data)) : ''; ?>">
                                    <?php if (!empty($dataErro)): ?>
                                        <span class="help-inline"><?php echo $dataErro; ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="control-group <?php echo!empty($horaErro) ? 'error' : ''; ?>">
                                <label class="control-label">Hora</label>
                                <div class="controls">
                                    <input name="hora" class="form-control" size="30" type="text" placeholder="Hora" value="<?php echo!empty($hora) ? $hora : ''; ?>">
                                    <?php if (!empty($horaErro)): ?>
                                        <span class="help-inline"><?php echo $horaErro; ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="control-group <?php echo!empty($qtde) ? 'error' : ''; ?>">
                                <label class="control-label">Quantidade de lugares</label>
                                <div class="controls">
                                    <input name="qtde" class="form-control" size="40" type="number" placeholder="Quantidade de lugares" value="<?php echo!empty($qtde) ? $qtde : ''; ?>">
                                    <?php if (!empty($qtdeErro)): ?>
                                        <span class="help-inline"><?php echo $qtdeErro; ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <br/>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-warning">Atualizar</button>
                                <a href="index.php" type="btn" class="btn btn-default">Voltar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    </body>
</html>

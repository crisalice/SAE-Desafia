<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/jquery-ui.css" media="all" />
        <title>Adicionar Espetaculo</title>
    </head>

    <body>
        <div class="container">
            <div clas="span10 offset1">
                <div class="card">
                    <div class="card-header">
                        <h3 class="well"> Adicionar Espetaculo </h3>
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal" action="create.php" method="post">

                            <div class="control-group <?php echo!empty($nomeErro) ? 'error ' : ''; ?>">
                                <label class="control-label">Espetaculo</label>
                                <div class="controls">
                                    <input size="50" class="form-control" name="nome" type="text" placeholder="Nome" required="" value="<?php echo!empty($nome) ? $nome : ''; ?>">
                                    <?php if (!empty($nomeErro)): ?>
                                        <span class="help-inline"><?php echo $nomeErro; ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="control-group <?php echo!empty($dataErro) ? 'error ' : ''; ?>">
                                <label class="control-label">Data</label>
                                <div class="controls">
                                    <input size="80" class="form-control" id="data" name="data" type="text" placeholder="Data" required="" value="<?php echo!empty($data) ? $data : ''; ?>">
                                    <?php if (!empty($dataErro)): ?>
                                        <span class="help-inline"><?php echo $dataErro; ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                              <div class="control-group <?php echo!empty($horaErro) ? 'error ' : ''; ?>">
                                <label class="control-label">Hora</label>
                                <div class="controls">
                                    <input size="35" class="form-control" id="hora" name="hora" type="datetime" placeholder="Hora" required="" value="<?php echo!empty($hora) ? $hora : ''; ?>">
                                    <?php if (!empty($horaErro)): ?>
                                        <span class="help-inline"><?php echo $horaErro; ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="control-group <?php echo!empty($qtdeErro) ? 'error ' : ''; ?>">
                                <label class="control-label">Email</label>
                                <div class="controls">
                                    <input size="40" class="form-control" name="qtde" type="number" placeholder="Qtde Lugares" required="" value="<?php echo!empty($qtde) ? $qtde : ''; ?>">
                                    <?php if (!empty($qtdeErro)): ?>
                                        <span class="help-inline"><?php echo $qtdeErro; ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="form-actions">
                                <br/>
                                <button type="submit" class="btn btn-success">Adicionar</button>
                                <a href="index.php" type="btn" class="btn btn-default">Voltar</a>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="assets/js/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/js/bootstrap-timepicker.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</body>
<script>
    $(function () {
        $("#data").datepicker({
            dateFormat: 'dd/mm/yy',
            dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
            dayNamesMin: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S', 'D'],
            dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'],
            monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
            monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
            nextText: 'Próximo',
            prevText: 'Anterior'
        });
    });


$('#hora').timepicker({
        showInputs: false,
        defaultTime: '',
        minuteStep: 1,
        disableFocus: true,
        template: 'dropdown',
        showMeridian: false

    });

</script>
</html>

<?php
require 'banco.php';

if (!empty($_POST)) {

    require_once 'valida.php';

    //Inserindo no Banco:
    if ($validacao) {
        $pdo = Banco::conectar();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO espetaculo (nome, data, hora, qtde_lugares, status) VALUES(?,?,?,?,?)";
        $q = $pdo->prepare($sql);
        $q->execute(array($nome, $data, $hora, $qtde, $status));
        Banco::desconectar();
        header("Location: index.php");
    }
}

<!DOCTYPE html>
<html lang="pt-br">

    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <title>Teste SAE Digital</title>
    </head>

    <body>
        <div class="container">
            <div class="jumbotron">
                <div class="row">
                    <h2>Cadastro de Espetaculo <span class="badge badge-secondary">Teste SAE - CRIS</span></h2>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12" align="right"> 
                    <p>
                        <a href="create.php" class="btn btn-success">Adicionar</a>
                    </p>
                </div>
             </div>

            <div class="row">
                <div class="col-lg-12"> 
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Espetaculo</th>
                                <th scope="col">Data</th>
                                <th scope="col">Hora</th>
                                <th scope="col">Total Lugares</th>
                                <th scope="col">Disponíveis</th>
                                <th scope="col">Reservados</th>
                                <th scope="col">Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include 'banco.php';
                            $pdo = Banco::conectar();
                            $sql = 'SELECT * FROM espetaculo WHERE status = "A" ORDER BY id DESC';

                            foreach ($pdo->query($sql)as $row) {

                                // pegar reservados
                                $sql = 'SELECT count(*) as "total" FROM poltrona WHERE status = "A" AND id_espetaculo = ?';
                                $q = $pdo->prepare($sql);
                                $q->execute(array($row['id']));
                                $reservados = $q->fetch(PDO::FETCH_ASSOC);

                                // contar disponíveis
                                $disponiveis = floatval($row['qtde_lugares']) - floatval($reservados['total']);

                                echo '<tr>';
                                echo '<th scope="row">' . $row['id'] . '</th>';
                                echo '<td>' . $row['nome'] . '</td>';
                                echo '<td>' . date("d/m/Y", strtotime($row['data'])) . '</td>';
                                echo '<td>' . $row['hora'] . '</td>';
                                echo '<td align="center">' . $row['qtde_lugares'] . '</td>';
                                echo '<td align="center">' . $disponiveis . '</td>';
                                echo '<td align="center">' . $reservados['total'] . '</td>';
                                echo '<td width=400>';
                                echo '<a class="btn btn-primary" href="reserva.php?id=' . $row['id'] . '">Reserva</a>';
                                echo ' ';
                                echo '<a class="btn btn-warning" href="update.php?id=' . $row['id'] . '">Atualizar</a>';
                                echo ' ';
                                echo '<a class="btn btn-danger" href="delete.php?id=' . $row['id'] . '">Excluir</a>';
                                echo ' ';
                                echo '<a class="btn btn-success" href="financeiro.php?id=' . $row['id'] . '">Financeiro</a>';
                                echo '</td>';
                                echo '</tr>';
                            }
                            Banco::desconectar();
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="assets/js/bootstrap.min.js"></script>
    </body>
</html>

<?php

//Acompanha os erros de validação
$nomeErro = null;

$id_espetaculo = $_POST['id_espetaculo'];
$nome = $_POST['nome'];
$status = 'A';

//Validaçao dos campos:
$validacao = true;
if (empty($nome)) {
    $nomeErro = 'Por favor digite o nome para efetuar a reserva da poltrona!';
    $validacao = false;
}

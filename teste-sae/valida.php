<?php

//Acompanha os erros de validação
$nomeErro = null;
$dataErro = null;
$horaErro = null;
$qtdeErro = null;

$nome = $_POST['nome'];
$dataN = $_POST['data'];
$hora = $_POST['hora'];
$qtde = $_POST['qtde'];
$status = 'A';

//Validaçao dos campos:
$validacao = true;
if (empty($nome)) {
    $nomeErro = 'Por favor digite o nome do espetáculo!';
    $validacao = false;
}

if (empty($dataN)) {
    $dataErro = 'Por favor digite a data do espetáculo!';
    $validacao = false;
}else{
    $data = date("Y-m-d", strtotime($dataN));
}

if (empty($hora)) {
    $$horaErro = 'Por favor digite a hora do espetáculo!';
    $validacao = false;
}

if (empty($qtde)) {
    $qtdeErro = 'Por favor digite a quantidade de lugares do espetáculo!';
    $validacao = false;
}
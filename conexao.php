<?php 
$servidor = 'localhost';
$usuario = 'root';
$senha = '';
$banco = 'listadominio';

$mysqli = new mysqli($servidor, $usuario, $senha, $banco);
# Escolhendo o banco de dados
if (mysqli_connect_errno()) trigger_error(mysqli_connect_error());
?>
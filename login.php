<?php
require_once("banco-usuario.php");
require_once("logica-login.php");

$email = $_POST['email'];
$senha = $_POST['senha'];

$usuario = buscaUsuario($conexao, $email, $senha);

$logado = "";
if ($usuario==null){
    $_SESSION['danger'] = "Falha na autenticação";
}else{
    logarUsuario($usuario['email']);
    $_SESSION['success'] = "Autenticado com sucesso.";
} 
header("Location: index.php");

die();

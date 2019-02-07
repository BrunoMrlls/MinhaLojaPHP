<?php
require_once("conecta.php");
function buscaUsuario($conexao, $email, $senha){ 
    $email = mysqli_real_escape_string($conexao, $email);
    $senha = mysqli_real_escape_string($conexao, $senha);
    $senhaMD5 = md5($senha);
    $query = "SELECT * FROM usua WHERE email='{$email}' AND senha='{$senhaMD5}'"; 
    $resultado = mysqli_query($conexao, $query);
    $usuario = mysqli_fetch_assoc($resultado);
    return $usuario;
}
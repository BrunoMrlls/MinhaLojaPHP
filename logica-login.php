<?php 
session_start();

function verificaUsuario(){
    if ( !isUsuarioLogado() ){
        $_SESSION['danger'] = "Você não tem acesso a essa funcionalidade.";
        header("Location: index.php");
        die();
    }
}

function isUsuarioLogado(){
    return isset($_SESSION['usuario_logado']);
}

function getUsuarioLogado(){
    return isUsuarioLogado() ? $_SESSION['usuario_logado'] : "";
}

function logarUsuario($email){
    $_SESSION["usuario_logado"] = $email;
}

function logout(){
    session_destroy();
    session_start();
}
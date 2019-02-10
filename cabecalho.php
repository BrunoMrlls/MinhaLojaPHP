<?php 
    error_reporting(E_ALL ^ E_NOTICE);
    require_once("logica-login.php");
    require_once("mostra-alerta.php");
    require_once 'class/config.php';
    
    function carregaClasse($nomeDaClasse){
        if (file_exists('class/'.$nomeDaClasse.'.php')) {
            require_once("class/".$nomeDaClasse.".php");
        }
    }

    spl_autoload_register("carregaClasse");

?>
<html>
<head>
    <meta charset="utf-8">
    <title>Minha Loja</title> 
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/loja.css" rel="stylesheet">
</head>
    <body>
        <?php if (isUsuarioLogado()) {?>  
            <div>
                <div class="container">
                    <div>
                        <ul class="nav nav-tabs">  
                            <li class="nav-item"> <a class="nav-link" href="index.php">Inicio</a> </li>
                            <li class="nav-item"> <a class="nav-link" href="produto-lista.php">Listagem de produtos</a> </li>
                            <li class="nav-item"> <a class="nav-link" href="categoria-lista.php">Listagem de categorias</a> </li>
                            <li class="nav-item"> <a class="nav-link" href="contato.php">Contato</a> </li>

                        </ul>
                    </div>
                </div>
            </div>
        <?php } ?>
        <div class="container">
            <div class="principal">
            <?php
                mostraAlerta("danger");
                mostraAlerta("success");
            ?>
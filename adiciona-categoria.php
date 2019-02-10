<?php 
    require_once 'cabecalho.php';

    verificaUsuario();

    $categoria = new Categoria();
    
    $categoria->setNome($_POST['nome']);
    if ( $categoria->inserir() ) {
        $_SESSION['success'] = "Categoria '".$categoria->getNome()."' adicionada com sucesso.";
    } else {
        $_SESSION['danger'] = "Erro: Erro ao inserir categoria.";
    }

    header('Location: categoria-lista.php');

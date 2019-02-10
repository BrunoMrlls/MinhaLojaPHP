<?php
    require_once 'cabecalho.php';
    try{    
        $categoria = new Categoria();
        $categoria->setId($_POST['id']);
        $categoria->setNome($_POST['nome']);

        if ( $categoria->atualizar() ) {
            $_SESSION['success'] = "Categoria atualizada com sucesso.";
        } else {
            $_SESSION['danger'] = "Erro ao atualizar categoria.";
        }
    
        header('Location: categoria-lista.php');
    } catch (Exception $e) {
        Erro::trataErro($e);
    }
?>
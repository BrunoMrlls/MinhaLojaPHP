<?php require_once 'cabecalho.php';
    require_once 'class/Categoria.php';

    $categoria = new Categoria();
    $categoria->setId($_POST['id']);

    if ( $categoria->excluir()) {
        $_SESSION['success'] = "Categoria excluida com sucesso!";
    } else {
        $_SESSION['danger'] = "erro ao excluir categoria!";
    }

    header('Location: categoria-lista.php');
?>
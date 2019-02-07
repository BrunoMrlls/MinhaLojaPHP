<?php
require_once("cabecalho.php");

$id = $_POST['id'];
$produtoDao = new ProdutoDao($conexao);
if ($produtoDao->removeProduto($id)){
    $_SESSION['success'] = "Produto removido com sucesso.";
}else{
    $_SESSION['danger'] = "Erro ao remover: ".mysqli_error($conexao);
}

header("Location: produto-lista.php");
die();
?>
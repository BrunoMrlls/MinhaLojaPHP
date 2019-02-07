<?php
require_once("cabecalho.php"); 

$categoria = new Categoria();
$categoria->setId($_POST['categoria_id']);

$tipoProduto = $_POST['tipoProduto'];
if($tipoProduto=="LivroFisico"){
    $produto = new LivroFisico();
    $produto->setIsbn($_POST['isbn']);
    $produto->setTaxaImpressao($_POST['taxaImpressao']);
}else if ($tipoProduto == "Ebook") {
    $produto = new Ebook();
    $produto->setIsbn($_POST['isbn']);
    $produto->setWaterMark($_POST['waterMark']);    
}else{
    $produto = new Produto();
}
$produto->setId($_POST['id']);
$produto->setNome($_POST['nome']);
$produto->setPreco($_POST['preco']);
$produto->setDescricao($_POST['descricao']);
$produto->setCategoria($categoria);
$produto->setUsado(array_key_exists('usado', $_POST) ? "true" : "false");

$produtoDao = new ProdutoDao($conexao);
if ( $produtoDao->alteraProduto($produto) ) {
    $_SESSION['success'] = "Produto ".$produto->getNome()." R$ ".$produto->getPreco()." alterado com sucesso!";
}else{ 
    $_SESSION['danger'] = "Produto ".$produto->getNome()." não foi alterado. \n".mysqli_error($conexao);
}
header("Location: produto-lista.php");
die();
?>
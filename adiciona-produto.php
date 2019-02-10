<?php
require_once("cabecalho.php");
require_once("logica-login.php");

verificaUsuario();

$categoria = new Categoria();
$categoria->setId($_POST['categoria_id']);
$tipoProduto = $_POST['tipoProduto'];

$taxaImpressao = $_POST['taxaImpressao'];
$waterMark = $_POST['waterMark'];
$isbn = $_POST['isbn'];

if ($tipoProduto == "LivroFisico") {
    $produto = new LivroFisico();
    $produto->setIsbn($isbn);
    $produto->setTaxaImpressao($taxaImpressao);
} else if ($tipoProduto == "Ebook") {
    $produto = new Ebook();
    $produto->setIsbn($isbn);
    $produto->setWaterMark($waterMark);
}else{
    $produto = new Produto();
}

$produto->setNome($_POST['nome']);
$produto->setPreco($_POST['preco']);
$produto->setDescricao($_POST['descricao']);
$produto->setCategoria($categoria);
$produto->setUsado(array_key_exists('usado', $_POST) ? "true" : "false");

$produto->setTipoProduto($_POST['tipoProduto']);
$produtoDao = new ProdutoDao();
if ( $produtoDao->insereProduto($produto) ) {
    $_SESSION['success'] = "Produto ".$produto->getNome().", R$ ".$produto->getPreco()." adicionado com sucesso! ";
}else{ 
    $msgErro = mysqli_error($conexao);    
    $_SESSION['danger'] = "Produto ".$produto->getNome()." não foi adicionado: $msgErro ";
}
header("Location: produto-lista.php");
?>
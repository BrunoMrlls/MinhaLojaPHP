<?php
    $conexao = mysqli_connect("127.0.0.1", "root", "1234", "loja"); 
    $query = "SELECT * FROM produto ORDER BY nome";
    $result = mysqli_query($conexao, $query);
    $produtos = array();
    while ( $produto = mysqli_fetch_assoc($result) ){
        array_push($produtos, $produto);
    }
    // var_dump($produtos);
    // echo $produtos;
?>
<head>
    <title> Listagem de produtos </title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/loja.css" rel="stylesheet">
</head>
<html class="container">
    <table class="table">
        <?php foreach ($produtos as $prod) :?>
            <tr>
                <td>Id:</td>
                <td><p><?=$prod['id']?></p></td>
            <tr>
            <tr>
                <td>Nome:</td>
                <td><p><?=$prod['nome']?></p></td>
            <tr>
            <tr>
                <td>Preço:</td>
                <td><p><?=$prod['preco']?></p></td>
            <tr>
            <tr>
                <td></td>
                <td></td>
            </tr>
        <?php endforeach ?>
    </table>
</html>
<?php 
    require_once("cabecalho.php"); 
    
    $id = $_GET['id'];
    $produtoDao = new ProdutoDao();
    $produto = $produtoDao->buscaProduto($id);
    
    $categoriaDao = new CategoriaDao();
    $categorias = $categoriaDao->listaCategorias();      
    $usado = $produto->getUsado() ? "checked='checked'" : "";
 
?>
<form action="altera-produto.php" method="POST">
    <input type="hidden" name="id" value="<?=$produto->getId()?>">
    <table class="table">
        
        <?php require_once("formulario-produto-base.php");?>      
        
        <tr>
           <td> <input class="btn btn-primary" type="submit" value="Alterar"> </td>
        </td>
    </table>
</form>
<?php require_once("rodape.php"); ?>
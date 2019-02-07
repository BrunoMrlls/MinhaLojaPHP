<?php 
    require_once("cabecalho.php"); 
    
    $categoriaDao = new CategoriaDao($conexao);
    $categorias = $categoriaDao->listaCategorias();

    
    $categoria = new Categoria();
    $produto = new Produto();
    
    $categoria->setId("1");
    $produto->setNome("");
    $produto->setDescricao("");
    $produto->setPreco("");
    $produto->setCategoria($categoria);
    $produto->setUsado(false);
    $usuada = "";
?>
<form action="adiciona-produto.php" method="POST">
    <table class="table">

        <?php require_once("formulario-produto-base.php");?>  
    
        <tr>
           <td> <input class="btn btn-primary" type="submit" value="Cadastrar"> </td>
        </td>
    </table>
</form>
<?php require_once("rodape.php"); ?>
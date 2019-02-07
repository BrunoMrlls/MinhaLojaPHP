<?php 
require_once("cabecalho.php");
verificaUsuario();
?>

 <table class="table table-striped table-bordered">
    <?php
    $produtoDao = new ProdutoDao($conexao);
    $produtos = $produtoDao->listaProdutos();

    foreach ( $produtos as $p ):
        $isbn = $p->temIsbn() ? $p->getIsbn() : '';
        $tipoProduto = get_class($p);
    ?>
        <tr> 
            <td><?=$p->getNome()?></td>
            <td><?=$p->getPreco()?></td>
            <td><?=substr($p->getDescricao(),0,50)?></td>
            <td><?=$p->getCategoria()->getNome()?></td>
            <td><?=$p->calculaImpostro()?></td>
            <td><?=$isbn?></td>
            <td><?=$tipoProduto?></td>
            <td>
               <a class="btn btn-primary" href="produto-altera-formulario.php?id=<?=$p->getId()?>">Alterar</a>
            </td>
            <td> 
                <form action="remove-produto.php" method="POST">
                    <input type="hidden" name="id" value="<?=$p->getId()?>" >
                    <button class="btn btn-danger">Remover</button>
                </form>
            </td>
        </tr>
    <?php
    endforeach
    ?>

<?php require_once("rodape.php"); ?>
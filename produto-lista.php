<?php 
require_once("cabecalho.php");
verificaUsuario();
?>
 <div class="row col-md-4">
    <a class="btn btn-info btn-block" href="produto-formulario.php">Novo Produto</a>
 </div>
 <table class="table table-striped table-bordered">
 <thead>
    <tr>
        <th>Nome</th>
        <th>Preço</th>
        <th>Descrição</th>
        <th>Categoria</th>
        <th>Imposto</th>
        <th>Isbn</th>
        <th>Tipo</th>
        <th>Alterar</th>
        <th>Remover</th>
    </tr>
    <tbody>
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
        <?php endforeach ?>
    </tbody>
<?php require_once("rodape.php"); ?>
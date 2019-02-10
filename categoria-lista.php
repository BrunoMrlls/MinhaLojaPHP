<?php 
    require_once("cabecalho.php");
    verificaUsuario();
    try{
        $categoria = new Categoria();
        $lista = $categoria->listar();
    } catch(Exception $e){
        Erro::trataErro($e);
    }
    
?>
<div class="row col-md-4">
    <a class="btn btn-info btn-block" href="formulario-adiciona-categoria.php">Nova categoria</a>
</div>
<div class="row">
    <div class="col-md-12">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nome</th>
                    <th class="acao">Editar</th>
                    <th class="acao">Excluir</th>
                <tr>
            </thead>
            <tbody>
                <?php foreach ( $lista as $cat ): ?>
                    <tr> 
                        <td><a> <?=$cat['id']?> </a></td>
                        <td><a> <?=$cat['nome']?> </a></td>
                        <td>
                            <a class="btn btn-primary" href="formulario-altera-categoria.php?id=<?=$cat['id']?>">Alterar</a>
                        </td>
                        <td>
                            <form action="remove-categoria.php" method="POST">
                                <input type="hidden" name="id" value="<?=$cat['id']?>" >
                                <button class="btn btn-danger">Remover</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>


<?php require_once("rodape.php"); ?>
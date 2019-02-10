<?php require_once 'cabecalho.php' ?>
<?php require_once 'class/Categoria.php';?>
<?php
    $categoria = new Categoria();
    $categoria->setId($_GET['id']);
    $resultado = $categoria->buscaCategoria();
    $categoria->setNome($resultado['nome']);
?>
<div class="row" >
    <div class="col-md-3">
        <h2>Alterar categoria</h2>
    </div>
</div>

<form action="altera-categoria.php" method="POST">

    <div class="row" >
        <div class="col-md-6 col-md-offset-3"> 
           
            <?php require_once 'formulario-categoria-base.php'; ?>
            
            <input type="submit" class="btn btn-success btn-block" value="Salvar" >
        </div>
    </div>

</form>

<?php require_once 'rodape.php' ?>
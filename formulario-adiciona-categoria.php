<?php require_once 'cabecalho.php' ?>
<?php require_once 'class/Categoria.php';?>
<?php
    $categoria = new Categoria();
    $categoria->setNome('');
?>
<div class="row" >
    <div class="col-md-4">
        <h2> Criar nova categoria</h2>
    </div>
</div>

<form action="adiciona-categoria.php" method="POST">

    <div class="row" >
        <div class="col-md-6 col-md-offset-3"> 
           
            <?php require_once 'formulario-categoria-base.php'; ?>
            
            <input type="submit" class="btn btn-success btn-block" value="Salvar" >
        </div>
    </div>

</form>

<?php require_once 'rodape.php' ?>
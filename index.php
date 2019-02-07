<?php require_once("cabecalho.php");?>
    <h1>Bem Vindo</h1>

    <?php
          if (isUsuarioLogado()){
    ?>
            <p class="alert-success">Você está logado como <?php getUsuarioLogado() ?>
                <a href="logout.php">Deslogar</a>
            </p>
    <?php } else { ?>
        <h2>Acesso</h2>
        <form action="login.php" method="POST">
            <table class="table">
                <tr>
                    <td>Email</td>
                    <td>
                        <input class="form-control" type="email" name="email" >
                    </td>
                </tr>
                <tr>
                    <td>Senha</td>
                    <td>
                        <input class="form-control" type="password" name="senha" >
                        <small class ="text-muted">Senha deve ter no mínimo 8 carateres</small>
                    </td>
                </tr>            
                <tr>
                    <td>
                        <button class="btn btn-primary">Logar</button>
                    </td>
                </tr>
            </table>
        </form>
    <?php }
 require_once("rodape.php"); ?>


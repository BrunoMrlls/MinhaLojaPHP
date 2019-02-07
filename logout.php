<?php
    require_once("logica-login.php");
    logout();
    $_SESSION['success'] = "Deslogado com sucesso.";
    header("Location: index.php");
?>
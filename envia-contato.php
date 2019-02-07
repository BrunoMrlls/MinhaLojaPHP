<?php
session_start();

$nome = $_POST['nome'];
$email = $_POST['email'];
$mensagem = $_POST['mensagem'];

if ( (empty($nome)) || (empty($email)) || (empty($mensagem) ) ) {
    $_SESSION['danger'] = "Parece que você esqueçeu de preencher algum campo para envio do e-mail ... ";
    header("Location: contato.php");
    die();
}
require_once("PHPMailer/PHPMailer.php");
require_once("PHPMailer/SMTP.php");
require_once("PHPMailer/Exception.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

$mail = new PHPMailer();
    try{ 
    $mail->isSMTP();
    $mail->Host='smtp.gmail.com';
    $mail->Port='587';
    $mail->SMTPSercure = 'tls';
    $mail->SMTPAuth=true;
    $mail->Username='brunobritomeireles@gmail.com';
    $mail->Password='password';

    $mail->setFrom("brunobritomeireles@gmail.com", "Administrador da Loja");
    $mail->addAddress("brunobritomeireles@gmail.com");
    $mail->Subject = "Email para contato";
    $mail->msgHTML("<html>de: {$nome}<br/>E-mail: {$email} <br/> Mensagem: {$mensagem}</html>");
    $mail->AltBody = "de: {$nome}\nE-mail: {$email}\nMensagem: {$mensagem}";

    if($mail->send()){
        $_SESSION['success'] = "Mensagem enviada com sucesso.";
        header("Location: index.php");        
    }else{
        $_SESSION['danger'] = "Erro ao enviar mensagem: ".$mail->ErrorInfo;
        header("Location: contato.php");
    }
}catch(Exception $e){
    echo 'Mensagem não pode ser enviada.';
    echo 'Erro: '.$mail->ErrorInfo;
}
die();
<?php
 /**
  * @author Ari Stopassola Junior <arijunior@gmail.com>
  */
setlocale(LC_ALL,"pt_BR");
date_default_timezone_set("Brazil/East");

//Carrega as credenciais de banco de dados e SMTP
if (is_file("./config/global.ini")) {
    $ini = parse_ini_file("./config/global.ini", true);
}
//Se houver um arquivo local de configurações, sobrescreve
if (is_file("./config/local.ini")) {
    $ini = parse_ini_file("./config/local.ini", true);
}

//Autoload do Composer.phar
require "vendor/autoload.php";

//Carrega a classe de e-mail    
$mail = new PHPMailer;

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host         = $ini['SMTP']['host'];  // Specify main and backup SMTP servers
$mail->SMTPAuth     = true;                               // Enable SMTP authentication
$mail->Username     = $ini['SMTP']['user'];                 // SMTP username
$mail->Password     = $ini['SMTP']['pass'];                           // SMTP password
$mail->SMTPSecure   = $ini['SMTP']['cryp'];                            // Enable TLS encryption, `ssl` also accepted
$mail->Port         = $ini['SMTP']['port'];                                    // TCP port to connect to

$mail->setFrom('fernando@f4acessorios.com.br', 'F4 Acessorios');
$mail->addAddress('arijunior@gmail.com', 'Ari Stopassola Junior');     // Add a recipient
$mail->addReplyTo('fernando@f4acessorios.com.br', 'F4 Acessorios');
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Cadastro de clientes do dia';
$mail->Body    = $conteudoHTML;

if(!$mail->send()) {
    echo 'Mensagem não pode ser enviada.';
    echo 'Erro:' . $mail->ErrorInfo;
    echo $mail->Username;
} else {
    echo 'Mensagem ENVIADA';
}
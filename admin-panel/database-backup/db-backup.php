<?php

use PHPMailer\PHPMailer\PHPMailer;

require_once "PHPMailer/PHPMailer.php";
require_once "PHPMailer/SMTP.php";
require_once "PHPMailer/Exception.php";

include_once('Mysqldump/Mysqldump.php');
$dump = new Ifsnop\Mysqldump\Mysqldump('mysql:host=localhost;dbname=himushar_db_akfhf_main', 'himushar_akfhf_admin', 'sH)kH4u7*rYV');

date_default_timezone_set('Asia/Dhaka');
$dateTime = date('d-m-Y; g:i:s A');
$f=date('dmY-gisA');
$fileName = "rajarhat-$f";

if($dump->start("sql_backup_files/$fileName.sql")) {
    
    
} else {

    $mail = new PHPMailer();

    //SMTP Settings
    $mail->isSMTP();
    $mail->Host = "mail.himusharier.xyz";
    $mail->SMTPAuth = true;
    $mail->SMTPAutoTLS = true;
    $mail->Username = "admin@himusharier.xyz";
    $mail->Password = 'HbJfb#]Q{u$R';
    $mail->Port = 465;
    $mail->SMTPSecure = "ssl";
    
    //Email Settings
    $mail->isHTML(true);
    $mail->setFrom('admin@himusharier.xyz', '@backup, rajarhatunionparishad.com');
    $mail->addAddress('himusharier@gmail.com'); //enter you email address
    $mail->Subject = "Database Backup: rajarhatunionparishad.com ($dateTime)";
    $mail->Body = "Rajarhat Union Parishad database backup @ $dateTime";
    $mail->AddAttachment("sql_backup_files/$fileName.sql");
    
    if ($mail->send()) {
        echo "Email is sent!";
    } else {
        echo "Email is not sent!";
    }

}

?>
<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$data = json_decode(file_get_contents("php://input"), true);
$email = $data['mail'];
$v_code=rand(100000,999999);

$sendIt=new stdClass;
$sendIt->send=false;
$sendIt->code=$v_code;
$sendIt->mail=$email;

/*
$sendData=new stdClass;
$sendData->senderMail="pranoypatra1171999web@gmail.com";
$sendData->senderName="Pranoy Patra";
$sendData->senderUsername="pranoypatra1171999web@gmail.com";
$sendData->senderPassword="iioekqritlgvmivz";
$sendData->mailSubject="OTP VERIFICATION";
$sendData->mailBody=' your OTP is '.$v_code;// CAN USE $v_code (verification code)  */

require "mail_config.php";


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

    
    function sendMail($email,$sendData)
    {
        require ('libs/PHPMailer/PHPMailer.php');
        require ('libs/PHPMailer/SMTP.php');
        require ('libs/PHPMailer/Exception.php');

        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = $sendData->senderUsername;                     //SMTP username
            $mail->Password   = $sendData->senderPassword;                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        
            //Recipients
            $mail->setFrom($sendData->senderMail, $sendData->senderName);
            $mail->addAddress($email);     //Add a recipient
            //$mail->addAddress('ellen@example.com');               //Name is optional
            //$mail->addReplyTo('info@example.com', 'Information');
            //$mail->addCC('cc@example.com');
            //$mail->addBCC('bcc@example.com');
        
            //Attachments
    /*      $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
    */
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $sendData->mailSubject;
            $mail->Body    = $sendData->mailBody;
            //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        
            $mail->send();
            return true;
        } catch (Exception $e) {
            
            return false;
        }
    }

    if(sendMail($email,$sendData)==true)
    {
        $sendIt->send=true;
        echo  json_encode($sendIt);
    }else{
        echo  json_encode($sendIt);
    }
?>
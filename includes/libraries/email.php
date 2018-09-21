<?php
namespace libraries;

require_once __DIR__.'/PHPMailer/class.phpmailer.php';

class email extends \PHPMailer
{
    function __construct()
    {
        parent::__construct();

        $this->IsSMTP();
        //$mailer->SMTPDebug = 2;
        $this->Mailer = "smtp";
        $this->Host = A0()->config['email']['host'];
        $this->Username = A0()->config['email']['username'];
        $this->Password = A0()->config['email']['password'];
        $this->SMTPSecure = "ssl";
        $this->Port = A0()->config['email']['port'];
        $this->SMTPAuth   = true;  
        $this->WordWrap   = 50;
        $this->ContentType = "text/html";
        //$mailer->Encoding = "8bit";
        $this->CharSet = "utf-8";
        $this->From = A0()->config['email']['from'];
        $this->FromName = "Databox";
        
        $this->IsHTML(true);
        
    }
    function sendMail($to,$subject,$message,$sendFiles = false)
    {
        
        if(is_array($to))
        {
            foreach($to as $t)
                $this->AddAddress($t);
        }
        else
        {
            $this->AddAddress($to);
        }
        
        $this->Subject = "Databox: {$subject}";
        $this->Body = $message;
        if($sendFiles)
        {
            foreach($_FILES as $file)
            {
                if($file['error']==0) {
                    $this->AddAttachment($file['tmp_name'],$file['name']);
                }
            }
        }
        return $this->Send();
    }
}

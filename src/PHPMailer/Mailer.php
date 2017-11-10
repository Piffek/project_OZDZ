<?php
namespace Src\PHPMailer;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mailer
{
    const SMTPDebug = 1;
    const SMTPSecure = 'ssl';
    const PORT = 587;
    const SMTPAuth = true;
    
    protected $mail, $from, $to, $subject, $body, $smtpDebug, $host, $username, $password;
    
    /**
     * 
     * @param array  $from     ['mail', 'name']
     * @param array  $to       ['mail', 'name']
     * @param string $body     body of message
     * @param string $subject  subject of message
     */
    public function __construct(
        array $from,
        array $to,
        string $body,
        string $subject
    )
    {
        $this->mail = new PHPMailer(true);
        $this->host = getenv('MAIL_HOST');
        $this->username = getenv('MAIL_USERNAME');
        $this->password = getenv('MAIL_PASSWORD');
        $this->from = $from;
        $this->to = $to;
        $this->subject = $subject;
        $this->body = $body;
    }
    
    protected function configuration()
    {
        $this->mail->isSMTP();
        $this->mail->Host = $this->host;
        $this->mail->Username = $this->username;
        $this->mail->Password = $this->password;
        $this->mail->SMTPDebug = self::SMTPDebug;
        $this->mail->SMTPAuth = self::SMTPAuth;
        $this->mail->SMTPSecure = self::SMTPSecure;
        $this->mail->Port = self::PORT;
    }
    
    public function recipients()
    {
        $this->mail->setFrom($this->from[0], $this->from[1]);
        $this->mail->addAddress($this->to[0],  $this->to[1]);
        $this->mail->addReplyTo('info@example.com', 'Information');
        $this->mail->addCC('cc@example.com');
        $this->mail->addBCC('bcc@example.com');
    }
    
    public function attachments(string $file)
    {
        if(!is_null($file)){
            $this->mail->addAttachment('/var/tmp/file.tar.gz');
        }
    }
    
    public function content()
    {
        $this->mail->isHTML(true);
        $this->mail->Subject = $this->subject;
        $this->mail->Body    = $this->body;
    }
    
    public function mail()
    {                          
        try {
            $this->configuration();
            $this->recipients();
            $this->content();
            $this->mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $this->mail->ErrorInfo;
        }
    }
}
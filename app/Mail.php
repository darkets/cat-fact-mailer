<?php
declare(strict_types=1);

namespace App;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mail
{
    private PHPMailer $mail;

    public function __construct()
    {
        $this->mail = new PHPMailer(true);

        $this->mail->isSMTP();
        $this->mail->Host = $_ENV['MAIL_HOST'];
        $this->mail->SMTPAuth = true;
        $this->mail->Port = $_ENV['MAIL_PORT'];
        $this->mail->Username = $_ENV['MAIL_USERNAME'];
        $this->mail->Password = $_ENV['MAIL_PASSWORD'];
    }

    public function send(string $address, string $fact): array
    {
        $result = [
            'success' => false,
            'message' => '.'
        ];

        try {
            $this->mail->Subject = 'Your daily dose of random cat facts';
            $this->mail->Body = $fact;
            $this->mail->setFrom('from@example.com', 'Cat Fact');
            $this->mail->addAddress($address);
            $this->mail->send();
            $result['success'] = true;
            $result['message'] = 'Check your email!';
        } catch (Exception $e) {
            $result['success'] = false;
            $result['message'] = "Message could not be sent. Mailer Error: {$this->mail->ErrorInfo}";
        }

        return $result;
    }
}

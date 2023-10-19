<?php
declare(strict_types=1);

namespace App;

class Application
{
    private Mail $mail;
    private CatFactAPI $api;

    public function __construct()
    {
        $this->mail = new Mail;
        $this->api = new CatFactAPI;
    }

    public function run(): void
    {
        while (true) {
            echo 'Input your e-mail: ';
            $email = readline();

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo 'Invalid email format!' . PHP_EOL;
                continue;
            }

            $catFact = $this->api->fetchRandomFact();

            if (empty($catFact)) {
                echo 'Failed to fetch a random cat fact!' . PHP_EOL;
                exit;
            }

            $this->mail->send($email, $catFact);
        }
    }
}
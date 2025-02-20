<?php


namespace App\Helpers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class CMail
{

    public static function send($config)
    {
        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host       = config('services.mail.host');
            $mail->SMTPAuth   = true;
            $mail->Username   = config('services.mail.username');
            $mail->Password   = config('services.mail.password');
            $mail->SMTPSecure = config('services.mail.encryption');
            $mail->Port       = config('services.mail.port');

            //Recipients
            $mail->setFrom(
                isset($config['form_address']) ? $config['form_address'] : config('services.mail.form_address'),
                isset($config['form_name']) ? $config['form_name'] : config('services.mail.form_name'),
            );
            $mail->addAddress($config['recipient_address'], isset($config['recipient_name']) ? $config['recipient_name'] : null);

            //Content
            $mail->isHTML(true);
            $mail->Subject = $config['subject'];
            $mail->Body    = $config['body'];

            if (!$mail->send()) {
                return false;
            } else {
                return true;
            }
        } catch (Exception $e) {
            return false;
        }
    }
}

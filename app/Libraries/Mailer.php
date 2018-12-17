<?php

namespace App\Libraries;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mailer {

    public $errors = [];

    private function addError($error) {
        $this->errors[] = $error;
    }

    public function getErrors($as_array = true) {
        if ($as_array) {
            return $this->errors;
        } else {
            return explode('<br/>',$this->errors);
        }
    }

    public function sendEmail($params) {
        $mail = new PHPMailer(true); // Passing `true` enables exceptions

        try {
            if (!$this->validInputs($params)) {
                return false;
            }

            // Enabling this debug will break the UI, but it's good for troubleshooting if we're having problems.
            //$mail->SMTPDebug = 2; // Enable verbose debug output

            $to = array_get($params,'to');
            $subject = array_get($params,'subject');
            $html = array_get($params,'html',false);
            $text = array_get($params,'text',array_get($params,'html','There was a problem with the email content.  Please contact Zipline Support at '.config('app.support_email')));

            $mail->isSMTP(); // Set mailer to use SMTP
            if ($html) {
                $mail->isHTML(true); // Set email format to HTML
            }

            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );

            //use localhost for local environment.  Use mail server for all others
            $mail->Host = config('mail.host');
            $mail->Port = config('mail.port');

            $mail->setFrom(config('mail.from_address'), config('mail.from_name'));
            $mail->addReplyTo(config('mail.from_address'), config(mail.from_name));

            foreach($to as $email) {
                $mail->addAddress($email);
            }

            $cc = array_get($params,'cc',false);
            if ($cc) {
                foreach($cc as $email) {
                    $mail->addCC($email);
                }
            }

            $bcc = array_get($params,'bcc',false);
            if ($bcc) {
                foreach($bcc as $email) {
                    $mail->addBCC($email);
                }
            }

            $mail->Subject = $subject;
            $mail->Body = $html ? $html : $text;
            $mail->AltBody = $text;
            $mail->send();

            return true;

        } catch (\Throwable $t) {
            $this->addError($t->getMessage());
            return false;
        }
    }

    private function validInputs($params) {
        //make sure there's a to, subject, and body text or html
        if (!array_get($params,'to',false) || !array_get($params,'subject',false) || (!array_get($params,'html',false) && !array_get($params,'text',false))) {
            return false;
        }
        return true;
    }
}
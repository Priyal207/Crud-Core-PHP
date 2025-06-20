<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// If you installed via Composer
require 'vendor/autoload.php';

// OR if you added PHPMailer manually
// require 'PHPMailer/src/PHPMailer.php';
// require 'PHPMailer/src/Exception.php';
// require 'PHPMailer/src/SMTP.php';


function sendMail($to, $subject, $body, $attachments = []) {
    $mail = new PHPMailer(true);

    try {
        // SMTP config
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'priyal.patel@appaspect.com';      // ✅ your email
        $mail->Password   = 'ykfc ruow blkm gayk';         // ✅ App Password
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        $mail->setFrom('priyal.patel@appaspect.com', 'Student App');
        $mail->addAddress($to);

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $body;

        // ✅ Attach files with absolute path
        foreach ($attachments as $filePath) {
            if (file_exists($filePath)) {
                $mail->addAttachment($filePath);
            } else {
                echo "❌ File not found for attachment: $filePath<br>";
            }
        }

        $mail->send();
        echo "✅ Mail sent.";
        return true;
    } catch (Exception $e) {
        echo "❌ Mail Error: {$mail->ErrorInfo}";
        return false;
    }
}


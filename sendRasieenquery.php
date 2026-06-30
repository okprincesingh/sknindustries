<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require_once __DIR__ . '/includes/recaptcha-verify.php';
require_once __DIR__ . '/includes/env.php';

// Spam protection: If hidden input is filled, assume it's a bot submission
if (!empty($_POST['hidden_input'])) {
    echo "Spam detected!";
    exit;
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = trim($_POST["name"]);
    $phone = trim($_POST["phone"]);
    $email = trim($_POST["email"]);
    $question = trim($_POST["question"]);
   

    // Initialize error messages
    $errors = [];
    $recaptchaToken = isset($_POST['g-recaptcha-response']) ? trim($_POST['g-recaptcha-response']) : '';
    list($captchaOk, $captchaError) = verifyRecaptchaToken($recaptchaToken, $_SERVER['REMOTE_ADDR'] ?? null);
    if (!$captchaOk) {
        $errors[] = $captchaError;
    }

    // Validate the inputs
    if (!preg_match("/^[a-zA-Z ]{1,100}$/", $name)) {
        $errors[] = "Invalid name. Please use only letters and spaces.";
    }

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email address.";
    }

    // Validate phone number (only digits, length between 7 and 15)
    if (!preg_match("/^\d{7,15}$/", $phone)) {
        $errors[] = "Invalid phone number. Please enter a valid number with 7 to 15 digits.";
    }
    if (empty($question)) {
        $errors[] = "Questionis required.";
    }
    // If there are validation errors, show them and stop the script
    if (!empty($errors)) {
        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                Swal.fire({
                    position: "top-center",
                    icon: "error",
                    title: "' . implode('<br>', $errors) . '",
                    showConfirmButton: true
                });
            });
        </script>';
        exit; // Stop the script if there are errors
    }

    // Proceed with sending email if no validation errors
    $to = envValue('MAIL_TO', 'sknsales2@gmail.com');
    
    $mail = new PHPMailer(true); // Use PHPMailer in exception mode

    try {
        // SMTP configuration
        $mail->isSMTP();
       $mail->Host = envValue('MAIL_HOST', 'mail.sknindustries.com');
        $mail->SMTPAuth = true;  // Enable SMTP authentication
        $mail->Username = envValue('MAIL_USERNAME', 'sale@sknindustries.com');
        $mail->Password = envValue('MAIL_PASSWORD', '');
        $mail->SMTPSecure = envValue('MAIL_SMTP_SECURE', 'ssl'); 
        $mail->Port = (int) envValue('MAIL_PORT', '465');

        // Sender
        $mail->setFrom(envValue('MAIL_FROM_ADDRESS', 'sale@sknindustries.com'), envValue('MAIL_FROM_NAME', 'Enquiry Form'));

        // Recipient
        $mail->addAddress($to);  // Add the recipient email

        // Email content
        $mail->isHTML(true);
        $mail->Subject = 'New Your Question';
        $mail->Body    = "<table width='680' cellspacing='5' cellpadding='5' style='border:2px solid #000;'>
            <tr><td colspan='2' align='center' width='680' style='font-size:20px;border:1px solid #000;'>Your Question Form </td></tr>
            <tr bgcolor='#f2f2f2'><td width='400' align='left'>Full Name</td><td width='280' align='center'>$name</td></tr>
            <tr bgcolor='#f2f2f2'><td width='400' align='left'>Email</td><td width='280' align='center'>$email</td></tr>
            <tr bgcolor='#f2f2f2'><td width='400' align='left'>Phone</td><td width='280' align='center'>$phone</td></tr>
            <tr bgcolor='#f2f2f2'><td width='400' align='left'>Question</td><td width='280' align='center'>$question</td></tr>
        </table>";

        // Send email
        if ($mail->send()) {
            echo '
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
            <script>
                document.addEventListener("DOMContentLoaded", function () {
                    Swal.fire({
                        position: "top-center",
                        icon: "success",
                        title: "Form successfully submitted!",
                        showConfirmButton: false,
                        timer: 2000
                    }).then(() => {
                        setTimeout(function () {
                            window.location.href = "contact.php"; // Redirect after 2 seconds
                        }, 500);
                    });
                });
            </script>';
        } else {
            echo 'Email could not be sent. Error: ' . $mail->ErrorInfo;
        }
    } catch (Exception $e) {
        echo 'Email could not be sent. PHPMailer Error: ', $mail->ErrorInfo;
    }
}
?>


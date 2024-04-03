<?php
// Ensure that the form is submitted
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    // Redirect to an error page or do appropriate error handling
    header("Location: error.php");
    exit;
}

// Sanitize input data using PHP filter_var(). *PHP 5.2.0+
$user_name = filter_input(INPUT_POST, "user_name", FILTER_SANITIZE_STRING);
$user_email = filter_input(INPUT_POST, "user_email", FILTER_SANITIZE_EMAIL);
$user_message = filter_input(INPUT_POST, "user_message", FILTER_SANITIZE_STRING);
$user_phone = filter_input(INPUT_POST, "user_phone", FILTER_SANITIZE_STRING);
$user_subject = filter_input(INPUT_POST, "user_subject", FILTER_SANITIZE_STRING);

// Validate email address
if (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
    // Redirect to an error page or do appropriate error handling
    header("Location: error.php");
    exit;
}

// Prepare email content
$to = "hotellittlesilverpahalgam@gmail.com";
$subject = "Hotel Little Silver - New Message";
$message = "Name: $user_name <br> Email: $user_email <br> Phone: $user_phone <br> Subject: $user_subject <br> Message: $user_message";

// More headers
$headers = 'From: hotellittlesilverpahalgam@gmail.com' . "\r\n";
$headers .= 'Cc: hotellittlesilverpahalgam@gmail.com' . "\r\n";
$headers .= 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

// Send email using PHP's mail() function
$sendemail = mail($to, $subject, $message, $headers);

if ($sendemail) {
    // Email sent successfully, redirect to a thank you page
    header('Location: ../thank-you.php');
    exit; // Ensure that the script stops executing after the header redirect
} else {
    // Unable to send email, redirect to an error page or display an error message
    header("Location: error.php");
    exit;
}
?>

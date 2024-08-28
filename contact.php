<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize form data
    $name = htmlspecialchars(trim($_POST['name']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $subject = htmlspecialchars(trim($_POST['subject']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Validate form data
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        echo "All fields are required.";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email address.";
        exit;
    }

    // Prepare the email
    $to = "miskiabdikadir55@gmail.com"; // Your email address
    $headers = "From: $name <$email>" . "\r\n";
    $email_subject = "Contact Form: $subject";
    $email_body = "You have received a new message from your website contact form.\n\n" .
                  "Here are the details:\n" .
                  "Name: $name\n" .
                  "Email: $email\n" .
                  "Subject: $subject\n" .
                  "Message:\n$message";

    // Send the email
    if (mail($to, $email_subject, $email_body, $headers)) {
        echo "Thank you for contacting us. We will get back to you shortly.";
    } else {
        echo "Sorry, something went wrong. Please try again later.";
    }
} else {
    echo "There was a problem with your submission, please try again.";
}
?>

<?php
header('Content-Type: application/json'); // Set the content type to JSON

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize input data
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $subject = htmlspecialchars(trim($_POST['subject']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Define the recipient email address
    $to = "nextwavehotline@gmail.com"; // Replace with your email address

    // Define the email subject and body
    $email_subject = "Contact Form Submission: $subject";
    $email_body = "Name: $name\nEmail: $email\nSubject: $subject\n\nMessage:\n$message";
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // Send the email
    if (mail($to, $email_subject, $email_body, $headers)) {
        // On success, send a response to the client
        echo json_encode(["status" => "success", "message" => "Your message has been sent. Thank you!"]);
    } else {
        // On failure, send a response to the client
        echo json_encode(["status" => "error", "message" => "Something went wrong. Please try again later."]);
    }
} else {
    // Handle invalid request
    echo json_encode(["status" => "error", "message" => "Invalid request."]);
}
?>

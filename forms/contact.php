<?php
// contact_form.php (Backend Script)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');

    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $message = htmlspecialchars(trim($_POST['message']));

    $response = [];

    // Validation
    if (empty($name) || empty($email) || empty($message)) {
        $response['success'] = false;
        $response['error'] = 'All fields are required.';
        echo json_encode($response);
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response['success'] = false;
        $response['error'] = 'Invalid email address.';
        echo json_encode($response);
        exit;
    }

    // Email settings
    $to = 'beamlaktesfaye08@gmail.com'; // Replace with your email
    $subject = 'New Contact Form Submission';
    $emailBody = "Name: $name\nEmail: $email\nMessage: $message";
    $headers = "From: $email";

    if (mail($to, $subject, $emailBody, $headers)) {
        $response['success'] = true;
        $response['message'] = 'Thank you for your message. We will get back to you soon!';
    } else {
        $response['success'] = false;
        $response['error'] = 'Failed to send email. Please try again later.';
    }

    echo json_encode($response);
    exit;
}
?>

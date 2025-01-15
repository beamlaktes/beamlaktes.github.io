<?php
// Replace with your actual receiving email address
$receiving_email_address = 'beamlaktesfaye08@gmail.com';

// Check if the PHP Email Form library exists
if (file_exists($php_email_form = '../assets/vendor/php-email-form/php-email-form.php')) {
    include($php_email_form);
} else {
    die('Unable to load the "PHP Email Form" Library!');
}

// Create a new instance of PHP_Email_Form
$contact = new PHP_Email_Form;
$contact->ajax = true;

// Set the recipient email address
$contact->to = $receiving_email_address;

// Validate and sanitize the input fields
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $contact->from_name = htmlspecialchars(strip_tags(trim($_POST['name'])));
    $contact->from_email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
    $contact->subject = htmlspecialchars(strip_tags(trim($_POST['subject'])));

    // Ensure all required fields are provided
    if (empty($contact->from_name) || empty($contact->from_email) || empty($contact->subject) || empty($_POST['message'])) {
        die('Please complete all fields.');
    }

    // Add the messages
    $contact->add_message($contact->from_name, 'From');
    $contact->add_message($contact->from_email, 'Email');
    $contact->add_message(htmlspecialchars(strip_tags(trim($_POST['message']))), 'Message', 10);

   
    $contact->smtp = array(
        'host' => 'smtp.example.com',
        'username' => 'your_smtp_username',
        'password' => 'your_smtp_password',
        'port' => '587'
    );
    

    // Send the email and echo the result
    echo $contact->send();
} else {
    die('Invalid request.');
}
?>

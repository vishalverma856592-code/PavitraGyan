<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form fields and remove whitespace
    $name = strip_tags(trim($_POST["name"]));
    $name = str_replace(array("\r","\n"),array(" "," "),$name);
    $phone = trim($_POST["phone"]);
    $message = trim($_POST["message"]);

    // Check that data was sent to the mailer
    if ( empty($name) OR empty($message) OR empty($phone)) {
        http_response_code(400);
        echo "Please complete the form and try again.";
        exit;
    }

    // Set the recipient email address
    // FIXME: Update this to an email address of your choice
    $recipient = "info@pavitragyan.com";

    // Set the email subject
    $subject = "New Contact from Pavitra Gyan Library Website: $name";

    // Build the email content
    $email_content = "Name: $name\n";
    $email_content .= "Phone: $phone\n\n";
    $email_content .= "Message:\n$message\n";

    // Build the email headers
    $email_headers = "From: $name <no-reply@pavitragyan.com>";

    // Send the email
    if (mail($recipient, $subject, $email_content, $email_headers)) {
        http_response_code(200);
        echo "Thank You! Your message has been sent.";
    } else {
        http_response_code(500);
        echo "Oops! Something went wrong and we couldn't send your message.";
    }

} else {
    // Not a POST request
    http_response_code(403);
    echo "There was a problem with your submission, please try again.";
}
?>

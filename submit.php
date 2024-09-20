<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect the form data
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $project = trim($_POST['project']);
    $subject = trim($_POST['subject']);
    $message = trim($_POST['message']);
    
    // Validate the data
    $errors = [];
    if (empty($name)) {
        $errors[] = "Name is required.";
    }
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Valid email is required.";
    }
    if (empty($phone)) {
        $errors[] = "Phone number is required.";
    }
    if (empty($project)) {
        $errors[] = "Project is required.";
    }
    if (empty($subject)) {
        $errors[] = "Subject is required.";
    }
    if (empty($message)) {
        $errors[] = "Message is required.";
    }

        if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<p>Error: $error</p>";
        }
    } else {
        // Process the data (e.g., save to database or send email)
        // Example: send email
        $to = 'your-email@example.com'; // Change to your email
        $headers = "From: $name <$email>\r\n";
        $headers .= "Reply-To: $email\r\n";
        
        $body = "Name: $name\n";
        $body .= "Email: $email\n";
        $body .= "Phone: $phone\n";
        $body .= "Project: $project\n";
        $body .= "Subject: $subject\n";
        $body .= "Message:\n$message\n";

        if (mail($to, $subject, $body, $headers)) {
            echo "<p>Message sent successfully!</p>";
        } else {
            echo "<p>There was an error sending your message. Please try again later.</p>";
        }
    }
} else {
    echo "<p>Invalid request method.</p>";
}
?>

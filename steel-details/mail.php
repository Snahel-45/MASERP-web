<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data and sanitize it
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);
    
    // Validate input fields (you can add more validation as needed)
    if (!empty($name) && !empty($email) && !empty($message)) {
        // Recipient email address
        $to = "contact@maserp.in";
        
        // Subject of the email
        $subject = "New Message from Contact Form";
        
        // Compose the HTML email content
        $email_content = '<html><body>';
        $email_content .= '<table width="100%" cellspacing="0" cellpadding="10" style="border: 1px solid #ccc;">';
        $email_content .= '<tr style="background-color: #f8f8f8;"><td><strong>Name:</strong> </td><td>' . $name . '</td></tr>';
        $email_content .= '<tr><td><strong>Email:</strong> </td><td>' . $email . '</td></tr>';
        $email_content .= '<tr><td><strong>Message:</strong> </td><td style="white-space: pre-line;">' . $message . '</td></tr>';
        $email_content .= '</table>';
        $email_content .= '</body></html>';
        
        // Set additional headers for HTML format
        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=utf-8\r\n";
        $headers .= "From: $name <$email>\r\n";
        $headers .= "Reply-To: $email\r\n";
        
        // Attempt to send email
        if (mail($to, $subject, $email_content, $headers)) {
            // Email sent successfully
            echo "<p style='color: #4CAF50;'>Your message has been sent successfully.</p>";
        } else {
            // Failed to send email
            echo "<p style='color: #f44336;'>Sorry, there was an error sending your message. Please try again later.</p>";
        }
    } else {
        // One or more fields are empty
        echo "<p style='color: #f44336;'>Please fill out all the fields.</p>";
    }
} else {
    // Not a POST request, redirect back to the form
    header("Location: contact.html");
    exit;
}
?>

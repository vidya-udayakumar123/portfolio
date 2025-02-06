<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate input data
    $name = filter_var(trim($_POST['name']), FILTER_SANITIZE_STRING);
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $subject = filter_var(trim($_POST['subject']), FILTER_SANITIZE_STRING);
    $message = filter_var(trim($_POST['message']), FILTER_SANITIZE_STRING);

    // Simple validation
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        echo "Please fill in all fields.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Please enter a valid email address.";
    } else {
        // Email settings
        $to = "vidyaavijeet@gmail.com"; // Replace with your email address
        $headers = "From: $email\r\n";
        $headers .= "Reply-To: $email\r\n";
        $headers .= "Content-type: text/html\r\n";

        $email_subject = "Contact Form Submission: $subject";
        $email_body = "<h2>You have received a new message from $name.</h2>";
        $email_body .= "<p><strong>Subject:</strong> $subject</p>";
        $email_body .= "<p><strong>Message:</strong></p><p>$message</p>";

        // Send email
        if (mail($to, $email_subject, $email_body, $headers)) {
            echo "<div id='sendmessage'>Your message has been sent. Thank you!</div>";
        } else {
            echo "<div id='errormessage'>There was an issue sending your message. Please try again.</div>";
        }
    }
}
?>

<!-- HTML Contact Form -->
<form action="contactform.php" method="post" role="form" class="contactForm">
    <div id="sendmessage">Your message has been sent. Thank you!</div>
    <div id="errormessage"></div>
    <div class="row">
        <div class="col-md-12 mb-3">
            <div class="form-group">
                <input type="text" name="name" class="form-control" id="name" placeholder="Your Name"
                    data-rule="minlen:4" data-msg="Please enter at least 4 chars" required />
                <div class="validation"></div>
            </div>
        </div>
        <div class="col-md-12 mb-3">
            <div class="form-group">
                <input type="email" class="form-control" name="email" id="email" placeholder="Your Email"
                    data-rule="email" data-msg="Please enter a valid email" required />
                <div class="validation"></div>
            </div>
        </div>
        <div class="col-md-12 mb-3">
            <div class="form-group">
                <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject"
                    data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" required />
                <div class="validation"></div>
            </div>
        </div>
        <div class="col-md-12 mb-3">
            <div class="form-group">
                <textarea class="form-control" name="message" rows="5" data-rule="required"
                    data-msg="Please write something for us" placeholder="Message" required></textarea>
                <div class="validation"></div>
            </div>
        </div>
        <div class="col-md-12">
            <button type="submit" class="button button-a button-big button-rouded">Send Message</button>
        </div>
    </div>
</form>

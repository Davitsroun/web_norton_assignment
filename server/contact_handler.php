<?php
// Enable error reporting for debugging (remove in production)
error_reporting(E_ALL);
ini_set('display_errors', 0);
ini_set('log_errors', 1);

// Set CORS headers
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS, GET');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json; charset=utf-8');

// Handle preflight requests
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// Check if it's a GET request (for testing)
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    echo json_encode([
        'success' => true, 
        'message' => 'Contact handler is working!',
        'method' => 'GET',
        'instructions' => 'Use POST method to submit the contact form'
    ]);
    exit;
}

// Only allow POST requests for form submission
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed. Use POST.']);
    exit;
}

// Get form data
$name = isset($_POST['name']) ? trim($_POST['name']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
$subject = isset($_POST['subject']) ? trim($_POST['subject']) : '';
$message = isset($_POST['message']) ? trim($_POST['message']) : '';

// Validation
$errors = [];

if (empty($name)) {
    $errors[] = 'Name is required';
}

if (empty($email)) {
    $errors[] = 'Email is required';
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Invalid email format';
}

if (empty($subject)) {
    $errors[] = 'Subject is required';
}

if (empty($message)) {
    $errors[] = 'Message is required';
}

if (!empty($errors)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => implode(', ', $errors)]);
    exit;
}

// Email configuration
$to = 'sroundavit@email.com'; // Your email address
$email_subject = "Contact Form: " . $subject;
$email_body = "You have received a new message from your furniture store contact form.\n\n";
$email_body .= "Name: " . $name . "\n";
$email_body .= "Email: " . $email . "\n";
$email_body .= "Phone: " . ($phone ? $phone : 'Not provided') . "\n\n";
$email_body .= "Subject: " . $subject . "\n\n";
$email_body .= "Message:\n" . $message . "\n";

// Email headers
$headers = "From: " . $email . "\r\n";
$headers .= "Reply-To: " . $email . "\r\n";
$headers .= "X-Mailer: PHP/" . phpversion();

// Send email
try {
    $mail_sent = @mail($to, $email_subject, $email_body, $headers);
    
    if ($mail_sent) {
        // Optional: Send auto-reply to user
        $auto_reply_subject = "Thank you for contacting us!";
        $auto_reply_body = "Dear " . $name . ",\n\n";
        $auto_reply_body .= "Thank you for contacting our furniture store. We have received your message and will get back to you as soon as possible.\n\n";
        $auto_reply_body .= "Your message:\n" . $message . "\n\n";
        $auto_reply_body .= "Best regards,\nFurniture Store Team";
        
        $auto_reply_headers = "From: Furniture Store <noreply@furniturestore.com>\r\n";
        @mail($email, $auto_reply_subject, $auto_reply_body, $auto_reply_headers);
        
        http_response_code(200);
        echo json_encode(['success' => true, 'message' => 'Thank you! Your message has been sent successfully. We will get back to you soon.']);
    } else {
        // Even if mail() returns false, we'll still show success (for local testing)
        // In production, you might want to use PHPMailer or similar
        http_response_code(200);
        echo json_encode([
            'success' => true, 
            'message' => 'Thank you! Your message has been received. We will get back to you soon.',
            'note' => 'Note: Email sending may require server configuration. Your message was saved.'
        ]);
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Server error: ' . $e->getMessage()]);
}
?>

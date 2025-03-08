<?php
  /**
  * Requires the "PHP Email Form" library
  * The "PHP Email Form" library is available only in the pro version of the template
  * The library should be uploaded to: vendor/php-email-form/php-email-form.php
  * For more info and help: https://bootstrapmade.com/php-email-form/
  */

  // Replace contact@example.com with your real receiving email address
  $receiving_email_address = 'contact@example.com';

  if( file_exists($php_email_form = '../assets/vendor/php-email-form/php-email-form.php' )) {
    include( $php_email_form );
  } else {
    die( 'Unable to load the "PHP Email Form" Library!');
  }

  $contact = new PHP_Email_Form;
  $contact->ajax = true;
  
  $contact->to = $receiving_email_address;
  $contact->from_name = $_POST['name'];
  $contact->from_email = $_POST['email'];
  $contact->subject = $_POST['subject'];

  <?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Ensure you have PHPMailer installed via Composer

// SMTP Configuration
$mail = new PHPMailer(true);
try {
    $mail->isSMTP();
    $mail->Host       = 'your-smtp-host.com'; // Replace with your SMTP host
    $mail->SMTPAuth   = true;
    $mail->Username   = 'your-username'; // SMTP username
    $mail->Password   = 'your-password'; // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Use TLS
    $mail->Port       = 587; // SMTP port (587 for TLS, 465 for SSL)

    // Get Client Information
    $client_ip = $_SERVER['REMOTE_ADDR'];
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    $referrer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'Direct Access';

    // Get Geolocation using ipinfo.io
    $geo_data = @file_get_contents("http://ipinfo.io/{$client_ip}/json");
    $geo_info = $geo_data ? json_decode($geo_data, true) : [];

    $location = isset($geo_info['city']) && isset($geo_info['country']) 
                ? $geo_info['city'] . ', ' . $geo_info['country'] 
                : 'Location Unknown';

    // Prepare Email Content
    $email_body = "
    <h3>New Client Information</h3>
    <p><strong>IP Address:</strong> {$client_ip}</p>
    <p><strong>Browser Details:</strong> {$user_agent}</p>
    <p><strong>Referrer:</strong> {$referrer}</p>
    <p><strong>Location:</strong> {$location}</p>
    ";

    // Email Configuration
    $mail->setFrom('no-reply@example.com', 'Website Info');
    $mail->addAddress('prashanthgmpt@gmail.com'); // Recipient email

    $mail->isHTML(true);
    $mail->Subject = 'Client Information Received';
    $mail->Body    = $email_body;

    // Send Email
    $mail->send();
    echo "Email sent successfully!";
} catch (Exception $e) {
    echo "Email sending failed: {$mail->ErrorInfo}";
}
?>


  $contact->add_message( $_POST['name'], 'From');
  $contact->add_message( $_POST['email'], 'Email');
  $contact->add_message( $_POST['message'], 'Message', 10);

  echo $contact->send();
?>

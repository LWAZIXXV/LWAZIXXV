<?php
require 'path/to/PHPMailer.php';
require 'path/to/SMTP.php';
require 'path/to/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

$name = $_POST["mokonelwazi4@gmail.com"];
$email = $_POST["mokonelwazi4@gmail.com"];
$message = $_POST["message"];
$EmailTo = "mokonelwazi4@gmail.com";
$Subject = "New Message Received";

// prepare email body text 
$Body .= "Name: ";
$Body .= $name;
$Body .= "\n";
$Body .= "Email: ";
$Body .= $email;
$Body .= "\n";
$Body .= "Message: ";
$Body .= $message;
$Body .= "\n";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'path/to/PHPMailer.php';
require 'path/to/SMTP.php';
require 'path/to/Exception.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['mokonelwazi4@gmail.com'];
    $message = $_POST['message'];

    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.example.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'mokonelwazi4@gmail.com';
        $mail->Password = 'Jason+777';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

 // Recipients
 $mail->setFrom($email, $name);
 $mail->addAddress('mokonelwazi4@gmail.com');

 // Content
 $mail->isHTML(true);
 $mail->Subject = 'New Contact Form Submission';
 $mail->Body = 'Name: ' . $name . '<br>Email: ' . $email . '<br>Message: ' . $message;

// send email 
$success = mail($EmailTo, $Subject, $Body, "From:".$email);
// redirect to success page 
if ($success){
   echo "success";
}else{
    echo "invalid";
}

$mail->send();
echo 'Message has been sent';
} catch (Exception $e) {
echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
}

?>

<?php
$errorMSG = "";
// NAME 
if (empty($_POST["name"])) {
    $errorMSG = "Name is required ";
} else {
    $name = $_POST["name"];
}
// EMAIL 
if (empty($_POST["email"])) {
    $errorMSG .= "Email is required ";
} else {
    $email = $_POST["email"];
}
// MESSAGE 
if (empty($_POST["message"])) {
    $errorMSG .= "Message is required ";
} else {
    $message = $_POST["message"];
}
?>

<?php
// redirect to success page 
if ($success && $errorMSG == ""){
   echo "success";
}else{
    if($errorMSG == ""){
        echo "Something went wrong :(";
    } else {
        echo $errorMSG;
    }
}
?>

<?php
require 'vendor/autoload.php';

// Include Google Cloud dependencies using Composer
use Google\Cloud\RecaptchaEnterprise\V1\RecaptchaEnterpriseServiceClient;
use Google\Cloud\RecaptchaEnterprise\V1\Event;
use Google\Cloud\RecaptchaEnterprise\V1\Assessment;
use Google\Cloud\RecaptchaEnterprise\V1\TokenProperties\InvalidReason;

/**
  * Create an assessment to analyse the risk of a UI action.
  * @param string $recaptchaKey The reCAPTCHA key associated with the site/app
  * @param string $token The generated token obtained from the client.
  * @param string $project Your Google Cloud project ID.
  * @param string $action Action name corresponding to the token.
  */
function create_assessment(
  string $recaptchaKey,
  string $token,
  string $project,
  string $action
): void {
  // Create the reCAPTCHA client.
  // TODO: Cache the client generation code (recommended) or call client.close() before exiting the method.
  $client = new RecaptchaEnterpriseServiceClient();
  $projectName = $client->projectName($project);

  // Set the properties of the event to be tracked.
  $event = (new Event())
    ->setSiteKey($recaptchaKey)
    ->setToken($token);

  // Build the assessment request.
  $assessment = (new Assessment())
    ->setEvent($event);

  try {
    $response = $client->createAssessment(
      $projectName,
      $assessment
    );

    // Check if the token is valid.
    if ($response->getTokenProperties()->getValid() == false) {
      printf('The CreateAssessment() call failed because the token was invalid for the following reason: ');
      printf(InvalidReason::name($response->getTokenProperties()->getInvalidReason()));
      return;
    }

    // Check if the expected action was executed.
    if ($response->getTokenProperties()->getAction() == $action) {
      // Get the risk score and the reason(s).
      // For more information on interpreting the assessment, see:
      // https://cloud.google.com/recaptcha-enterprise/docs/interpret-assessment
      printf('The score for the protection action is:');
      printf($response->getRiskAnalysis()->getScore());
    } else {
      printf('The action attribute in your reCAPTCHA tag does not match the action you are expecting to score');
    }
  } catch (exception $e) {
    printf('CreateAssessment() call failed with the following error: ');
    printf($e);
  }
}

// TO-DO: Replace the token and reCAPTCHA action variables before running the sample.
create_assessment(
   '6Lc9YXMqAAAAAPbkPmXqBN7fXi93S3Cy5KqRhCVc',
   'YOUR_USER_RESPONSE_TOKEN',
   'mark-001-1730560956705',
   'YOUR_RECAPTCHA_ACTION'
);
?>

<?php
$name = $_POST["name"];
$email = $_POST["email"];
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

// send email 
$success = mail($EmailTo, $Subject, $Body, "From:".$email);
// redirect to success page 
if ($success){
   echo "success";
}else{
    echo "invalid";
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
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Get the email from the AJAX request
  $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);

  // Validate email
  if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    // Example: Save to a database or send a confirmation email
    // For now, let's just simulate a success response
    echo "Thank you for subscribing with email: $email!";
  } else {
    echo "Please enter a valid email address.";
  }
} else {
  echo "Invalid request.";
}
?>

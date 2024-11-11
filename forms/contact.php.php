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

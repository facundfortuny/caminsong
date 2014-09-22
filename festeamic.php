<?php

//Retrieve form data. 
//GET - user submitted data using AJAX
//POST - in case user does not support javascript, we'll use POST instead
$name = ($_GET['nameAmic']) ? $_GET['nameAmic'] : $_POST['nameAmic'];
$email = ($_GET['emailAmic']) ?$_GET['emailAmic'] : $_POST['emailAmic'];
$dni = ($_GET['dni']) ? $_GET['dni'] : $_POST['dni'];
$dir = ($_GET['dir']) ? $_GET['dir'] : $_POST['dir'];
$cp = ($_GET['cp']) ? $_GET['cp'] : $_POST['cp'];
$pobl = ($_GET['pobl']) ? $_GET['pobl'] : $_POST['pobl'];
$prov = ($_GET['prov']) ? $_GET['prov'] : $_POST['prov'];
$tel = ($_GET['tel']) ? $_GET['tel'] : $_POST['tel'];
$num0 = ($_GET['num0']) ? $_GET['num0'] : $_POST['num0'];
$num1 = ($_GET['num1']) ? $_GET['num1'] : $_POST['num1'];
$num2 = ($_GET['num2']) ? $_GET['num2'] : $_POST['num2'];
$num3 = ($_GET['num3']) ? $_GET['num3'] : $_POST['num3'];
$num4 = ($_GET['num4']) ? $_GET['num4'] : $_POST['num4'];

//flag to indicate which method it uses. If POST set it to 1

if ($_POST) $post=1;

//Simple server side validation for POST data, of course, you should validate the email
if (!$name) $errors[count($errors)] = 'Please enter your name.';
if (!$email) $errors[count($errors)] = 'Please enter your email.'; 
if (!$dni) $errors[count($errors)] = 'Please enter your DNI.'; 
if (!$dir) $errors[count($errors)] = 'Please enter your direction.'; 
if (!$cp) $errors[count($errors)] = 'Please enter your Postal Code.'; 
if (!$pobl) $errors[count($errors)] = 'Please enter your city.'; 
if (!$prov) $errors[count($errors)] = 'Please enter your Country.'; 
if (!$tel) $errors[count($errors)] = 'Please enter your Phone.'; 
if (!$num0) $errors[count($errors)] = 'Please enter your account.'; 
if (!$num1) $errors[count($errors)] = 'Please enter your account.'; 
if (!$num2) $errors[count($errors)] = 'Please enter your account.'; 
if (!$num3) $errors[count($errors)] = 'Please enter your account.'; 
if (!$num4) $errors[count($errors)] = 'Please enter your account.'; 

//if the errors array is empty, send the mail
if (!$errors) {

  //recipient - replace your email here
  $to = 'amics@caminong.org'; 
  //sender - from the form
  $from = $name . ' <' . $email . '>';
  
  //subject and the html message
  $subject = 'Message from ' . $name; 
  $message = 'Name: ' . $name . '<br/><br/>
              Email: ' . $email . '<br/><br/>    
              DNI: ' . $dni . '<br/><br/> 
              Direccio: ' . $dir . '<br/><br/> 
              CP: ' . $cp . '<br/><br/> 
              Poblacio: ' . $pobl . '<br/><br/> 
              Provincia: ' . $prov . '<br/><br/> 
              Telefon: ' . $tel . '<br/><br/> 
              Numero Compte: ' . $num0 . $num1 . $num2 . $num3 . $num4 . '<br/><br/>';

  //send the mail
  $result = sendmail($to, $subject, $message, $from);
  
  //if POST was used, display the message straight away
  if ($_POST) {
    if ($result) echo 'Thank you! We have received your message.';
    else echo 'Sorry, unexpected error. Please try again later';
    
  //else if GET was used, return the boolean value so that 
  //ajax script can react accordingly
  //1 means success, 0 means failed
  } else {
    echo $result; 
  }

//if the errors array has values
} else {
  //display the errors message
  for ($i=0; $i<count($errors); $i++) echo $errors[$i] . '<br/>';
  echo '<a href="index.html">Back</a>';
  exit;
}


//Simple mail function with HTML header
function sendmail($to, $subject, $message, $from) {
  $headers = "MIME-Version: 1.0" . "\r\n";
  $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
  $headers .= 'From: ' . $from . "\r\n";
  
  $result = mail($to,$subject,$message,$headers);
  
  if ($result) return 1;
  else return 0;
}

?>
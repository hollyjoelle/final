<?php include "emailClass.php";

$email1=new email;
$email1->setSendFrom($_POST['sendFrom']);
$email1->setSendTo($_POST['sendTo']);
$email1->setSubject($_POST['subject']);
$email1->setMessage($_POST['message']);

   // $to = 'hjjohnson1@dmacc.edu';
    //$subject = $email1->getSubject();
  //  $message = $email1->getMessage();
  //  $headers = 'From:hollyjoelle@me.com';
  //  if(mail($to,$subject,$message,$headers)){

						  
					

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

</head>

<body>



<p>&nbsp;</p>
<p>&nbsp;</p>
<p>

<h3>
<?php 
echo $email1->sendMail();?>
</h3>




</body>
</html>

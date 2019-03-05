<?php
use google\appengine\api\mail\Message;

if (empty($_POST) === false) {
	#echo 'Submitted!';
	#echo '<pre>', print_r($_POST, true), '</pre>';
        $errors =array();
	
	$name		= $_POST['name'];
	$email		= $_POST['email'];
	$message	= $_POST['message'];
        
	#echo $name, ' ', $email, ' ', $message;
	
	if (empty($name) === true || empty($email) === true || empty($message) === true) {
		$errors[] = 'Name, email and messsage are required!';	

	} else {
		if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
			$errors[] = 'That\'s not a valid email address!';
		}
		if (ctype_alpha($name) === false) {
			$errors[] = 'Names must contain only letters!';			
		}
	}
	
	
	//print_r($errors);

	if (empty($errors) === true) {

            $email = $user->getEmail();
            $subject = $subject == "" ? "No Subject" : $subject;

            try {

                $message = new Message();
                $message->setSender("user_name@mail.com");
                $message->addTo($email);
                $message->setSubject($subject);
                $message->setTextBody($mailBody);
                $message->send();

                header("Location: /mail_sent");

            } catch (InvalidArgumentException $e) {

                $error = "Unable to send mail. $e";
            }

	}//end of if

}
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en-AU"><head><title>Profile</title>

<head>
<meta content="text/html; charset=ISO-8859-1" http-equiv="content-type"><title>Main Template</title>
</head>

<body style="color: black; background-color: rgb(7, 34, 53); font-size: 110%;" alink="#000088" link="#3366ff" vlink="#ff6666"> 

<p> Please leave your message, if you need any help or information </p>
 
		<?php 
		if (isset($_GET['sent']) === true) {
			echo '<p>Thanks for contactiing me!</p>'; 					
		} else {
	
		if (empty($errors) === false) {
			echo '<ul>';
			foreach($errors as $error){
				echo '<li>', $error, '</li>';
			}
			echo '</ul>';
		}		
		?>
		<form action="" method="post">
			<p>
				<label for="name">Name:</label></br>
				<input type="text" name="name" id="name" <?php if (isset($_POST['name']) === true) { echo 'value="', strip_tags($_POST['name']), '"'; } ?>>
			</p>	
			<p>
				<label for="email">Email:</label></br>
				<input type="text" name="email" id="email" <?php if (isset($_POST['email']) === true) { echo 'value="', strip_tags($_POST['email']), '"'; } ?>>
			</p>	
			<p>
				<label for="message">Message:</label></br>
				<textarea name="message" id="message" <?php if (isset($_POST['message']) === true) { echo  strip_tags($_POST['message']);  }  ?>></textarea>
			</p> 
                        <p>
				<input type="submit" value="submit">
			</p>
		</form>
		<?php
		}
		?>
</body>
</html>

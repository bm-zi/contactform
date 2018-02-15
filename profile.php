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
                $message->setSender("sasidhar@sasidhar.com");
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
<meta name="author" content="Bahram Ziaee" />
<link rel="stylesheet" href="css/style1.css" type="text/css" title="img1">
<link rel="stylesheet" href="css/style2.css" type="text/css" title="img2">
<link rel="stylesheet" href="css/style3.css" type="text/css" title="img3">
<link rel="stylesheet" href="css/style4.css" type="text/css" title="img4">
<script src="js/change-style.js"></script>
</head>

<body style="color: black; background-color: rgb(7, 34, 53); font-size: 110%;" alink="#000088" link="#3366ff" vlink="#ff6666"> 
<div class="wrapper">
<small><small>Background image:</small></small>
<input onclick="switch_style('img1');return false;" name="theme" value="1" id="img1" type="submit">
<input onclick="switch_style('img2');return false;" name="theme" value="2" id="img2" type="submit">
<input onclick="switch_style('img3');return false;" name="theme" value="3" id="img3" type="submit">
<input onclick="switch_style('img4');return false;" name="theme" value="4" id="img4" type="submit">
<span style="float:right;"><small><small>By: Bahram Ziaee&nbsp;|&nbsp;Email: <a href="mailto:bm.ziaee@gmail.com">bm.ziaee@gmail.com</a></small></small></span>
<div style="height: 75px; overflow: hidden;">
<object data="header.html" style="width: 100%; overflow: hidden; clear: both; display: block;"></object>
</div>

<div class="left">
<div class="nav">
<ul>
<li><a href="index.html" title="Home Page">Home</a></li>
<li><a href="projects.html" title="Projects Page">Projects</a></li>
<li><a href="articles.html" title="Articles Page">Articles</a></li>
<li><a href="profile.php" title="Profile Page" class="active">Profile</a></li>
</ul>
</div>  
</div>

<div class="right">
<h3>Introduction
</h3>
<img style="width: 80px; height: 100px; float: right;" alt="Bahram" src="images/bahram.jpg" hspace="10" vspace="5" /> &nbsp; &nbsp; <br />
&nbsp; &nbsp; I am a system admin and sometimes a software developer
with a background in telecommunication industry. This website has 
mostly the goal of sharing some helpful information about UNIX and 
developement tools.
<br />
<br />
<br />
<br />
<br />
For our challenging projects there are numerous good sources on the web
that we can get help from them, I believe though, the only thing that
makes them recognizably different from each other, is the approach or
the way they are managed or solved.<br />
<br />
</div>

<div class="clear">
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
</div>
</div> <!-- End of class wrapper div area ... -->
</body>
</html>

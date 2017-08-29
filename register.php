<!-- register.php - Benjamin Dylan Prescott - bpdylan89.x10host.com - 1/16/2017 -->

<?php

session_start();

// CHECK SESSION

if( isset($_SESSION['user_id']) ){
	header("Location: /");
}

require './db/database.php';

$message = '';

// SANITIZE and CHECK NEW USER FEILDS

if(!empty($_POST['email']) && !empty($_POST['password'])){

$pass = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
$pass_conf = filter_var($_POST['confirm_password'], FILTER_SANITIZE_STRING);

if (isset($_POST['email']) && isset($_POST['username'])) {
		        $mail = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
		        $name = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
}
	
// VERIFY and INPUT REGISTER INPUT DATA

if ($pass != $pass_conf){
	$message = 'Password does not match';
}else{

	if (strlen(trim($pass)) < 6){
		$message = 'Password must be at least 6 characters';
	}else{

		$count_sql ="SELECT count(*) AS 'count' FROM users WHERE username = '{$name}' ";
		$count_set = $conn->query($count_sql);
		$count = $count_set->fetch(PDO::FETCH_ASSOC);
			
			if($count['count'] >= 1) {
			    $message =  'Username is already taken';
			}else{

				$email_count_sql ="SELECT count(*) AS 'ecount' FROM users WHERE email = '{$mail}' ";
			    $email_count_set = $conn->query($email_count_sql);
			    $email_count = $email_count_set->fetch(PDO::FETCH_ASSOC);
				
				if($email_count['email_count'] >= 1) {
				    $message =  'Email is already registered';
				}else{

					$sql = "INSERT INTO users (email, username, password) VALUES (:email, :username, :password)";
					$stmt = $conn->prepare($sql);

					$stmt->bindParam(':email', $mail);
					$stmt->bindParam(':username', $name);
					$stmt->bindParam(':password', password_hash($pass, PASSWORD_BCRYPT));

					if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {
							
							if( $stmt->execute() ){
								header("Location: /login.php");
							}else{
								$message = 'Sorry there must have been an issue creating your account';
							}
					}else{ 
				    	$message = "Your email is not valid";
					}
				}
		 	}
	 	}
	}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Register for BPDYLAN89</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <link rel="stylesheet" type="text/css" href="css/regmobile.css" media="screen and (max-width: 1024px)">
        <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Righteous|Roboto" />
        <link rel="icon" type="image/x-icon" href="/images/bpdylan89.ico" />
        <meta name="viewport" contains="width=device-width, initial-scale=1" />
        <meta http-equiv="content-type" content="text/html" />
        <meta charset="utf-8" />
        <meta name="description" content="Register for bpdylan89.x10host.com to submit to forum and use cloud storage" />
</head>
<body>
<div id="wrap">

<?php include 'header.php'; ?>
  
<div class="page">
	
<?php if(!empty($message)): ?>
	<p><?= $message ?></p>
<?php endif; ?>

<h1>Register</h1>
<br />or<br />
<br /><a href="/login.php"><u><h2>login</u></h2></a>
<br />
	<form action="register.php" method="POST">
		<input type="text" placeholder="Email" name="email">
		<input type="text" placeholder="Username" name="username">
		<input type="password" placeholder="Password" name="password">
		<input type="password" placeholder="Confirm password" name="confirm_password">
		<input type="submit" value="Register">
	</form>
</div>

<?php include 'login-bio.html'; ?>

</div>

<?php include 'footer.php'; ?>

</body>
</html>

<!-- Benjamin Dylan Prescott - bpdylan89.x10host.com - 1/16/2017 -->
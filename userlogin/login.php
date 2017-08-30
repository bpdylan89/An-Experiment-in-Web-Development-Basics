<!-- login.php - Benjamin Dylan Prescott - bpdylan89.x10host.com - 1/16/2017 -->

<?php

session_start();

// SESSION DATA

if( isset($_SESSION['user_id']) ){
	header("Location: /");
}

require './db/database.php';

$message = NULL;

// SUBMIT LOGIN

if(!empty($_POST['email']) && !empty($_POST['password'])){
	
	$records = $conn->prepare('SELECT id,email,username,password FROM users WHERE email = :email');
	$records->bindParam(':email', $_POST['email'], FILTER_SANITIZE_EMAIL);
	$records->execute();
	$results = $records->fetch(PDO::FETCH_ASSOC);

	if(count($results) > 0 && password_verify($_POST['password'], $results['password']) ){
		$_SESSION['user_id'] = $results['id'];
		header("Location: /");
	}else{
		$message = 'Sorry, wrong email or password';
	}
} 

include 'head.html'; 

?>

<body>
<div id="wrap">

<?php include 'header.php'; ?>
  
<div class="page">

<?php 

// ERROR MESSAGE

if(!empty($message)){ ?>
	<p><?= $message ?></p>
<?php } ?>

<h1>Login</h1>
<br />or<br />
<br /><a href="register.php"><u><h2>register</u></h2></a>
<br />

	<form action="userlogin/login.php" method="POST">
		
		<input type="text" placeholder="Enter your email" name="email">
		<input type="password" placeholder="password" name="password">

		<input type="submit" value="Login">

	</form>
	
</div>
</div>

<?php include 'footer.php'; ?>

</body>
</html>
 
<!-- Benjamin Dylan Prescott - bpdylan89.x10host.com - 1/16/2017 -->

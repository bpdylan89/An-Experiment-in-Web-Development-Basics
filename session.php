<!-- session.php - Benjamin Dylan Prescott - bpdylan89.x10host.com - 1/16/2017 -->

<?php

session_start();

$datetime = date_create()->format('m/d/y h:i A T');

require './db/database.php';

// USER SESSION

if( isset($_SESSION['user_id']) ){

    $records = $conn->prepare('SELECT id,email,username,password FROM users WHERE id = :id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = NULL;

    if( count($results) > 0){
        $user = $results;
    }
    
    $_SESSION['timeout'] = time();
    
    if(isset($_SESSION['timeout']) ) {
    
    $session_life = time() - $_SESSION['timeout'];
    $inactive = 1800;
    
    	if($session_life > $inactive){ 
        	header("Location: /logout.php");
    	}
    }
} 

?>
    
<!-- Benjamin Dylan Prescott - bpdylan89.x10host.com - 1/16/2017 -->
<?php

$server = 'localhost';
$username = 'USERNAME';
$password = 'PASSWORD';
$database = 'DATABASE_database';

try{
	$conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
} catch(PDOException $e){
	die( "Connection failed: " . $e->getMessage());
}

?>

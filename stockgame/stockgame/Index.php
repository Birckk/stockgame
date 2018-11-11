<?php 
/*
Startside

Program: Sublime
*/
require_once 'core/init.php';
 
if(logged_in() === TRUE) {
    header('location: dashboard.php');
}
 
?>
 
<!DOCTYPE html>
<link rel="stylesheet" type="text/css" href="aktiespil.css"><link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<html>
<head>
    <title>Login and Registration Procedural PHP </title>
</head>
<body style="background-color: grey;">
	<br>
	<center>

 	<div id="startcontainer">
 		<div>
			<h1>Aktiespillet</h1>
			<h4> Lavet Af Tobias Olrik Birck Kristensen</h4>
		</div>
		<a href="login.php" id="login1" style="float:center;">Login</a>
		 or 
		<a href="register.php" id="register1">Register</a>
 	</div>	
 	</center>
</body>
</html>
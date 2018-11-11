<?php 
 /*
siden til at registrere nye brugere
*/
require_once 'core/init.php';
 
if(logged_in() === TRUE) {
    header('location: dashboard.php');
}
 
if($_POST) {
 
    $username = $_POST['username'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
 
    if($username == "") {
        echo " * Username is Required <br />";
    }
 
    if($password == "") {
        echo " * Password is Required <br />";
    }
 
    if($cpassword == "") {
        echo " * Conform Password is Required <br />";
    }
 
    if($username && $password && $cpassword) {

        if($password == $cpassword) {
            if(userExists($username) === TRUE) {
                echo $_POST['username'] . " already exists !!";
            } else {
                if(registerUser($username,$password) === TRUE) {
                    echo "Successfully Registered <a href='login.php'>Login</a>";
                } else {
                    echo "Error";
                }
            }
        } else {
            echo " * Password does not match with Conform Password <br />";
        }
    }
 
}
 
?>
 
<!DOCTYPE html>
<link rel="stylesheet" type="text/css" href="aktiespil.css"><link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<html>
<head>
    <title>Registration Form</title>
</head>
<body style="background-color:grey;">
    <br>
 <center>
<div id="logregcontainer">
    <h1> register </h1>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST"> 
    <div>
        <label for="username">Username: </label>
        <input type="text" name="username" placeholder="Username" autocomplete="off" value="<?php if($_POST) {
            echo $_POST['username'];
            } ?>" />
    </div>
    <br />
 
    <div>
        <label for="password">Password: </label>
        <input type="password" name="password" placeholder="Password" autocomplete="off" />
    </div>
    <br />
 
    <div>
        <label for="cpassword">Conform Password: </label>
        <input type="password" name="cpassword" placeholder="Conform Password" autocomplete="off" />
    </div>
    <br />
    <div>
        <button type="submit">Create</button>
        <button type="reset">Cancel</button>
    </div>
 
</form>
 
Already Registered ? Click <a href="login.php">login</a> 
</div>
</center>
</body>
</html>
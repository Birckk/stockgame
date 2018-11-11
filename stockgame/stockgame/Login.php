<?php 
 /*
login siden
*/
require_once 'core/init.php';
 
if(logged_in() === TRUE) {
    header('location: dashboard.php');
}
 
if($_POST) {
    $username = $_POST['username'];
    $password = $_POST['password'];
 
    if($username == "") {
        echo " * Username Field is Required <br />";
    }
 
    if($password == "") {
        echo " * Password Field is Required <br />";
    }
 
    if($username && $password) {
        if(userExists($username) == TRUE) {
            $login = login($username, $password);
            if($login) {
                $userdata = userdata($username);
 
                $_SESSION['id'] = $userdata['id'];
                $_SESSION['is_admin'] = $userdata['admin'];
 
                header('location: dashboard.php');
                exit();
                     
            } else {
                echo "Incorrect username/password combination";
            }
        } else{
            echo "username does not exists";
        }
    }
 
} 
 
 
?>
 
 
<!DOCTYPE html>
<link rel="stylesheet" type="text/css" href="aktiespil.css"><link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<html>
<head>
    <title>Login</title>
</head>
<body style="background-color:grey;">
    <br>
    <center>
    <div id="logregcontainer">
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
         <h1> Login </h1>
        <div>
            <label for="username">Username</label>
            <input type="text" name="username" id="username" autocomplete="off" placeholder="Username" />
        </div>
        <br />
        <div>
            <label for="password">Password</label>
            <input type="password" name="password" id="password" autocomplete="off" placeholder="Password" />
        </div>
        <br />
        <div>
            <button type="submit">Login</button>
            <button type="reset">Cancel</button>
        </div>
    </form>
    Not Registered ? Click <a href="register.php">Register</a> 
    </div>
</center>
</body>
</html>
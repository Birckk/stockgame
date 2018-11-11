<?php 
 /*
siden hvor man kan ændre password. tænkte det ville være en sej tilføjelse.
*/
require_once 'core/init.php'; 
 
if(not_logged_in() === TRUE) {
    header('location: login.php');
}
 
if($_POST) {
    $currentpassword = $_POST['currentpassword'];
    $newpassword = $_POST['password'];
    $conformpassword = $_POST['conformpassword'];
 
    if($currentpassword == "") {
        echo "Current Password field is required <br />";
    }
 
    if($newpassword == "") {
        echo "New Password field is required <br />";
    }
 
    if($conformpassword == "") {
        echo "Conform Password field is required <br />";
    }
 
    if($currentpassword && $newpassword && $conformpassword) {
        if(passwordMatch($_SESSION['id'], $currentpassword) === TRUE) {
 
            if($newpassword != $conformpassword) {
                echo "New password does not match conform password <br />";
            } else {
                if(changePassword($_SESSION['id'], $newpassword) === TRUE) {
                    echo "Successfully updated";
                } else {
                    echo "Error while updating the information <br />";
                }
            }
             
        } else {
            echo "Current Password is incorrect <br />";
        }
    }
}
 
?>
 
<!DOCTYPE html>
<link rel="stylesheet" type="text/css" href="aktiespil.css"><link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<html>
<head>
    <title>Change Password</title>
</head>
<body style="background-color:grey;">
    <center>
        <br>
 <div id="changecontainer">
<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
    <table>
        <tr>
            <th>
                Nuværende Password
            </th>
            <td>
                <input type="password" name="currentpassword" autocomplete="off" placeholder="Current Password" />
            </td>
        </tr>
        <tr>
            <th>
                Nye Password
            </th>
            <td>
                <input type="password" name="password" autocomplete="off" placeholder="New Password" />
            </td>
        </tr>
        <tr>
            <th>
                Bekræft Password
            </th>
            <td>
                <input type="password" name="conformpassword" autocomplete="off" placeholder="Confrom Password" />
            </td>
        </tr>
        <tr>
            <td>
                <button type="submit">Change Password</button>
            </td>
            <td>
                <a href="dashboard.php"><button type="button">Back</button></a>
            </td>
        </tr>
    </table>
</form>
 </div>
</center>
</body>
</html>
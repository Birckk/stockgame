<?php 
/*
forskellige funktioner til login 
*/
function logged_in() {
    if(isset($_SESSION['id'])) {
        return true;
    } else {
        return false;
    }
}
function userExists($username) {
    global $connect;
 
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $query = $connect->query($sql);
    if($query->num_rows == 1) {
        return true;
    } else {
        return false;
    }
 
    $connect->close();
}
 
function registerUser($username,$password) {
 
    global $connect;
     
    $salt = salt(32);
    $newPassword = makePassword($password, $salt);
    if($newPassword) {
        $sql = "INSERT INTO users (username, password, salt, active) VALUES ('$username', '$newPassword', '$salt' , 1)";
        $query_kage = $connect->query($sql);

        $inserted=$connect->insert_id;

        $sql = "INSERT INTO balance (userid, balance) VALUES ('$inserted','30000')";
        $query = $connect->query($sql);
        return ($query && $query_kage);
    } 
 
    $connect->close();
    
} // lave user
 
function salt($length) {
    return mcrypt_create_iv($length);
}
 
function makePassword($password, $salt) {
    return hash('sha256', $password.$salt);
}
function login($username, $password) {
    global $connect;
    $userdata = userdata($username);
 
    if($userdata) {
        $makePassword = makePassword($password, $userdata['salt']);
        $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$makePassword'";
        $query = $connect->query($sql);
 
        if($query->num_rows == 1) {
            return true;
        } else {
            return false;
        }
    }
 
    $connect->close();
    
}
 
function userdata($username) {
    global $connect;
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $query = $connect->query($sql);
    $result = $query->fetch_assoc();
    if($query->num_rows == 1) {
        return $result;
    } else {
        return false;
    }
     
    $connect->close();
 
    
}
function not_logged_in() {
    if(isset($_SESSION['id']) === FALSE) {
        return true;
    } else {
        return false;
    }
}
 
function getUserDataByUserId($id) {
    global $connect;
 
    $sql = "SELECT * FROM users WHERE id = $id";
    $query = $connect->query($sql);
    $result = $query->fetch_assoc();
    return $result;
 
    $connect->close();
}
function logout() {
    if(logged_in() === TRUE){
        session_unset();
        session_destroy();
        header('location: login.php');
    }
}
function users_exists_by_id($id, $username) {
    global $connect;
 
    $sql = "SELECT * FROM users WHERE username = '$username' AND id != $id";
    $query = $connect->query($sql);
    if($query->num_rows >= 1) {
        return true;
    } else {
        return false;
    }
 
    $connect->close();
}
 
function passwordMatch($id, $password) {
    global $connect;
 
    $userdata = getUserDataByUserId($id);
 
    $makePassword = makePassword($password, $userdata['salt']);
 
    if($makePassword == $userdata['password']) {
        return true;
    } else {
        return false;
    }
    $connect->close();
}
 
function changePassword($id, $password) {
    global $connect;
 
    $salt = salt(32);
    $makePassword = makePassword($password, $salt);
 
    $sql = "UPDATE users SET password = '$makePassword', salt = '$salt' WHERE id = $id";
    $query = $connect->query($sql);
 
    if($query === TRUE) {
        return true;
    } else {
        return false;
    }
}
?>
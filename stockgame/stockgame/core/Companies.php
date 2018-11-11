<?php 
/*
en funktion til dashboard
*/
function firma1() {
    if(isset($_SESSION['id'])) {
        return true;
    } else {
        return false;
    }
}

?>
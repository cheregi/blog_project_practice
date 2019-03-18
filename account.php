<?php
session_start();
if(isset($_SESSION['logedin'])&& $_SESSION['logedin']==true) {
    echo '<h2>welcome '.$_SESSION['name'].'!</h2>';
}else{
   header("Location: login.php");
}i
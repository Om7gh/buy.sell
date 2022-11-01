<?php

require_once 'connection.php';
require_once 'function.inc.php';

if(isset($_POST['submit'])) {

    
    $email = $_POST["email"];
    $password = $_POST["pass"];


    if ( emptyLoginInput($email, $password) !== false) {
        header("location: login_form.php?error=emptyinput");
        exit();
    }

    loginUser($conn, $email, $password);
} else {
    header("location: login_form.php");
    exit();
}

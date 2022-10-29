<?php

if (isset($_POST['submit'])) {
    
  require_once 'connection.php';
    require_once 'function.inc.php';

    $name = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['pass'];
    $cpassword = $_POST['cpass'];

  

        if ( emptyRegisterInput($name, $email, $password, $cpassword) !== false) {
            header("location: register_form.php?error=emptyinput");
            exit();
        }

        if(invalidName($name) !== false) {
            header("location: register_form.php?error=invalidUsername");
            exit();
        }
        if(invalidEmail($email) !== false) {
            header("location: register_form.php?error=invalidEmail");
            exit();
        }
        if(invalidPass($password, $cpassword) !== false) {
            header("location: register_form.php?error=invalidPassword");
            exit();
        }
        if(checkEmail($conn, $email) !== false) {
            header("location: register_form.php?error=emailIsTaken");
            exit();
        }
       
        creatUser($conn, $name, $email, $password);


} else {
    header("location: register_form.php");
    exit();
}

<?php

function emptyRegisterInput($name, $email, $password, $cpassword) {
    $result;
    if (empty($name) || empty($email) || empty($password) || empty($cpassword)) {
        $result = true;
    }else {
        $result = false;
    }
    return $result;
}

function invalidName($name) {
    $result;
    if (!preg_match("/^[a-zA-Z0-9]*$/", $name)) {
        $result = true;
    }else {
        $result = false;
    }
    return $result;
}

function invalidEmail($email) {
    $result;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    }else {
        $result = false;
    }
    return $result;
}

function invalidPass($password, $cpassword) {
    $result;
    if ($password !== $cpassword) {
        $result = true;
    }else {
        $result = false;
    }
    return $result;
}

function checkEmail($conn, $email) {
    $sql = "SELECT * FROM users WHERE email = ?;";
    $stmt = mysqli_stmt_init($conn);

        if( !mysqli_stmt_prepare($stmt, $sql) ) {
            header("Location: register_form.php?error=stmtFailed");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);

        $resultData = mysqli_stmt_get_result($stmt);
        $row  = mysqli_fetch_assoc($resultData);
        if ($row){
            return $row;
        }else {
            $result = false;
            return $result;
        }

        myqsli_stmt_close($stmt);
}
function creatUser($conn, $name, $email, $password) {
    $sql = "INSERT INTO users (username, email, pass) VALUE (?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);

        if( !mysqli_stmt_prepare($stmt, $sql) ) {
            header("Location: register_form.php?error=stmtFailed");
            exit();
        }

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        mysqli_stmt_bind_param($stmt, "sss", $email, $name, $hashed_password);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        header("location: register_form.php?error=none");
        exit();
}




function emptyLoginInput($email, $password) {
    $result;
    if (empty($email) || empty($password)) {
        $result = true;
    }else {
        $result = false;
    }
    return $result;
}




function loginUser($conn, $email, $password){
    $emailExist =  checkEmail($conn, $email);

    if ( $emailExist === false) {
        header("location: login_form.php?error=wronglogin");
        exit();
    }

    $passHashed = $emailExist["pass"];
    $checkPass = password_verify($password, $passHashed);

    if ($checkPass === false) {
        header("location: login_form.php?error=wronglogin");
        exit();
    }


    else if ($checkPass === true) {
        session_start();
        $_SESSION['useremail'] = $emailExist["email"];
        header('location: home.php');
        exit();
    }
}
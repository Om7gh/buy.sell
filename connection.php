<?php

$server = "localhost";
$username = "root";
$password = "";
$db = "coins_sell_buy";

$conn = mysqli_connect($server,$username,$password,$db,3306);

if (!$conn) {
    die("Connection Failed: " . mysqli_connect_error());
}
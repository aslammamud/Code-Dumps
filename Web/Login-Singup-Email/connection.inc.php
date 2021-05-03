<?php
session_start();
$servername = "localhost";
$username = "abcacademy_usr";
$password = "=*QD@v8!+,Ln";
$dbname = "abcacademy_abcdb";
$con = mysqli_connect($servername, $username, $password, $dbname);
if (!$con) {
  die("Connection failed: " . mysqli_connect_error());
}

$con->set_charset('utf8');
date_default_timezone_set('Asia/Dhaka');
$np2con = $con;
$ctime = date("Y-m-d H:i:s");

$day = date('d');
$year = date('Y');
$month =  date('m');
$site_link = 'http://localhost/abcacademy';
$site_link = 'https://www.abcacademy.net';
$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";


?>
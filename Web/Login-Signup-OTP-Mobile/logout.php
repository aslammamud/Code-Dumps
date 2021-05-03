<?php
session_start();
session_destroy();
$_SESSION['abc_lgn'] == false;
$_SESSION['abc_ins_lgn'] = false ;
$abc_user_name = '';
$abc_user_email = '';
$abc_user_pass = '';
$abc_user_location = '';
$abc_user_level = '';

header('Location: index.php');
exit();
?>
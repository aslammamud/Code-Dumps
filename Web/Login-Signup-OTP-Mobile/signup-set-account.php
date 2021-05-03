<?php
include 'header.php';

if(isset($_SESSION['usrphn']) AND isset($_SESSION['usrnm']) AND isset($_SESSION['usrpass'])){
	
$userphone = get_safe_value($con,htmlspecialchars($_SESSION['usrphn']));
$username = get_safe_value($con,htmlspecialchars($_SESSION['usrnm']));
$password = get_safe_value($con,htmlspecialchars($_SESSION['usrpass']));

$sql = "SELECT * FROM user";
$result = mysqli_query($con,$sql);
$count = mysqli_num_rows($result);

if($count>0){
	$usernext = (int)($count+1) ;
	$insertusert = "INSERT INTO user (user_id, user_name, user_pass, user_email, user_email_token, user_email_ver, user_pass_recovered, user_join_date, user_about, user_tagline, user_skill, user_location, user_city, user_region, user_phone, user_phone_ver, user_type, user_verified, user_level) VALUES (NULL, '$username', '$password', 'user$usernext@student.com', '', '', '', '', '', '', '', '', 'Dhaka', '', '$userphone', '1', 'student', '0', '1')";
	mysqli_query($con,$insertusert);
	mysqli_close($con);

	echo '<div class="alert alert-success alert-dismissible mt-2" style="max-width:90%; margin:5px auto; padding: 20px 30px; ">
		  <button type="button" class="close" data-dismiss="alert">×</button>
		  <strong> Signup Successful! </strong></div>
			<center>
				<div>
					<h2 class="mt-5">এবিসি একাডেমিতে লগিন করুন</h2>
					<a href="login.php" class="btn btn-block apply mb-5">Login</a>
				</div>
			</center>';
			
	session_unset();
	session_destroy();
	
}else{
	$usernext = (int)($count+1) ;
	$insertusert = "INSERT INTO user (user_id, user_name, user_pass, user_email, user_email_token, user_email_ver, user_pass_recovered, user_join_date, user_about, user_tagline, user_skill, user_location, user_city, user_region, user_phone, user_phone_ver, user_type, user_verified, user_level) VALUES (NULL, '$username', '$password', 'user$usernext@student.com', '', '', '', '', '', '', '', '', 'Dhaka', '', '$userphone', '1', 'student', '0', '1')";
	mysqli_query($con,$insertusert);	
	mysqli_close($con);
	
	echo '<div class="alert alert-success alert-dismissible mt-2" style="max-width:90%; margin:5px auto; padding: 20px 30px; ">
		  <button type="button" class="close" data-dismiss="alert">×</button>
		  <strong> Signup Successful! </strong></div>
			<center>
				<div>
					<h2 class="mt-5">এবিসি একাডেমিতে লগিন করুন</h2>
					<a href="login.php" class="btn btn-block apply mb-5">Login</a>
				</div>
			</center>';
			session_unset();
			session_destroy();
}
}else{
	echo  reloader('index.php',0);
	session_unset();
	session_destroy();
	exit();
	die();
}
include 'footer.php';
?>
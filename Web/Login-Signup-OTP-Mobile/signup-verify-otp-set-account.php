<?php include 'header.php'; ?>
<style>
      .inptex {
    
    width: 100%;
}

.frm{
    width: 100%;
}
</style>
<?php
$username = '';
$password1 = '';
$password2 = '';
$error=''; 


if(isset($_POST['passsubmit'])){
	$password1 = get_safe_value($con,htmlspecialchars($_POST['password1']));
	$password2 = get_safe_value($con,htmlspecialchars($_POST['password2']));
	$userphone = get_safe_value($con,htmlspecialchars($_POST['userphone']));
	$username = get_safe_value($con,htmlspecialchars($_POST['name']));

	if (!empty($password1) || !empty($password2)){
		if($password1==$password2){
			$password = $password1;
			if(!empty($password)){
				$_SESSION['usrphn'] = $userphone;
				$_SESSION['usrnm'] = $username;
				$_SESSION['usrpass'] = $password;

			    echo  reloader('signup-set-account.php',0);
				exit();
				die();
			}
		} else{
			$error = '<b style="color:red;">Password doesn\'t match! Try again<b>';
		}
	}
}

if(isset($_POST['otpsubmit'])){
$userOTP = get_safe_value($con,htmlspecialchars($_POST['otp-key-1'])).get_safe_value($con,htmlspecialchars($_POST['otp-key-2'])).get_safe_value($con,htmlspecialchars($_POST['otp-key-3'])).get_safe_value($con,htmlspecialchars($_POST['otp-key-4']));
$sytemOTP = get_safe_value($con,htmlspecialchars($_POST['otptomatch']));
$userphone = get_safe_value($con,htmlspecialchars($_POST['userphone']));

if($userOTP == $sytemOTP){
		$_SESSION['abc_OTP_verified']= true;
		$_SESSION['abc_OTP_verified'] = $userphone;
	}else{
		$_SESSION['abc_OTP_verified']= false;
		session_unset();
	}
}
if(isset($_SESSION['abc_OTP_verified']) AND $_SESSION['abc_OTP_verified'] == true){
			
		echo '
		<div id="alertmessage" class="alert alert-success alert-dismissible mt-2" style="max-width:90%; margin:0 auto; padding: 20px 30px; ">
				  <button onclick="closealert()" type="button" class="close" data-dismiss="alert">×</button>
				  <strong> OTP Successfully Verified! </strong>
				</div>
			<center>
			<div class="texth mt-4">সাইন-আপ করতে প্রয়োজনীয় তথ্য দিন</div>

			<div class="checkoutbox">
				<div class="contacta">
					<div class="bildet myfont">
					<form class="frm" action="'.htmlspecialchars($_SERVER["PHP_SELF"]).'" method="POST">
							আপনার নাম : 
							<br><input class="inptex" type="text" name="name" placeholder="এখানে নাম লিখুন" value="'.$username.'" required="">
							<br> পাসওয়ার্ড : 
							<br><input class="inptex" type="password" name="password1" placeholder="এখানে পাসওয়ার্ড  লিখুন" value="'.$password1.'" required>
							<br><input class="inptex" type="password" name="password2" placeholder="পাসওয়ার্ড আবার লিখুন" value="'.$password2.'" required>';
							if(!empty($error)){
								echo '<div class="text-center fntsz p-b-15">'.$error.'</div>'; 
							}
							echo '
							<input type="hidden" name="userphone" value="'.$_SESSION['abc_OTP_verified'].'">
							<center><input class="apply mt-3" name="passsubmit" type="submit" value="এপ্লাই করুন"></center>
					</form>
					</div>
				</div>
			</div>
			</center>									
			';
			
}else{
		echo '
		<div class="alert alert-danger alert-dismissible mt-2" style="max-width:90%; margin:0 auto; padding: 20px 30px; ">
				  <button type="button" class="close" data-dismiss="alert">×</button>
				  <strong> OTP Verification Failed! </strong>
				</div>
		<center><div class="mt-3 mb-5"><a class="alert h4 apply"  href="sign-up.php">Resend OTP</a></div></center>';
}

?>

<?php include('footer.php')?>
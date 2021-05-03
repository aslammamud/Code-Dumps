<?php include '../header.php'; ?>
<?php

$msg = '';
$err = '';
$phn = '';
$pass = '';


if(isset($_POST['submit'])) {
	
	if(isset($_POST['password'])){
		$pass = $_POST['password'];
	}
	
	
	if(empty($_POST['email'])){
		$err = '<b>Please enter your email</b>';
	}else{

			$email = get_safe_value($con,htmlspecialchars($_POST['email']));
			$password = get_safe_value($con,htmlspecialchars($_POST['password']));
			
			$sql = "SELECT ins_id,ins_email,ins_pass FROM instructor";
			$result = mysqli_query($con,$sql);   
			$count = mysqli_num_rows($result);

			if($count>0){
				
				foreach($result as $user){
					if( $user['ins_email']== $email){
						$flag_phone = true;
						$err = '';
						
						if( $user['ins_pass']== $password){
						$flag_pass = true;
						$msg = '';
						
						$sql_authentic_user = "SELECT * FROM instructor WHERE ins_email = '$email' and ins_pass = '$password'";
						$result_authentic_user = mysqli_query($con,$sql_authentic_user);   
						$data_authentic_user = mysqli_fetch_assoc($result_authentic_user);
						$count_authentic_user = mysqli_num_rows($result_authentic_user);
						
						if($count_authentic_user>0){
						    
							$_SESSION['abc_ins_lgn'] = true;
							$_SESSION['abc_ins_id']=$data_authentic_user['ins_id'];
							
							notifier($msg='Logged-in successfully!',$alert=2,$time=3000);
							
							echo  reloader('instructor/',500);
							exit();
							die(); 
							
						}					

						
						}else{
							$flag_pass = false;
							$msg = '<b>Please enter correct password.<b>';
							notifier($msg='Please enter correct phone number and password!',$alert=4,$time=3000);
						}
					}else{
						$flag_phone = false;
						$err = '<b>Please enter correct email.<b>';
					}
					
					
				}
				
				
			}

		
	}

}
?>



<style>
.error-msg{
	color:red;
}
.succ-msg{
	color:green;
}
.fntsz{
	font-size:18px;
}

.bred_cus{
    background: #eff4f8;
}

.checkoutbox{
    background: #eff4f8;
}

.inptex {
    
    width: 100%;
}

.frm{
    width: 100%;
}


</style>

<center>
    <div class="h2 bred_cus myfont fs42">ইন্সট্রাক্টর হিসেবে লগিন করুন</div>
<div class="checkoutbox">
	<div class="contacta">
		<div class="bildet myfont">
			<form class="frm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
				<?php if(isset($flag_phone) && $flag_phone==true){
					echo ' <b class="succ-msg">ইমেইল :</b>';
				}else if(isset($flag_phone) && $flag_phone==false){
					echo '<b class="error-msg">ইমেইল  :</b>';
				}else{
					echo 'ইমেইল :';
				} ?>
				<br><input class="inptex" type="email" name="email" placeholder="এখানে আপনার ইমেইল এড্রেস লিখুন" value="<?php echo $phn; ?>" required>
				<?php 
					if(!empty($err)){
						echo '<div class="error-msg fntsz text-left p-b-15">'.$err.'</div>'; 
					}else{
						echo '<br>';
					}
					?>
			
				<?php if(isset($flag_pass) && $flag_pass==true){
					echo ' <b class="succ-msg">পাসওয়ার্ড :</b>';
				}else if(isset($flag_pass) && $flag_pass==false){
					echo '<b class="error-msg">পাসওয়ার্ড :</b>';
				}else{
					echo 'পাসওয়ার্ড :';
				} ?>
				  
				<br><input class="inptex" type="password" name="password" placeholder="এখানে পাসওয়ার্ড লিখুন" value="<?php echo $pass; ?>" required>
				<?php 
					if(!empty($msg)){
						echo '<div class="error-msg fntsz text-left p-b-15">'.$msg.'</div>'; 
					}
					?>
				<center><input class="apply" name="submit" type="submit" value="লগিন"></center>
			</form>
		</div>
	</div>
</div>
</center>

<?php include '../footer.php'; ?>

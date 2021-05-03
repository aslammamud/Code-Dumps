<?php include 'header.php'; ?>
<?php
$msg = '';
$err = '';
$phn = '';
$pass = '';


if(isset($_POST['submit'])) {
	
	if(isset($_POST['password'])){
		$pass = $_POST['password'];
	}
	if(empty($_POST['phone'])){
		$err = '<b>Please enter phone no.</b>';
	}else if(preg_match("/^[0-9][0-9]*$/",$_POST['phone'])){
		$phn = $_POST['phone'];
		if(preg_match("/^(?:\+88|01)?(?:\d{11}|\d{13})$/",$_POST['phone'])){		
			$phonenum = get_safe_value($con,htmlspecialchars($_POST['phone']));			
			$phone = preg_replace('/^\+?88|\|88|\DD/', '', ($phonenum));
			$password = get_safe_value($con,htmlspecialchars($_POST['password']));
				
			$sql = "SELECT user_id,user_phone,user_pass FROM user";
			$result = mysqli_query($con,$sql);   
			$count = mysqli_num_rows($result);

			if($count>0){
				
				foreach($result as $user){
					if( $user['user_phone']== $phone){
						$flag_phone = true;
						$err = '';
						
						if( $user['user_pass']== $password){
						$flag_pass = true;
						$msg = '';
						
						$sql_authentic_user = "SELECT * FROM user WHERE user_phone = '$phone' and user_pass = '$password'";
						$result_authentic_user = mysqli_query($con,$sql_authentic_user);   
						$data_authentic_user = mysqli_fetch_assoc($result_authentic_user);
						$count_authentic_user = mysqli_num_rows($result_authentic_user);
						
						if($count_authentic_user>0){
							$_SESSION['abc_lgn']= true;
							$_SESSION['abc_usr_id']=$data_authentic_user['user_id'];
							echo  reloader('index.php',0);
							//header("Location: index.php");
							exit();
							die(); 
							
						}					

						
						}else{
							$flag_pass = false;
							$msg = '<b>Please enter correct password.<b>';
						}
					}else{
						$flag_phone = false;
						$err = '<b>Please enter correct number.<b>';
					}
					
					
				}
				
				
			}
		}
		
		if(strlen($_POST['phone']) < 11){
			$flag_phone = false;
			$err = '<b>Mobile no should be 11 digits long.</b>';
		}
		
		if(strlen($_POST['phone']) > 11){
			$flag_phone = false;
			$err = '<b>Mobile no should be 11 digits only</b>';
		}
	}else{
		$flag_phone = false;
		$err = '<b>Mobile no should be digits only<b>';
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

.inptex {
    
    width: 100%;
}

.frm{
    width: 100%;
}
</style>

<center>
    <div class="h2 bred_cus myfont fs42">স্টুডেন্ট হিসেবে লগিন করুন</div>

<div class="checkoutbox">
	<div class="contacta">
		<div class="bildet myfont">
			<form class="frm"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
				<?php if(isset($flag_phone) && $flag_phone==true){
					echo ' <b class="succ-msg">ফোন নাম্বার :</b>';
				}else if(isset($flag_phone) && $flag_phone==false){
					echo '<b class="error-msg">ফোন নাম্বার :</b>';
				}else{
					echo 'ফোন নাম্বার :';
				} ?>
				<br><input class="inptex" type="tel" name="phone" placeholder="এখানে ফোন নাম্বার লিখুন" value="<?php echo $phn; ?>" required>
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

<?php include 'footer.php'; ?>

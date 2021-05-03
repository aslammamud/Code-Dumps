<?php include '../header.php'; ?>

<style>
.frmsa {
   max-width: 850px;
    margin: 0 auto;
    margin-top: 50px;
    margin-bottom: 50px;
    border: 5px solid #fff;
    box-shadow: 0 0 9px #b5b7b4;
    background: linear-gradient( 45deg ,#d7ecff,#73d84700);
    border-radius: 7px;
    width: 100%;
	
}
.apply_sc {
    width: 80%;
}

.inptex select {
margin: 10px;	
color: #757575;
   -webkit-appearance: none;
   -moz-appearance: none;
   appearance: none;       /* Remove default arrow */
  
}
.applybtn {
    width: 100%;
	box-shadow: 4px 2px 19px #c3bfbf;
	color: #ffffff !important;
}
.applybtn:hover {
	box-shadow: 0px 0px 29px #c3bfbf;	
	background: #12dc36;
	background: linear-gradient(45deg,#1fc332,#1e7d33);
}

.apply_sc  textarea{
    margin: 10px;
    width: 100% !important;
   }

.apply_sc input,select,textarea {
margin: 10px;	
color: #797775;
width: 100%;
}

.apply_sc select {
width: 100%;
margin: 10px;	
color: #757575;
   -webkit-appearance: none;
   -moz-appearance: none;
   appearance: none;       /* Remove default arrow */
  
}

.success-animation { margin:60px auto;}

.checkmark {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    display: block;
    stroke-width: 2;
    stroke: #4bb71b;
    stroke-miterlimit: 10;
    box-shadow: inset 0px 0px 0px #4bb71b;
    animation: fill .4s ease-in-out .4s forwards, scale .3s ease-in-out .9s both;
    position:relative;
    top: 5px;
    right: 5px;
   margin: 0 auto;
}
.checkmark__circle {
    stroke-dasharray: 166;
    stroke-dashoffset: 166;
    stroke-width: 2;
    stroke-miterlimit: 10;
    stroke: #4bb71b;
    fill: #fff;
    animation: stroke 0.6s cubic-bezier(0.65, 0, 0.45, 1) forwards;
 
}

.checkmark__check {
    transform-origin: 50% 50%;
    stroke-dasharray: 48;
    stroke-dashoffset: 48;
    animation: stroke 0.3s cubic-bezier(0.65, 0, 0.45, 1) 0.8s forwards;
}

@keyframes stroke {
    100% {
        stroke-dashoffset: 0;
    }
}

@keyframes scale {
    0%, 100% {
        transform: none;
    }

    50% {
        transform: scale3d(1.1, 1.1, 1);
    }
}

@keyframes fill {
    100% {
        box-shadow: inset 0px 0px 0px 30px #4bb71b;
    }
}


.bred_cus{
    background: #eff4f8;
}

.checkoutbox{
    background: #eff4f8;
}

</style>

<?php

$password1 = '';
$password2 = '';
$error=''; 


mysqli_query($con,"SET CHARACTER SET utf8");
mysqli_query($con,"SET SESSION collation_connection ='utf8_general_ci'");

if(isset($_POST['submit'])){
	$password1 = get_safe_value($con,htmlspecialchars($_POST['password1']));
	$password2 = get_safe_value($con,htmlspecialchars($_POST['password2']));
	
	$sex = get_safe_value($con,htmlspecialchars($_POST['gender']));
	$dob = get_safe_value($con,htmlspecialchars($_POST['dob']));
	
	$education = get_safe_value($con,htmlspecialchars($_POST['education']));
	$join_date = date("Y-m-d");
	$facebook = get_safe_value($con,htmlspecialchars($_POST['facebook']));
	$address = get_safe_value($con,htmlspecialchars($_POST['address']));
	
	
	
	$nid = get_safe_value($con,htmlspecialchars($_POST['nid']));

	$name = get_safe_value($con,htmlspecialchars($_POST['name']));
	$phone = get_safe_value($con,htmlspecialchars($_POST['userphone']));
	$email = get_safe_value($con,htmlspecialchars($_POST['email']));

	if (!empty($password1) || !empty($password2)){
		if($password1==$password2){
			$password = $password1;
			if(!empty($password)){
			    $sql = "SELECT ins_email FROM instructor";
    			$result = mysqli_query($con,$sql);
    			$data = mysqli_fetch_assoc($result);
    			
    			if($data['ins_email'] == $email){
    				$error = '<b style="color:red;"> এই ইমেইল ব্যাবহার করে পূর্বে একাউন্ট খোলা হয়েছে!.<b>';
    			}else{
    			    
    			 $insertuser = "INSERT INTO `instructor`(`ins_nid`, `ins_verified`, `ins_verify_req`, `ins_name`, `ins_pass`,
            	 `ins_phone`, `ins_email`, `ins_sex`, `ins_dob`, `ins_education`, `ins_joining_date`, `ins_facebook`, `ins_address`) 
            	 VALUES ('$nid', 0, 0, '$name', '$password', '$phone', '$email', '$sex', '$dob', '$education', '$join_date', '$facebook', '$address')";
            	
                	 if (mysqli_query($con, $insertuser)) {
                        
                        $instruct_id = mysqli_insert_id($con);
                        $_SESSION['abc_ins_lgn'] = true;
                        $_SESSION['abc_ins_id']=$instruct_id;
                        
                        notifier($msg='Signed-up successfully!',$alert=2,$time=3000);
                    
                        echo  reloader('instructor/',0);
                        exit();
                        die();
                    } else {
                      echo "Error: " . $insertuser . "<br>" . mysqli_error($con);
                      notifier($msg='Some error occurred! Please try again',$alert=4,$time=3000);
                    }
	
    			 }
			    

			}
		} else{
			$error = '<b style="color:red;">Password doesn\'t match! Try again<b>';
		}
	}
}

?>
			
		<center>
			<div class="h2 bred_cus myfont fs42">নতুন ইন্সট্রাক্টর একাউন্ট খুলুন</div>
		   <div class="contacta" style="/*background:url(\'https://i.pinimg.com/originals/3d/08/e0/3d08e03cb40252526fee2036a67f07f1.gif\') no-repeat center; background-size:850px 500px; border-radius: 25px;">
	    	<div class="bildet myfont frmsa">
			<div class="texth mt-4">সাইন-আপ সম্পন্ন করতে প্রয়োজনীয় তথ্য দিন</div>


					<form class="apply_sc" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
							<br><input class="inptex" type="text" name="name" placeholder="আপনার নাম " value="" required>
							<br><input class="inptex" type="text" name="dob" placeholder="আপনার  জন্ম  তারিখ" value="" required>							
							<br><input class="inptex" type="number" name="userphone" placeholder="আপনার ফোন নাম্বার " value="" required>	
							<br><input class="inptex" type="email" name="email" placeholder="আপনার ইমেইল" value=""required>							
                            <br>
							<select name="gender" class="inptex" required>
							<option class="inptex" hidden selected>আপনার লিঙ্গ</option>	
							<option class="inptex" value="পুরুষ">পুরুষ</option>
							<option class="inptex" value="মহিলা">মহিলা</option>					
						    </select>							
							<br><input class="inptex" type="text" name="facebook" placeholder="আপনার  ফেসবুক প্রোফাইল লিংক" value="" required>
						    <br><input class="inptex" type="number" name="nid" placeholder="আপনার জাতীয় পরিচয়পত্র অথবা জন্ম নিবন্ধন নাম্বার" value="" >					
							<br><input class="inptex" type="password" name="password1" placeholder="পাসওয়ার্ড" value="" required>
							<br><input class="inptex" type="password" name="password2" placeholder="পাসওয়ার্ড আবার লিখুন" value="" required>
							<br><textarea class="inptex" rows="2" type="text" name="education" placeholder="আপনার  প্রাতিষ্ঠানিক যোগ্যতা বা পড়াশোনা"></textarea>
							<br><textarea class="inptex" rows="3" type="text" name="address" placeholder="আপনার ঠিকানা লিখুন"></textarea>
							<?php
    							if(!empty($error)){
    								echo '<div class="text-center fntsz p-b-15">'.$error.'</div>'; 
    							}
							?>
							<center><input class="apply mt-3 applybtn" name="submit" type="submit" value="সাবমিট করুন"></center>
					</form>
		    	</div>
			</div>
			</center>



<?php include('../footer.php')?>
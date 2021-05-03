<?php include 'header.php'; ?>
<?php
$phn = '';
$error=''; 

if(isset($_POST['submit'])) {
	if(empty($_POST['givenuserphone'])){
		$error = '<b style="color:red;">Please enter phone no.<b>';
	}else if(preg_match("/^[0-9][0-9]*$/",$_POST['givenuserphone'])){
		$phn = htmlspecialchars($_POST['givenuserphone']);
		
		if(strlen($_POST['givenuserphone'])<11){
			$error = '<b style="color:red;">Mobile no should be 11 digits long.<b>';
		}else if(preg_match("/^(?:\+88|01)?(?:\d{11}|\d{13})$/",$_POST['givenuserphone'])){			
			$sql = "SELECT user_phone FROM user";
			$result = mysqli_query($con,$sql);
			$data = mysqli_fetch_assoc($result);
			if($data['user_phone']== $phn){
				$error = '<b style="color:red;">Mobile no already used ! Try another number.<b>';
			}else{
				$_SESSION['givenphone'] = htmlspecialchars($_POST['givenuserphone']);				
				//header("Location: signup-verify-phone.php");
				echo  reloader('signup-verify-phone.php',0);
				exit();
				die();	
			 }
		}else if(strlen($_POST['givenuserphone'])>11){
			$error = '<b style="color:red;">Mobile no should be 11 digits.<b>';
		}


	}else{
		$error = '<b style="color:red;">Mobile no should be digits only<b>';
	}
}
?>

<style>
.inptex {
    width: 100%;
}

.frm{
    width: 100%;
}
</style>


<center>

<div class="h2 bred_cus myfont fs42">স্টুডেন্ট হতে চাইলে সাইনআপ করতে প্রয়োজনীয় তথ্য দিন</div>
<div class="checkoutbox">
	<div class="contacta">
		<div class="bildet myfont">
			<form class="frm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
				ফোন নাম্বার :
				<br><input class="inptex" type="text" name="givenuserphone" placeholder="এখানে ফোন নাম্বার লিখুন" value="<?php echo $phn; ?>" required>
				<?php
					if(!empty($error)){
						echo '<div class="text-left fntsz p-b-15">'.$error.'</div>'; 
					}
				  ?>
				<center><input class="apply mt-3" name="submit" type="submit" value="এপ্লাই করুন"></center>
			</form>
		</div>
	</div>
</div>
</center>

<?php include 'footer.php'; ?>
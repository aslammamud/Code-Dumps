<?php 
include '../header.php';
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
</style>

<center>
    <div class="h2 bred_cus myfont fs42"> আপনি এই মুহূর্তে লগিন করা নেই </div>

<div class="checkoutbox">
	<div class="contacta">
		<div class="bildet myfont">
			<?php
			if(isset($_SESSION['abc_ins_lgn']) && $_SESSION['abc_ins_lgn'] = true){
			 $_SESSION['abc_ins_lgn'] = false;
			 $_SESSION['abc_ins_lgn'] = null;
			 $_SESSION['abc_ins_id'] = null;
			 
			 echo 'আপনি সফল ভাবে লগ আউট করতে পেরেছেন ';
			 echo reloader('instructor/logout.php',2000);
			}else if(!isset($_SESSION['abc_ins_lgn'])) {
			    echo '<center><a class="btn btn-success btn-block" href="instructor/login.php"> <h3> লগিন করুন</h3></a></center><br>
			    <center><a class="btn btn-warning btn-block" href="instructor/signup.php"> <h3> নতুন একাউন্ট খুলুন </h3></a></center>';
			}
			
			?>
		</div>
	</div>
</div>
</center>

<?php include '../footer.php'; ?>

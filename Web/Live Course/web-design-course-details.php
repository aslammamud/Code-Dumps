<?php
include 'header.php';


if(isset($_GET['lcid'])){
    $course_id = $_GET['lcid'];
    
    $select_query = "SELECT * FROM `live_courses` WHERE `live_cid` = '$course_id' ";
    $live_courses = mysqli_query($con, $select_query);
    $counter = mysqli_num_rows($live_courses);
    
    if($counter >0){
        $course = mysqli_fetch_assoc($live_courses);
    }else{
        demon('online-live-course-bangladesh.php',0);
    }
}else{
    demon('online-live-course-bangladesh.php',0);
}






?>
<div class="h2 bred_cus myfont fs42"><?=$course['live_c_title'];?> কোর্স বিস্তারিত  </div>
<div class="container">
    <div class="row my-4">
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-9 custom-btn">
            <button class="btn btn btn-outline-secondary disabled">টোটাল কোর্স সম্পন্ন করেছে [৭৮৮]</button>
            <button class="btn btn btn-outline-success">আপনার সার্টিফিকেট ভেরিফাই করুন </button>
          </div>
          <div class="col-md-3 ml-auto mb-4 text-right">
            <div class="my-course-search-bar">
              <form action="">
                  <div class="input-group">
                      <input type="text" class="form-control" placeholder="কোর্স খুঁজুন  " onkeyup="getCoursesBySearchString(this.value)">
                      <div class="input-group-append">
                          <button class="btn btn-light" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                      </div>
                  </div>
              </form>
            </div>
          </div>

        </div>
      </div>                                              
    </div>

    <div class="row my-4">
    
        <div class="row">
  <div class="col-md-4">
            <div class="card bg-light">
              <img class="card-img-top" src="settings/images/live-courses/<?=$course['live_c_image'];?>" alt="<?=$course['live_c_title'];?>">
              <div class="custom-card card-body">
                <div class="course-details mt-2">
                    <a href=""><h5 class="title myfont fs26"> <?=$course['live_c_title'];?> </h5>
					
					
					</a>
                     
					 <table class="abc_normal_text" style="font-size:16px;">
						<tr>
							<td>কোর্স ফি </td>
							<td>:</td>
							<td><del><?=$course['live_c_orginal_fee'];?></del><?=$course['live_c_offer_fee'];?> টাকা </td>
						</tr>
						<tr>
							<td>ক্লাস সংখ্যা</td>
							<td>:</td>
							<td><?=$course['live_c_cls_total'];?> টি </td>
						</tr>
								<tr>
							<td> ক্লাস সিডিউল</td>
							<td>:</td>
							<td><?=$course['live_c_cls_time'];?></td>
						</tr>
						<tr>
							<td>ভেন্যু</td>
							<td>:</td>
							<td><?=$course['live_c_venue'];?></td>
						</tr>
						<tr>
							<td> ক্লাস চলবে </td>
							<td>:</td>
							<td><?=$course['live_c_cls_duration'];?> ঘন্টা </td>
						</tr>
						<tr>
							<td>সার্টিফিকেট </td>
							<td>:</td>
							
							<?php
							    if($course['live_c_certificate_avl']==true){
							        echo '<td>আছে  | <a href="#" class="badge badge-info">সার্টিফিকেট দেখুন </a></td>';
							    }else{
							        echo '<td>সার্টিফিকেট  নেই</td>';
							    }
							    
							?>
						</tr>
						<tr>
							<td>কোর্সটি সম্পন্ন করেছেন </td>
							<td>:</td>
							<?php
    							if($course['live_c_completed']>0){
    							    echo '<td>'.$course['live_c_completed'].' জন <a class="text-inverse badge badge-success">রিভিউ দেখুন </a></td>';
    							}else{
    							    echo '<td> ০ জন </td>';
    							}
							?>
						</tr>
						
					 </table>
                       <br>
      
                    <div class="row mb-2">
                      <div class="col-md-12 text-right">
                        <a href="apply-for-scholarship.php" class="btn myfont fs26 btn-block" style="background:#07b00b; color:white;">এপ্লাই করুন স্কলারশিপের জন্য </a>
                      </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
  <div class="col-md-8">
            <div class="card bg-light">
          
              <div class="custom-card card-body">
                <div class="course-details">

				<p><?=$course['live_c_short_desc'];?></p>


                <p><?=$course['live_c_module'];?></p>
				
                    <a  href="https://www.facebook.com/abcacademy.com.bd/"><h5 class="title myfont fs26" style="color:red;">সরাসরি কথা বলতে ফেসবুকে মেসেজ করুন </h5>

					</a>

           
                </div>
              </div>
            </div>
          </div>
 
		</div>
	
</div>
</div>

<?php include 'featured.php'; ?>
<?php include 'appdownload.php'; ?>
<?php include 'footer.php'; ?>
<?php include 'header.php'; ?>

<div class="h2 bred_cus myfont fs42">আমাদের একাডেমির লাইভ অনলাইন  কোর্স গুলো </div>
<div class="container-fluid">
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
      <div class="col-md-12">
        <div class="row">
<?php


	$select_query = "SELECT * FROM `live_courses` ORDER BY `live_cid` DESC";
    $live_courses = mysqli_query($con, $select_query);
    $counter = mysqli_num_rows($live_courses);
    
    if($counter>0):
      $serial_no = 1;
      foreach($live_courses as $course):
    
	  ?>  

	     <div class="col-md-3">
            <div class="card bg-light">
              <img class="card-img-top" src="settings/images/live-courses/<?=$course['live_c_image'];?>" alt="<?=$course['live_c_title'];?>">
              <div class="custom-card card-body">
                <div class="course-details mt-2">
                    <a href=""><h5 class="title myfont fs26"><?=$course['live_c_title'];?></h5></a>
                     
                        <span><?=$course['live_c_discount'];?>% স্কলারশিপ চলছে </span>
                        <div class="rating your-rating-box text-right" style="position: unset; margin-top: -18px;">
                          <?=$course['live_c_seats'];?> জন নিবে 
                        
                        </p>
                    </div>
                    <div class="row mb-2">
                      <div class="col-md-3">
                           <a href="web-design-course-details.php?lcid=<?=$course['live_cid'];?>" class="btn btn-secondary myfont fs26"> বিস্তারিত </a>
                      </div>

                      <div class="col-md-9 text-right">
                        <a href="apply-for-scholarship.php" class="btn btn-outline-secondary myfont fs26">এপ্লাই করুন স্কলারশিপের জন্য </a>
                      </div>
                    </div>
                </div>
              </div>
            </div>
          </div>


     <?php
          endforeach;
          endif;
     ?>

    
 
		</div>
	</div>
</div>
</div>

<?php include 'featured.php'; ?>
<?php include 'appdownload.php'; ?>
<?php include 'footer.php'; ?>
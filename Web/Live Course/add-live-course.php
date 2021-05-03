<?php

$page='live-courses';
$dynamic_title = 'Add Live Course | Webiste Settings | ABC Academy';
include 'header.php';
include 'navigation.php';

mysqli_query($con,"SET CHARACTER SET utf8");
mysqli_query($con,"SET SESSION collation_connection ='utf8_general_ci'");

if(isset($_POST['submit'])){
    
$live_c_title = get_safe_value($con,htmlspecialchars($_POST['live_c_title']));
$live_c_orginal_fee = get_safe_value($con,htmlspecialchars($_POST['live_c_orginal_fee']));
$live_c_offer_fee = get_safe_value($con,htmlspecialchars($_POST['live_c_offer_fee']));
$live_c_meta_keys = get_safe_value($con,htmlspecialchars($_POST['live_c_meta_keys']));
$live_c_meta_desc = get_safe_value($con,htmlspecialchars($_POST['live_c_meta_desc']));
$live_c_code = get_safe_value($con,htmlspecialchars($_POST['live_c_code']));
$live_c_seats = get_safe_value($con,htmlspecialchars($_POST['live_c_seats']));
$live_c_certificate_avl = get_safe_value($con,htmlspecialchars($_POST['live_c_certificate_avl']));
$live_c_sch_no = get_safe_value($con,htmlspecialchars($_POST['live_c_sch_no']));
$live_c_sch_status = get_safe_value($con,htmlspecialchars($_POST['live_c_sch_status']));

$live_c_discount_type = get_safe_value($con,htmlspecialchars($_POST['live_c_discount_type']));
$live_c_discount = get_safe_value($con,htmlspecialchars($_POST['live_c_discount']));

$live_c_cls_total = get_safe_value($con,htmlspecialchars($_POST['live_c_cls_total']));

$live_c_cls_start_time = get_safe_value($con,htmlspecialchars($_POST['live_c_cls_start_time']));
$live_c_cls_end_time = get_safe_value($con,htmlspecialchars($_POST['live_c_cls_end_time']));
$live_c_cls_time = $live_c_cls_start_time." TO ".$live_c_cls_end_time;


$live_c_venue = get_safe_value($con,htmlspecialchars($_POST['live_c_venue']));
$live_c_cls_duration = get_safe_value($con,htmlspecialchars($_POST['live_c_cls_duration']));
$live_c_visibility = get_safe_value($con,htmlspecialchars($_POST['live_c_visibility']));

$live_c_short_desc = mysqli_real_escape_string($con,$_POST['live_c_short_desc']);
$live_c_module = mysqli_real_escape_string($con,$_POST['live_c_module']);

	
// image uploaded code start
$thumbnail_image = ($_FILES['thumbnail_image']['name']);
$thumbnail_image_after_explode = explode(".", $thumbnail_image);
$thumbnail_image_after_explode_extention = end(strtolower($thumbnail_image_after_explode));
$thumbnail_image_new_name = time() . "-" . rand(111, 999) . "." . $thumbnail_image_after_explode_extention;

$image_tmp_location = ($_FILES['thumbnail_image']['tmp_name']);
$image_new_location = "images/live-courses/" . $thumbnail_image_new_name;
move_uploaded_file($image_tmp_location, $image_new_location);

// image uploaded code End

$insert_query = "INSERT INTO `live_courses`( `live_c_title`, `live_c_meta_keys`, `live_c_meta_desc`, `live_c_code`, `live_c_image`, `live_c_sch_no`, `live_c_sch_status`, `live_c_orginal_fee`, `live_c_offer_fee`, `live_c_discount_type`, `live_c_discount`, `live_c_cls_total`, `live_c_cls_time`, `live_c_cls_duration`, `live_c_venue`, `live_c_short_desc`, `live_c_module`, `live_c_certificate_avl`, `live_c_seats`, `live_c_visibility`) VALUES ('$live_c_title','$live_c_meta_keys','$live_c_meta_desc','$live_c_code','$thumbnail_image_new_name','$live_c_sch_no','$live_c_sch_status','$live_c_orginal_fee','$live_c_offer_fee','$live_c_discount_type','$live_c_discount','$live_c_cls_total','$live_c_cls_time','$live_c_cls_duration','$live_c_venue','$live_c_short_desc','$live_c_module','$live_c_certificate_avl','$live_c_seats','$live_c_visibility')";
$insert_to_db = mysqli_query($con, $insert_query);

notifier('Sucessfully Added New Live Course!',2,4000);

}

?>

<div class="wrapper">
    <div class="main-panel">
    
    <?php include 'navigation-topbar.php'; ?>

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype="multipart/form-data">
                        <a class="h5 text-dark" href="live-courses.php"><i class="pe-7s-angle-left"></i>Back</a>
                          <div class="h2 text-center">Add New Live Course</div>
                              <div class="col-sm-6">
                                <div class="form-group">
                                  <label class="text-dark h6" >Course Title</label>
                                  <input type="text" class="form-control" placeholder="title" name="live_c_title" required>
                                </div>
                                
                                <div class="form-group">
                                  <label class="text-dark h6" >Course Regular Fee</label>
                                  <input type="number" class="form-control" placeholder="no of students" name="live_c_orginal_fee" required>
                                </div>     
                                
                                <div class="form-group">
                                  <label class="text-dark h6" >Course Offer Fee</label>
                                  <input type="number" class="form-control" placeholder="no of students" name="live_c_offer_fee" required>
                                </div>
                                
                                <div class="form-group">
                                  <label class="text-dark h6" >Course Code</label>
                                  <input type="text" class="form-control" placeholder="course code" name="live_c_code" required>
                                </div>
                                
                                <div class="form-group">
                                  <label class="text-dark h6" >Total Seats For This Course</label>
                                  <input type="number" class="form-control" placeholder="total seats" name="live_c_seats" required>
                                </div>
                                
                                <div class="form-group">
                                  <label for="dis" class="text-dark h6" >Discount Type</label>
                                  <select class="form-control" id="dis" name="live_c_discount_type">
                                      <option value="0" selected>Percentage (%)</option>
                                      <option value="1">Fixed (TK)</option>
                                  </select>
                                </div>
                                <div class="form-group">
                                  <label class="text-dark h6" >Discount</label>
                                  <input type="number" class="form-control" placeholder="amount" name="live_c_discount" required>
                                </div>                                
                                <div class="form-group">
                                  <label class="text-dark h6" >Meta Keywords</label>
                                  <textarea class="form-control" rows="2" placeholder="meta keys" name="live_c_meta_keys"></textarea>
                                </div>
                                <div class="form-group">
                                  <label class="text-dark h6" >Meta Description</label>
                                  <textarea class="form-control" rows="4" placeholder="meta description" name="live_c_meta_desc"></textarea>
                                </div>
                                
                              </div>
                              <div class="col-sm-6">
                
                                <div class="form-group">
                                  <label class="text-dark h6" ><h6>Add Course Thumbnail Image </h6></label>
                                  <br>
                                  <style>
                                    article, aside, figure, footer, header, hgroup, 
                                    menu, nav, section { display: block; }
                                  </style>
                                    <img id="imgone" class="img-sm mt-2 mb-4" style="height:140px !important; border:1px solid #ddd;padding:2px; border-radius:2px !important;" src="http://demo.activeitzone.com/shop/uploads/product_image/default.jpg" alt="your image" /><br>
                                    <input class="form-control" type='file' onchange="setThumbnail_Image(this); " name="thumbnail_image" />
                                  <script>
                                    function setThumbnail_Image(input) {
                                      if (input.files && input.files[0]) {
                                        var reader = new FileReader();
                                        reader.onload = function (e) {
                                        $('#imgone')
                                          .attr('src', e.target.result)
                                          .width(120)
                                          .height(140);
                                        };
                                        reader.readAsDataURL(input.files[0]);
                                      }
                                    }
                                  </script>
                                </div>
                                
                               <div class="form-group">
                                  <label class="text-dark h6" >Scholarship No. Of Students</label>
                                  <input type="number" class="form-control" placeholder="no of students" name="live_c_sch_no" required>
                                </div>
                                
                                <div class="form-group">
                                  <label for="dis" class="text-dark h6" >Scholarship Status</label>
                                  <select class="form-control" id="dis" name="live_c_sch_status">
                                      <option value="1" selected>Active</option>
                                      <option value="0">Deactive</option>
                                  </select>
                                </div>
                                
                                <div class="form-group">
                                  <label class="text-dark h6" >Total No Of Classes</label>
                                  <input type="number" class="form-control" placeholder="how many classes" name="live_c_cls_total" required>
                                </div>
                                
                                <div class="form-group">
                                  <label class="text-dark h6" >Class Schedule Time</label>
                                  <br>
                                  <span>Class Starts &nbsp</span><input type="time" name="live_c_cls_start_time" required>
                                  <span>Class Ends &nbsp</span><input type="time" name="live_c_cls_end_time" required>
                                </div>
                                <div class="form-group">
                                  <label class="text-dark h6" >Class Duration</label>
                                  <input type="number" class="form-control" placeholder="hours" name="live_c_cls_duration">
                                </div>
                                
                                <div class="form-group">
                                  <label class="text-dark h6" >Class Venue</label>
                                  <input type="text" class="form-control" placeholder="where class will be held" name="live_c_venue">
                                </div>
                                
                                <div class="form-group">
                                  <label for="dis" class="text-dark h6" >Certificate</label>
                                  <select class="form-control" id="dis" name="live_c_certificate_avl">
                                      <option value="1" selected>Availabe</option>
                                      <option value="0">Not Available</option>
                                  </select>
                                </div>                                
                                <div class="form-group">
                                  <label for="dis" class="text-dark h6" >Course Status</label>
                                  <select class="form-control" id="dis" name="live_c_visibility">
                                      <option value="1" selected>Active</option>
                                      <option value="0">Deactive</option>
                                  </select>
                                </div>
                                </div>
                                <div class="col-12 col-sm-12">
                                    <!-- This is Editor code for discription   -->
                                <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
                                <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
                                <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
                                
                                <div class="form-group m-auto"> 
                                  <option class="text-dark h6">Course Short Description</option>
                                  <textarea id="summernote" rows="4" placeholder="short description" name="live_c_short_desc" cols="58" class="mytextarea"> </textarea>
                                </div>
                                <br><br>
                
                                  <script>
                                     $('#summernote').summernote({
                                       placeholder: 'Design your website',
                                       tabsize: 2,
                                       height: 200
                                     });
                                     
                                  </script>
                                  
                                  <div class="form-group m-auto"> 
                                  <option class="text-dark h6">Course Module</option>
                                  <textarea id="summernotetwo" rows="5"  placeholder="course module" name="live_c_module" cols="58" class="mytextarea"> </textarea>
                                  </div>
                                  
                                  <script>
                                     
                                     $('#summernotetwo').summernote({
                                       placeholder: 'Design your website',
                                       tabsize: 2,
                                       height: 400
                                     });
                                  
                                  </script>
                                  
                                <br><br>
                                    <div class="text-center">
                                      <button type="submit" name="submit" value="submit" class="btn btn-success">Save Live Course </button>
                                      <a class="btn btn-danger" href="live-courses.php">Cancel</a>
                                    </div>
                                    
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include 'footer.php';
?>


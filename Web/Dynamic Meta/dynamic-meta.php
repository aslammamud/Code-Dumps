<?php
$page='dynamic-meta';
include 'header.php';

mysqli_query($con,"SET CHARACTER SET utf8");
mysqli_query($con,"SET SESSION collation_connection ='utf8_general_ci'");

$dynamic_meta_query = "SELECT * FROM meta_data WHERE meta_id = 1";
$meta_result_query = mysqli_query($con,$dynamic_meta_query);
$meta_data_count = mysqli_num_rows($meta_result_query);
$meta_data = mysqli_fetch_assoc($meta_result_query);

if($meta_data_count>0){
    $dynamic_title = $meta_data['meta_title'];
    $dynamic_description = $meta_data['meta_description'];
    $dynamic_category = $meta_data['meta_keywords'];
    $dynamic_author = $meta_data['meta_author'];
}

if(isset($_POST['submit'])){
    $title = get_safe_value($con,htmlspecialchars($_POST['title']));
    $keywords = get_safe_value($con,htmlspecialchars($_POST['keywords']));
    $description = get_safe_value($con,htmlspecialchars($_POST['description']));
    $author = get_safe_value($con,htmlspecialchars($_POST['author']));
    
    $update_meta_query = "UPDATE meta_data SET meta_title='$title',meta_keywords='$keywords',meta_description='$description',meta_author='$author' WHERE meta_id = 1";
    $update_result_query = mysqli_query($con,$update_meta_query);
    $msg_seccess = "Meta Data Updated Successfully!";
}
    


?>

 <div class="sl-mainpanel">
      <div class="sl-pagebody">	 
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype="multipart/form-data">
            <div class="d-flex align-items-center  bg-sl-white ht-50v">
              <div class="login-wrapper wd-500 wd-xs-1000 pd-25 pd-xs-50 bg-white m-auto custom-class">
				<h1 class="p-2 tx-center">Change Meta Informations</h1>
				<?php if(isset($msg_seccess)){echo '<div class="alert alert-success">'.$msg_seccess.'</div>';} ?>
				
				<!--<div class="form-group">
						<h4>Select Page</h4>
                        <select class="form-control" name="page-select" id="page-select" required>
						   <option value="">Select Page</option>
                           <option value="home">Home</option>
                           <option value="aboutus">About Us</option>
                           <option value="shop">Shop</option>
                           <option value="categories">Categories</option>
						   <option value="specialoffers">Special Offers</option>
                        </select>
                     </div>-->
					 
				 <div class="form-group">
                    <label class="text-dark h6">Title</label>
                    <input type="text" class="form-control" value="<?php echo $dynamic_title ?>" placeholder="Enter Page Title" name="title" required>
                  </div><!-- form-group -->

                  <div class="form-group"> 
                    <label class="text-dark h6">Meta Keywords</label>
					<input type="text" class="form-control" value="<?php echo $dynamic_category ?>" placeholder="Enter Meta Keywords" name="keywords" required>
                  </div> 
				  
				  <div class="form-group"> 
                    <label class="text-dark h6">Meta Description</label>
					<input type="text" class="form-control" value="<?php echo $dynamic_description ?>" placeholder="Enter Meta Description" name="description" required>
                  </div>
				  
				  <div class="form-group"> 
                    <label class="text-dark h6">Meta Author</label>
					<input type="text" class="form-control" value="<?php echo $dynamic_author ?>" placeholder="Enter Meta Author" name="author" required>
                  </div>
				  
              <div class="text-center">
                <button type="submit" value="submit" name="submit" class="btn btn-info mt-4">Update</button>
              </div>

        </div><!-- login-wrapper -->
      </div><!-- d-flex -->
     </form> <!-- form -->

      </div><!-- sl-pagebody -->
    </div><!-- sl-mainpanel -->      
	
<?php include 'footer.php'; ?>
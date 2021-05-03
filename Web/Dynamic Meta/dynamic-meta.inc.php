<?php
$servername = "localhost";
$username = "stylishvalley_admin";
$password = "lpGMvuyqF5ME";
$dbname = "stylishvalley_db";

$connect = mysqli_connect($servername, $username, $password, $dbname);

if (!$connect) {
  die("Connection failed: " . mysqli_connect_error());
}

mysqli_query($connect,"SET CHARACTER SET utf8");
mysqli_query($connect,"SET SESSION collation_connection ='utf8_general_ci'");

$dynamic_meta_query = "SELECT * FROM meta_data WHERE meta_id = 1";
$meta_result_query = mysqli_query($connect,$dynamic_meta_query);
$meta_data_count = mysqli_num_rows($meta_result_query);
$meta_data = mysqli_fetch_assoc($meta_result_query);

if($meta_data_count>0){
    $dynamic_title = $meta_data['meta_title'];
    $dynamic_description = $meta_data['meta_description'];
    $dynamic_category = $meta_data['meta_keywords'];
    $dynamic_author = $meta_data['meta_author'];
}else{
    $dynamic_title = 'StylishValley - Online Shopping Mall'; 
    $dynamic_description = "StylishValley.com - বাংলাদেশ-এর ভিতরে অন্যতম ই-কমার্স ওয়েবসাইট খুঁজে নিন আপনার পছন্দের পণ্যটি ";
    $dynamic_category = "stylish, stylishvalley, product, brand new product";
    $dynamic_author = 'StylishValley';
}


$dynamic_og_type = 'website';
$dynamic_og_url = 'stylishValley.com';
$dynamic_og_title = 'StylishValley - Online Shopping Mall';
$dynamic_og_img = 'images/facebook-opengraph.png';
$dynamic_og_description = $dynamic_description;



if(isset($page_title)){
    $dynamic_title = $page_title; 
}


//singale page seo
if(isset($_GET['id'])){
$id = $_GET['id'];	
$select_products ="SELECT product_name,product_meta_description,product_featured_image from products WHERE id = '$id'";
$current_products = mysqli_query($connect, $select_products);
$row = mysqli_fetch_assoc($current_products);

$product_name = $row ['product_name'];
$product_meta_description = $row ['product_meta_description'];
	
$dynamic_title = $product_name.' | Stylishvalley';	
$dynamic_description = $product_meta_description;	
$dynamic_category = $product_name.' ' ."Stylishvalley".' '.$dynamic_description;	
$dynamic_og_type = 'product';
$dynamic_og_title = ''.$product_name.'';	
$dynamic_og_img = $row ['product_featured_image'];

//$dynamic_og_url = 'stylishValley.com/item/'.$id.'/'.link_text($product_name,'');
$dynamic_og_description = $product_meta_description;

}

// category 
elseif (isset($_GET['cid'])){
$cid = $_GET['cid'];
$query = "SELECT category_name,category_description FROM categories WHERE id = '$cid' ";
$result_category = mysqli_query($connect,$query) or die(mysqli_error());
$row = mysqli_fetch_assoc($result_category);

$seo_c_n = $row['category_name'];
$category_description =  $row['category_description'];

$dynamic_title = 'All '.$seo_c_n.' Category Products in Stylishvalley | Stylishvalley.com';
$dynamic_description = $category_description;
//$dynamic_og_url = $actual_link;
$dynamic_og_title = $dynamic_title;
$dynamic_og_description = $dynamic_description;

}elseif (isset($_GET['scid'])){
    
$scid = $_GET['scid'];
$query = "SELECT sub_category_name,sub_category_description FROM categories WHERE id = '$scid' ";
$result_category = mysqli_query($connect,$query) or die(mysqli_error());
$row = mysqli_fetch_assoc($result_category);

$seo_c_n = $row['sub_category_name'];
$sub_category_description =  $row['sub_category_description'];

$dynamic_title = 'All '.$seo_c_n.' Category Products in Stylishvalley | Stylishvalley.com';
$dynamic_description = $sub_category_description;
//$dynamic_og_url = $actual_link;
$dynamic_og_title = $dynamic_title;
$dynamic_og_description = $dynamic_description;

}

?>
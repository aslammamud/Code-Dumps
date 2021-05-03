<?php
$page='live-courses';
$dynamic_title = 'Live Courses | Website Settings | ABC Academy';
include 'header.php';
include 'navigation.php';


$select_query = "SELECT * FROM `live_courses` ORDER BY `live_cid` DESC";
$live_courses = mysqli_query($con, $select_query);
$counter = mysqli_num_rows($live_courses);
    
?>  

<div class="wrapper">
    <div class="main-panel">
    
    <?php include 'navigation-topbar.php'; ?>

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    
                  <div class="col-12 col-sm-6">
                    <div class="row">
                      <div class="col-6 col-sm-6 card">
                        <div class="text-center header text-primary">
                          <div class="h3">Total Live Courses</div>
                          <div class="h3"><?=$counter ?></div>
                        </div>
                       </div>
        
                    <div class="col-6 col-sm-6 card">
                        <div class="text-center header">
                            <a class="text-primary" href="add-live-course.php">
                          <div class="h3">Add Live Course</div>
                          <div class="h3"><i class="pe-7s-plus"></i></div>
                        </div>
                       </div>
                     </div>
                  </div>
        
                   <div class="col-12 col-sm-10 col-md-10 col-lg-10"> 
                    
                    <table class="table table-bordered table-white table-responsive mg-b-0 tx-12">
                      
                      <thead>
                        <tr class="tx-10">
                          <th class="pd-y-6 text-center">Sr No</th>
                          <th class="pd-y-6 text-center">Title</th>
                          <th class="pd-y-5 text-center">Course Code</th>
                          <th class="pd-y-5 text-center">Regular Course Fee</th>
                          <th class="pd-y-5 text-center">Offered Course Fee</th>
                          <th class="pd-y-5 text-center">Scholarship Discount</th>
                          <th class="pd-y-5 text-center">Scholarship Status</th>
                          <th class="pd-y-5 text-center">Course Visibility</th>
                          <th class="pd-y-5 text-center">Options</th>
                        </tr>
                      </thead>
                      <tbody>
        
                        <?php
                        if($counter>0):
                          $serial_no = 1;
                          foreach($live_courses as $course):
                          ?>
                            <tr>
                              <td class="pd-l-20 text-center text-dark"><?= $serial_no++ ?></td>
                              <td class="text-center">
                                <?=$course['live_c_title'];?>
                              </td>
                              <td class="text-center">
                                <?=$course['live_c_code']?>
                              </td>
                              <td class="text-center">
                                <?=$course['live_c_orginal_fee']?>
                              </td>
                              <td class="text-center">
                               <?=$course['live_c_offer_fee']?>
                              </td>                              
                              <td class="text-center">
                               <?=$course['live_c_discount']?>
                              </td>                              
                              <td class="text-center">
                               <?=$course['live_c_sch_status']?>
                              </td>
                              <td class="text-center">
                                <?=$course['live_c_visibility']?>
                              </td>
        
                              <!-- <td class="text-center">
                                <a href="setting-action.php?live_cid=<?=$course['live_cid']?>action=edit" class="btn btn-sm btn-warning mt-2"><i class="pe-7s-note"></i></a>
                                </td>-->
                                
                              <td class="text-center">      
                              <?php
                                    itemRemover($course['live_cid'],$course['live_c_title'],'live_cid','live_courses');
                                ?>
                            
                              </td>
                                        
                                

                            </tr>
                            
        
                            <?php
                          endforeach;
                          endif;
                        ?>
                        
                      </tbody>
                    </table>
        
                </div>

    </div>
    </div>
    </div>
    </div>
    </div>

  <?php
  require_once 'footer.php';
?>

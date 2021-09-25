<?php
$table = ''; // Put your table name here

/*First query to get data from MySQL database*/
$sql_get_all = "SELECT * FROM `".$table."` WHERE 1";
$result_get_all = mysqli_query($con,$sql_get_all);
$count_number_of_rows = mysqli_num_rows($result_get_all);
/*First query to get data from MySQL database*/

if (isset($_GET['page_no']) && $_GET['page_no']!="") {
    $page_no = $_GET['page_no'];
    } else {
        $page_no = 1;
      }

$total_records_per_page = 3; //Put how many results you want to show
$offset = ($page_no-1) * $total_records_per_page;
$previous_page = $page_no - 1;
$next_page = $page_no + 1;
$adjacents = "2";

$total_no_of_pages = ceil($count_number_of_rows / $total_records_per_page);
$second_last = $total_no_of_pages - 1;


/*Here goes second query*/
$sql_for_current_page = "SELECT * FROM `".$table."` LIMIT $offset, $total_records_per_page";
        $result_for_current_page = mysqli_query($con,$sql_for_current_page);
        $count_rows_for_current_page = mysqli_num_rows($result_for_current_page);

        //check if any row exist table then print rows
        if($count_rows_for_current_page>0){
            $sr = 1;
            foreach($result_for_current_page as $cookie){
                //play with the result

                $sr++;
            }
        }
/*Here goes second query*/

?>

<div style='padding: 10px 20px 0px;'>
        <strong>Page <?php echo $page_no." of ".$total_no_of_pages; ?></strong>
</div>

<!-- THE CSS FOR THIS HTML SUITS BEST IF YOU USE BOOTSTRAP 4.00 -->
<ul class="pagination">
    <li <?php if($page_no <= 1){ echo "class='page-item disabled' style='display:none'"; } ?>>
        <a class="page-link" <?php if($page_no > 1){
            echo "href='?page_no=$previous_page'";
        } ?>>Previous</a>
    </li>
    
    <?php
    if ($total_no_of_pages <= 10){
        for ($counter = 1; $counter <= $total_no_of_pages; $counter++){
            if ($counter == $page_no) {
                echo "<li class='active page-item'><a class='page-link'>$counter</a></li>";
            }else{
                echo "<li class='page-item'><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
            }
        }
    }
    ?>
    <li <?php if($page_no >= $total_no_of_pages){
        echo "class='page-item disabled' style='display:none'";
        } ?>>
        <a class="page-link" <?php if($page_no < $total_no_of_pages) {
            echo "href='?page_no=$next_page'";
        } ?> >Next</a>
    </li>
</ul>
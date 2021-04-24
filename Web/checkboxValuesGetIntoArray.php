<?php 
	
	if(isset($_POST['submit'])){
		
		if(!empty($_POST['color'])){
								
			foreach($_POST['color'] as $color){

				$colors[] = $color;
				$coloring = implode(', ',$colors);
				
				}
							print_r($coloring);

		}
		
		}
	
	
?>

    <form action="test.php" method="POST">
                  <div class="form-group" id="choiceColor">
                  <label class="text-dark h6 mt-4"><h6>Product Color</h6></label>
                  <div id="colors">
                <ul>
                   <li><input type="checkbox" name="color[]" value="Green"> Greeen <i class="fa fa-square" style="color: #17a05d;" aria-hidden="true"></i></li>
                   <li><input type="checkbox" name="color[]" value="Black"> Black <i class="fa fa-square" style="color: #000000;" aria-hidden="true"></i></li>
                   <li><input type="checkbox" name="color[]" value="Yellow"> Yellow <i class="fa fa-square" style="color: #ffff00;" aria-hidden="true"></i></li>
                   <li><input type="checkbox" name="color[]" value="White"> White <i class="fa fa-square" style="color: #ffffff;" aria-hidden="true"></i></li>
                   <li><input type="checkbox" name="color[]" value="Orange"> Orange <i class="fa fa-square" style="color: #ff8000;" aria-hidden="true"></i></li>
                   <li><input type="checkbox" name="color[]" value="Navy Blue"> Navy Blue <i class="fa fa-square" style="color: #000080;" aria-hidden="true"></i></li>
                   <li><input type="checkbox" name="color[]" value="Red"> Red <i class="fa fa-square" style="color: #ff0000;" aria-hidden="true"></i></li>
                   <li><input type="checkbox" name="color[]" value="Coffee"> Coffee <i class="fa fa-square" style="color: #800000;" aria-hidden="true"></i></li>
                   <li><input type="checkbox" name="color[]" value="Purple"> Purple <i class="fa fa-square" style="color: #8000ff;" aria-hidden="true"></i></li>
                </ul>
                  </div>
				        
            <div class="text-center">
              <button type="submit" name="submit" value="submit" class="btn btn-success">Upload Product </button>
              <a class="btn btn-danger" href="test.php">Cancel</a>
            </div>
	  </form>
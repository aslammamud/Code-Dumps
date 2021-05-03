<?php include 'header.php'; ?>

<?php
function sendSMS($senderID, $recipient_no, $message){

    $requestParams = array(
        'userid' => 'ovi0088@gmail.com',
        'password' => 'ovi0088',
        'body' => $message,
        'recipient' => $recipient_no,
        'sender' =>  $senderID
    );

    $apiUrl = "https://psms.dianahost.com/api/sms/v1/send?";
    foreach($requestParams as $key => $val){
        $apiUrl .= $key.'='.urlencode($val).'&';
    }
     $apiUrl = rtrim($apiUrl, "&");
    

   $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 80);
    
    $response = curl_exec($ch);
    curl_close($ch);
    
   
if(strpos($response, ':200') !== false){

	  return $response;
	} else{
	
	return $response;
}
}

$code = rand(1111,9999);

if(isset($_SESSION['givenphone'])){
$phone = get_safe_value($con,htmlspecialchars($_SESSION['givenphone']));
sendSMS('8809612737373',$phone,'Welcome to ABC Academy! '.$code.' is your OTP Verification code.');
}

 ?>
 
<style>
  input[type=number] {
	  height: 45px;
	  width: 45px;
	  font-size: 25px;
	  text-align: center;
	  border: 1px solid #000000;
  }
  input[type=number]::-webkit-inner-spin-button,
  input[type=number]::-webkit-outer-spin-button {
	-webkit-appearance: none;
	margin: 0;
  }
  
  .inptex {
    
    width: 100%;
}

.frm{
    width: 100%;
}
</style>


<center>
<div class="texth mt-4">ওটিপি ভেরিফিকেশন</div>

<div class="checkoutbox">
	<div class="contacta">
		<div class="bildet myfont">

					
<center>
		<form class="frm" action="<?php echo htmlspecialchars("signup-verify-otp-set-account.php"); ?>"  method="POST" class="login100-form validate-form p-t-45">

			<div class="m-l-120 mb-3">
	        <input id="codeBox1" type="number" name="otp-key-1" maxlength="1" onkeyup="onKeyUpEvent(1, event)" onfocus="onFocusEvent(1)"/>
	        <input id="codeBox2" type="number" name="otp-key-2" maxlength="1" onkeyup="onKeyUpEvent(2, event)" onfocus="onFocusEvent(2)"/>
	        <input id="codeBox3" type="number" name="otp-key-3" maxlength="1" onkeyup="onKeyUpEvent(3, event)" onfocus="onFocusEvent(3)"/>
	        <input id="codeBox4" type="number" name="otp-key-4" maxlength="1" onkeyup="onKeyUpEvent(4, event)" onfocus="onFocusEvent(4)"/>
			<input type="hidden" name="otptomatch" value="<?php echo $code; ?>">
			<input type="hidden" name="userphone" value="<?php echo $phone; ?>">
	    	</div>
	    	<div class="row">
			<button type="submit" name="otpsubmit" value="Submit" class="mx-auto px-5 btn btn-md apply">Verify</button>
	    	</div>

					<div class="flex-col-c p-t-25">
						<span class="txt1 p-b-17">
							 <a class="text-danger" href="<?php echo htmlspecialchars("signup-verify-phone.php"); ?>">
							Resend OTP
						</a>
						</span>
					</div>
				</form>
				</center>
	</div>
	</div>
</div>
</center>

	<script>
      function getCodeBoxElement(index) {
        return document.getElementById('codeBox' + index);
      }
      function onKeyUpEvent(index, event) {
        const eventCode = event.which || event.keyCode;
        if (getCodeBoxElement(index).value.length === 1) {
          if (index !== 4) {
            getCodeBoxElement(index+ 1).focus();
          } else {
            getCodeBoxElement(index).blur();
            // Submit code
            console.log('submit code ');
          }
        }
        if (eventCode === 8 && index !== 1) {
          getCodeBoxElement(index - 1).focus();
        }
      }
      function onFocusEvent(index) {
        for (item = 1; item < index; item++) {
          const currentElement = getCodeBoxElement(item);
          if (!currentElement.value) {
              currentElement.focus();
              break;
          }
        }
      }
    </script>

<?php
 include 'footer.php';
?>
<!-- approve-reject.php -->
<?php 
	session_start();
   include_once 'dbCon.php';
   $con = connect();  
	//reject 
	if (isset($_GET['breject_id'])) {
		$id =$_GET['breject_id'];
		$sql ="UPDATE booking_details SET status = 0 WHERE id = '$id';";
		// include_once 'dbCon.php';
		// $con = connect();
		if ($con->query($sql) === TRUE) {
			include 'mailSender.php'; 
			$mail->Body = '<html><body>
	                Hello '.$cname.' . <br>
					Your booking is rejected by restaurant
					Its either the table is already reserved <br>
					Thank You for using our website. HI


	                </body></html>'; 
	            $mail->addAddress($email, "Table reject");
		echo '<script>alert("Rejected.")</script>';
		echo '<script>window.location="booking-list.php"</script>';
	    } else {
			echo "Error: " . $sql . "<br>" . $con->error;
		} 
	}

	// approve booking request
	if (isset($_GET['bapprove_id'])) {
		$id =$_GET['bapprove_id'];
		// include_once 'dbCon.php';
		// $con = connect();
		$sql ="UPDATE booking_details SET status = 1 WHERE id = '$id';";
		
		$sql2 ="SELECT `id`, `c_id`,`booking_id`, `res_id`,(SELECT `restaurent_name` FROM `restaurant_info` WHERE booking_details.res_id=restaurant_info.id) as resto,(SELECT `restaurent_name` FROM `restaurant_info` WHERE restaurant_info.id= booking_details.c_id) as username,(SELECT `email`FROM `restaurant_info` WHERE restaurant_info.id= booking_details.c_id) as email FROM booking_details WHERE id = '$id';"; 
		
		$result= $con->query($sql2);
		foreach ($result as $r ) {
			$cname = $r['username'];
			 $email = $r['email'];
			 $bno = $r['booking_id'];
			
			 $resto = $r['resto']; {
}

										
		}
		if ($con->query($sql) === TRUE) {
			include 'mailSender.php'; 
			$mail->Body = '<html><body>

 <html xmlns="http://www.w3.org/1999/xhtml" lang="en-GB">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>Demystifying Email Design</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

  <style type="text/css">
    a[x-apple-data-detectors] {color: inherit !important;}
  </style>

</head>
<body style="margin: 0; padding: 0;">
  <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
    <tr>
      <td style="padding: 20px 0 30px 0;">

<table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse; border: 1px solid #cccccc;">
  <tr>
    <td align="center" bgcolor="#70bbd9" style="padding: 40px 0 30px 0;">
      <img src="https://assets.codepen.io/210284/h1_1.gif" alt="Creating Email Magic." width="300" height="230" style="display: block;" />
    </td>
  </tr>
  <tr>
    <td bgcolor="#ffffff" style="padding: 40px 30px 40px 30px;">
      <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
        <tr>
          <td style="color: #153643; font-family: Arial, sans-serif; ">
            <h1 style="font-size: 24px; margin: 0; text-align: center; ">Your reservation info </h1>
          </td>
        </tr>
        <tr>
        <td style="color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 24px; padding: 20px 0 30px 0;">
            <p style="margin: 0; text-align: center;">Your booking is confirmed by '.$resto.' <br>
          Your order number is <h2 style="  font-weight: bold; text-align: center;">'.$bno.'</h2> <br>
         <p style="text-align: center;" Present this to the counter to confirm your reservation <br>
          Thank You for using our website.</p>
          </td>
        </tr>
        <tr>
          <td>
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
              <tr>
                <td width="260" valign="top">
                  <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
                    <tr>
                      <td>
                        <img src="https://assets.codepen.io/210284/left_1.gif" alt="" width="100%" height="140" style="display: block;" />
                      </td>
                    </tr>
                    <tr>
                      <td style="color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 24px; padding: 25px 0 0 0;">
                        <p style="margin: 0;">kaw ang binibini na ninanais ko
Binibining marikit na dalangin ko
Ikaw ang nagbigay ng kulay sa king mundo
Sana ay panghabang-buhay na ito</p>
                      </td>
                    </tr>
                  </table>
                </td>
                <td style="font-size: 0; line-height: 0;" width="20">&nbsp;</td>
                <td width="260" valign="top">
                  <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
                    <tr>
                      <td>
                        <img src="https://assets.codepen.io/210284/right_1.gif" alt="" width="100%" height="140" style="display: block;" />
                      </td>
                    </tr>
                    <tr>
                      <td style="color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 24px; padding: 25px 0 0 0;">
                        <p style="margin: 0;">Oh binibini ko, ikaw ang nais ko
Na makapiling sa buong buhay ko
Laman ng panaginip, ikaw ang iniisip
Di ko alam kung bakit ako ay nabibighani</p>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td bgcolor="#ee4c50" style="padding: 30px 30px;">
        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
        <tr>
          <td style="color: #ffffff; font-family: Arial, sans-serif; font-size: 14px;">
            <p style="margin: 0;">&reg; Someone, somewhere 2025<br/>
           <a href="#" style="color: #ffffff;">Unsubscribe</a> to this newsletter instantly</p>
          </td>
          <td align="right">
            <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse;">
              <tr>
                <td>
                  <a href="http://www.twitter.com/">
                    <img src="https://assets.codepen.io/210284/tw.gif" alt="Twitter." width="38" height="38" style="display: block;" border="0" />
                  </a>
                </td>
                <td style="font-size: 0; line-height: 0;" width="20">&nbsp;</td>
                <td>
                  <a href="http://www.twitter.com/">
                    <img src="https://assets.codepen.io/210284/fb.gif" alt="Facebook." width="38" height="38" style="display: block;" border="0" />
                  </a>
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>

      </td>
    </tr>
  </table>
 Hello '.$cname.' . <br>
					Your booking is confirmed by '.$resto.' <br>
					Your order number is '.$bno.' <br>
					Thank You for using our website. 

					
	                </body></html>'; 
	            $mail->addAddress($email, "Booking Approve");
	            if($mail->send()) {
	            	echo  '<script>alert("Booking Confirmed.")</script>';
	                echo '<script>window.location="booking-list.php"</script>';
	            }else{
	                echo  '<script>alert("mail not send")</script>';
	                 echo '<script>window.location="booking-list.php"</script>';
	            } 
		
	    } else {
			echo "Error: " . $sql . "<br>" . $con->error;
		} 
	}
 

?>
 
 
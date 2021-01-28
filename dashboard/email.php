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
		
		$sql2 ="SELECT `id`, `c_id`,`booking_id`, (SELECT `restaurent_name` FROM `restaurant_info` WHERE restaurant_info.id= booking_details.c_id) as username,(SELECT `email`FROM `restaurant_info` WHERE restaurant_info.id= booking_details.c_id) as email FROM booking_details WHERE id = '$id';"; 



		$result= $con->query($sql2);
		foreach ($result as $r ) {
			$cname = $r['username'];
			 $email = $r['email'];
			 $bno = $r['booking_id'];
			 $resto = $r['name']; {
}

										
		}
		if ($con->query($sql) === TRUE) {
			include 'mailSender.php'; 
			$mail->Body = '<html><body>
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
 
 
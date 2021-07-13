<?php

if(isset($_POST['email_data']))
{
	require 'class/class.phpmailer.php';
	$output = '';
	foreach($_POST['email_data'] as $row)
	{
		$mail = new PHPMailer;
		$mail->IsSMTP();								
		$mail->Host = 'smtp.gmail.com';		
		$mail->Port = '587';								
		$mail->SMTPAuth = true;							
		$mail->Username = 'hjmgngn@gmail.com';				
		$mail->Password = 'bfggfb';				
		$mail->SMTPSecure = 'tls';							
		$mail->From = 'ghnnnn@gmail.com';			
		$mail->FromName = 'Online Examination System';				
		$mail->AddAddress($row["email"], $row["name"]);	
		$mail->WordWrap = 50;							
		$password = 123456;
		$mail->IsHTML(true);		
		$mail->Subject = 'Online Examination System UserID & Password'; 
		$mail->Body = " <b> Hello Student myfullname,</b><br>Your Online Examination System <br> UserId :- <br> Password is :- <b style='font-size:15px;color:Green;background-color:yellow;'>$password</>";   
		

		$mail->AltBody = '';

		$result = $mail->Send();		
	
	}

	if($output == '')
	{
		echo 'ok';
	}
	else
	{
		echo $output;
	}
}

?>
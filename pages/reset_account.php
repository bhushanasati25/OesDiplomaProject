<?php
include '../includes/uniques.php';
include '../database/config.php';
$myid = mysqli_real_escape_string($conn, $_POST['user']);

$sql = "SELECT * FROM tbl_users WHERE user_id = '$myid' OR email = '$myid'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {
$myuserid = $row['user_id'];
$myemail = $row['email'];
$myfname = $row['first_name'];
$mylname = $row['last_name'];
$myfullname = "$myfname $mylname";
$new_password = get_rand_alphanumeric(10);
$encpass = md5($new_password);
$sql = "UPDATE tbl_users SET login='$encpass' WHERE user_id='$myuserid'";

if ($conn->query($sql) === TRUE) {

$message = "<b> Dear $myfullname,</b><b><br><br> Hello, <br>We received a request for your new password for the Online Examination System account, therefore your password have been changed to </b><br><b style='font-size:20px;color:Green;background-color:yellow;'>$new_password</b>";   
require '../mail/PHPMailerAutoload.php';

$mail = new PHPMailer;
                          

$mail->isSMTP();                                      
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;                               
$mail->Username = 'project434@gmail.com';           
$mail->Password = 'fgghghh';                         
$mail->SMTPSecure = 'tls';                            
$mail->Port = 587;                                   

$mail->setFrom('project434@gmail.com', 'Oes Admin');
$mail->addAddress($myemail , $myfullname);              
   
$mail->isHTML(true);                                 

$mail->Subject = '....!!....Oes Password Forget....!!....';
$mail->Body    = $message;
$mail->AltBody = $message;

if(!$mail->send()) {

} else {
header("location:../forgot_pw.php?rp=1804");
}


} else {
header("location:../forgot_pw.php?rp=1100");
}

	
    }
} else {
header("location:../forgot_pw.php?rp=8924");
}
$conn->close();
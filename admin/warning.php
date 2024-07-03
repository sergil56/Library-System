
<?php

require_once 'includes/conn.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require "../vendor/phpmailer/src/Exception.php";
require "../vendor/phpmailer/src/PHPMailer.php";
require "../vendor/phpmailer/src/SMTP.php";

$today = date('Y-m-d');
$twoDaysAhead = date('Y-m-d', strtotime('+2 days'));

$sql = "SELECT * FROM tbl_issue WHERE due_date = '$twoDaysAhead'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $to = $_POST['email'];

        // Initialize PHPMailer
        $mail = new PHPMailer(true);

        // Server settings
        $mail->isSMTP();                              
        $mail->Host       = 'smtp.gmail.com';       
        $mail->SMTPAuth   = true;             
        $mail->Username   = 'cyrhiljohnc@gmail.com';   
        $mail->Password   = 'jgqtqwstvjvtkwbc';      
        $mail->SMTPSecure = 'ssl';           
        $mail->Port       = 465;

        // Email content
        $mail->setFrom( $_POST["email"],"MNHS Library"); 
        $mail->addAddress($to);
        $mail->Subject = 'Reminder: Your return date is approaching';
        $mail->Body = 'Dear User, 

        Just a friendly reminder that your return date is approaching. Please make sure to return your item(s) on time. 

        Best regards,
        Your Website Team';

        // Send email
        if ($mail->send()) {
            echo 'Email sent successfully';
        } else {
            echo 'Email could not be sent. Mailer Error: ' . $mail->ErrorInfo;
        }
    }
} else {
    echo "No returns found two days ahead.";
}

$conn->close();
?>



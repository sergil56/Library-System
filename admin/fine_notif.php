<?php
//Start of the session
session_start();

// Check if user is not logged in
if (!isset($_SESSION['id'])) {
    header("Location: index.php");
    exit();
}
?>

<?php


//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require "../vendor/phpmailer/src/Exception.php";
require "../vendor/phpmailer/src/PHPMailer.php";
require "../vendor/phpmailer/src/SMTP.php";

if (isset($_POST["send"])) {

  $mail = new PHPMailer(true);

    //Server settings
    $mail->isSMTP();                              
    $mail->Host       = 'smtp.gmail.com';       
    $mail->SMTPAuth   = true;             
    $mail->Username   = 'cyrhiljohnc@gmail.com';   
    $mail->Password   = 'jgqtqwstvjvtkwbc';      
    $mail->SMTPSecure = 'ssl';           
    $mail->Port       = 465;                                    

    //Recipients
    $mail->setFrom( $_POST["email"],"MNHS Library"); 
    $mail->addAddress($_POST["email"]);    
    $mail->addReplyTo('mnhslibrary@gmail.com', "MNHS Library"); 

    //Content
    $mail->isHTML(true);               
    $mail->Subject = 'Library Notice: Return Reminder - No Reply Necessary'; 
    $mail->Body    = '
    <h4>Dear '.$_POST["name"]. ',</h4>

    <p>I hope this email finds you well. This is just a friendly reminder regarding the book you borrowed from Manjuyod National High School Library.</p>

          <li><strong>Date Borrowed:</strong> '.$_POST["issue_date"].'</li>
          <li><strong>Borrowed Book Title:</strong> '.$_POST["book_name"].'</li>
          <li><strong>Author:</strong> '.$_POST["author"].'</li>
          <li><strong>Borrower\'s Name:</strong> '.$_POST["name"].'</li>
          <li><strong>Penalty</strong> '.$_POST["fine"].'</li>
            
    <p>As per our records, the book mentioned above is overdued and you need make sure to return the book and pay the late fees or penalties.

    <p> If you have already returned the book, please disregard this reminder.</p>
    
    <p> If you have any questions or concerns regarding your library account or this notice, please contact the library staff at the Library.</p>

    <h4>Thank you for your cooperation.</h4>
    <h4>Best regards,<br> MNHS Library</h4>';

  // Success sent message alert
    $mail->send();
    echo
    " 
    <script> 
     alert('Message was sent successfully!');
     document.location.href = 'fines.php?id';
    </script>
    ";
}
?>



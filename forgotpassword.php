<?php
include 'connection.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


function sendMail($email, $reset_token)
{
    require('PHPMailer/PHPMailer.php');
    require('PHPMailer/SMTP.php');
    require('PHPMailer/Exception.php');

    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();                    // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';  // Set the SMTP server to send through
        $mail->SMTPAuth   = true;           // Enable SMTP authentication
        $mail->Username   = 'takemichi3123@gmail.com'; // SMTP username
        $mail->Password   = 'etzuorpwivlaelmc';   // SMTP password
        $mail->SMTPSecure= 'tls' ;
        $mail->SMTPAutoTLS = true;          // Enable SMTP AutoTLS
        $mail->Port       = 587;            // TCP port to connect to
        $mail->SMTPDebug  = 1; // Enable SMTP debug

        // Recipients
        $mail->setFrom('takemichi3123@gmail.com', 'Bcas ADMIN');
        $mail->addAddress($email);          // Add a recipient
        $mail->addReplyTo($email);

        // Content
        $mail->isHTML(true);                // Set email format to HTML
        $mail->Subject = 'Password reset link from BCAS admin';
        $mail->Body    = "Hello <br>
                            : <br>
                            <a href='http://localhost/blood-donation-management-system-master/updatepassword.php?email=$email&reset_token=$reset_token'>Reset Password</a>";
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}

if (isset($_POST['send-reset-link'])) {
    $query = "SELECT * FROM `users` WHERE `email` = '" . $_POST['email'] . "'";
    $result = mysqli_query($conn, $query);
    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            $reset_token = bin2hex(random_bytes(16));
            $date = date("Y-m-d");
            $query = "UPDATE users SET `resettoken`='$reset_token',`resettokenexpire`='$date' WHERE `email`='" . $_POST['email'] . "'";
            if (mysqli_query($conn, $query) && sendMail($_POST['email'], $reset_token)) {
                echo "
                <script>
                    alert('Password Reset Link sent to mail');
                    window.location.href='login.php';
                </script>
                ";
            } else {
                echo "
                <script>
                    alert('Server Down!! Error: " . mysqli_error($conn) . "');
                    window.location.href='login.php';
                </script>
                ";
            }
        } else {
            echo "
            <script>
                alert('Invalid email');
                window.location.href='login.php';
            </script>
            ";
        }
    } else {
        echo "
        <script>
            alert('Cannot run query');
            window.location.href='login.php';
        </script>
        ";
    }
}
?>


    // if(isset($_POST['send-reset-link']))
    // {
    //     $query = "SELECT * FROM  `admin` WHERE `email`='$_POST[email]'";
    //     $result = mysqli_query($conn, $query);
    //     if($result)
    //     {
    //         if(mysqli_num_rows($result)==1)
    //         {
    //             $reset_token=bin2hex(random_bytes(16));
    //             // date_default_timezone_set('Asia/Philippines');
    //             $date=date("Y-m-d");
    //             $query="UPDATE `admin` SET `resettoken`='$reset_token',`resettokenexpire`='$date' WHERE `email`='$_POST[email]'";
    //             if(mysqli_query($conn, $query) && sendMail($_POST['email'],$reset_token))
    //             {
    //                 echo"
    //                 <script>
    //                     alert('Password Reset Link sent to mail');
    //                     window.location.href='login_admin.php';
    //                     </script>
    //                 ";
    //             }
    //             else
    //             {
    //                 echo"
    //                 <script>
    //                     alert(' Server Down!!');
    //                     window.location.href='login_admin.php';
    //                     </script>
    //                 ";
    //             }
    //         }
    //         else
    //         {
    //             echo"
    //             <script>
    //                 alert('invalid email');
    //                 window.location.href='login_admin.php';
    //                 </script>
    //             ";
    //         }
    //     }
    //     else
    //     {
    //         echo"
    //         <script>
    //             alert('cannot run query');
    //             window.location.href='login_admin.php';
    //             </script>
    //         ";
            
    //     }
    // }
?>
<?php 
	include('../lib/session.php');
	Session::checkLogin();
?>
<?php 
	include('../config/config.php');
    include('../lib/database.php');
    include('../helpers/format.php');
?>
<?php 
	$db = new Database();
	$fm = new Format();
?>

<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Password Recovery</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">
		<?php
			if($_SERVER['REQUEST_METHOD'] == 'POST')
			{
				$email = $fm->validation($_POST['email']);
				$email = mysqli_real_escape_string($db->link,$email);

                if(!filter_var($email, FILTER_VALIDATE_EMAIL))
                {
                    echo "<span style='color:red; font-size:18px;'>Invalid Email Address!!.</span>";
                }else{

                    $emailquery = "SELECT * FROM tbl_user where email='$email' LIMIT 1";
                    $mailcheck = $db->select($emailquery);

                    if ($mailcheck != false) {

                        while($value = $mailcheck->fetch_assoc())
                        {
                            $userid = $value['id'];
                            $username = $value['username'];
                        }
                        
                        $text = substr($email, 0,3);
                        $rand = rand(1000,99999);
                        $newpass = "$text$rand";
                        $password = md5($newpass);

                        $query = "UPDATE tbl_user SET name='$password' WHERE id='$userid'";
                        $categoryUpdate = $db->update($query);

                        $to = "$email";
                        $from = "nazmus.shakib.cse@gmail.com";
                        $headers = "From: $from\n";
                        $headers .= 'MIME-Version: 1.0';
                        $headers .= 'Content-type: text/html; charset=iso-8859-1';
                        $subject = "Your Password";
                        $message = "You username is ".$username." and password is ".$newpass." Please Visit website to login.";

                        $sendmail = mail($to, $subject, $message, $headers);

                        if($sendmail)
                        {
                            echo "<span style='color:green; font-size:18px;'>Please check your email for new password!!.</span>";
                        }else{
                            echo "<span style='color:red; font-size:18px;'>Email Not Send!!.</span>";
                        }
                        
                        
                    } else {
                        echo "<span style='color:red; font-size:18px;'>Email Not Exits!!.</span>";
                    }
                }
			}
		?>
		<form action="" method="POST">
			<h1>Password Recovery</h1>
			<div>
				<input type="text" placeholder="Enter Valid Email" required="" name="email"/>
			</div>
			<div>
				<input type="submit" value="Send Mail" />
			</div>
		</form><!-- form -->
		<div class="button">
			<a href="login.php">Login !</a>
		</div><!-- button -->
		<div class="button">
			<a href="#">Training with live project</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>
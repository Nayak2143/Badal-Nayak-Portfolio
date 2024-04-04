<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer autoloader
require './PHPMailer/src/Exception.php';
require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';

if (isset($_POST['send'])) {
    // echo("hello");
    try {
        $mail = new PHPMailer(true);

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'badal.kalia12@gmail.com';
        $mail->Password = 'igfhuhizrtcxfrav'; // not required in this example, but is if you are not
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // $mail->setFrom('badal.kalia12@gmail.com', 'Badal Nayak'); // Set your name here

        // Admin email address
        $adminEmail = 'badal.kalia12@gmail.com';
        $mail->addAddress($adminEmail);

        // User email address
        $userEmail = $_POST["email"];
        // $mail->addAddress($userEmail);

        $mail->isHTML(true);

        // Subject for admin
        $mail->Subject = 'Contact Form Submission from ' . $_POST["name"];

        // Body for admin (contains all details)
        $mail->Body = '
            <html>
            <head>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                    }
                    h2 {
                        color: #333;
                    }
                    p {
                        color: #666;
                    }
                </style>
            </head>
            <body>
                <h2>Contact Form Submission</h2>
                <p><strong>Name:</strong> ' . $_POST["name"] . '</p>
                <p><strong>Email:</strong> ' . $_POST["email"] . '</p>
                <p><strong>Telephone:</strong> ' . $_POST["tel"] . '</p>
                <p><strong>Project Name:</strong> ' . $_POST["project-name"] . '</p>
                <p><strong>Message:</strong> ' . $_POST["message"] . '</p>
            </body>
            </html>
        ';

        // Send email to admin
        $mail->send();

        // Clone the $mail object for the second email
        $mailUser = clone $mail;

        // Reset recipients and subject for user
        $mailUser->clearAddresses();
        $mailUser->clearCCs();
        $mailUser->clearBCCs();
        $mailUser->clearReplyTos();
        $mailUser->Subject = 'Thank you for contacting us';
        $mailUser->addAddress($userEmail);

        // Body for user (notification)
        $mailUser->Body = '
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>One Letter</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" style="background: #e7e7e7; width: 100%; height: 100%; margin: 0; padding: 0;">
	<div id="mailsub">
		<center class="wrapper" style="table-layout: fixed; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; padding: 0; margin: 0 auto; width: 100%; max-width: 960px;">
	        <div class="webkit">
				<table cellpadding="0" cellspacing="0" border="0" bgcolor="#ffffff" style="padding: 0; margin: 0 auto; width: 100%; max-width: 960px;">
					<tbody>
						<tr>
							<td align="center">
								<table id="intro" cellpadding="0" cellspacing="0" border="0" bgcolor="#4F6331" align="center" style="width: 100%; padding: 0; margin: 0; background-image: url(https://github.com/lime7/responsive-html-template/blob/master/index/intro__bg.png?raw=true); background-size: auto 102%; background-position: center center; background-repeat: no-repeat; background-color: #080e02">
									<tbody >
										<tr><td colspan="3" height="20"></td></tr>
										<tr>
											<td width="330" style="width: 33%;"></td>
											<!-- Logo -->
											<td width="300" style="width: 30%;" align="center">
												<a href="#" target="_blank" border="0" style="border: none; display: block; outline: none; text-decoration: none; line-height: 60px; height: 60px; color: #ffffff; font-family: Verdana, Geneva, sans-serif;  -webkit-text-size-adjust:none;">
                                                <h3 style="color:#fff;">Badal Nayak</h3>
												</a>
											</td>
											<td width="330" style="width: 33%;" align="right">
												<div style="text-align: center; max-width: 150px; width: 100%;">
													<span>&nbsp;</span>
													<a href="#" target="_blank" border="0" style="border: none; outline: none; text-decoration: none; line-height: 60px; color: #ffffff; font-family: Verdana, Geneva, sans-serif;  -webkit-text-size-adjust:none">
														<img src="https://github.com/lime7/responsive-html-template/blob/master/index/f.png?raw=true" alt="facebook.com" border="0" width="11" height="23" style="border: none; outline: none; -ms-interpolation-mode: bicubic;">
													</a>
													<span>&nbsp;</span>
													<a href="#" target="_blank" border="0" style="border: none; outline: none; text-decoration: none; line-height: 60px; color: #ffffff; font-family: Verdana, Geneva, sans-serif; -webkit-text-size-adjust:none">
														<img src="https://github.com/lime7/responsive-html-template/blob/master/index/vk.png?raw=true" alt="vk.com" border="0" width="39" height="23" style="border: none; outline: none; -ms-interpolation-mode: bicubic;">
													</a>
													<span>&nbsp;</span>
													<a href="#" target="_blank" border="0" style="border: none; outline: none; text-decoration: none; line-height: 60px; color: #ffffff; font-family: Verdana, Geneva, sans-serif; -webkit-text-size-adjust:none;">
														<img src="https://github.com/lime7/responsive-html-template/blob/master/index/g+.png?raw=true" alt="google.com" border="0" width="23" height="23" style="border: none; outline: none; -ms-interpolation-mode: bicubic;">
													</a>
													<span>&nbsp;</span>
												</div>
											</td>
										</tr>
										<tr><td colspan="3" height="100"></td></tr>
										<tr>
											<td colspan="3" height="60" align="center">
												<div border="0" style="border: none; line-height: 60px; color: #ffffff; font-family: Verdana, Geneva, sans-serif; font-size:32px; text-transform: uppercase; font-weight: bolder;">Dear ' . $_POST["name"] . '</div>
											</td>
										</tr>
										<tr>
											<td colspan="3" height="20" valign="bottom" align="center">
												<img src="https://github.com/lime7/responsive-html-template/blob/master/index/line-1.png?raw=true" alt="line" border="0" width="464" height="5" style="border: none; outline: none; max-width: 464px; width: 100%; -ms-interpolation-mode: bicubic;" >
											</td>
										</tr>
										<tr>
											<td colspan="3">
												<table cellpadding="0" cellspacing="0" border="0" align="center" style="padding: 0; margin: 0; width: 100%;">
													<tbody>
														<tr>
															<td width="90" style="width: 9%;"></td>
															<td align="center">
																<div border="0" style="border: none; height: 60px;">
																	<p style="font-size: 18px; line-height: 24px; font-family: Verdana, Geneva, sans-serif; color: #ffffff; text-align: center; mso-table-lspace:0;mso-table-rspace:0;">
                                                                    Thank you for reaching out to us. We will get back to you soon.</p>
																</div>
															</td>
															<td width="90" style="width: 9%;"></td>
														</tr>
													</tbody>
												</table>
											</td>
										</tr>
										<tr>
                                        <td colspan="3" height="160"></td></tr>
										<tr><td colspan="3" height="85"></td></tr>
									</tbody>
								</table>			
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</center> 
	</div> 
</body>

</html>
        ';

        // Send email to user
        $mailUser->send();

        echo "<script>alert('Sent successfully'); document.location.href = 'index.php';</script>";
    } catch (Exception $e) {
        echo "<script>alert('Mailer Error: " . $mail->ErrorInfo . "'); document.location.href = 'index.php';</script>";
    }
}
?>
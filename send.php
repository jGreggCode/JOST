<?php 

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'Mail/src/Exception.php';
    require 'Mail/src/PHPMailer.php';
    require 'Mail/src/SMTP.php';

    $mail = new PHPMailer(true);
    $registerEmail = "";
    $registerUserType = "";
    $activatedEmail = "";
    $activatedAccountType = "";
    $activateDetailsUserStatus = "";

    if (isset($_POST['registerEmail'])) {
        $registerEmail = $_POST['registerEmail'];
		$registeruserType = $_POST['registerUserType'];

        registerSendEmail($registeruserType, $registerEmail);
    }

    if (isset($_POST['userDetailsUserEmail'])) {
        $activatedEmail = $_POST['userDetailsUserEmail'];
        $activatedAccountType = $_POST['userDetailsUserPosition'];
        $activateDetailsUserStatus = $_POST['userDetailsUserStatus'];
        

        if ($activateDetailsUserStatus === 'Active') {
            accountActivatedEmail($activatedAccountType, $activatedEmail);

            echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>Account Activated</div>';
            
        }
        exit();
    }

    function accountActivatedEmail($accountType, $recipientEmail) {
        try {
            global $mail;
            $mail->isSMTP();
            $mail->Host = 'smtp.hostinger.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'noreply@jasdyofficesupplies.shop';
            $mail->Password = '10kls.Smalltank';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 465;
    
            // Set sender and recipient
            $mail->setFrom('noreply@jasdyofficesupplies.shop', 'JASDY OFFICE SUPPLIES TRADING');
            $mail->addAddress($recipientEmail);
            $mail->isHTML(true);
            $mail->Subject = "Account Activation " .  "(" . $accountType . ")";
    
            // Embed logo
            $mail->AddEmbeddedImage('data/item_images/logowithbg.jpg', 'logo_img');
    
            // HTML Email Content
            $mail->Body = "
            <html>
            <head>
                <style>
                    body {
                        background: linear-gradient(135deg, #ffffff, #000000);
                        font-family: Arial, sans-serif;
                        color: #333333;
                        padding: 20px;
                    }
                    .email-container {
                        max-width: 600px;
                        margin: auto;
                        background: #ffffff;
                        padding: 20px;
                        border-radius: 10px;
                        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                    }
                    .header {
                        text-align: center;
                        padding: 20px;
                    }
                    .header img {
                        width: 150px;
                        margin-bottom: 20px;
                    }
                    .content {
                        text-align: center;
                        font-size: 18px;
                        line-height: 1.6;
                    }
                    .code {
                        display: inline-block;
                        font-size: 24px;
                        font-weight: bold;
                        background: #000000;
                        color: #ffffff;
                        padding: 10px 20px;
                        border-radius: 5px;
                        margin-top: 20px;
                    }
                    .note {
                        text-align: center;
                    }
                    .footer {
                        margin-top: 30px;
                        font-size: 12px;
                        color: #555555;
                        text-align: center;
                    }
                </style>
            </head>
            <body>
            <div class='email-container'>
                <div class='header'>
                    <img src='cid:logo_img' alt='System Logo'>
                    <h2>Your account has been activated!</h2>
                </div>
                <div class='content'>
                    <p>We are pleased to inform you that your account has been successfully activated. You can now access all our services and features. As an <b>$accountType</b></p>
                    <p>Thank you for choosing us!</p>
                </div>
                <div class='note'>
                    <p><strong>Note:</strong> If you have any issues accessing your account, please feel free to contact us at <b>+63 906 236 4630</p>
                </div>
                <div class='footer'>
                    <p>You may now REST IN PEACE FUCK YOU!</p>
                </div>
            </div>
            </body>
            </html>
            ";
    
            // Send the email
            $mail->send();
            
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

    function registerSendEmail($accountType, $recipientEmail) {
        try {
            global $mail;
            $mail->isSMTP();
            $mail->Host = 'smtp.hostinger.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'noreply@jasdyofficesupplies.shop';
            $mail->Password = '10kls.Smalltank';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 465;
    
            // Set sender and recipient
            $mail->setFrom('noreply@jasdyofficesupplies.shop', 'JASDY OFFICE SUPPLIES TRADING');
            $mail->addAddress($recipientEmail);
            $mail->isHTML(true);
            $mail->Subject = "Account Registration " .  "(" . $accountType . ")";
    
            // Embed logo
            $mail->AddEmbeddedImage('data/item_images/logowithbg.jpg', 'logo_img');
    
            // HTML Email Content
            $mail->Body = "
            <html>
            <head>
                <style>
                    body {
                        background: linear-gradient(135deg, #ffffff, #000000);
                        font-family: Arial, sans-serif;
                        color: #333333;
                        padding: 20px;
                    }
                    .email-container {
                        max-width: 600px;
                        margin: auto;
                        background: #ffffff;
                        padding: 20px;
                        border-radius: 10px;
                        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                    }
                    .header {
                        text-align: center;
                        padding: 20px;
                    }
                    .header img {
                        width: 150px;
                        margin-bottom: 20px;
                    }
                    .content {
                        text-align: center;
                        font-size: 18px;
                        line-height: 1.6;
                    }
                    .code {
                        display: inline-block;
                        font-size: 24px;
                        font-weight: bold;
                        background: #000000;
                        color: #ffffff;
                        padding: 10px 20px;
                        border-radius: 5px;
                        margin-top: 20px;
                    }
                    .note {
                        text-align: center;
                    }
                    .footer {
                        margin-top: 30px;
                        font-size: 12px;
                        color: #555555;
                        text-align: center;
                    }
                </style>
            </head>
            <body>
                <div class='email-container'>
                    <div class='header'>
                        <img src='cid:logo_img' alt='System Logo'>
                        <h2>Thank you for registering!</h2>
                    </div>
                    <div class='content'>
                        <p>Your registration is currently being reviewed by our administration team. You will receive an email once your profile has been approved.</p>
                        <p>We appreciate your patience during this process.</p>
                    </div>
                    <div class='note'>
                        <p><strong>Note:</strong> Please be patient as we work to review all registrations. Thank you!</p>
                    </div>
                    <div class='footer'>
                        <p>If you have any questions, please feel free to contact us at <b>+63 906 236 4630</b></p>
                    </div>
                </div>
            </body>
            </html>
            ";
    
            // Send the email
            $mail->send();
            
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

    function changePasswordEmail($verificationCode, $recipientEmail) {
        try {
            global $mail;
            $mail->isSMTP();
            $mail->Host = 'smtp.hostinger.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'noreply@jasdyofficesupplies.shop';
            $mail->Password = '10kls.Smalltank';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 465;
            $mail->SMTPDebug = 2;
    
            // Set sender and recipient
            $mail->setFrom('noreply@jasdyofficesupplies.shop', 'JASDY OFFICE SUPPLIES TRADING');
            $mail->addAddress($recipientEmail);
            $mail->isHTML(true);
            $mail->Subject = "Change Password Verification";
    
            // Embed logo
            $mail->AddEmbeddedImage('data/item_images/logowithbg.jpg', 'logo_img');
    
            // HTML Email Content
            $mail->Body = "
            <html>
            <head>
                <style>
                    body {
                        background: linear-gradient(135deg, #ffffff, #000000);
                        font-family: Arial, sans-serif;
                        color: #333333;
                        padding: 20px;
                    }
                    .email-container {
                        max-width: 600px;
                        margin: auto;
                        background: #ffffff;
                        padding: 20px;
                        border-radius: 10px;
                        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                    }
                    .header {
                        text-align: center;
                        padding: 20px;
                    }
                    .header img {
                        width: 150px;
                        margin-bottom: 20px;
                    }
                    .content {
                        text-align: center;
                        font-size: 18px;
                        line-height: 1.6;
                    }
                    .code {
                        display: inline-block;
                        font-size: 24px;
                        font-weight: bold;
                        background: #000000;
                        color: #ffffff;
                        padding: 10px 20px;
                        border-radius: 5px;
                        margin-top: 20px;
                    }
                    .note {
                        text-align: center;
                    }
                    .footer {
                        margin-top: 30px;
                        font-size: 12px;
                        color: #555555;
                        text-align: center;
                    }
                </style>
            </head>
            <body>
                <div class='email-container'>
                <div class='header'>
                    <img src='cid:logo_img' alt='System Logo'>
                    <h2>Welcome to JASDY OFFICE SUPPLIES TRADING</h2>
                </div>
                <div class='content'>
                    <p>Use the verification code below to complete your change password request:</p>
                    <div class='code'>{$verificationCode}</div>
                    <p>This code will expire in 30 minutes.</p>
                </div>
                <div class='footer'>
                    <p>If you did not request this code, please ignore this email or contact our support team.</p>
                </div>
            </div>
            </body>
            </html>
            ";
    
            // Send the email
            $mail->send();
            echo 'Verification email has been sent.';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

    
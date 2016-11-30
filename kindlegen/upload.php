<?php

require_once('phpmailer/PHPMailerAutoload.php');

$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

// Allow certain file formats
if($imageFileType != "opf" && $imageFileType != "epub" && $imageFileType != "html"
&& $imageFileType != "htm" && $imageFileType != "zip" ) {
    echo "Sorry, only opf, ePub, htm, html, & zip files are allowed.<br />";
// if everything is ok, try to upload file
} else {
    $filena = basename($_FILES["fileToUpload"]["name"]);
    $newFile = substr($filena, 0 , (strrpos($filena, ".")));
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded, and has been processed.\n";
	$linuxfilename = str_replace(" ","\\ ",basename( $_FILES["fileToUpload"]["name"]));
        $output=shell_exec("./kindlegen uploads/". $linuxfilename);
        echo "<pre>$output</pre>";
	if(strpos($output, 'Mobi file built successfully') !== false ){
		echo "Mobi file built successfully.<br />";
		kindlemail($_POST["to"], $newFile);
	} else {
		echo "There was a problem processing the file.<br />";
	}
    } else {
        echo "Sorry, there was an error uploading your file.<br />";
    }
    shell_exec("rm uploads/". str_replace(" ","\\ ",$newFile). ".*");
}

function kindlemail($to, $filename){

	//PHPMailer Object
	$mail = new PHPMailer;

	//From email address and name
	$mail->From = "a@b.com";
	$mail->FromName = "Kindlegen Webapp";

	//To address and name
	$mail->addAddress($to. "@kindle.com"); //Recipient name is optional

	$mail->addAttachment("uploads/". $filename. ".mobi");

	//Send HTML or Plain Text email
	$mail->isHTML(true);

	$mail->Subject = "";
	$mail->Body = " ";
	$mail->AltBody = " ";

	if(!$mail->send()) {
	echo "Mailer Error: " . $mail->ErrorInfo;
	echo "<br />Mobi file wasn't sent";
	}
	else {
		echo "Mobile file has been sent successfully";
	}

}

?>

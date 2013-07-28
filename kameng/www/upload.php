<?php

require_once("includes/connect.php");
require_once("includes/functions.php");

session_check();

$username = $_SESSION["username"];
$query = "SELECT Credits FROM tbl_users ";
$query.= "WHERE Username='$username' ";
$query.= "LIMIT 1";
$row = mysql_fetch_array(mysql_query($query));
$credits = $row["Credits"];

?>

<!DOCTYPE html>

<html>

<head>
<title>Processing the uploaded file...</title>
</head>

<body>

Processing the uploaded file...

<?php

//Check that we have a file
if ((!empty($_FILES["uploaded_file"])) && ($_FILES["uploaded_file"]["error"] == 0)) {
	//Check if the file is PDF image and it's size is less than 0.93 GB
	$filename = basename($_FILES["uploaded_file"]["name"]);
	$ext = substr($filename, strrpos($filename, '.') + 1);
	
	/*
	
	File size check has been disabled:
	
	if (($ext == "pdf") && ($_FILES["uploaded_file"]["type"] == "application/pdf") && 
	($_FILES["uploaded_file"]["size"] < 1000000000))
	
	*/
	
	if (($ext == "pdf") && ($_FILES["uploaded_file"]["type"] == "application/pdf")) {
	
		//Determine the path to which we want to save this file
		
		/*
		
		for server:
		$newname = dirname(__FILE__).'/../printer/upload/'.$filename;
		
		for local:
		$newname = dirname(__FILE__).'/sandbox/printer/upload/'.$filename;
		
		Note: $tempname remains the same for both server and local
		
		*/
		
		$tempname = dirname(__FILE__) . '/includes/' . $filename;
		$newname = dirname(__FILE__).'/../printer/upload/'.$filename;
		
		//Check if the file with the same name is already exists on the server
		if (!file_exists($newname)) {
			//Check if sufficient credits are there for the print job (determine number of pages in the pdf)
			if ((move_uploaded_file($_FILES["uploaded_file"]["tmp_name"],$tempname))) {
				$pages = getNumPagesInPDF($tempname);
				
			} else {
				msg_redir("Error: The number of pages in the PDF could not be determined. The file could be corrupt. Please try again.", "profile.php");
			}			
			
			if ($pages > $credits) {
				msg_redir("Error: Sorry, you do not have sufficient credits for the print job. Please buy credits from Kameng Technical Secretary.", "profile.php");
			} else {
				//Attempt to move the uploaded file to it's new place

				if ((copy($tempname,$newname))) {
					unlink($tempname);
					
					//Perform update of credits in database
					$newcredits = $credits - $pages;
					$query = "UPDATE tbl_users ";
					$query.= "SET Credits='$newcredits', LastPrint='$pages', TotalPrint=TotalPrint+'$pages' ";
					$query.= "WHERE Username='$username' ";
					$query.= "LIMIT 1";
					mysql_query($query) or die("db_update failed! <br />" . mysql_error());
					
					date_default_timezone_set("Asia/Calcutta"); // IST
					$logfile = date("Ym") . ".csv";
					$file_flag = file_exists(dirname(__FILE__) . "/logs/" . $logfile);
					$logfile_handle = fopen(dirname(__FILE__) . "/logs/" . $logfile, "a");
					if ($file_flag == FALSE) {
						fputcsv($logfile_handle, array("Date", "Time", "IP", "User", "File", "Pages"));
					}
					fputcsv($logfile_handle, array(date("d-m-Y"), date("h:i:s A"), getIP(), $username, $filename, $pages));
					fclose($logfile_handle);
					
					msg_redir("Your file is being printed. Please collect the print-out at Kameng security desk. Pages in the PDF: " . $pages, "profile.php");
					
				} else {
					msg_redir("Error: A problem occurred during file upload process. Please contact Kameng Technical Secretary or Kameng Webmaster", "profile.php");
				}
			}
		} else {
			msg_redir("Error: The file ".$_FILES["uploaded_file"]["name"]." already exists in printer queue. Print has been cancelled.", "profile.php");
		}
	} else {
		// msg_redir("Error: Only .pdf under 0.93 GB are accepted for upload.", "profile.php");
		msg_redir("Error: Please check if the file uploaded was in PDF format. Otherwise, please contact Kameng Technical Secretary or Kameng Webmaster.", "profile.php");
	}
} else {
	msg_redir("Error: No file uploaded.", "profile.php");
}

?>

</body>

</html>

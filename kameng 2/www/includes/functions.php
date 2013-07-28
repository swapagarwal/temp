<?php

function msg_redir($message, $url)
{
	echo "<script type='text/javascript'>alert('". $message . "'); location = '" . $url . "';</script>";
}

function logged_in()
{
	session_start();
	return isset($_SESSION["username"]);
}

function session_check()
{
	if (!logged_in()) {
		header("Location: ./");
		exit;
	}
}

function getNumPagesInPDF($file)
{
	// Extract the number using PHP and native grep

	// for local: $cmd = "C:\\xampp\\htdocs\\kapilgain\\kameng\\private\\includes\\pdfinfo.exe " . '"' . $file . '"' . ' | findstr /B /C:"Pages:"';
	// for server: $cmd = "C:\\wamp\\www\\includes\\pdfinfo.exe " . '"' . $file . '"' . ' | findstr /B /C:"Pages:"';
	
	$cmd = "C:\\wamp\\www\\includes\\pdfinfo.exe " . '"' . $file . '"' . ' | findstr /B /C:"Pages:"';
	exec("$cmd", $output);

	foreach($output as $op)
	{
		if(preg_match("/Pages:\s*(\d+)/i", $op, $matches) !== false) {
			return $matches[1];
		}
		else
			return 0;
	}
}

/* Old PDF Page Count function - found to be faulty - pls dont use this

function getNumPagesInPDF($file) 
{
    //http://www.hotscripts.com/forums/php/23533-how-now-get-number-pages-one-document-pdf.html
    if(!file_exists($file))return null;
    if (!$fp = @fopen($file,"r"))return null;
    $max=0;
    while(!feof($fp)) {
            $line = fgets($fp,255);
            if (preg_match('/\/Count [0-9]+/', $line, $matches)){
                    preg_match('/[0-9]+/',$matches[0], $matches2);
                    if ($max<$matches2[0]) $max=$matches2[0];
            }
    }
    fclose($fp);
    return (int)$max;
}

*/

function getIP()
{
	$ip;
	if (getenv("HTTP_CLIENT_IP"))
		$ip = getenv("HTTP_CLIENT_IP");
	else if (getenv("HTTP_X_FORWARDED_FOR"))
		$ip = getenv("HTTP_X_FORWARDED_FOR");
	else if (getenv("REMOTE_ADDR"))
		$ip = getenv("REMOTE_ADDR");
	else
		$ip = "UNKNOWN";
	return $ip;
}

?>

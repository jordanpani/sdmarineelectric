<?php 
/*
sendemail.php used for index.php contact form on home page

*/
require_once "Mail.php";
	
function debug_to_console( $data ) {

    if ( is_array( $data ) )
        $output = "<script>console.log( 'Debug Objects: " . implode( ',', $data) . "' );</script>";
    else
        $output = "<script>console.log( 'Debug Objects: " . $data . "' );</script>";

    echo $output;
}

$p = "." . PATH_SEPARATOR . ($UserDir = dirname($_SERVER['DOCUMENT_ROOT'])) . "/pear/php" . PATH_SEPARATOR . get_include_path();
debug_to_console( "P is $p");
set_include_path($p);
	


function getIP() {
	if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
		$ip=$_SERVER['HTTP_CLIENT_IP'];
	elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
		$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
	elseif (!empty($_SERVER['REMOTE_ADDR']))   //to check ip is pass from proxy
		$ip=$_SERVER['REMOTE_ADDR'];
	else
		if($arh = apache_request_headers())
			$ip = $arh['PC-Remote-Addr'];
		else
			$ip = "UNKNOWN";
	return $ip;
}



function SendMail($subject, $body, $additionalHeaders) {
	debug_to_console("subject:".$subject. "\nbody:".$body+"\n");
	
	
	$host = "mail.omnis.com";
	$username = "information@stanfordtravel.com";//jordan@galapagoslegend-cruise.com";
	$password = "info-travel12";
	$port = "587";
	$to = "information@stanfordtravel.com";
	$email_from = "information@stanfordtravel.com";//"jordan@4galapagoslegend-cruise.com";
	//$email_subject = "StanfordTravel.com Contact" ;
	//$email_body = "message body" ;
	$email_address = "information@stanfordtravel.com";
	
	$headers = array ('From' => $email_from, 'To' => $to, 'Subject' => $subject, 'Reply-To' => $email_address);
	//$header  = "From: $email_from\r\n"; 
	//$header .= "Subject: $subject\r\n"; 
	//$header .= "Reply-To: $email_address\r\n"; 
	//$header .= "MIME-Version: 1.0\r\n"; 
	//$header .= "Content-Type: text/html; charset=ISO-8859-1\r\n"; 
	if (is_array($additionalHeaders)) 
		$headers = array_merge($headers, $additionalHeaders);


	$smtp = Mail::factory('smtp', array ('host' => $host, 'port' => $port, 'auth' => true, 'username' => $username, 'password' => $password));
	
	//jordan: dont send if ip address is banned
	$ip = getIP();
	
	$bannedIPArray = ["91.200.12.",
	 "91.207.7.", 
	 "91.213.126.", 
	 '46.105.81.'
	 ];
	
	$isBannedIP = false;
	foreach($bannedIPArray as $bannedIP) {
		//if string startswith the banned ip address range
		$s = substr($ip,0, strlen($bannedIP));
		if ($s === $bannedIP) {
			$isBannedIP = true;
			break;
		}
	}
	
	//phpinfo();
	$body = $body . $eol;
	if ($isBannedIP)
	{
		//do not mail if the ip address is banned
		$body = $body . "Spam detected via bannedIP" . $eol; 
		//DO NOT SEND EMAIL, BY COMMENTING OUT NEXT LINE
		//$mail = $smtp->send($to, $headers, $body);
	} else {
		$body = $body . $eol; 
		$mail = $smtp->send($to, $headers, $body);

		if (PEAR::isError($mail)) {
			echo("<p>Mail error: " . $mail->getMessage() . "</p>");
		} else {
			$_POST['e'] = 1;
			//echo("<p>Message successfully sent!</p>");
		}
		
	}

	return $mail;
} //end of function
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<?php echo 'this worked?'; 
$p = "." . PATH_SEPARATOR . ($UserDir = dirname($_SERVER['DOCUMENT_ROOT'])) . "/pear/php" . PATH_SEPARATOR . get_include_path();
//echo "P is $p";
set_include_path($p);
require_once "Mail.php";

$host = "mail.omnis.com";
$username = "information@stanfordtravel.com";//jordan@galapagoslegend-cruise.com";
$password = "info-travel12";
$port = "587";
$to = "information@stanfordtravel.com";
$email_from = "information@stanfordtravel.com";//"jordan@galapagoslegend-cruise.com";
$email_subject = "StanfordTravel.com Contact" ;
$email_body = "message body" ;
$email_address = "information@stanfordtravel.com";

$headers = array ('From' => $email_from, 'To' => $to, 'Subject' => $email_subject, 'Reply-To' => $email_address);
$smtp = Mail::factory('smtp', array ('host' => $host, 'port' => $port, 'auth' => true, 'username' => $username, 'password' => $password));
$mail = $smtp->send($to, $headers, $email_body);


if (PEAR::isError($mail)) {
echo("<p>" . $mail->getMessage() . "</p>");
} else {
	$_POST['e'] = 1;
echo("<p>Message successfully sent!</p>");
}
?>
</body>
</html>
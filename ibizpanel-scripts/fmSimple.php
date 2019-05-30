<?PHP
  $fm_name = $_REQUEST[fm_name];
  list($fm_email,$junk) = split("\n",$_REQUEST[fm_email]);
  $fm_subject = $_REQUEST[fm_subject];
  $fm_body = $_REQUEST[fm_body];
  $fm_address = $_REQUEST[fm_address];
  if (isset($_REQUEST[email]) && $_REQUEST[email] != "" && !isset($_REQUEST[fm_address]))
  {
    $fm_address = $_REQUEST[email];
  }
  $addresses = array('admin@stanfordtravel.com');
  if (!in_array($fm_address, $addresses))
  {
    $fm_address = $addresses[0];
  }

  $headers = "From: $fm_email\n"; 
  $headers .= "X-FormMail-User: admin@stanfordtravel.com\n"; 
  $subject = "iBizPanel Form Mail Post"; 
  $ip_addr = $_SERVER["REMOTE_ADDR"];
  $date = date("D M j Y G:i:s T");
  $body = "IP Address: $ip_addr\nDate: $date\nName: $fm_name\nEmail: $fm_email\nSubject: $fm_subject\nBody: $fm_body";

  mail($fm_address,$subject,$body,$headers);

  $return_url = "http://stanfordtravel.com/";
  if (isset($_REQUEST[fm_return]) && $_REQUEST[fm_return] != "")
  {
    $return_url = $_REQUEST[fm_return];
  }
?>
<html>
<head>
<meta http-equiv="Refresh" content="2; URL=<?PHP echo $return_url ?>"> 
<title>Thank You</title>
</head>
<body bgcolor="white">
<div align="center">
<br><br>
<font size="4">Thank You.</font>
</div>
</body>
</html>

<?php
$cLoc = '';

$form_url = "";
$_POST['form_file'] = isset($_POST['f']) ? $_POST['f'] : (isset($_GET['f']) ? $_GET['f'] : 'index.php' );

if(true){
    $vars = ($REQUEST_METHOD == 'GET') ? $_GET : $_POST;
    foreach ($vars as $k=>$value){
		input_check_query($value);
	}
}

$fee = isset($_POST['fee']) ? $_POST['fee'] : (isset($_GET['fee']) ? $_GET['fee'] : '' );
$rec = isset($_POST['r']) ? $_POST['r'] : (isset($_GET['r']) ? $_GET['r'] : 'x' );
if($rec!=''){
	$rec0 = substr($rec,0,strlen($rec)-5);
	$rec1 = substr($rec,-5);
	if($rec0!=md5(' - AppealMedia.com - '.getIP().$rec1) || $fee!=''){
		header("Location: ".$form_url.$_POST['form_file']);
		exit;
	}
}

// adresa de test
$form_to = 'information@stanfordtravel.com';//'service@stanfordtravel.com';
if(getIP()=='89.121.172.190')
	$form_to = 'nbosneac@appealmedia.com';
// ------------------------------------------------------------------------------------------------------------------------

get_form_data();

// ------------------------------------------------------------------------------------------------------------------------


# Is the OS Windows or Mac or Linux
if (strtoupper(substr(PHP_OS,0,3)=='WIN')) {
	$eol="\r\n";
} elseif (strtoupper(substr(PHP_OS,0,3)=='MAC')) {
	$eol="\r";
} else {
	$eol="\n";
}

$body="";

$cPara = '';
// CEL MAI UZUAL CAZ ~ UN SINGUR FORMULAR DE CONTACT
if($_POST['form_file']=='index.php') {
	$cPara = '#contact';
	$subject = "Contact From Machu Picchu site..";
	$body= $body . "Full Name:  " . $_POST['name'] . $eol . $eol;
	$body= $body . "Email Address:  " . $_POST['email'] . $eol . $eol;
	$body= $body . "Phone:  " . $_POST['phone'] . $eol . $eol;
	$body= $body . "Comments or Questions:  " . $_POST['comments'] . $eol . $eol;
	$body .= "IP:  " . getIP() . $eol;

} else {

	$cPara = '#contact';
	$subject = "Reservation From Machu Picchu site..";
	$fullLine = "-----------------------------------".$eol;
	$body .= $fullLine;
	$body= $body . "Full Name:  " . $_POST['name'] . $eol . $eol;
	$body= $body . "Email Address:  " . $_POST['email'] . $eol . $eol;
	$body= $body . "Day Phone:  " . $_POST['dayphone'] . $eol . $eol;
	$body= $body . "Evening Phone:  " . $_POST['evphone'] . $eol . $eol;
	$body= $body . "Fax Phone:  " . $_POST['fax'] . $eol . $eol;
	$body= $body . "Comments or Questions:  " . $_POST['comments'] . $eol . $eol . $eol . $eol;
	$body= $body . "  TRAVEL AGENT ONLY:" . $eol . $eol;
	$body= $body . "Full Name:  " . $_POST['TA_name'] . $eol . $eol;
	$body= $body . "Email Address:  " . $_POST['TA_email'] . $eol . $eol;
	$body= $body . "Day Phone:  " . $_POST['TA_dayphone'] . $eol . $eol;
	$body= $body . "Evening Phone:  " . $_POST['TA_evphone'] . $eol . $eol;
	$body= $body . "Fax Phone:  " . $_POST['TA_fax'] . $eol . $eol;
	$body= $body . "Comments or Questions:  " . $_POST['TA_comments'] . $eol . $eol . $eol . $eol;
	$body .= $fullLine;
	$body .= "IP:  " . getIP() . $eol;

}
//========================================

// E R R O R   C H E C K --------------------------------------------------------------------------------------------
if(isset($_POST['form_avar']) && isset($_POST['form_amsg']) && isset($_POST['form_aval']) && isset($_POST['form_aftp'])){
	$cErr = '';
	$nNr=0;
	$aVar=explode("|", $_POST['form_avar']);
	$aMsg=explode("|", $_POST['form_amsg']);
	$aVal=explode("|", $_POST['form_aval']);
	$aFtp=explode("|", $_POST['form_aftp']);
	foreach($aVar as $var){
		$val = stripslashes($aVal[$nNr]);
		if($val=="'".trim($_POST[$var])."'" || $val==''){
			$cErr = '1';
		} else {
			$ftp = stripslashes($aFtp[$nNr]);
			if(strpos(' '.$ftp,'E')>0){
				if(!eregi ("^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,6}$", trim($_POST[$var]))){
					$cErr = '2';
					$cFld = $_POST[$var];
				}
			}

	//
	// ONLY FOR SPECIAL CODE
	//
			if(strpos($aFtp[$nNr],'G') !== false){
				$cGCode = trim($_POST[$var]);
			}
	//
	// YOU CAN REMOVE FOR froms WITHOUT SPECIAL CODE
	//

		}
		$nNr+=1;
	}

	//
	// ONLY FOR SPECIAL CODE
	//
	$bErr = false;
	if($cGCode!=''){
		session_start();
		include_once("php/vImage.php");
		$vImage = new vImage();
		$vImage->loadCodes();
		if ($vImage->checkCode()!=true){
			$bErr = true;
			$cErr = "<br>Incorrect Code";
		}
	}
	if($cErr == "<br>Incorrect Code" && !$bErr){
		$cErr = "";
	}
	//
	// YOU CAN REMOVE FOR froms WITHOUT SPECIAL CODE
	//
} else {
	$cErr = "The Security Code is required!";
}

if($cErr!=''){
	$cVal = '';
	$cLoc = '';
	include_once('php/cookie.php');
	sess_start("temp/","");
	foreach (array("_POST") as $source) {
		foreach (${$source} as $idx => $value) {
			if(strpos($key,'form_') === false){
				sess_register($idx);
				$cEval = '$'.$idx.'="'.urlencode($value).'";';
				eval($cEval);
			}
		}
	}

	// Permanent redirection
	sess_register('cErr');
	sess_register('cFld');
	sess_register('form_url');
	sess_register('refpage');
	$refpage=$_POST['form_file'];
	sess_close();
	$eChar = md5(rand(0,32000) . time() . rand(0,32000));
	$cVal = "?k=".substr($eChar,0,8).$MYSID;

	header("HTTP/1.1 301 Moved Permanently");
	header("Location: ".$refpage.$cVal.$cPara);
	exit;
}


$_AHSKey = '92b3564bbfc38bac0b999e78b4e87d1dc91cc5338';
$_AHSLevel = 95;
$_AHSUrl = $form_url.$_POST['form_file'];
include_once('AHSCheck.php');

// ------------------------------------------------------------------------------------------------------------------------
if($cErr==''){

	$headers  = "From: " . $_POST["name"] ." " . "<" . $_POST["email"] .">".$eol;
	$headers .= "Reply-To: " . $_POST["email"] . $eol;
	$headers .= "Return-path: " . $_POST["email"] . $eol;
	$headers .= "X-Mailer: PHP v".phpversion() . $eol;
	
if(getIP()=='89.121.172.190'){
	print $headers;
	print '-------------------------------------------------<br>';
	print $body;
	exit;
}

	$nSend = mail($form_to, $subject, $body, $headers, "-f".$form_to);
	if($nSend==0)
		$nSend = mail($form_to, $subject, $body, $headers);
	if($nSend==1)
		header("Location: ".$form_url.$_POST['form_file']."?s=1".$cLink.$cPara);
	else
		header("Location: ".$form_url.$_POST['form_file']."?s=0".$cLink.$cPara);
}
//-----------------------------------------------------------------------------------------------------------------------------
function get_form_data(){
    global $REQUEST_METHOD;
    global $HTTP_POST_VARS;
    global $HTTP_GET_VARS;
    
   	//strip spaces from all fields
    $vars = ($REQUEST_METHOD == 'GET') ? $_GET : $_POST;
    foreach ($vars as $k=>$value){
		input_check_mailinj($value);
	}
}


function input_check_mailinj($value)
{
   # mail adress(ess) for reports...
   $report_to = "nbosneac@appealmedia.com";

   # array holding strings to check...
   $suspicious_str = array
   (
       "content-type:"
       ,"charset="
       ,"mime-version:"
       ,"multipart/mixed"
       ,"bcc:"
       ,"cc:"
   );

   // remove added slashes from $value...
   $value = stripslashes($value);

   foreach($suspicious_str as $suspect)
   {
       # checks if $value contains $suspect...
       if(eregi($suspect, strtolower($value)))
       {
           $ip = (empty($_SERVER['REMOTE_ADDR'])) ? 'empty' : $_SERVER['REMOTE_ADDR']; // replace this with your own get_ip function...
           $rf = (empty($_SERVER['HTTP_REFERER'])) ? 'empty' : $_SERVER['HTTP_REFERER'];
           $ua = (empty($_SERVER['HTTP_USER_AGENT'])) ? 'empty' : $_SERVER['HTTP_USER_AGENT'];
           $ru = (empty($_SERVER['REQUEST_URI'])) ? 'empty' : $_SERVER['REQUEST_URI'];
           $rm = (empty($_SERVER['REQUEST_METHOD'])) ? 'empty' : $_SERVER['REQUEST_METHOD'];

           # if so, file a report...
           if(isset($report_to) && !empty($report_to))
           {
               @mail
               (
                     $report_to
                   ,"[ABUSE] mailinjection @ " . $_SERVER['HTTP_HOST'] . " by " . $ip
                   ,"Stopped possible mail-injection @ " . $_SERVER['HTTP_HOST'] . " by " . $ip . " (" . date('d/m/Y H:i:s') . ")\r\n\r\n" .
                     "*** IP/HOST\r\n" . $ip . "\r\n\r\n" .
                     "*** USER AGENT\r\n" . $ua . "\r\n\r\n" .
                     "*** REFERER\r\n" . $rf . "\r\n\r\n" .
                     "*** REQUEST URI\r\n" . $ru . "\r\n\r\n" .
                     "*** REQUEST METHOD\r\n" . $rm . "\r\n\r\n" .
                     "*** SUSPECT\r\n--\r\n" . $value . "\r\n--"
               );
           }

           # ... and kill the script.
           die
           (
               'Script processing cancelled: string (`<em>'.$value.'</em>`) contains text portions that are ' .
               'potentially harmful to this server. <em>Your input has not been sent!</em> Please use your ' .
               'browser\'s `back`-button to return to the previous page and try refrasing your input.</p>'
           );
       }
   }
}
//-----------------------------------------------------------------------------------------------------------------------------

// curat denumirea fisierelor de caractere ilegale
function cleanString($wild) {
	$pwild = strrpos($wild,'.');
	$twild = substr($wild, $pwild);
    return ereg_replace("[^[:alnum:]+]","_",substr($wild, 0, $pwild)).$twild;
}
//-----------------------------------------------------------------------------------------------------------------------------
?>

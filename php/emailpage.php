<?php
$bDB = false;	// true => the AdminEmail is from DB; 
$bFHeader = false; // true => the "-f $header" as optional header is added to mail() function;
$bHeader = true; // true => using header() function to relay to the next page;
$bAttach = true; // true =>  attach file

/* BELOW SETTINGS SEND MAIL BUT WITH NO MESSAGE
$bFHeader = false; // true => the "-f $header" as optional header is added to mail() function;
$bHeader = true; // true => using header() function to relay to the next page;
$bAttach = false; // true =>  attach file
*/

$nBodyMsg = 1;	// 0 -  send no email, 1 - send only text mail, 3 - send only html mail;
$bRecDB = false;	// true => all fields are recorded into database; 
$bSiteMap = false;	// true => change date into sitemap.xml file

//print $HTTP_POST_VARS['Comments'];

// DEBUG PROPOSE ONLY!!!
$nDebugViewMail = 0; // 0 - no view, 1 - view only text mail, 2 - view text & html mail, 3 view html mail;
// DEBUG PROPOSE ONLY!!!

$cMailTo = "information@stanfordtravel.com";//$HTTP_POST_VARS['mailform_to'];

// A T T E N T I O N ! --------------------------------------------------------------------------------------------
// THE EMAIL FORM MUST HAVE THE FOLLOWING OBJECTS
// 									<input type="hidden" name="mailform_from" value="">
// 									<input type="hidden" name="mailform_subj" value="mail subject">
// 									<input type="hidden" name="mailform_url" value="thank_you.html">
// A T T E N T I O N ! --------------------------------------------------------------------------------------------
$cMailFrom = $HTTP_POST_VARS['mailform_from'];
$cMailFrom = $HTTP_POST_VARS['email'] != '' ? $HTTP_POST_VARS['email'] : $HTTP_POST_VARS['TAemail'];

$cUrl = $HTTP_POST_VARS['mailform_url'];
$cSubj = $HTTP_POST_VARS['mailform_subj'];

// A T T E N T I O N ! --------------------------------------------------------------------------------------------
// EDIT THIS LINE USING THE RIGHT ADDRESS FOR 'email_address'

$AdminEmail = array();
$AdminEmail[0]="addressee's email";
if($bDB){
	$nNr = 0;
	foreach (array("_GET","_POST") as $source) {
		foreach (${$source} as $idx => $value) {
			if(!strpos(' '.$idx,'idemail') === false){
				if($nNr==0){
					$cSql  = "SELECT * FROM adminlogin";
					$strget = mysql_query($cSql);
					$recget = mysql_fetch_assoc($strget);
				}
				$nNr += 1;
				$cVal = '$AdminEmail['.($nNr-1).'] = $recget["'.$HTTP_POST_VARS['idemail'.$nNr].'"];';
				eval($cVal);
			}
		}
	}

	if(!isset($HTTP_POST_VARS['idemail1'])){
		$AdminEmail[0] = $cMailTo;
	}
//	mysql_close($strlink);	
} else {
	if($AdminEmail[0] == "addressee's email")
		$AdminEmail[0] = $cMailTo;
}


//$AdminEmail[0]="nbosneac@appealmedia.com";
//$AdminEmail[0]="nbosneac@yahoo.com";
$AdminEmail[0]="information@stanfordtravel.com";
//$AdminEmail[0]="information@mailforstanfordtravel.com";

$cPath = "www.machupicchutravel.com/";
$refpage = "reservations.php";
//debugbreak();
// A T T E N T I O N ! --------------------------------------------------------------------------------------------
if(isset($HTTP_POST_VARS['form_avar']) && isset($HTTP_POST_VARS['form_amsg']) && isset($HTTP_POST_VARS['form_aval']) && isset($HTTP_POST_VARS['form_aftp'])){
	$cErr = '';
	$nNr=0;
	$aVar=explode(",", $HTTP_POST_VARS['form_avar']);
	$aMsg=explode(",", $HTTP_POST_VARS['form_amsg']);
	$aVal=explode(",", $HTTP_POST_VARS['form_aval']);
	$aFtp=explode(",", $HTTP_POST_VARS['form_aftp']);
	foreach($aVar as $var){
		$val = stripslashes($aVal[$nNr]);
		if($val=="'".trim($HTTP_POST_VARS[$var])."'"){
			$cErr = '1';
		} else {
			$ftp = stripslashes($aFtp[$nNr]);
			if(strpos(' '.$ftp,'E')>0){
				if(!eregi ("^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,6}$", trim($HTTP_POST_VARS[$var]))){
					$cErr = '2';
					$cFld = $var;
				}
			}
//
// ONLY FOR SPECIAL CODE
//
			if(strpos($ftp,'G') !== false){
				$cGCode = trim($HTTP_POST_VARS[$var]);
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
	if($cGCode!=''){
		session_start();
		include_once("vImage.php");
		$vImage = new vImage();
		$vImage->loadCodes();
		if ($vImage->checkCode()!=1){
			$bErr = true;
			$cErr = urlencode("Incorrect Confirmation Code!");
		}
	}
//
// YOU CAN REMOVE FOR froms WITHOUT SPECIAL CODE
//

	if($cErr!=''){
		$cLoc="../";
		$cVal = '';
		include_once("cookie.php");
		sess_start("temp/","");
		foreach (array("_POST") as $source) {
			foreach (${$source} as $idx => $value) {
				sess_register($idx);
				$idx = $value;
			}
		}
	
	// Permanent redirection

	sess_register('cErr');
	sess_register('cFld');
	sess_register('baseurl');
	$baseurl=$baseURL;
	sess_register('refpage');
	$SESSION_DIR = $cLoc."temp/";
	sess_close();
	$eChar = md5(rand(0,32000) . time() . rand(0,32000));
	$cVal = "k=".substr($eChar,0,8).$MYSID;

	header("HTTP/1.1 301 Moved Permanently");
	header("Location: ../emailerror.php?".$cVal);
	exit;
	}
}
// E R R O R   C H E C K --------------------------------------------------------------------------------------------

get_form_data();

//Do you want to strip images from the printable output?
// If no, change to "no". Otherwise, images are stripped by default.
$stripImages = "yes";

//what's the base domain name of your site, without trailing slash? 
// Just the domain itself, so we can fix any relative image and link problems.
//$refpage = (phpversion() > "4.1.0") ? $_SERVER['HTTP_REFERER'] : $HTTP_SERVER_VARS['HTTP_REFERER'];
$refpage='http://'.$cPath.$refpage;

if(empty($refpage) || strpos($refpage,'localhost') || strpos($refpage,'127.0.0.1')){
	//$refpage='http://'.$cPath.$refpage;
} else {
	$file = $refpage;;

	$tmp = time();
	$ch = curl_init($file);
	$fp = @fopen("../temp/".$tmp, "w");
	curl_setopt($ch, CURLOPT_FILE, $fp);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_exec($ch);
	curl_close($ch);
	fclose($fp);

	$rep=opendir('../temp/');
	while (false != ($file = readdir($rep))){
		if (!is_dir($file)){
			if (file_exists('../temp/'.$file)){
				if(time()-$file>60*5)
					unlink("../temp/".$file);
			}
		}	
	}
	$refpage = "../temp/".$tmp;
}

/*
<!-- startemail -->
<!-- stopemail -->
*/
$startingpoint = "<!-- startemail -->";
$endingpoint = "<!-- stopemail -->";

if(isset($HTTP_POST_VARS[startemail]))
	$startingpoint = "<!-- ".$HTTP_POST_VARS[startemail]." -->";

if(isset($HTTP_POST_VARS[stopemail]))
	$endingpoint = "<!-- ".$HTTP_POST_VARS[stopemail]." -->";

// let's turn off any ugly errors for a sec-
//error_reporting(0);

// $read = fopen($refpage, "rb") ... may work better if you're using NT and images
//$cFile = substr($refpage,strrpos($refpage,'/')+1);
//$read = fopen(substr($refpage,strrpos($refpage,'/')+1), "r");
//debugbreak();
$read = fopen($refpage, "r");

if($read === false)
	$read = fopen($refpage, "r") or die ("<br />Sorry! There is no access to this file directly. You must follow a link. <br /><br />Please click your browser's back button. <br>");
// let's turn errors back on so we can debug if necessary
error_reporting(1);

$file_size = 50000;
$PHPtext = "";
$value = "";
while(!feof($read)){
$value .= fread($read, $file_size); // reduce number to save server load
}
fclose($read);
$start= strpos($value, "$startingpoint") + strlen("$startingpoint"); 
$finish= strpos($value, "$endingpoint"); 
$length= $finish-$start;

$cError='';
if($AdminEmail == "addressee's email")
	$cError  = " THE '<font color=red>mail to</font>' ADDRESS IS UNDEFINED !<br> EDIT THE LINE 25, '<font color=green>&amp;AdminEmail=\"addressee's email\";</font>' IN THIS FILE, (emailpage.php) USING THE RIGHT ADDRESS FOR 'addressee's email' !<br><br>";
if($cMailFrom == '' &&  !isset($HTTP_POST_VARS['mailform_from']))
	$cError .= " THE '<font color=red>mail from</font>' ADDRESS IS UNDEFINED !<br> USE THE FOLLOWING OBJECT '<font color=green>&lt;input type=\"text\" name=\"mailform_from\" value=\"\"&gt;</font>' IN ".$refpage." FORM PAGE TO DEFINE THIS VARIABLE !<br><br> ";
if($cSubj == '' && !isset($HTTP_POST_VARS['mailform_subj']))
	$cError .= " THE MAIL '<font color=red>subject</font>' IS UNDEFINED !<br> USE THE FOLLOWING OBJECT '<font color=green>&lt;input type=\"hidden\" name=\"mailform_subj\" value=\"email subject\"&gt;</font>' IN ".$refpage." FORM PAGE TO DEFINE THIS VARIABLE !<br><br> ";
if($cUrl == '' && !isset($HTTP_POST_VARS['mailform_url']))
	$cError .= " THE '<font color=red>thankyou</font>' FILE IS UNDEFINED !<br> USE THE FOLLOWING OBJECT '<font color=green>&lt;input type=\"hidden\" name=\"mailform_url\" value=\"thank_you_page.html\"&gt;</font>' IN ".$refpage." FORM PAGE TO DEFINE THIS VARIABLE! <br><br>";
if($length == 0)
	$cError .= " USE THE <font color=green><!-- startemail --></font> AND <font color=green><!-- stopemail --></font> COMMENT IN ".$refpage." FORM PAGE TO DEFINE THE EMAIL CONTENT ! (EX: '<font color=green>&lt;!-- startemail --&gt;&lt;form  .... &lt;/form&gt;&lt;!-- stopemail --&gt;</font>')";

if($cError != ''){
	print $cError;
	exit;
}


$value=substr($value, $start, $length);

function i_denude($variable)
{
return(eregi_replace("<img src=[^>]*>", "", $variable));
}

function i_denudef($variable)
{
return(eregi_replace("<font[^>]*>", "", $variable));
}

$PHPHtml = ("$value"); 

if ($stripImages == "yes") {
$PHPHtml = i_denude("$PHPHtml");
}

$PHPHtml = i_denudef("$PHPHtml");
$PHPHtml = eregi_replace( "</font>", "", $PHPHtml );
$PHPHtml = stripslashes("$PHPHtml"); 

// EMAIL FORM PAGE _________________________________________B_U_T_T_O_N______________________
// THE Button, Submit OR Reset TYPE OF INPUT MUST BE LIKE THE FOLLOWING [CASE SENSITIVE!]:
// <input type="submit" [...]>
// <input type="reset" [...]> [ex: <input type="submit" name="Submit" value="Submit Form"> ]
// <input type="hidden" [...]> [ex: <input type="submit" name="Submit" value="Submit Form"> ]
//
 //debugbreak();
$PHPHtml = str_replace(stripslashes($HTTP_POST_VARS['mailform_etag']), '', $PHPHtml);

$PHPHtml = eregi_replace ("<input type=\"button\"[^>]*>", "", $PHPHtml);
$PHPHtml = eregi_replace ("<input type=\"submit\"[^>]*>", "", $PHPHtml);
$PHPHtml = eregi_replace ("<input type=\"reset\"[^>]*>", "", $PHPHtml);
$PHPHtml = eregi_replace ("<input type=\"hidden\"[^>]*>", "", $PHPHtml);

if(substr_count($PHPHtml, "=\"button\"") >0 || substr_count($PHPHtml, "='button'") >0 )
	$cError  = "USE THE '<font color=red>type=\"button\"</font>' RIGHT AFTER '<font color=red>&lt;input ...</font>' FOR button OBJECT IN YOUR FORM, LIKE THIS '<font color=green>&lt;input type=\"button\"</font>' <BR><BR>";
if(substr_count($PHPHtml, "=\"submit\"") >0 || substr_count($PHPHtml, "='button'") >0 )
	$cError .= "USE THE '<font color=red>type=\"submit\"</font>' RIGHT AFTER '<font color=red>&lt;input ...</font>' FOR submit OBJECT IN YOUR FORM, LIKE THIS '<font color=green>&lt;input type=\"submit\"</font>' <BR><BR>";
if(substr_count($PHPHtml, "=\"reset\"") >0 || substr_count($PHPHtml, "='button'") >0 )
	$cError .= "USE THE '<font color=red>type=\"reset\"</font>' RIGHT AFTER '<font color=red>&lt;input ...</font>' FOR reset OBJECT IN YOUR FORM, LIKE THIS '<font color=green>&lt;input type=\"reset\"</font>' <BR><BR>";
if(substr_count($PHPHtml, "=\"hidden\"") >0 || substr_count($PHPHtml, "='button'") >0 )
	$cError .= "USE THE '<font color=red>type=\"hidden\"</font>' RIGHT AFTER '<font color=red>&lt;input ...</font>' FOR hidden OBJECT IN YOUR FORM, LIKE THIS '<font color=green>&lt;input type=\"hidden\"</font>' <BR><BR>";

if($cError != ''){
	print $cError;
	exit;
}

$nOffset = 0;
$nNrInput = substr_count($PHPHtml, "<!-- start removetext -->");
for($nNr = 1; $nNr < $nNrInput+1; $nNr ++){
	$nSTag = strpos($PHPHtml, "<!-- start removetext -->", $nOffset);
	$nFTag = strpos($PHPHtml, "<!-- stop removetext -->", $nSTag);
	$nName = strpos($PHPHtml, "name", $nSTag+1);
	$PHPHtml = str_replace(substr($PHPHtml, $nSTag, $nFTag - $nSTag + 24), "", $PHPHtml);
}

// SECTIUNE PARTICULARA - STERG bgcolor="#006997" si bgcolor="#007DB1"
	$PHPHtml = str_replace('bgcolor="#006997"', "", $PHPHtml);
	$PHPHtml = str_replace('bgcolor="#007DB1"', "", $PHPHtml);
// SECTIUNE PARTICULARA - inlocuiesc width="100%" cu width="80%"
	$PHPHtml = str_replace('width="100%"', 'width="80%"', $PHPHtml);


// EMAIL FORM PAGE ___________________________________________T_E_X_T_________________________
// THE Text TYPE OF INPUT MUST BE LIKE THE FOLLOWING [CASE SENSITIVE!]:
// <input [...] value=""> WITH THE value WORD AT THE LAST POSITION
// [ex: <input name="EventYear" type="text" id="EventYear" size="4" maxlength="4" value=""> ]
//
// EMAIL FORM PAGE _______________________________________C_H_E_C_K_B_O_X_____________________
// THE Checkbox TYPE OF INPUT MUST BE LIKE THE FOLLOWING [CASE SENSITIVE!]:
// <input [...] value="Yes"> WITH THE value WORD AT THE LAST POSITION AND THE Yes WORD FOR THE CHECKED VALUE AND THE TYPE checked MUST BE LOWERCASE!
// [ex: <input name="Contactphone" type="checkbox" id="Contactphone" value="Yes"> ]
//
$PHPHtmlTmp = $PHPHtml;
//echo "PHPHtmlTmp is $PHPHtmlTmp";

$nNrInput = substr_count($PHPHtml, "<input ");
$nOffset = 0;
for($nNr = 1; $nNr < $nNrInput+1; $nNr ++){
	$nSTag = strpos($PHPHtml, "<input ", $nOffset);
	$nFTag = strpos($PHPHtml, ">", $nSTag+1);
	$nName = strpos($PHPHtml, "name", $nSTag+1);
	if($nName < $nFTag){
		$nName = strpos($PHPHtml, '"', $nName+1);
		if($nName < $nFTag){
			$cVar = substr($PHPHtml, $nName+1, strpos($PHPHtml, '"', $nName+1) - $nName-1);
//			print $cVar." = ".$HTTP_POST_VARS["$cVar"]."<br>";
			if(strpos($PHPHtml, " value", $nSTag) == 0 ){
				print "USE THE '<font color=red>value=\"\"</font>' AT THE END OF ALL '<font color=red>&lt;input ...</font>' OBJECTS IN YOUR FORM, LIKE THIS '<font color=green>.... value=\"\"&gt;</font>' <BR><BR>";
				exit;
			}			
			$cInput = substr($PHPHtml, $nSTag, strpos($PHPHtml, " value", $nSTag) - $nSTag);
			$cFinal = $cInput." value='".$HTTP_POST_VARS["$cVar"]."' size=32>";
			if(strpos($cInput, "checkbox") === false){
				$cInptVar .= " '".$cVar."' ";
			} else {
				$cCBoxVar .= " '".$cVar."' ";
				if($HTTP_POST_VARS["$cVar"] == 'yes')
					$cFinal = $cInput." checked>";
				else
					$cFinal = $cInput.">";
			}
			$PHPHtml = str_replace(substr($PHPHtml, $nSTag, $nFTag - $nSTag + 1), $cFinal, $PHPHtml);
		}
	}
	$nOffset = $nSTag+1;
}

$nNrInput = substr_count($PHPHtmlTmp, "<input ");
$nOffset = 0;
for($nNr = 1; $nNr < $nNrInput+1; $nNr ++){
	$nSTag = strpos($PHPHtmlTmp, "<input ", $nOffset);
	$nFTag = strpos($PHPHtmlTmp, ">", $nSTag+1);
	$nName = strpos($PHPHtmlTmp, "name", $nSTag+1);
	if($nName < $nFTag){
		$nName = strpos($PHPHtmlTmp, '"', $nName+1);
		if($nName < $nFTag){
			$cVar = substr($PHPHtmlTmp, $nName+1, strpos($PHPHtmlTmp, '"', $nName+1) - $nName-1);
//			print $cVar." = ".$HTTP_POST_VARS["$cVar"]."<br>";
			$cInput = substr($PHPHtmlTmp, $nSTag, strpos($PHPHtmlTmp, " value", $nSTag) - $nSTag);
			$cFinal = $cInput." value='".$HTTP_POST_VARS["$cVar"]."'>#[".$HTTP_POST_VARS["$cVar"]."]";
			if(strpos($cInput, "checkbox") === false){
				$cInptVar .= " '".$cVar."' ";
			} else {
				$cCBoxVar .= " '".$cVar."' ";
				if($HTTP_POST_VARS["$cVar"] == 'Yes')
					$cFinal = $cInput." checked>[".$HTTP_POST_VARS["$cVar"]."]";
				else
					$cFinal = $cInput.">[No ]";
			}
			$PHPHtmlTmp = str_replace(substr($PHPHtmlTmp, $nSTag, $nFTag - $nSTag + 1), $cFinal, $PHPHtmlTmp);
		}
	}
	$nOffset = $nSTag+1;
}

// EMAIL FORM PAGE _________________________________________S_E_L_E_C_T_______________________
// THE Select TYPE OF INPUT MUST BE LIKE THE FOLLOWING [CASE SENSITIVE!]:
// <select name=[...]></select> WITH THE TAG <option value=[...]> AND </option> LOWERCASE
// [ex: <select name="Comments" id="Comments">... ]
//
$nNrInput = substr_count($PHPHtml, "<select");
$nOffset = 0;
$nETag = 0;
for($nNr = 1; $nNr < $nNrInput+1; $nNr ++){
	$nSTag = strpos($PHPHtml, "<select", $nOffset);
	$nETag = strpos($PHPHtml, "</select>", $nSTag+1);
	$nFTag = strpos($PHPHtml, ">", $nSTag+1);
	$nName = strpos($PHPHtml, "name", $nSTag+1);
	if($nName < $nFTag){
		$nName = strpos($PHPHtml, '"', $nName+1);
		if($nName < $nFTag){
			$cVar = substr($PHPHtml, $nName+1, strpos($PHPHtml, '"', $nName+1) - $nName-1);

			$nNrOption = substr_count(substr($PHPHtml, $nSTag, $nETag-$nSTag), "<option");
			$nOffsetO = $nSTag+1;
			for($nNrO = 1; $nNrO < $nNrOption+1; $nNrO ++){
				$nSTagO = strpos($PHPHtml, "value=\"", $nOffsetO);
				$nFTagO = strpos($PHPHtml, "\">", $nSTagO+1);
				$cVal = substr($PHPHtml, $nSTagO, $nFTagO-$nSTagO+1);
				$cFinal = $cVal;
				if("value=\"".$HTTP_POST_VARS["$cVar"]."\"" == $cVal){
					$cFinal = $cVal." selected";
					$cFinal = str_replace($cVal, $cFinal, substr($PHPHtml, $nSTag, $nETag - $nSTag ));
//print $nNr." > ".$nNrO." : ".$cVar." : ".$nSTag." - ".$nETag ." = ".$nSTagO." _ ".$nFTagO." [".$cFinal."]<br>";
					$PHPHtml = str_replace(substr($PHPHtml, $nSTag, $nETag - $nSTag ), $cFinal, $PHPHtml);
				}
				$nOffsetO = $nSTagO + 1;
			}
		}
	}
	$nOffset = $nSTag+1;
}


$nNrInput = substr_count($PHPHtmlTmp, "<select");
$nOffset = 0;
$nETag = 0;
for($nNr = 1; $nNr < $nNrInput+1; $nNr ++){
	$nSTag = strpos($PHPHtmlTmp, "<select", $nOffset);
	$nETag = strpos($PHPHtmlTmp, "</select>", $nSTag+1);
	$nFTag = strpos($PHPHtmlTmp, ">", $nSTag+1);
	$nName = strpos($PHPHtmlTmp, "name", $nSTag+1);
	if($nName < $nFTag){
		$nName = strpos($PHPHtmlTmp, '"', $nName+1);
		if($nName < $nFTag){
			$cVar = substr($PHPHtmlTmp, $nName+1, strpos($PHPHtmlTmp, '"', $nName+1) - $nName-1);

			$nNrOption = substr_count(substr($PHPHtmlTmp, $nSTag, $nETag-$nSTag), "<option");
			$nOffsetO = $nSTag+1;
			for($nNrO = 1; $nNrO < $nNrOption+1; $nNrO ++){
				$nSTagO = strpos($PHPHtmlTmp, "value=\"", $nOffsetO);
				$nFTagO = strpos($PHPHtmlTmp, "\">", $nSTagO+1);
				$cVal = substr($PHPHtmlTmp, $nSTagO, $nFTagO-$nSTagO+1);
				$cFinal = $cVal;
				if("value=\"".$HTTP_POST_VARS["$cVar"]."\"" == $cVal){
					$cFinal = $cVal." selected";
					$cFinal = str_replace($cVal, $cFinal, substr($PHPHtmlTmp, $nSTag, $nETag - $nSTag ));
//print $nNr." > ".$nNrO." : ".$cVar." : ".$nSTag." - ".$nETag ." = ".$nSTagO." _ ".$nFTagO." [".$cFinal."]<br>";
					$PHPHtmlTmp = str_replace(substr($PHPHtmlTmp, $nSTag, $nETag - $nSTag ), $cFinal, $PHPHtmlTmp);
				}
				$nOffsetO = $nSTagO + 1;
			}
		}
	}
	$nOffset = $nSTag+1;
}

// EMAIL FORM PAGE _______________________________________T_E_X_T_A_R_E_A_____________________
// THE Textarea TYPE OF INPUT MUST BE LIKE THE FOLLOWING [CASE SENSITIVE!]:
// <textarea [...]></textarea> WITH THE TAG <textarea> AND </texarea> LOWERCASE
// [ex: <textarea name="Comments" cols="80" rows="5" id="Comments"></textarea> ]
//
$nOffset = 0;
$nNrInput = substr_count($PHPHtml, '<textarea cols="');
for($nNr = 1; $nNr < $nNrInput+1; $nNr ++){
	$nSTag = strpos($PHPHtml, '<textarea cols="', $nOffset);
	$nFTag = strpos($PHPHtml, '" rows="', $nSTag);
	$PHPHtml = str_replace(substr($PHPHtml, $nSTag, $nFTag - $nSTag+8), '<textarea cols="40" rows="', $PHPHtml);
}
$nOffset = 0;
$nNrInput = substr_count($PHPHtml, '<textarea cols="40" rows="');
for($nNr = 1; $nNr < $nNrInput+1; $nNr ++){
	$nSTag = strpos($PHPHtml, '<textarea cols="40" rows="', $nOffset);
	$nFTag = strpos($PHPHtml, '"', $nSTag);
	$PHPHtml = str_replace(substr($PHPHtml, $nSTag, $nFTag - $nSTag+13), '<textarea cols="40" rows="10"', $PHPHtml);
}

$nNrInput = substr_count($PHPHtml, "<textarea ");
$nOffset = 0;
for($nNr = 1; $nNr < $nNrInput+1; $nNr ++){
	$nSTag = strpos($PHPHtml, "<textarea ", $nOffset);
	$nFTag = strpos($PHPHtml, "</textarea>", $nSTag+1);
	$nName = strpos($PHPHtml, "name", $nSTag+1);
	if($nName < $nFTag){
		$nName = strpos($PHPHtml, '"', $nName+1);
		if($nName < $nFTag){
			$cVar = substr($PHPHtml, $nName+1, strpos($PHPHtml, '"', $nName+1) - $nName-1);
			$cInput = substr($PHPHtml, $nSTag, strpos($PHPHtml, ">", $nSTag+1) - $nSTag + 1);
			$cFinal = $cInput.$HTTP_POST_VARS["$cVar"]."<";
			$PHPHtml = str_replace(substr($PHPHtml, $nSTag, $nFTag - $nSTag + 1), $cFinal, $PHPHtml);
		}
	}
	$nOffset = $nSTag+1;
}


$nNrInput = substr_count($PHPHtmlTmp, "<textarea ");
$nOffset = 0;
for($nNr = 1; $nNr < $nNrInput+1; $nNr ++){
	$nSTag = strpos($PHPHtmlTmp, "<textarea ", $nOffset);
	$nFTag = strpos($PHPHtmlTmp, "</textarea>", $nSTag+1);
	$nName = strpos($PHPHtmlTmp, "name", $nSTag+1);
	if($nName < $nFTag){
		$nName = strpos($PHPHtmlTmp, '"', $nName+1);
		if($nName < $nFTag){
			$cVar = substr($PHPHtmlTmp, $nName+1, strpos($PHPHtmlTmp, '"', $nName+1) - $nName-1);
			$cInput = substr($PHPHtmlTmp, $nSTag, strpos($PHPHtmlTmp, ">", $nSTag+1) - $nSTag + 1);
			$cFinal = $cInput.$HTTP_POST_VARS["$cVar"]."<";
			$PHPHtmlTmp = str_replace(substr($PHPHtmlTmp, $nSTag, $nFTag - $nSTag + 1), "[".$HTTP_POST_VARS["$cVar"]."]<textarea><", $PHPHtmlTmp);
			$cTxtAVar .= " '".$cVar."' ";
		}
	}
	$nOffset = $nSTag+1;
}

//echo "PHPHTML IS $PHPHtmlTmp";

$cEmailMsg = "";
if(!checkEmail($cMailFrom,1))
   	$cEmailMsg = "[".$cMailFrom." - WARNING ! Email address was not able to be validate ! - ".date('m.d.y h:i A')."]";
$PHPHtml = "<table width='100%'><tr><td>".$PHPHtml."<br>".$cEmailMsg."</td></tr></table>";

if($HTTP_POST_VARS['addmsg'] != '')
	$PHPHtml = $HTTP_POST_VARS['addmsg'].$PHPHtml;

$cType = "text/html";

if($nBodyMsg >0){
	if($nBodyMsg >1){
		foreach ($AdminEmail as $source){
			$nSend = SendFile($cType, $source, $cMailFrom, $cSubj, $PHPHtml, $bFHeader, $bAttach);
			if($nDebugViewMail > 0)
				$sAdminEmail .= $source." [Send Email: ".($nSend==1 ? 'OK' : 'FAILED!')."] ";
		}
	}
}

if($nDebugViewMail > 0 && $nDebugViewMail > 1){
	if(!isset($sAdminEmail)){
		foreach ($AdminEmail as $source){
			$sAdminEmail .= $source." [Send Email: DISABLED] ";
		}
	}
	echo "Email from:".$cMailFrom."<br>";	
	echo "Email to  :".$sAdminEmail."<br>";	
	echo "Subject   :".$cSubj."<br>";	
	echo "Redirect  :".$cUrl."<br><br>";	
	echo $PHPHtml; 
}

$PHPHtmlTmp = str_replace('</tr>', "[NEWLINE]", $PHPHtmlTmp);
$PHPtext = html2text( $PHPHtmlTmp );
$nOffset = 0;
$nSTag = 5;
//print $cCBoxVar.$cSOptVar.$cInptVar.$cTxtAVar."<br>";
$PHPtext = str_replace('[INPUT]', "", $PHPtext);
//print $PHPtext;
$aPHP = explode("[NEWLINE]",$PHPtext);
foreach ($aPHP as $Val){
	$Val .= "\r\n";
	$cDim ="";
	if(substr_count($Val,"#[")>0){
		$nSTag = strpos($Val, "#[");	
		$cStr1 =  trim(substr($Val, 0, $nSTag));	
		$cStr2 = substr($Val, $nSTag+1);
		$cVal = str_repeat(".",50-strlen(trim($cStr1)));
		$Val = " ".$cStr1.$cVal.$cStr2."\r\n" ;
//print $Val."<br>";
	}
	$Final .=  $Val;
}
$PHPtext = $Final."\r\n".$cEmailMsg ;
if($HTTP_POST_VARS['addmsg'] != '')
	$PHPtext = $HTTP_POST_VARS['addmsg']."\r\n".$PHPtext;

$cType = "text/plain";

if($nBodyMsg >0){
	if($nBodyMsg <2){
		foreach ($AdminEmail as $source){
			$nSend = SendFile($cType, $source, $cMailFrom, $cSubj, $PHPtext, $bFHeader, $bAttach);
                        if($nDebugViewMail > 0)
                            echo " [Send Email: ".($nSend==1 ? 'OK' : 'FAILED!')."] ";
		}
	}
}

if($nDebugViewMail > 0 && $nDebugViewMail < 3){
	print "Email to  :".$AdminEmail."<br>";	
	print "Email from:".$cSubj."<br>";	
	print $PHPtext;
	print "<br>".$cUrl;
}

if($nDebugViewMail > 0)
	exit;

//if($nSend==0)
//	$cUrl = "email_error.php";

if($nSend==1)
	$cId = "?msg=1";


if($bRecDB){
	$_POST['email'] = $HTTP_POST_VARS['mailform_from'];
	require_once("inc/dataconn.php");
	$cDB = "contacts";

	$cSql = "INSERT INTO ".$cDB." (id".$cDB.") VALUES ('')";
	$strget = mysql_query($cSql);
	$id = mysql_insert_id($strlink);

	$cSql  = "UPDATE ".$cDB." SET ";
	$result = mysql_query("SELECT * FROM ".$cDB." WHERE id".$cDB."=".$id);

	$nNr = 0;
	while($field = mysql_fetch_field($result)){
		foreach (array("_GET","_POST") as $source) {
			foreach (${$source} as $idx => $value) {
				if($field->name == $idx){
					$nNr += 1;
					if($nNr>1)
						$cSql .=",";
					$cSql .= " ".$idx."='".$value."'"; 
				}
			}
		}
	}
	$cSql .= " WHERE id".$cDB."=".$id;
	$strget = mysql_query($cSql);
	$cId = "?id=".$id;
	@mysql_close($strlink);
}

if($bSiteMap){

	error_reporting(0);
	$refpage="../sitemap.xml";
	$read = fopen($refpage, "r");

	$value = "";
	while(!feof($read)){
		$value .= fread($read, 20000); // reduce number to save server load
	}
	fclose($read);
	$SMap = $value;
	$nNrInput = substr_count($SMap, "<lastmod>");
	$nOffset = 0;
	for($nNr = 1; $nNr < $nNrInput+1; $nNr ++){
		$nSTag = strpos($SMap, "<lastmod>", $nOffset);
		$nFTag = strpos($SMap, "</lastmod>", $nSTag+1);
		$cDate = date('Y-m-d');
		if(substr_count(substr($SMap, $nSTag + 9, $nFTag - $nSTag - 9), $cDate)==0){
			$SMap = str_replace(substr($SMap, $nSTag + 9, $nFTag - $nSTag - 9), $cDate, $SMap);
			$bWrite = true;
		}
		$nOffset = $nSTag+1;
	}
	if($bWrite){
		$write = fopen($refpage, "w");
		fwrite($write, $SMap);
		fclose($write);
	}
	error_reporting(1);
}


if($bHeader){
	header("Location:".$cUrl.$cId);
	exit;
} else {
?>
	<html><body>
	<div name style="visibility:hidden">
	<form name="frm1" action="<?=$cUrl?>">
		<input type="submit" value="1">
		<input type="hidden" name="sendok" value="<?=$nSend?>">
	</form>
	<form name="frm2" action="<?=$refpage?>">
		<input type="submit" value="2">
	</form>
	</div>
	<script type="text/javascript">
	window.location.href="http://<?=$cUrl?>";
	</script>
	</body>
	</html>
<?php
}
?>

<?php
function SendFile($cType, $AdminEmail, $cMailFrom, $cSubj, $PHPEmail, $bFHeader, $bAttach){
// build mail

global $HTTP_POST_FILES;
$date_time = date('Y-m-d H:i:s');
$mime_delimiter = "----=_NextPart_000_0001_".md5(time());
$mail =
"This is a multi-part message in MIME format.

--$mime_delimiter
Content-type: $cType
Content-Transfer-Encoding: 8bit
Content-Disposition: inline

$PHPEmail

";


$files = array(); //files (field names) to attach in mail
if (count($HTTP_POST_FILES) && $bAttach){
	$files = array_keys($HTTP_POST_FILES);
}

if (count($files)){
foreach ($files as $file){
	$file_name     = $HTTP_POST_FILES[$file]['name'];
    $file_type     = $HTTP_POST_FILES[$file]['type'];
	$file_tmp_name = $HTTP_POST_FILES[$file]['tmp_name'];
	$file_cnt = "";
	$f=@fopen($file_tmp_name, "rb");
	if (!$f)
		continue;
	while($f && !feof($f))
		$file_cnt .= fread($f, 4096);
    fclose($f);
	if (!strlen($file_type)) $file_type="applicaton/octet-stream";
	if ($file_type == 'application/x-msdownload')
		$file_type = "applicaton/octet-stream";

	$mail .= "\n--$mime_delimiter\n";
	$mail .= "Content-Type: $file_type;\n       name=\"$file_name\"\n";
	$mail .= "Content-Transfer-Encoding: base64\n";
	$mail .= "Content-Disposition: attachment;\n       filename=\"$file_name\"\n\r\n";
	$mail .= chunk_split(base64_encode($file_cnt));
    }
}
$mail .= "\n--$mime_delimiter--";

//print $mail;
//exit;

//print $AdminEmail.'<br>';
//print $cSubj.'<br>';
//print "MIME-Version: 1.0\nFrom: $cMailFrom\nContent-Type: multipart/mixed;\n    boundary=\"$mime_delimiter\"\n";
//exit;

if($bFHeader)
    $nSend = mail($AdminEmail, $cSubj, $mail, "MIME-Version: 1.0\nFrom: $cMailFrom\nContent-Type: multipart/mixed;\n    boundary=\"$mime_delimiter\"\n", "-f $cMailFrom");
else
    $nSend = mail($AdminEmail, $cSubj, $mail, "MIME-Version: 1.0\nFrom: $cMailFrom\nContent-Type: multipart/mixed;\n    boundary=\"$mime_delimiter\"\n");

return $nSend;
}
?>





<?php
//-----------------------------------------------------------------------------------------------------------------------------
function get_form_data(){
    global $REQUEST_METHOD;
    global $HTTP_POST_VARS;
    global $HTTP_GET_VARS;
    
   	//strip spaces from all fields
    $vars = ($REQUEST_METHOD == 'GET') ? $HTTP_GET_VARS : $HTTP_POST_VARS;
    foreach ($vars as $k=>$v){
		input_check_mailinj($value);
	}
}


function input_check_mailinj($value)
{
   # mail adress(ess) for reports...
   $report_to = "information@stanfordtravel.com";

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



function html2text( $badStr ) {

    //remove PHP if it exists

    while( substr_count( $badStr, '<'.'?' ) && substr_count( $badStr, '?'.'>' ) && strpos( $badStr, '?'.'>', strpos( $badStr, '<'.'?' ) ) > strpos( $badStr, '<'.'?' ) ) {

        $badStr = substr( $badStr, 0, strpos( $badStr, '<'.'?' ) ) . substr( $badStr, strpos( $badStr, '?'.'>', strpos( $badStr, '<'.'?' ) ) + 2 ); }

    //remove comments

    while( substr_count( $badStr, '<!--' ) && substr_count( $badStr, '-->' ) && strpos( $badStr, '-->', strpos( $badStr, '<!--' ) ) > strpos( $badStr, '<!--' ) ) {

        $badStr = substr( $badStr, 0, strpos( $badStr, '<!--' ) ) . substr( $badStr, strpos( $badStr, '-->', strpos( $badStr, '<!--' ) ) + 3 ); }

    //now make sure all HTML tags are correctly written (> not in between quotes)

    for( $x = 0, $goodStr = '', $is_open_tb = false, $is_open_sq = false, $is_open_dq = false; strlen( $chr = $badStr{$x} ); $x++ ) {

        //take each letter in turn and check if that character is permitted there

        switch( $chr ) {

            case '<':

                if( !$is_open_tb && strtolower( substr( $badStr, $x + 1, 5 ) ) == 'style' ) {

                    $badStr = substr( $badStr, 0, $x ) . substr( $badStr, strpos( strtolower( $badStr ), '</style>', $x ) + 7 ); $chr = '';

                } elseif( !$is_open_tb && strtolower( substr( $badStr, $x + 1, 6 ) ) == 'script' ) {

                    $badStr = substr( $badStr, 0, $x ) . substr( $badStr, strpos( strtolower( $badStr ), '</script>', $x ) + 8 ); $chr = '';

                } elseif( !$is_open_tb ) { $is_open_tb = true; } else { $chr = '&lt;'; }

                break;

            case '>':

                if( !$is_open_tb || $is_open_dq || $is_open_sq ) { $chr = '&gt;'; } else { $is_open_tb = false; }

                break;

            case '"':

                if( $is_open_tb && !$is_open_dq && !$is_open_sq ) { $is_open_dq = true; }

                elseif( $is_open_tb && $is_open_dq && !$is_open_sq ) { $is_open_dq = false; }

                else { $chr = '&quot;'; }

                break;

            case "'":

                if( $is_open_tb && !$is_open_dq && !$is_open_sq ) { $is_open_sq = true; }

                elseif( $is_open_tb && !$is_open_dq && $is_open_sq ) { $is_open_sq = false; }

        } $goodStr .= $chr;

    }

    //now that the page is valid (I hope) for strip_tags, strip all unwanted tags

    $goodStr = strip_tags( $goodStr, '<title><hr><h1><h2><h3><h4><h5><h6><div><p><pre><sup><ul><ol><br><dl><dt><table><caption><tr><li><dd><th><td><a><area><img><form><input><textarea><button><select><option>' );

    //strip extra whitespace except between <pre> and <textarea> tags

    $badStr = preg_split( "/<\/?pre[^>]*>/i", $goodStr );

    for( $x = 0; is_string( $badStr[$x] ); $x++ ) {

        if( $x % 2 ) { $badStr[$x] = '<pre>'.$badStr[$x].'</pre>'; } else {

            $goodStr = preg_split( "/<\/?textarea[^>]*>/i", $badStr[$x] );

            for( $z = 0; is_string( $goodStr[$z] ); $z++ ) {

                if( $z % 2 ) { $goodStr[$z] = '<textarea>'.$goodStr[$z].'</textarea>'; } else {

                    $goodStr[$z] = preg_replace( "/\s+/", ' ', $goodStr[$z] );

            } }

            $badStr[$x] = implode('',$goodStr);

    } }

    $goodStr = implode('',$badStr);

    //remove all options from select inputs

    $goodStr = preg_replace( "/<option[^>]*>[^<]*/i", '', $goodStr );

    //replace all tags with their text equivalents

    $goodStr = preg_replace( "/<(\/title|hr)[^>]*>/i", "\n          --------------------\n", $goodStr );

    $goodStr = preg_replace( "/<(h|div|p)[^>]*>/i", "\n\n", $goodStr );

    $goodStr = preg_replace( "/<sup[^>]*>/i", '^', $goodStr );

    $goodStr = preg_replace( "/<(ul|ol|br|dl|dt|table|caption|\/textarea|tr[^>]*>\s*<(td|th))[^>]*>/i", "\n", $goodStr );

    $goodStr = preg_replace( "/<li[^>]*>/i", "\n? ", $goodStr );

    $goodStr = preg_replace( "/<dd[^>]*>/i", "\n\t", $goodStr );

    $goodStr = preg_replace( "/<(th|td)[^>]*>/i", "\t", $goodStr );

    $goodStr = preg_replace( "/<a[^>]* href=(\"((?!\"|#|javascript:)[^\"#]*)(\"|#)|'((?!'|#|javascript:)[^'#]*)('|#)|((?!'|\"|>|#|javascript:)[^#\"'> ]*))[^>]*>/i", "[LINK: $2$4$6] ", $goodStr );

    $goodStr = preg_replace( "/<img[^>]* alt=(\"([^\"]+)\"|'([^']+)'|([^\"'> ]+))[^>]*>/i", "[IMAGE: $2$3$4] ", $goodStr );

    $goodStr = preg_replace( "/<form[^>]* action=(\"([^\"]+)\"|'([^']+)'|([^\"'> ]+))[^>]*>/i", "\n[FORM: $2$3$4] ", $goodStr );

    $goodStr = preg_replace( "/<(input|textarea|button|select)[^>]*>/i", "[INPUT] ", $goodStr );

    //strip all remaining tags (mostly closing tags)

    $goodStr = strip_tags( $goodStr );

    //convert HTML entities

    $goodStr = strtr( $goodStr, array_flip( get_html_translation_table( HTML_ENTITIES ) ) );

    preg_replace( "/&#(\d+);/me", "chr('$1')", $goodStr );

    //wordwrap

    $goodStr = wordwrap( $goodStr );

    //make sure there are no more than 3 linebreaks in a row and trim whitespace

    return preg_replace( "/^\n*|\n*$/", '', preg_replace( "/[ \t]+(\n|$)/", "$1", preg_replace( "/\n(\s*\n){2}/", "\n\n\n", preg_replace( "/\r\n?|\f/", "\n", str_replace( chr(160), ' ', $goodStr ) ) ) ) );

}

?>


<?php
function checkEmail($email,$nCheckDNSRR) {
list($username,$domain)=split('@',$email);
if(!empty($domain)){
	if(preg_match("/^[a-zA-Z0-9][\w.-]*$/i",$username) && preg_match("/^[a-zA-Z0-9][\w.-]*$/i",$domain)){
// the "checkdnsrr" function is not implemented on the Windows platform and I used myCheckDNSRR functions
		if(!myCheckDNSRR($domain,'MX',$nCheckDNSRR))
			return false;
		else
			return true;
	} else
		return false;
}
return false;
}

function myCheckDNSRR($hostName, $recType, $nCheckDNSRR) 
{ 
 if(!empty($hostName)) { 
   if( $recType == '' ) $recType = "MX"; 
   if($nCheckDNSRR==1) {	
	   exec("nslookup -type=$recType $hostName", $result); 
// check each line to find the one that starts with the host name. If it exists then the function succeeded. 
	   foreach ($result as $line) { 
    	 if(eregi("^$hostName",$line)) { 
	       return true; 
    	 } 
	   } 
// otherwise there was no mail handler for the domain 
	   return false; 
	} else
    return true; 
 }	 
 return false; 
}
?>


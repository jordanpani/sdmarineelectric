<?php
require_once('errhandler.php');
$bConnect = false;
if(!isset($bConnect)) $bConnect = true;
$cPath = 'http://www.machupicchutravel.com/';
if($bConnect==true){
$strHOST = '';
$strDB = '';
$strUSER = '';
$strPWD = '';
$strlink = @mysql_connect($strHOST,$strUSER,$strPWD) or trigger_error('SQL', E_USER_NOTICE);
if($strlink===false){
$error = 9;if(!(strpos($_SERVER['PHP_SELF'], "admin") === false)){$cErrMsg=' DataBase Server not responding! ';
print '<script>alert("'.$cErrMsg.'")</script>';}
} else {
mysql_select_db($strDB);}
}
$cTFile = substr(time(),-5);
$cAuth = md5(' - AppealMedia.com - '.getIP().$cTFile);
?>
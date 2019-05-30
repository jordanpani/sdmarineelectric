<?php
	foreach (array("_GET","_POST") as $source) {
		foreach (${$source} as $idx => $value) {
			eval("$".$idx."='';"); 
		}
	}

	$cLoc="../";
	include_once("cgi-bin/cookie.php");  
	$kpin = substr($HTTP_GET_VARS["k"],8);
	sess_start("temp/",$kpin);

	if($refpage=='')
		header('Location:contact.php');			

	$cErr = $cErr;
	$cUrl = $mailform_url;

	$nNr=0;
	$aVar=explode(",", $form_avar);
	$aMsg=explode(",", $form_amsg);
	$aVal=explode(",", $form_aval);
	$aFtp=explode(",", $form_aftp);

	if($cErr=='1')
		$cErr = '<b><center><font color="red">Please complete the following fields: </font></center></b>';
	else
		$cErr = '<b><center><font color="red">Please complete the following fields: [invalid value]</font></center><br>';
		
	$cPath = "www.stanfordtravel.com/";
	$file = $cPath.$refpage;

	if(true){
//	if(!extension_loaded('php_curl') && !extension_loaded('curl')){
//		$baseURL = $baseurl;
//		if($baseURL!='')
//			$refpage = $baseURL.substr($refpage,strrpos($refpage,'/'));
//	} else {
		$tmp = time();
		$ch = curl_init($file);
		$fp = @fopen("temp/".$tmp, "w");
		curl_setopt($ch, CURLOPT_FILE, $fp);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_exec($ch);
		curl_close($ch);
		fclose($fp);

		$rep=opendir('temp/');
		while (false != ($file = readdir($rep))){
			if (!is_dir($file)){
				if (file_exists('temp/'.$file)){
					if(time()-$file>60*5)
						unlink("temp/".$file);
				}
			}	
		}
		$refpage = "temp/".$tmp;
	}

	$read = fopen($refpage, "r");

	if($read === false)
		$read = fopen($refpage, "r") or die ("<br>Sorry! There is no access to this file directly. You must follow a link. Please click your browser's back button. <br>");
	error_reporting(1);

	$value = "";
	while(!feof($read)){
		$value .= fread($read, 20000); // reduce number to save server load
	}
	fclose($read);
     //debugbreak();
	$startingpoint = "<!-- startcheck -->";
	$endingpoint = "<!-- stopcheck -->";
	$start= strpos($value, "$startingpoint") + strlen("$startingpoint"); 
	$finish= strpos($value, "$endingpoint"); 
	$length= $finish-$start;
	$value=substr($value, $start, $length);

	if($errpoint!=''){
		$errpoint = explode(",", $errpoint);
		$errpoint[0] = stripslashes($errpoint[0]);
		$errpoint[1] = stripslashes($errpoint[1]);
		$errpoint[0] = substr($errpoint[0], 1, strlen($errpoint[0])-2);
		$errpoint[1] = substr($errpoint[1], 1, strlen($errpoint[1])-2);
	} else {
		$errpoint[0] = "<!-- starterr -->";
		$errpoint[1] = "<!-- stoperr -->";
	}
        $errpoint[0] = "<!-- starterr -->";
        $errpoint[1] = "<!-- stoperr -->";
	//debugbreak();
    $start= strpos($value, "$errpoint[0]") + strlen("$errpoint[0]"); 
	$finish= strpos($value, "$errpoint[1]"); 

	$value = substr($value, 0, $start).$cErr.substr($value, $finish);		
	
	foreach($aVar as $var){
		$val = stripslashes($aVal[$nNr]);
		$cEval = '$eVar = $'.$var.';';
		eval($cEval);
		if(stripslashes($val)=="'".trim($eVar)."'"){
			$value = str_replace('name="'.$var.'"', 'name="'.$var.'" style="background-color:red; color: #ffffff"', $value);
		} else {
			if($var==$cFld)
				$value = str_replace('name="'.$var.'"', 'name="'.$var.'" style="background-color:red; color: #ffffff" value="'.$eVar.'"', $value);
			else
				$value = str_replace('name="'.$var.'"', 'name="'.$var.'" value="'.$eVar.'"', $value);
		}
		$nNr+=1;
	}

    $nPozC = 1997;
	foreach($aCookie as $idx => $var){
		$nNr = array_search($idx, $aVar);
		if($nNr===false){
			if($idx != "vImageCodS") {
				if($idx == 'comments' || $idx == 'TAcomments') {
					$value = str_replace('</textarea>', $var.'</textarea>', $value);
				} else {
					$value = str_replace('name="'.$idx.'"', 'name="'.$idx.'" value="'.$var.'"', $value);
				}				
			}
		}
	}
	
	print $value;

?>
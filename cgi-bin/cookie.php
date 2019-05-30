<?php
// your temp directory :
if(!isset($cLoc))
	$cLoc='';

$SESSION_DIR = $cLoc."temp/";

// The expired date.
$expired_date = 1*1;  // 30 days times 3 (3 months)

srand((double)microtime()*1000000);
$SES_VAR = array();

function generate_SID(){
	return md5(rand(0,32000) . $REMOTE_ADDR . rand(0,32000));
}

function sess_start($sdir, $spin){
global $MYSID, $CKDOMAIN, $SES_VAR, $SESSION_DIR;
if (!$MYSID) 
    $MYSID = generate_SID();

if($sdir != '')
	$SESSION_DIR = $sdir;

if($spin != '')
	$MYSID = $spin;
	
if (file_exists($SESSION_DIR.$MYSID)){
    $arr = file($SESSION_DIR.$MYSID);

	if(time()-fileatime($sdir.$spin)>60*30)
		unlink($sdir.$spin);

    // read content of session from file system ... 
	GLOBAL $aCookie;
    for ($i=1;$i<count($arr);$i++){
        $arr2=explode(":",$arr[$i]);
        $arr2[1]=base64_decode($arr2[1]);
        $SES_VAR[$arr2[0]]=1;
		eval("GLOBAL $".$arr2[0].";");
		eval("$".$arr2[0]."='".$arr2[1]."';");
		eval("$"."aCookie['".$arr2[0]."']='".$arr2[1]."';");
   }
}

}

function sess_register($name){
global $SES_VAR;
$SES_VAR[$name]=1;
}

function sess_close(){
global $MYSID, $CKDOMAIN, $SES_VAR, 
       $SESSION_DIR, $expired_date;

reset($SES_VAR);
$fp = fopen($SESSION_DIR.$MYSID,"w");
fputs($fp,(time() + $expired_date * 24 * 3600)."\n");
while (list($key,$val)=each($SES_VAR)){
	GLOBAL ${$key}; 
	$val = ${$key};
    fputs($fp,$key.":".base64_encode($val)."\n");
}
fclose($fp);
}

function sess_delete($sdir, $spin){
	@unlink($sdir.$spin);

	if ($handle = opendir($sdir)){
		while( ($file = readdir($handle)) !== false){
			if(!is_dir($file)){
				if($file != $spin && file_exists($sdir.$file))
					if(time()-filemtime($sdir.$file)>24*60*60)
						@unlink($sdir.$file);
			}
		}
	}

}
?>
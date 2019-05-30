<?
chdir('../');
require_once("php/verytop.php");
$rec = isset($_POST['r']) ? $_POST['r'] : (isset($_GET['r']) ? $_GET['r'] : '' );
if($rec!=''){
	$rec0 = substr($rec,0,strlen($rec)-5);
	$rec1 = substr($rec,-5);
	if($rec0!=md5(' - AppealMedia.com - '.getIP().$rec1)){
		header("Location: http://".$cPath);
		exit;
	} else {
		chdir('php');
		include("pImage.php");		
	}
}
?>
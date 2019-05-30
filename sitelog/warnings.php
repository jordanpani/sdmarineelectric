<?php
include_once("../inc/dataconn.php");
include_once("../admin/checkuser.php");
if(!isset($nLog) || $nLog!=1){
header("Location: ../index.php");
exit;
}
?>

<?php
include("vImage.php");
if(strlen($_GET['size'])==1 && strlen($_GET['sess'])==32){
	$vImage = new vImage();
	$vImage->gerText($_GET['size'],$_GET['sess']);
	$vImage->showimage($_GET['b']);
}
?>
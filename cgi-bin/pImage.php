<?php
include("vImage.php");

$vImage = new vImage();
$vImage->gerText($_GET['size'],$_GET['sess']);
$vImage->showimage();

?>
<?php
//$cImg = '../../images/ships/santacruz_deck_large.jpg';
$cImg = $HTTP_GET_VARS['img'];
$nImageSize = getimagesize($cImg);
$cTitle = $HTTP_GET_VARS['title']!='' ? $HTTP_GET_VARS['title'] : 'Deck Plan';
?>
<html>
<head>
<title><?php echo $cTitle?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript1.2">

top.window.moveTo(0,0);
if (document.all) {
top.window.resizeTo(<?php echo $nImageSize[0]?>+60,<?php echo $nImageSize[1]?>+100);
}
else if (document.layers||document.getElementById) {
if (top.window.outerHeight<<?php echo $nImageSize[1]?> || top.window.outerWidth<<?php echo $nImageSize[0]?>){
top.window.outerHeight = <?php echo $nImageSize[1]?>+60;
top.window.outerWidth = <?php echo $nImageSize[0]?>+100;
}
}
//-->
</script>
<script type="text/javascript" src="/js/ganalytics.js"></script>
</head>

<body bgcolor="#006088">
<div align="center">
<table width="100%" height="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#006088">
  <tr>
    <td align="center">
	<img src='<?php echo $cImg?>'>
	</td>
  </tr>
</table>
</div>
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-1421095-1");
pageTracker._trackPageview();
} catch(err) {}</script>
</body>
</html>

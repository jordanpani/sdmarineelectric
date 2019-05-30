<?php 
class vImage{

	var $numChars = 6;
	var $w;
	var $h = 50;
	var $colBG = "229 229 229";
	var $colTxt = "0 0 0";
//var $colBorder = "0 128 192";
	var $colBorder = "0 0 0";
	var $charx = 20;
	var $numCirculos = 10;
	var $font = 'monofont.ttf';	
	
	function vImage($sess=0){
		if($sess==1){
			include_once('php/cookie.php');
			sess_start("temp/","");
			sess_register("vImageCodS");
		    global $MYSID;
			global $vImageCodS;
			global $pinCode;
			$vImageCodS = '';
			sess_close();
			$pinCode = $MYSID;
		}
		if($sess==2){
			include_once('php/cookie.php');
			sess_start("temp/","");
			sess_register("vImageCodS");
		    global $MYSID;
			global $vImageCodS;
			global $pinCode;
			$vImageCodS = '';
			sess_close();
			$pinCode = $MYSID;
		}
	}
	
	function gerText($num,$sess){
		if (($num != '')&&($num > $this->numChars)) $this->numChars = $num;		
		$this->texto = $this->gerString();

		if(isset($HTTP_SESSION_VARS['vImageCodS'])){
			$_SESSION['vImageCodS'] = $this->texto;

		} else {

			include_once('../php/cookie.php');
			sess_start("../temp/",$sess);
			sess_register("vImageCodS");
		    global $MYSID;
			global $vImageCodS;
			$vImageCodS = $this->texto;
			sess_close();
			global $pinCode;
			$pinCode = $MYSID;
		}

	}
	
	function loadCodes(){
		$this->postCode = $_POST['vImageCodP'];
		$postCheck = $_POST['vImageCodS'];
		if($_SESSION['vImageCodS']=='' && $postCheck!=''){
			include_once('php/cookie.php');
			sess_start("temp/",$postCheck);
			global $vImageCodS;
			$this->sessionCode = $vImageCodS;
			sess_delete("temp/",$postCheck);
//print $postCheck;
//exit;
		} else {
			$this->sessionCode = $_SESSION['vImageCodS'];
		}
	}
	
	function checkCode(){
		if (isset($this->postCode)) $this->loadCodes();
//if(getIP()=='89.121.172.190'){
//	print $this->postCode.' = '.$this->sessionCode;
//	exit;
//}
		if ($this->postCode == $this->sessionCode)
			return true;
		else
			return false;
	}
	
	function showCodBox($mode=0,$extra=''){
		global $pinCode;
		$str = "<input type=\"text\" name=\"vImageCodP\" ".$extra." size=\"6\" MAXLENGTH=\"6\" AUTOCOMPLETE=OFF value=\"\" >";
		if($pinCode!='')
			$str = $str."<input type=\"hidden\" name=\"vImageCodS\" value=\"".$pinCode."\">";
		
		if ($mode)
			echo $str;
		else
			return $str;
	}
	
	function showImage($nBck=1){
		$height = $this->h;
		$width = ($this->numChars*$this->charx) + 20;
		
		header('Content-Type: image/jpeg');
		
		$this->font = getcwd().'/'.$this->font;
		$code = $this->texto;
		/* font size will be 75% of the image height */
		$font_size = $height * 0.75;
		$image = @imagecreate($width, $height) or die('Cannot Initialize new GD image stream');
		/* set the colours */
		if($nBck==1){
			$background_color = imagecolorallocate($image, 215, 214, 207);
			$text_color = imagecolorallocate($image, 20, 109, 174);
			$noise_color = imagecolorallocate($image, 23, 152, 235);
		} else {
			$background_color = imagecolorallocate($image, 215, 214, 207);
			$text_color = imagecolorallocate($image, 117, 116, 113);
			$noise_color = imagecolorallocate($image, 153, 151, 136);
		}
		/* generate random dots in background */
		for( $i=0; $i<($width*$height)/3; $i++ ) {
			imagefilledellipse($image, mt_rand(0,$width), mt_rand(0,$height), 1, 1, $noise_color);
		}
		/* generate random lines in background */
		for( $i=0; $i<($width*$height)/150; $i++ ) {
			imageline($image, mt_rand(0,$width), mt_rand(0,$height), mt_rand(0,$width), mt_rand(0,$height), $noise_color);
		}
		/* create textbox and add text */
		$textbox = imagettfbbox($font_size, 0, $this->font, $code);
		$x = ($width - $textbox[4])/2;
		$y = ($height - $textbox[5])/2;
		imagettftext($image, $font_size, 0, $x, $y, $text_color, $this->font , $code);
		/* output captcha image to browser */
		imagejpeg($image);
		imagedestroy($image);
		
	}
	
	
	function gerString(){
		$possible = '23456789bcdfghjkmnpqrstvwxyz'; 
		$code = '';
		$i = 0;
		while ($i < $this->numChars) { 
			$code .= substr($possible, mt_rand(0, strlen($possible)-1), 1);
			$i++;
		}
		$txt = $code;
		
		return $txt;
	}
} 
?>
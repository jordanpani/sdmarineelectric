<?php
include_once("php/verytop.php");

$cThisFile = 'index.php';

$fee = isset($_POST['fee']) ? $_POST['fee'] : (isset($_GET['fee']) ? $_GET['fee'] : '' );
$rec = isset($_POST['r']) ? $_POST['r'] : (isset($_GET['r']) ? $_GET['r'] : '' );
if($rec!=''){
	$rec0 = substr($rec,0,strlen($rec)-5);
	$rec1 = substr($rec,-5);
	if($rec0!=md5(' - AppealMedia.com - '.getIP().$rec1) || $fee!=''){
		header("Location: ".$cThisFile);
		exit;
	}
	require_once('php/sendemail.php');
}

$cAgent = $_SERVER['HTTP_USER_AGENT'];
$bIE = false;
if(preg_match('/MSIE/i',$cAgent)){
	$bIE = true;
}
?>
	<!DOCTYPE html>
	<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
	<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
	<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
	<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
		<head>
			<meta charset="utf-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
			<title>Travel to Machu Picchu and Peru - Guided Tours</title>
            <meta name="description" content="Luxury and first-class travel to Peru and Machu Picchu - experienced guides and boutique hotels, good prices, for an authentic Peruvian getaway">
			<meta name="keywords" content="First class and luxury travel Peru, vacation, travel holiday, Machu Picchu, luxury travel south america, Machu Picchu travel,family trips, adventure cruises to the Amazon, and Inca Trail trekking, Lima, Cusco, Cuzco,  Sacred Valley, Peru ">
			<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

			<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

			<link rel="stylesheet" href="css/normalize.css">
			<link rel="stylesheet" href="css/main.css">
			
<link rel="stylesheet" href="css/styles.css">
			<link rel="stylesheet" href="css/responsive.css">
			<script src="js/vendor/modernizr-2.6.2.min.js"></script>
            <script type="text/javascript" src="/js/ganalytics.js"></script>
		</head>
		<body>
			
			<header>
				<div class="wrap">
					<img src="img/logo-machu-picchu.png" alt="Machu Picchu Travel" />
					<p>Machu Picchu Travel. Luxury and first-class travel to  Machu Picchu and the Amazon  in Peru. Private Tours through the Amazon and up to Machu Picchu.</p>
					<div>
						<span>Call Stanford Travel Toll Free</span>
						<span>(877) 213-1688</span>
					</div>
				</div>
			</header><!-- #BeginLibraryItem "/Library/MainMenu.lbi" --><nav>
    <a class="toggleMenu" href="#">
        <span class="line"></span>
        <span class="line"></span>
        <span class="line"></span> 
    </a>
  <div class="nav wrap">
    <ul class="clearfix">
      <li><a href="http://www.machupicchutravel.com">Home</a></li>
      <li><a href="/machu-picchu-tour.html">Tours to Machu Picchu</a></li>
      <li><a href="/amazon-tours-peru.html">Peruvian Amazon</a></li>
      <li><a href="/lake-titicaca-tours-peru.html">Tours to Lake Titcaca</a></li>
      <li><a href="/nazca-lines-travel.html">Travel to the Nazca Lines</a></li>
      <li><a href="/testimonials.html">Testimonials</a></li>
      <li><a href="/faq.html">FAQ</a></li>
      <li><a href="/reservations.php">Reservations</a></li>
    </ul>
  </div>
</nav>
<!-- #EndLibraryItem --><div class="flexslider">
  <div class="black-bottom"></div>
				<div class="white-top"></div>
				
				<div class="get-in-touch" >

<?php
$nFrm = 1;
$e = isset($_POST['e']) ? $_POST['e'] : (isset($_GET['e']) ? $_GET['e'] : $nFrm );
if(isset($_GET['s']) && $_GET['s']==1 && $e==$nFrm)
$msg[$nFrm] = "<span style='color:#0000FF; font-weight:bold;'><br>Thank you! Your information has been submitted.<br><br></span>";
if(isset($_GET['s']) && $_GET['s']==0 && $e==$nFrm)
$msg[$nFrm] = "<span style='color:#DD0000; font-weight:bold;'><br>Error processing contact form!<br><br><br></span>";
//	$msg[$nFrm] = "<span class='usererr".$nFrm."'>Error processing contact form!</span>";

$bEmail[$nFrm] = false;
if($bIE){
	$name = $name==''?'fullname':$fname;
	$email = $email==''?'email':$email;
	$phone = $phone==''?'phone':$phone;
	$comments = $comments==''?'comments':$comments;
} else {
	$name = '';
	$email = '';
	$phone = '';
	$comments = '';
}

$k = isset($_POST['k']) ? $_POST['k'] : (isset($_GET['k']) ? $_GET['k'] : '' );
if($k!='' && $e==$nFrm){
	include_once('php/cookie.php');
	$kpin = substr($k,8);
	sess_start("temp/",$kpin);
	sess_close();

	if(strlen($cErr)>1)
		$msg[$nFrm] = "<span style='color:#DD0000; font-weight:bold;'><br>".$cErr."<br><br></span>";
	else
		$msg[$nFrm] = "<span style='color:#DD0000; font-weight:bold;'><br>You have errors! Please review your form and send it again.<br><br></span>";

	if(!validEmail(trim(urldecode($email))))
		$bEmail[$nFrm] = true;
}

$cAC = isset($_POST['ac']) ? $_POST['ac'] : (isset($_GET['ac']) ? $_GET['ac'] : '' );
if($cAC=='')
$cAC = $cAuth.$cTFile;

require_once("php/vImage.php");
$vImage = new vImage(2);
$vImage->loadCodes();
?>
<script type="text/javascript" src="js/checkform.js"></script>
<script type="text/javascript">
<!--
// Enter name of mandatory fields
var fieldRequired<?=$nFrm?> = new Array();
var selFld<?=$nFrm?> = '';
var emailfilter=/^\w+[\+\.\w-]*@([\w-]+\.)*\w+[\w-]*\.([a-z]{2,4}|\d+)$/i
-->
</script>											

<form name="frm<?=$nFrm?>" id="contact" action="<?=$cThisFile?>" method="post" onSubmit="return formCheck(this,fieldRequired<?=$nFrm?>,selFld<?=$nFrm?>);"> 
<input type="hidden" name="r" value="<?=$cAuth.$cTFile?>" />
<input type="hidden" name="f" value="<?=$cThisFile?>">
<input type="hidden" name="e" value="<?=$nFrm?>">

					<?=$msg[$nFrm]==''?'<h1>Get in touch</h1>':$msg[$nFrm]?>

						<input type="text" class="txtfld" <?=$bIE==true?'onfocus="if (this.value==\'fullname\') this.value = \'\'" onblur="if (this.value==\'\') this.value = \'fullname\'"':'placeholder="fullname"'?> name="name" value="<?=urldecode($name)?>" <?=$name=='' && $k!='' && $e==$nFrm?'style="color:#FF0000"':''?> />
						<input type="text" class="txtfld" <?=$bIE==true?'onfocus="if (this.value==\'phone\') this.value = \'\'" onblur="if (this.value==\'\') this.value = \'phone\'"':'placeholder="phone"'?> name="phone" value="<?=urldecode($phone)?>" />
						<input type="text" class="txtfld" <?=$bIE==true?'onfocus="if (this.value==\'email\') this.value = \'\'" onblur="if (this.value==\'\') this.value = \'email\'"':'placeholder="email"'?> name="email" value="<?=urldecode($email)?>" <?=($email=='' && $k!='' && $e==$nFrm) || ($bEmail[$nFrm] && $k!='' && $e==$nFrm)?'style="color:#FF0000"':''?> />
						<textarea class="txtarea" <?=$bIE==true?'onfocus="if (this.value==\'comments\') this.value = \'\'" onblur="if (this.value==\'\') this.value = \'comments\'"':'placeholder="comments" onFocus="this.style.color=\'#3D3320\'" onBlur="if(this.value==\'\') this.style.color=\'#3D3320\';"'?> name="comments" /><?=urldecode($comments)?></textarea>
					<div class="clearfix">
					<span style="display:block; float:left; width:91px; height:54px; padding: 5px 4px 0 0;"><font id="captcha<?=$nFrm?>"><img src="images/image.php?size=6&sess=<?=$pinCode?>&b=<?=$nFrm?>&r=<?=$cAuth.$cTFile?>" height=35 width=91></font></span>
<span style="display:block; float:left; padding:17px 5px;"><a onClick="reLoad<?=$nFrm?>('<?=$pinCode?>','1')" href="javascript: void(0)"><img title="Get a new Security Code" src="images/reload.png"></a></span>
					<? $cCStyle=($k!='' && $e==$nFrm?'id="code" class="txtfld" style="color:#ff0000;float:left;width:115px; margin-top:10px;"':'id="code" class="txtfld" style="float:left;width:115px; margin-top:10px;"').' '.($bIE==true?'onfocus="if(this.value==\'security code\') this.value = \'\'" onblur="if(this.value==\'\') this.value = \'security code\'" value=\'security code\'':'placeholder="security code"');?><?=$vImage->showCodBox(1,$cCStyle); ?>
					</div>
					<div style="display:none">
					<input type="text" name="fee" value="">
					</div>
					<div class="clearfix">
						<input type="reset" class="btn-white re" value="reset">
						<input type="submit" class="btn-white su" value="submit">
					</div>
<input type="hidden" name="form_avar" value="name|email|comments|vImageCodP">
<input type="hidden" name="form_amsg" value="'Your Full Name'|'Your E-mail Address'|'Your Comments'|'Your Security Code'">
<?
if($bIE){
?>
<input type="hidden" name="form_aval" value="'fullname'|'email'|'comments'|'security code'">
<?
} else {
?>
<input type="hidden" name="form_aval" value="''|''|''|''">
<?
}
?>
<input type="hidden" name="form_aftp" value="''|'E'|''|'G'">
</form>
<script>
<!--
// Array = ['field Name', 'field Label', 'field Empty value', 'field Type'] - for field Type = N - numeric, E - email address, P - phone format (XXX) XXX - XXXXX / XXX - XXX.XXXX, D -date
myString = new String()
myString = document.frm<?=$nFrm?>.form_avar.value;
aStringA = myString.split("|")
myString = document.frm<?=$nFrm?>.form_amsg.value;
aStringB = myString.split("|")
myString = document.frm<?=$nFrm?>.form_aval.value;
aStringC = myString.split("|")
myString = document.frm<?=$nFrm?>.form_aftp.value;
aStringD = myString.split("|")

for(n=0; n<aStringA.length; n++){
cEval = "fieldRequired<?=$nFrm?>.push(['"+aStringA[n]+"',"+aStringB[n]+","+aStringC[n]+","+aStringD[n]+"]);";
eval(cEval);
}

function reLoad<?=$nFrm?>(sess,b){
document.getElementById('captcha'+b).innerHTML = '<img src="images/spacer.gif" height="35px" width="91px">';
var rnr=Math.floor(Math.random()*1001)
str = "sess="+sess+"&b="+b+"&n="+rnr;
document.getElementById('captcha'+b).innerHTML = '<img src="images/image.php?size=3&'+str+'&b=<?=$nFrm?>&r=<?=$cAuth.$cTFile?>" height="35px" width="91px">';
}
-->
</script>
				</div>


				<ul class="slides">
					<li>
						<h2>Explore Machu Picchu<span>Visit the Lost City of the Incas</span></h2>
						<img src="img/image-slide01.jpg" alt="" />
					</li>
					<li>
						<h2>The Peruvian Amazon<span>An Untaimed Frontier</span></h2>
						<img src="img/image-slide1c.jpg" alt="" />
					</li>
					<li>
						<h2>Cusco - Festival of the Sun <span>Tour Cusco during the summer solstice</span></h2>
						<img src="img/image-slide1b.jpg" alt="" />
					</li>
					<li>
						<h2>Explore Lake Titicaca in Peru <span>Daily Tours</span></h2>
						<img src="img/image-slide1d.jpg" alt="" />
					</li>
				</ul>
			</div>
			<div id="red-divider">
				<div class="wrap"></div>
			</div>
			
			<div id="content"><!-- #BeginLibraryItem "/Library/ToursCascade.lbi" --><div class="tours wrap clearfix">
					<div class="tour">
                                        <a href="machu-picchu-tour.html">
						<h3>Machu Picchu</h3></a>                                        <a href="machu-picchu-tour.html">
						<img src="img/image-tour1.jpg" alt="Explore Machu Picchu" />
                        </a> 
						<div class="details">
                                                                <a href="machu-picchu-tour.html">
							6 days/5 nights - daily departures Lima/Cuzco. see more &raquo;</a>
						</div>
					</div>
					<div class="tour">
                    <a href="amazon-tours-peru.html">
						<h3>Peruvian Amazon</h3></a>
                        <a href="amazon-tours-peru.html">
						<img src="img/image-tour2.jpg" alt="Take a tour to the Peruvian Amazon on the way to Machu Picchu" /></a>
						<div class="details">
                        <a href="amazon-tours-peru.html">
							3 night stay at the Reserva Amazonica in the Amazon &raquo;</a>
						</div>
					</div>
					<div class="tour">
                    <a href="lake-titicaca-tours-peru.html">
						<h3>Lake Titicaca</h3></a>
                                            <a href="lake-titicaca-tours-peru.html">
						<img src="img/image-tour3.jpg" alt="Lake Titicaca on the border between Peru and Bolivia" />
                        </a>
						<div class="details">
                                            <a href="lake-titicaca-tours-peru.html">
							3 days / 2 nights stay at the
Hotel Libertador&raquo; </a>
						</div>
					</div>
					<div class="tour">
                                        <a href="nazca-lines-travel.html">
						<h3>Nazca Lines</h3></a>
                        <a href="nazca-lines-travel.html">
						<img src="img/image-tour4.jpg" alt="Visit the Nazca Lines of Peru" /></a>
						<div class="details">
                        <a href="nazca-lines-travel.html">
							The Nazca Lines are one of the
world's great mysteries. more &raquo;</a>
						</div>
					</div>
					<img src="img/title-travel-to.png" alt="" />
				</div><!-- #EndLibraryItem --><div class="wrap w-sidebar clearfix">
	  <div>
						<article>
							<img src="img/badge.png" alt="" />
							<h4 class="th2">Our Specials</h4>
							<div class="clearfix">
								<div class="left">
									<div class="photo-small">
                                    	
                                        <a href="inca-sun-festival-cusco.html">
										<img src="img/border-small.png" alt="Travel to Machu Picchu to see the Inca Sun Festival " class="main" />
                                        </a>
                                        
                                        <a href="inca-sun-festival-cusco.html">
										<img src="images/inca_festival_for_index.jpg" alt="Travel to Machu Picchu to see the Inca Sun Festival" class="main" />
                                        </a>
									</div>
									<h5 class="th3">Come to an Inca Festival</h5>
									<p><strong>Machu Picchu Special Discount: Include travel to Cusco to see the Festival of the Sun - 25% off on Festival permits </strong>
									Be one of more than thousands of spectators that come to this annual celebration
									and see 500 actors, musicians, and dancers reenact traditional inca ceremonies. Festivities continue throughout the week, with elaborately costumed dancers, street fairs, and free concerts.</p>
								</div>
								<div class="right">
									<div>
										<img src="img/image-star.png" alt="" />
										<img src="img/image-star.png" alt="" />
										<img src="img/image-star.png" alt="" />
										<img src="img/image-star.png" alt="" />
										<img src="img/image-star.png" alt="" />
									</div>
									<p>Special Promotions Availalbe for the Sun Festival in Cusco!</p>
									<ul class="clearfix">
										<li><a href="reservations.php" class="btn-green">Inquire Now!</a></li>
										<li><a href="inca-sun-festival-cusco.html" class="btn-green">Sun Festival</a></li>
										<li><a href="#" class="btn-green">Promotions</a></li>
									</ul>
									<div class="btn-maroon">Call Now (877) 213-1688</div>
								</div>
							</div>
						</article>
						<article>
							<h4 class="th4">first class and  Luxury Travel</h4>
							<ul>
								<li>
								<p>We are your #1 source for first class and luxury <strong>travel to Machu Picchu and Peru</strong> in South America, including tours, vacations, family trips and adventure cruises.</p>
									<ul>
										<li>We can also combine luxury and first-class tours to South America from StanfordTravel.com</li>
										<li>For more tours to Peru see <strong>luxury and first-class travel, Peru at StanfordTravel.com</strong></li>
										<li>Or see StanfordTravel.com for <strong>luxury, and first-class travel to South America</strong> and for the <strong>Galapagos vacation packages.</strong></li>
									</ul>
								</li>
							</ul>
							<div class="photo" >
								<img src="images/border_457h.png" alt="" 	/>
								<img src="images/llamas_691x457.jpg"  alt="" />
							</div>
						</article>
					</div>
					<aside>
						<div class="widget faq">
							<h5 class="th5">FAQ</h5>
							<ul>
								<li class="clearfix">
									<div><img src="img/image-passport.png" alt="" /></div>
									<div>
										<h6 class="th6">Entry Requirements</h6>
										<p>U.S. citizens must carry a valid passport to travel in South America. In general, the passport must be valid for up to...</p>
										<a href="faq.html#entry_requirements" class="btn-green">Read More</a>
									</div>
								</li>
								<li class="clearfix">
									<div><img src="img/image-thermo.png" alt="" /></div>
									<div>
										<h6 class="th6">Winter Travel</h6>
										<p>The Galapagos Islands and Machu Picchu in Peru, are a year round destination that offers a great winter getaway on the equator. If you are travelling from a nothern city in the winter...</p>
										<a  href="faq.html#winter_travel" class="btn-green">Read More</a>
									</div>
								</li>
							</ul>
						</div>
						<div class="widget weather clearfix">
							<h5 class="th5">Weather</h5>
							<div class="meter"><img src="img/fscale1.jpg" alt="" /></div>
							<div class="data" id="weather"></div>
							<div>
								<select name="sloc" id="sloc" class="textbox1">
									<optgroup label="Ecuador">
										<option value="Quito, Ecuador">Quito</option>
										<option value="Cayambe, Ecuador">Cayambe</option>
										<option value="Cuenca, Ecuador">Cuenca</option>
										<option value="Galapagos Island, Ecuador">Galapagos Island</option>
										<option value="Guayaquil, Ecuador">Guayaquil</option>
										<option value="Loja, Ecuador">Loja</option>
										<option value="Manta, Ecuador">Manta</option>
									</optgroup>
									<optgroup label="Peru">
										<option value="Lima, Peru">Lima</option>
										<option value="Chiclayo, Peru">Chiclayo</option>
										<option value="Cusco, Peru">Cusco</option>
										<option value="Iquitos, Peru">Iquitos</option>
										<option value="Nazca, Peru">Nazca</option>
										<option value="Puerto Maldonado, Peru">Puerto Maldonado</option>
										<option value="Puno, Peru">Puno</option>
										<option value="Trujillo, Peru">Trujillo</option>
									</optgroup>
								</select>
							</div>
						</div>
					</aside>
				</div>
			</div><!-- #BeginLibraryItem "/Library/page_footer.lbi" --><footer> 
  <div class="wrap">
    <div class="brown-divider"></div>
    <div class="clearfix three-box">
      <div> <img src="img/logo-stanford-travel.png" alt="StanfordTravel Systems logo" >
        <p class="tag"> "The world's leader in upper-class travel experiences" </p>
        <p> This site is independently owned and operated by Stanford Travel Systems, Incorporated
          California Seller of Travel Registration # 2065584-40
          Copyright 2002 by Stanford Travel Systems, Incorporated. All Rights Reserved. </p>
        <p>Emails -- Please <strong><a href="/reservations.php" style="text-decoration:none">Use Our Reservation Page</a></strong></p>
        <p><a href="tel:8772131688">(877) 213-1688 </a><strong>TOLL FREE</strong></p>
      </div>
      <div> 
        <ul>
          <li><a href="/index.php">Home</a></li>
          <li><a href="/terms_and_conditions.html">Terms of Use</a></li>
          <li><a href="/faq.html">FAQ</a></li>
          <li><a href="/testimonials.html">Testimonials</a></li>
          <li><a href="/reservations.php">Reservations</a> </li>
        </ul>
      </div>
      <div>
        <ul>
          <li><a href="/machu-picchu-tour.html">Travel to Machu Picchu - Tours</a></li>
          <li><a href="/nazca-lines-travel.html">Travel to the Nazca - Tours</a></li>
          <li><a href="/amazon-tours-peru.html">Travel to the Amazon - Tours</a></li>
          <li><a href="/lake-titicaca-tours-peru.html">Travel to Lake Titcaca</a></li>
          <li>Related Links:</li>
          <li><a href="http://www.stanfordtravel.com">Galapagos Cruises and Machu Picchu Travel</a></li>
          <li><a href="http://www.traveltourstoindia.com">Travel &amp; Tours to India</a></li>
        </ul>
      </div>
    </div>
    <div class="copy clearfix">
      <div> <img src="img/image-cards.png" alt="" >
        <div>Copyright © 2006, Stanford Travel Systems Inc.</div>
      </div>
      <div> <a href="https://www.facebook.com/pages/Stanford-Travel-Systems/312786045402576?ref=hl" rel="nofollow" ><img src="img/icon-facebook.png" alt="" ></a>  <a href="http://stanfordtravel.wordpress.com/category/luxury-travel-and-cruises/stanford-travel-system/"><img src="img/icon-wordpress.png" alt="" ></a>
        <div>Site Design by: APPEAL INTERACTIVE</div>
      </div>
    </div>
  </div>
</footer>
<!-- #EndLibraryItem --><script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
			<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.9.1.min.js"><\/script>')</script>
			<script src="js/plugins.js"></script>
			<script src="js/main.js"></script>
			
		<script type="text/javascript" src="js/jquery.simpleWeather.min.js"></script>

<script type="text/javascript">
  $(document).ready(function(){
	var temp = 'f';
	var loc = 'Quito, Eucador';
	function weatherf(){ 
	  $.simpleWeather({
		location: loc,
		woeid: '',
		unit: temp,
		success: function(weather) {

		  tval = weather.temp;
			if(temp == "f"){
				if(tval>10 && tval<21)
					tcolor = "#ccffff";
				if(tval>20 && tval<31)
					tcolor = "#99ffff";
				if(tval>30 && tval<41)
					tcolor = "#66ccff";
				if(tval>40 && tval<51)
					tcolor = "#54a9ff";
				if(tval>50 && tval<61)
					tcolor = "#ccff99";
				if(tval>60 && tval<71)
					tcolor = "#ffff99";
				if(tval>70 && tval<81)
					tcolor = "#ffcc66";
				if(tval>80 && tval<91)
					tcolor = "#ff9966";
				if(tval>90 && tval<101)
					tcolor = "#cc6666";
				if(tval>100 && tval<110)
					tcolor = "#d14949";
			} else {
				if(tval>-20 && tval<-9)
					tcolor = "#ffffff";
				if(tval>-10 && tval<-4)
					tcolor = "#ccffff";
				if(tval>-5 && tval<1)
					tcolor = "#99ffff";
				if(tval>0 && tval<6)
					tcolor = "#66ccff";
				if(tval>5 && tval<11)
					tcolor = "#54a9ff";
				if(tval>10 && tval<16)
					tcolor = "#ccff99";
				if(tval>15 && tval<21)
					tcolor = "#ffff99";
				if(tval>21 && tval<26)
					tcolor = "#ffcc66";
				if(tval>25 && tval<31)
					tcolor = "#ff9966";
				if(tval>30 && tval<36)
					tcolor = "#cc6666";
				if(tval>35 && tval<40)
					tcolor = "#d14949";
			}
		
		  if(temp=='f'){
			  html = '<h6>'+weather.city+'</h6>';
			  html += '<div class="degree">Currently: <span id="rsstitle" class="rsstitle" style="color:'+tcolor+'">'+weather.temp+'&deg; '+weather.units.temp+' </span><div>';
			  html += '<div class="tickerimg link"><img src="images/weather/'+weather.code+'.gif" width="90%"></div>';
			  html += '<div class="current">'+weather.currently+'</div>';
			  html += '<div class="forecast">Forecast:</div>';
			  html += '<div id="rssforecast1" class="tickercnt"><b>'+weather.forecast[1].day+' </b>'+weather.forecast[1].date+'<br>Low:'+weather.forecast[1].low+'&deg; &nbsp; High:'+weather.forecast[1].high+'&deg; <br>'+weather.forecast[1].text+'</div>';
			  html += '<div id="rssforecast2" class="tickercnt"><b>'+weather.forecast[2].day+' </b>'+weather.forecast[2].date+'<br>Low:'+weather.forecast[2].low+'&deg;  &nbsp; High:'+weather.forecast[2].high+'&deg; <br>'+weather.forecast[2].text+'</div>';
			  html += '<div id="rssforecast3" class="tickercnt"><b>'+weather.forecast[3].day+' </b>'+weather.forecast[3].date+'<br>Low:'+weather.forecast[3].low+'&deg;  &nbsp; High:'+weather.forecast[3].high+'&deg; <br>'+weather.forecast[3].text+'</div>';
			  html += '<div id="rssforecast4" class="tickercnt"><b>'+weather.forecast[4].day+' </b>'+weather.forecast[4].date+'<br>Low:'+weather.forecast[4].low+'&deg;  &nbsp; High:'+weather.forecast[4].high+'&deg; <br>'+weather.forecast[4].text+'</div>';
			  html += '<div class="lastdate">Last Updated:<span id="rssdate">'+weather.updated+'</span></div>';
		  } else {
			  html = '<h6>'+weather.city+'</h6>';
			  html += '<div class="degree">Currently: <span id="rsstitle" class="rsstitle">'+weather.alt.temp+'&deg; '+weather.alt.unit+' </span><div>';
			  html += '<div class="tickerimg link"><img src="images/weather/'+weather.code+'.gif" width="90%"></div>';
			  html += '<div class="current">'+weather.currently+'</div>';
			  html += '<div class="forecast">Forecast:</div>';
			  html += '<div id="rssforecast1" class="tickercnt"><b>'+weather.forecast[1].day+' </b>'+weather.forecast[1].date+'<br>Low:'+weather.forecast[1].alt.low+'&deg; &nbsp; High:'+weather.forecast[1].alt.high+'&deg; <br>'+weather.forecast[1].text+'</div>';
			  html += '<div id="rssforecast2" class="tickercnt"><b>'+weather.forecast[2].day+' </b>'+weather.forecast[2].date+'<br>Low:'+weather.forecast[2].alt.low+'&deg;  &nbsp; High:'+weather.forecast[2].alt.high+'&deg; <br>'+weather.forecast[2].text+'</div>';
			  html += '<div id="rssforecast3" class="tickercnt"><b>'+weather.forecast[3].day+' </b>'+weather.forecast[3].date+'<br>Low:'+weather.forecast[3].alt.low+'&deg;  &nbsp; High:'+weather.forecast[3].alt.high+'&deg; <br>'+weather.forecast[3].text+'</div>';
			  html += '<div id="rssforecast4" class="tickercnt"><b>'+weather.forecast[4].day+' </b>'+weather.forecast[4].date+'<br>Low:'+weather.forecast[4].alt.low+'&deg;  &nbsp; High:'+weather.forecast[4].alt.high+'&deg; <br>'+weather.forecast[4].text+'</div>';
			  html += '<div class="lastdate">Last Updated:<span id="rssdate">'+weather.updated+'</span></div>';
		  }
		  $("#weather").html(html);

		},
		error: function(error) {
		  $("#weather").html('<div></div>');
		}
	
	  });
	  
	  $('#sloc').change(function(){
		cLoc = document.getElementById('sloc');
		loc = cLoc.options[cLoc.selectedIndex].value;
		weatherf();
	  });
	  
	  $('#atemp').click(function(){
		if(temp=='f'){
			temp = 'c';
			$('.tickerbld').html('<img src="img/fscale2.jpg" alt="" />');
		} else {
			temp = 'f';
			$('.tickerbld').html('<img src="img/fscale1.jpg" alt="" />');
		}
		weatherf();
	  });
	  
	}
	weatherf();
	
	setInterval(weatherf, 600000);

  });
</script>
			
		</body>
	</html>

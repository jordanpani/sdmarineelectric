<?php

require_once("php/verytop.php");
if(isset($_POST['r']) && $_POST['r']!=''){
	require_once('php/sendemail.php');
}
$cThisFile = 'index.php';
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		
		<title>Galapagos Island Cruise and Travel to Machu Picchu in Peru</title>
		
		<meta name="description" content="Luxury or first class cruise in the Galapagos Islands and tours to Machu Picchu in Peru with Stanford Travel">
		
		<meta name="keywords" content="Stanford  Travel Systems, luxury travel, first class travel, Galapagos Island cruise,  Galapogos Islands,  Machu Picchu tour, travel, holiday, tour packages">
		
		<meta name="viewport" content="width=device-width">
		
		<meta name="verify-v1" content="zn7jL6MwbVk4H2YfbrpmjCRI+6HRkJ0S0MdLju0cTuU=" >

		<meta name="google-site-verification" content="Ob-YPkp_p1URczQ9bPdfhebZMS2ENZShiTIu7oajVb0" >


		<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

		<link rel="stylesheet" href="css/normalize.css">
		<link rel="stylesheet" href="css/main.css">
		<link rel="stylesheet" href="css/styles.css">
		<script src="js/vendor/modernizr-2.6.2.min.js"></script>

	    <script type="text/javascript" src="/js/ganalytics.js"></script>
	</head>
	<body>
		<!--[if lt IE 7]>
			<p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
		<![endif]-->
		<header>
			<div class="wrap clearfix">
				<img src="img/logo-stanford-travel.png" alt="" />
				<h1>Galapagos Island Cruises and Machu Picchu
                <br>Machu Pichu Tours</h1>
				<div>Call Stanford Travel Toll Free<span>(877) 213-1688</span></div>
				<a class="toggleMenu" href="#">
					<span></span>
					<span></span>
					<span></span>
				</a>
			</div>
			<nav>
				<ul class="nav clearfix">
					<li><a href="destinations.html">Destination</a></li>
					<li><a href="contact.php">Contact Us</a></li>
					<li><a href="testimonials.html">Testimonials</a></li>
					<li><a href="GalapagosCruisePlanner.html" title="take a tour in the Galapagos Islands">Galapagos Tours</a></li>
					<li><a href="machu.html" title="travel to Machu Picchu">Travel to Machu Picchu</a></li>
					<li><a href="galapagos_photo_gallery.html" title="Galapagos Photo Gallery">Galapagos Photo Gallery</a></li>
					<li><a href="aboutus.html">About</a></li>
					<li><a href="faq.html" title="questions and answers about Machu Picchu and Galapagos Islands Travel">FAQ</a></li>
				</ul>
			</nav>
		</header>
		<div class="content clearfix">
			<div class="flexslider">
				<ul class="slides">
					<li>
						<img src="img/slide-image01.jpg" alt="Vacation in the Galapagos" />
						<p class="flex-caption">Experience the Vacation <br>of a Lifetime</p>
					</li>
					<li>
						<img src="img/slide-image02.jpg" alt="" />
						<p class="flex-caption">Incredible Proximity to Amazing Creatures!</p>
					</li>
					<li>
						<img src="img/slide-image03.jpg" alt="" />
						<p class="flex-caption">Experience the Amazing Amazon</p>
					</li>
					<li>
						<img src="img/slide-image04.jpg" alt="" />
						<p class="flex-caption">Nature's Magnificent Galapagos Islands</p>
					</li>
				</ul>
				<div class="wave"><img src="img/slider-wave.png" alt="" /></div>
				<div class="contact clearfix">
<?php
$nFrm = 1;
$e = isset($_POST['e']) ? $_POST['e'] : (isset($_GET['e']) ? $_GET['e'] : $nFrm );
if(isset($_GET['s']) && $_GET['s']==1 && $e==$nFrm)
$msg[$nFrm] = "<span style='color:#00AA00'><br>Thank you!<br>Your information has been submitted.<br><br></span>";
if(isset($_GET['s']) && $_GET['s']==0 && $e==$nFrm)
$msg[$nFrm] = "<span style='color:#DD0000'><br>Error processing contact form!<br><br><br></span>";
//	$msg[$nFrm] = "<span class='usererr".$nFrm."'>Error processing contact form!</span>";

$bEmail[$nFrm] = false;
$fname = '';
$lname = '';
$email = '';
$phone = '';
$comment = '';

$k = isset($_POST['k']) ? $_POST['k'] : (isset($_GET['k']) ? $_GET['k'] : '' );
if($k!='' && $e==$nFrm){
include_once('php/cookie.php');
$kpin = substr($k,8);
sess_start("temp/",$kpin);
sess_close();

$msg[$nFrm] = "<span style='color:#DD0000'><br>You have errors! Please review your form and send it again.<br><br></span>";

if(!eregi ("^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,6}$", trim(urldecode($email))))
	$bEmail[$nFrm] = true;
}

$cAC = isset($_POST['ac']) ? $_POST['ac'] : (isset($_GET['ac']) ? $_GET['ac'] : '' );
if($cAC=='')
$cAC = $cAuth.$cTFile;

require_once("php/vImage.php");
$vImage = new vImage(1);
$vImage->loadCodes();
?>
<script type="text/javascript" src="js/checkform.js"></script>
<script type="text/javascript">
<!--
// Enter name of mandatory fields
var fieldRequired<?php echo $nFrm?> = new Array();
var selFld<?php echo $nFrm?> = '';
var emailfilter=/^\w+[\+\.\w-]*@([\w-]+\.)*\w+[\w-]*\.([a-z]{2,4}|\d+)$/i
-->
</script>											

<form name="frm<?php echo $nFrm?>" id="form1" action="index.php" method="post" onSubmit="return formCheck(this,fieldRequired<?php echo $nFrm?>,selFld<?php echo $nFrm?>);"> 
<input type="hidden" name="r" value="<?php echo $cAuth.$cTFile?>" />
<input type="hidden" name="f" value="<?php echo $cThisFile?>">
<input type="hidden" name="e" value="<?php echo $nFrm?>">

					<?php echo $msg[$nFrm]==''?'<h2>Get in touch</h2>':$msg[$nFrm]?>
					
					<input type="text" placeholder="fullname" name="fname" value="<?php echo urldecode($fname)?>" required <?php echo $fname=='' && $k!='' && $e==$nFrm?'style="color:#FF0000"':''?> />
					<input type="text" placeholder="phone" name="phone" value="<?php echo urldecode($phone)?>" />
					<input type="email" placeholder="email" name="email" value="<?php echo urldecode($email)?>" required <?php echo ($email=='' && $k!='' && $e==$nFrm) || ($bEmail[$nFrm] && $k!='' && $e==$nFrm)?'style="color:#FF0000"':''?> />
					<textarea placeholder="comment" name="comment" onFocus="this.style.color='#3D3320'" onBlur="if(this.value=='') this.style.color='#BFBFBF';" /><?php echo urldecode($comment)?></textarea>
					<span style="display:block; float:left; width:91px; height:35px; padding: 5px 4px 0 0;"><font id="captcha<?php echo $nFrm?>"><img src="php/pImage.php?size=6&sess=<?php echo $pinCode?>&b=<?php echo $nFrm?>&t=<?php echo time()?>" height=35 width=91></font></span>
					<?php $cCStyle=$k!='' && $e==$nFrm?'id="code" class="seccode" style="color:#ff0000" required placeholder="security code"':'id="code" class="seccode" required placeholder="security code"';?><?php echo $vImage->showCodBox(1,$cCStyle); ?>
					<input type="submit" value="submit" class="fright" />
<input type="hidden" name="form_avar" value="fname|email|comment|vImageCodP">
<input type="hidden" name="form_amsg" value="'Your Full Name'|'Your E-mail Address'|'Your Message'|'Your Security Code'">
<input type="hidden" name="form_aval" value="''|''|''|''">
<input type="hidden" name="form_aftp" value="''|'E'|''|'G'">
</form>
<script>
<!--
// Array = ['field Name', 'field Label', 'field Empty value', 'field Type'] - for field Type = N - numeric, E - email address, P - phone format (XXX) XXX - XXXXX / XXX - XXX.XXXX, D -date
myString = new String()
myString = document.frm<?php echo $nFrm?>.form_avar.value;
aStringA = myString.split("|")
myString = document.frm<?php echo $nFrm?>.form_amsg.value;
aStringB = myString.split("|")
myString = document.frm<?php echo $nFrm?>.form_aval.value;
aStringC = myString.split("|")
myString = document.frm<?php echo $nFrm?>.form_aftp.value;
aStringD = myString.split("|")

for(n=0; n<aStringA.length; n++){
cEval = "fieldRequired<?php echo $nFrm?>.push(['"+aStringA[n]+"',"+aStringB[n]+","+aStringC[n]+","+aStringD[n]+"]);";
eval(cEval);
}

function reLoad<?php echo $nFrm?>(sess,b){
document.getElementById('captcha'+b).innerHTML = '<img src="images/spacer.gif" height="35px" width="91px">';
var rnr=Math.floor(Math.random()*1001)
str = "sess="+sess+"&b="+b+"&n="+rnr;
document.getElementById('captcha'+b).innerHTML = '<img src="php/pImage.php?size=3&'+str+'">';
}
-->
</script>
				</div>
				<div class="line"></div>
				<div class="bottom-line"><div class="wrap"></div></div>
			</div>
			<div class="four wrap clearfix">
				<article>
					<div class="image">
						<h1>Galapagos Cruises</h1>
						<img src="img/border-white-transparent.png" alt="" />
						<img src="img/img-galapos-cruises.jpg" alt="Galapagos Island Cruises"  class="two" />
					</div>
					<p>Cruise in the Galapagaos Islands - Offering 3, 4, and 7-day tour specials on first-class and luxury ships cruising in the Galapagos</p>
					<footer><a href="GalapagosCruisePlanner.html">learn more &raquo;</a></footer>
				</article>
				<article>
					<div class="image">
						<h1>Travel to Machu Picchu</h1>
						<img src="img/border-white-transparent.png" alt="" />
						<img src="img/img-machu-pichu.jpg" alt="" class="two" />
				  </div>
					<p>Travel to Machu Picchu in Peru, by way of Cuzco, the ancient capital of the Incan Empire.</p>
					<footer><a href="machu.html">learn more &raquo;</a></footer>
				</article>
				<article>
					<div class="image">
						<h1>Tours to the Amazon</h1>
						<img src="img/border-white-transparent.png" alt="" />
						<img src="img/img-amazon.jpg" alt="" class="two"  />
				  </div>
					<p>In the Amazon,  STS offers tours to the Peruvian and Ecuadorian Amazon, including

Sacha Lodge and the Reserva Amazonica</p>
					<footer><a href="ecuador_tours.html">learn more &raquo;</a></footer>
				</article>
				<article>
					<div class="image">
						<h1>Reserve Your Trip</h1>
						<img src="img/border-white-transparent.png" alt="" />						  <img src="img/img-reserve-trip.jpg" alt="Reserve your trip to the Galapagos" class="two"  />
				  </div>
					<p>Contact Stanford Travel Systems to plan a trip,  reserve a Galapagos cruise, or get the latest information on travel to South America</p>
					<footer><a href="contact.php">learn more &raquo;</a></footer>
				</article>
			</div>
			<div class="wrap main clearfix">
				<section>
					<article>
						<img src="img/ribbon-good-deal.png" alt="" class="ribbon"/>
						<h1 class="wribbon">Our Specials</h1>
						<div class="entry clearfix">
							<div class="left">
								<img src="img/image-ship.jpg" alt="" />
								<h2><a href="la_pinta_galapagos.html#profile">La Pinta</a></h2>
								<p><strong><a href="GalapagosCruisePlanner.html#la_pinta">- Discount for cruises on the Santa Cruz II, La Pinta, Eclipse</a></strong>
                                <br />
                                <a href="faq.html#WEATHER">
								- Weather in the Galapagos Island Updates</a><br />
                                <a href="GalapagosCruisePlanner.html#">
								- See Galapagos Tours, see the cruise planner page for new videos on the Galapagos Legend and the Yacht Coral I and Coral II</a></p>
							</div>
							<div class="right">
								<img src="img/img-star.png" alt="" class="star" />
								<img src="img/img-star.png" alt="" class="star" />
								<img src="img/img-star.png" alt="" class="star"/>
								<img src="img/img-star.png" alt="" class="star" />
								<img src="img/img-star.png" alt="" class="star" style="margin-right:0;"/>
								<em>Find the best deal for you</em>
								<div class="clearfix">
									<a href="contact.php">Inquire Now</a>
									<a href="GalapagosCruisePlanner.html">Our Cruises</a>
									<a href="GalapagosCruisePlanner.html#PROMOTIONS">Promotions</a>
		<!--removed for now				<a href="GalapagosCruisePlanner.html">Specs</a>   -->
							</div>
								<a href="#">Call now (877) 213-1688</a>
							</div>
						</div>
					</article>
					<article>
						<h1 class="blue">Our Luxury & First Class Cruises</h1>
						<div class="entry clearfix article2">
							<div class="ships"> <img src="img/img-ship2.jpg" alt="M/V Santa Cruz - Galapagos Islands" />								  <img src="img/img-ship3.jpg" alt="Eric Letty Flamingo Luxury Yachts- Galapagos Islands " />
								<img src="img/img-ship4.jpg" alt="" />
					</div>
							<div class="titles2 clearfix">
								<h2><a href="santacruz.html">Santa Cruz II</a></h2>
								<h2><a href="eric-letty-galapagos.html" title="Eric Letty Flamingo Luxury Yachts- Galapagos Islands">Eric Letty Flamingo</a></h2>
								<h2><a href="GalapagosCruisePlanner.html#SEAMAN2">Seaman II</a></h2>
							</div>
							<p>Cruise in the Galapagos Islands and take a travel tour to Machu Picchu in Peru and other destinations in Latin America! Browse our selection of informative travel sites offering first-class & luxury tour packages to South America including a Galapagos Island cruise and travel to Machu Picchu in Peru.</p>
							<p class="stronger">EARLY BOOKING DISCOUNTS VALID UNTIL END OF JANUARY</p>
							<a href="GalapagosCruisePlanner.html" class="btn-blue">Select Your Tour</a>
						</div>
					</article>
					<article>
						<img src="img/ribbon-the-legend.png" alt="" class="ribbon"/>
						<h1 class="wribbon">Galapagos Legend</h1>
						<div class="entry clearfix article3"> <a href="galapagos_legend.html"><img src="img/img-ship5.jpg" alt="Galapagos Legend Ship tours to the Galapagos" /></a>
						  <p class="p1">The Legend is offering free upgrades, discounts and complementary hotel rooms for selected dates for this year and the year to come.</p>
							<p class="p2">Select from tours, adventure cruises, eco-tourism, family adventure trips, 
							as well as conference and incentive programs for business and corporate 
							travelers. Travel by air, ship, or train exploring unique civilizations, 
							diverse cultures and the remarkable natural wonder of South America...</p>
							<a href="galapagos_legend.html" class="btn-blue">Read More here</a>
						</div>
					</article>
					<article>
						<h1>View what others have said!</h1>
						<div class="entry clearfix article4">
							<img src="img/video.png" alt="" />
						</div>
					</article>
				</section>
				<aside>
					<div class="box-wrap clearfix">
						<div class="clearfix">
							<h3 class="blue">FAQ</h3>
							<div class="one box clearfix">
								<div><img src="img/passport.png" alt="" /></div>
								<div>
									<h4>Entry Requirements</h4>
									<p>U.S. citizens must carry a valid passport to travel to Machu Picchu or the Galapagos Islands in South America. In general, the passport must be valid for up to...</p>
									<a href="faq.html" class="btn-blue2">Read More</a>
								</div>
							</div>
							<div class="two box clearfix">
								<div><img src="img/thermo.png" alt="" /></div>
								<div>
									<h4>Winter Travel</h4>
									<p>The Galapagos Islands and Machu Picchu in Peru, are a year round destination that offers a great winter getaway on the equator. If you are traveling from a northern city in the winter...</p>
									<a href="faq.html" class="btn-blue2">Read More</a>
								</div>
							</div>
						</div>
						<div class="clearfix">
							<h3 class="blue">Weather&nbsp;Ticker</h3>
							<br><br>
							<div class="item clearfix weather" id="tabcurrent" >
								<div class="tickerbld">
								<div class="temp"><strong>&deg;F&nbsp;</strong></div><div class="tickerbld"><img src="img/fscale1.jpg" alt="" /></div>
								</div>

								<div class="databox" id="weather"></div>
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
						</div>
					</div>
				</aside>
			</div>
		</div>
		
		<footer>
			<div class="wrap">
				<div class="top"></div>
				<div class="boxes clearfix">
					<div>
						<h2>Nav</h2>
						<ul>
							<li><a href="destinations.html">Destination</a></li>
							<li><a href="contact.php">Contact</a></li>
							<li><a href="testimonials.html">Testimonials</a></li>
							<li><a href="GalapagosCruisePlanner.html">Galapagos Island Tours</a></li>
							<li><a href="machu.html">Travel to Machu Picchu</a></li>
							<li><a href="galapagos_photo_gallery.html">Galapagos Photo Gallery</a></li>
							<li><a href="aboutus.html">About</a></li>
							<li><a href="faq.html">FAQ</a></li>
						</ul>
					</div>
					<div>
						<h2>Galapagos <span>Cruise Ships</span></h2>
						<ul>
							<li><a href="#" target="_blank">SilverSeas Explorer</a></li>
							<li><a href="galapagos_legend.html">Galapagos Legend</a></li>
							<li><a href="galaxy.html">Galaxy</a></li>
							<li><a href="santacruz.html" title="Santa Cruz Ship">Santa Cruz II</a></li>
							<li><a href="isabela.html" title="Yacht Isabela II">Isabela II</a></li>
							<li><a href="eclipse.html" title="M/V Eclipse - Galapagos">Eclipse</a></li>
							<li><a href="la_pinta_galapagos.html" title="La Pinta Yacht Galapagos Islands">La Pinta</a></li>
							<li><a href="galapagos-cruise-queenofgalapagos.html" title="Queen of the Galapagos - Luxury Catamaran">Queen of Galapagos</a></li>
							<li><a href="eric-letty-galapagos.html" title="ERIC, LETTY and FLAMINGO - Galapagos Island Cruise">Eric, Letty and Flamingo</a></li>
							<li><a href="sea-star-journey.html" title="Grand Odyssey Ship">Sea Star Journey</a></li>
							<li><a href="coral-profile.html" title="M/Y Coral I and II">Coral I and Coral II</a></li>
							<li><a href="evolution.html" title="M/V Evolution - Seven Night Galapagos Tour with Genovesa Island">Evolution</a></li>
						</ul>
					</div>
					<div>
						<h2>Ecuador</h2>
						<ul>
							<li><a href="travel_ecuador.html" title="Ecuador Travel Packages">Travel to Ecuador-Overview</a></li>
							<li><a href="ecuador_tours.html" title="Ecuador - Land Tours in and Around Quito, Ecuador">Ecuador Land Tours</a></li>
							<li><a href="GalapagosCruisePlanner.html" title="Many of our passengers tell us that a tour in the Galapagos Islands, is the voyage of a lifetime">Galapagos Island Tours</a></li>

							<li><a href="galapagos_diving.html" title="Seven Night Diving Packages for Intermediate and Advanced Divers">Diving in Galapagos Island</a></li>
							<li><a href="ecuador_quito.html" title="Quito City Tour Plus a Visit to the Equatorial Monument">Ecuador - Quito City Tour</a></li>
							<li><a href="ecuador_mindo.html" title="Ecuador - Visit the Mindo Cloudforest with an Overnight at the Arasha Resort">Mindo Cloud Forest and the Arasha Resort</a></li>
							<li><a href="ecuador_otavalo.html" title="Ecuador - Private One and Two Day Tours to the Otavalo Indian Market">Otavalo Indian Market - 1 Day</a></li>
							<li><a href="ecuador_luna_runtun.html" title="Travel to the South of Ecuador for Three or Four Nights at Luna Runtun">Luna Runtun - Adventure Spa</a></li>
						</ul>
					</div>
					<div>
						<h2>Peru</h2>
						<ul>
							<li><a href="machu.html" title="Travel to Machu Picchu in the Peruvian Andes">Travel to Machu Picchu and Cuzco</a></li>
							<li><a href="travel_peru.html" title="The Highlights of Peru with a Vacation to Machu Picchu">Tours in Peru Overview</a></li>
							<li><a href="peru_nazca.html" title="The Nazca Lines Are One of the Wonders of Peru">The Nazca Lines</a></li>
							<li><a href="peru_tour_sacred_valley.html" title="Visit the Amazon Region of Peru on the Way to Machu Picchu">The Scared Valley</a></li>
							<li><a href="peru_amazon_tour.html" title="Peru Tour - Travel to the Amazon Region of Peru">Amazon River Lodges</a></li>
							<li><a href="peru_inca_trail.html" title="Trek Along the Royal Inca Trail Through the Andes to Machu Picchu">Inca Trail to Machu Picchu Tours</a></li>
						</ul>
                        
                        <h2 style="height: 20px;">RELATED LINKS</h2>
						<ul>
							<li><a href="http://www.machupicchutravel.com" title="Travel to Machu Picchu in Peru">Travel to Machu Picchu in Peru</a></li>
                            <li><a href="http://www.traveltourstoindia.com" title="Travel and Tours to India">Travel and Tours to India</a></li>
                            
						</ul>
					</div>

				</div>
				<div class="copy clearfix">
					<div class="clearfix">
						<div>
							<ul class="clearfix">
								<li><a href="http://www.bbb.org/sdoc/business-reviews/travel-agencies-and-bureaus/stanford-travel-systems-in-carlsbad-ca-171987632/#bbbonlineclick"><img src="img/logo-bbb.png" alt="" /></a></li>
								<li><img src="img/logo-american-express.png" alt="" /></li>
								<li><img src="img/logo-mastercard.png" alt="" /></li>
								<li><img src="img/logo-visa.png" alt="" /></li>
							</ul>
						</div>
						<div>
							<ul class="clearfix">
								<li><a href="https://www.facebook.com/pages/Stanford-Travel-Systems/312786045402576?ref=hl" rel="nofollow" class="fb"></a></li>
								<li><a href="http://stanfordtravel.wordpress.com/category/luxury-travel-and-cruises/stanford-travel-system/" class="wp"></a></li>
							</ul>
						</div>
					</div>
					<div class="clearfix">
						<div>Copyright &copy; Stanford Travel Systems Inc.</div>
						<div>Site Design by: <a rel="nofollow" style="text-decoration:none;">APPEAL INTERACTIVE</a></div>
					</div>
				</div>
			</div>
		</footer>
		

		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
		<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.9.1.min.js"><\/script>')</script>
		<script src="js/plugins.js"></script>
		<script src="js/main.js"></script>
		<script src="js/placeholder.js"></script>

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
			  html = '<div id="rsslocation" class="location">'+weather.city+'</div>';
			  html += '<div class="degree">Currently:<span id="rsstitle" class="rsstitle" style="color:'+tcolor+'">'+weather.temp+'&deg; '+weather.units.temp+' </span><div>';
			  html += '<div class="tickerimg link"><img src="images/weather/'+weather.code+'.gif" width="90%"></div>';
			  html += '<div class="current">'+weather.currently+'</div>';
			  html += '<div class="forecast">Forecast:</div>';
			  html += '<div id="rssforecast1" class="tickercnt"><b>'+weather.forecast[1].day+' </b>'+weather.forecast[1].date+'<br>Low:'+weather.forecast[1].low+'&deg; &nbsp; High:'+weather.forecast[1].high+'&deg; <br>'+weather.forecast[1].text+'</div>';
			  html += '<div id="rssforecast2" class="tickercnt"><b>'+weather.forecast[2].day+' </b>'+weather.forecast[2].date+'<br>Low:'+weather.forecast[2].low+'&deg;  &nbsp; High:'+weather.forecast[2].high+'&deg; <br>'+weather.forecast[2].text+'</div>';
			  html += '<div id="rssforecast3" class="tickercnt"><b>'+weather.forecast[3].day+' </b>'+weather.forecast[3].date+'<br>Low:'+weather.forecast[3].low+'&deg;  &nbsp; High:'+weather.forecast[3].high+'&deg; <br>'+weather.forecast[3].text+'</div>';
			  html += '<div id="rssforecast4" class="tickercnt"><b>'+weather.forecast[4].day+' </b>'+weather.forecast[4].date+'<br>Low:'+weather.forecast[4].low+'&deg;  &nbsp; High:'+weather.forecast[4].high+'&deg; <br>'+weather.forecast[4].text+'</div>';
			  html += '<div class="lastdate">Last Updated:<span id="rssdate">'+weather.updated+'</span></div>';
		  } else {
			  html = '<div id="rsslocation" class="location">'+weather.city+'</div>';
			  html += '<div class="degree">Currently:<span id="rsstitle" class="rsstitle">'+weather.alt.temp+'&deg; '+weather.alt.unit+' </span><div>';
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


		<!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
		
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

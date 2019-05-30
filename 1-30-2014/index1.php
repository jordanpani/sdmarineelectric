	<?php
	// WEATHER TICKER HEADER
	if(isset($HTTP_POST_VARS['t']) || isset($HTTP_GET_VARS['t'])){
		$bGP = true;
	} else {
		$bGP = false;
		if(isset($_COOKIE['lt'])){
			list($cLoc, $cTemp) = explode(':',$_COOKIE['lt']);
			if($cTemp=='' || $cLoc=='')
				$bGP = true;
		} else {
			$bGP = true;
		}
	}
	if($bGP){
		if(substr(time(),strlen(time())-1,1) <5){
			$nRand = '0'.rand(1, 7);
		} else {
			$nRand = '5'.rand(1, 8);
		}
		$cTemp = (isset($HTTP_POST_VARS['t']) && $HTTP_POST_VARS['t']!='') ? $HTTP_POST_VARS['t'] : ((isset($HTTP_GET_VARS['t']) && $HTTP_GET_VARS['t']!='') ? $HTTP_GET_VARS['t'] : "F");
		$cLoc = (isset($HTTP_POST_VARS['l']) && $HTTP_POST_VARS['l']!='') ? $HTTP_POST_VARS['l'] : ((isset($HTTP_GET_VARS['l']) && $HTTP_GET_VARS['l']!='') ? $HTTP_GET_VARS['l'] : "Y".$nRand);
		$domain = getDomain();
		$expire = time()+60*60*24*365;
		//setcookie('lt', $cLoc.':'.$cTemp, $expire);
	}
	include_once('lastrss/lastRSS1.php'); 

	$rss = new lastRSS;
	$rss->cache_dir = '';
	$rss->date_format = 'M d, Y g:i:s A';

	$cache_file = 'lastrss/static/rsscache'.$cLoc.$cTemp.'.xml';

	include_once('lastrss/rssxml1.php');

	$aRSS = outputRSS_XML($cLoc.$cTemp, 1800, 1, $cache_file);

	$title = $aRSS['title'] != ' ' ? $aRSS['title']."&deg; ".$cTemp : '   ';
	if($title=="&deg; ".$cTemp)
		$title = '   ';
	$location = $aRSS['location'] != '' ? $aRSS['location'] : '&nbsp;';
	$description = $aRSS['description'] != '' ? $aRSS['description'] : '<br>&nbsp;<br>';
	$pubDate = $aRSS['pubDate'] != '' ? $aRSS['pubDate'] : '<br>&nbsp;<br>&nbsp;<br>';
	$link = $aRSS['link'] != '' ? $aRSS['link'] : 'images/spacer.gif';
	$forecast1 = $aRSS['forecast1'] != '' ? $aRSS['forecast1'] : '<br>&nbsp;<br>&nbsp;<br>';
	$forecast2 = $aRSS['forecast2'] != '' ? $aRSS['forecast2'] : '<br>&nbsp;<br>&nbsp;<br>';
	unset($rss);

	function getDomain() {
	   if ( isset($_SERVER['HTTP_HOST']) ) {
		   $dom = $_SERVER['HTTP_HOST'];
		   if (strtolower(substr($dom, 0, 4)) == 'www.') { $dom = substr($dom, 4); }
		   $uses_port = strpos($dom, ':');
		   if ($uses_port) { $dom = substr($dom, 0, $uses_port); }
		   $dom = '.' . $dom;
	   } else {
		   $dom = false;
	   }
	   return $dom; 
	}
	// WEATHER TICKER HEADER
	?>
	<!DOCTYPE html>
	<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
	<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
	<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
	<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
		<head>
			<meta charset="utf-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
			<title>Machu Picchu Travel</title>
			<meta name="description" content="">
			<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

			<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

			<link rel="stylesheet" href="css/normalize.css">
			<link rel="stylesheet" href="css/main.css">
			<link rel="stylesheet" href="css/styles.css">
			<link rel="stylesheet" href="css/responsive.css">
			<script src="js/vendor/modernizr-2.6.2.min.js"></script>
		</head>
		<body>
			
			<header>
				<div class="wrap">
					<img src="img/logo-machu-picchu.png" alt="Machu Picchu Travel" />
					<p>Luxury and first-class travel to  Machu Picchu and the Amazon  in Peru. Tours through the Amazon and up to machu Picchu</p>
					<div>
						<span>Call Stanford Travel Toll Free</span>
						<span>(877) 213-1688</span>
					</div>
				</div>
			</header>
			<nav>
				<a class="toggleMenu" href="#">
					<span class="line"></span>
					<span class="line"></span>
					<span class="line"></span>
				</a>
				<div class="nav wrap">
					<ul class="clearfix">
						<li><a href="#">Home</a></li>
						<li><a href="tours.php">Tours to Machu Picchu</a></li>
						<li><a href="#">Peruvian Amazon</a></li>
						<li><a href="#">Tours to Lake Titcaca</a></li>
						<li><a href="#">Travel to the Nazca Lines</a></li>
						<li><a href="#">Testimonials</a></li>
						<li><a href="#">FAQ</a></li>
						<li><a href="#">Reservations</a></li>
					</ul>
				</div>
			</nav>
			<div class="flexslider">
				<div class="black-bottom"></div>
				<div class="white-top"></div>
				
				<div class="get-in-touch">
					<h1 class="th1">Get In Touch</h1>
					<form>
						<input type="text" class="txtfld" placeholder="firstname" />
						<input type="text" class="txtfld" placeholder="lastname" />
						<input type="text" class="txtfld" placeholder="phone" />
						<input type="text" class="txtfld" placeholder="email" />
						<textarea class="txtarea" placeholder="comments"></textarea>
						<div class="clearfix">
							<img src="img/captcha.png" alt="" />
							<input type="text" class="txtfld sc" placeholder="security code" />
						</div>
						<div class="clearfix">
							<button class="btn-white re">reset</button>
							<button class="btn-white su">submit</button>
						</div>
					</form>
				</div>
				<ul class="slides">
					<li>
						<h2>Explore Machu Picchu - <span>A Modern Wonder of the World</span></h2>
						<img src="img/image-slide01.png" alt="" />
					</li>
					<li>
						<h2>Explore Machu Picchu - <span>A Modern Wonder of the World</span></h2>
						<img src="img/image-slide01.png" alt="" />
					</li>
					<li>
						<h2>Explore Machu Picchu - <span>A Modern Wonder of the World</span></h2>
						<img src="img/image-slide01.png" alt="" />
					</li>
					<li>
						<h2>Explore Machu Picchu - <span>A Modern Wonder of the World</span></h2>
						<img src="img/image-slide01.png" alt="" />
					</li>
				</ul>
			</div>
			<div id="red-divider">
				<div class="wrap"></div>
			</div>
			<div id="content">
				<div class="tours wrap clearfix">
					<div class="tour">
						<h3>Machu Picchu</h3>
						<img src="img/image-tour1.jpg" alt="" />
						<div class="details">
							3 days/2 nights - daily departures Lima/Cuzco. see more &raquo;
						</div>
					</div>
					<div class="tour">
						<h3>Machu Picchu</h3>
						<img src="img/image-tour1.jpg" alt="" />
						<div class="details">
							3 days/2 nights - daily departures Lima/Cuzco. see more &raquo;
						</div>
					</div>
					<div class="tour">
						<h3>Machu Picchu</h3>
						<img src="img/image-tour1.jpg" alt="" />
						<div class="details">
							3 days/2 nights - daily departures Lima/Cuzco. see more &raquo;
						</div>
					</div>
					<div class="tour">
						<h3>Machu Picchu</h3>
						<img src="img/image-tour1.jpg" alt="" />
						<div class="details">
							3 days/2 nights - daily departures Lima/Cuzco. see more &raquo;
						</div>
					</div>
					<img src="img/title-travel-to.png" alt="" />
				</div>
				<div class="wrap w-sidebar clearfix">
					<div>
						<article>
							<img src="img/badge.png" alt="" />
							<h4 class="th2">Our Special</h4>
							<div class="clearfix">
								<div class="left">
									<div class="photo-small">
										<img src="img/border-small.png" alt="" class="main" />
										<img src="img/image-temp.png" alt="" class="main" />
									</div>
									<h5 class="th3">Come to an Inca Festival</h5>
									<p><strong>Booking discount for tours to Cusco to watch the Festival of the Sun</strong>
									Be one of more than 50.000 spectators that come to this annual celebration
									and see 500 actors, musicians, and dancers reenact the chronicles of Garcilazo de la Vega. Festivities continue throughout the week, with elaborately costumed dancers, street fairs, and free concerts.</p>
								</div>
								<div class="right">
									<div>
										<img src="img/image-star.png" alt="" />
										<img src="img/image-star.png" alt="" />
										<img src="img/image-star.png" alt="" />
										<img src="img/image-star.png" alt="" />
										<img src="img/image-star.png" alt="" />
									</div>
									<p>Jump on the deal that's waiting for you!</p>
									<ul class="clearfix">
										<li><a href="#" class="btn-green">Inquire Now!</a></li>
										<li><a href="#" class="btn-green">Our Tours</a></li>
										<li><a href="#" class="btn-green">Promotions</a></li>
									</ul>
									<div class="btn-maroon">Call Now (866) 930-3480</div>
								</div>
							</div>
						</article>
						<article>
							<h4 class="th4">Your #1 Source For Luxury Travel</h4>
							<ul>
								<li>
								<p>We are your #1 source for luxury travel to Peru and South America, including tours, vacations, family trips and adventure cruises.</p>
									<ul>
										<li>We can also combine luxury and first-class tours to South America from StanfordTravel.com</li>
										<li>For more tours to Peru see <strong>luxury and first-class travel, Peru at StanfordTravel.com</strong></li>
										<li>Or see StanfordTravel.com for <strong>luxury, and first-class travel to South America</strong> and for the <strong>Galapagos vacation packages.</strong></li>
									</ul>
								</li>
							</ul>
							<div class="photo">
								<img src="img/border.png" alt="" />
								<img src="img/image-monkey.jpg" alt="" />
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
										<a href="#" class="btn-green">Read More</a>
									</div>
								</li>
								<li class="clearfix">
									<div><img src="img/image-thermo.png" alt="" /></div>
									<div>
										<h6 class="th6">Winter Travel</h6>
										<p>The Galapagos Islands and Machu Picchu in Peru, are a year round destination that offers a great winter getaway on the equator. If you are travelling from a nothern city in the winter...</p>
										<a  href="#" class="btn-green">Read More</a>
									</div>
								</li>
							</ul>
						</div>
						<form id="frm" name="frm" action="index.php" method="GET" enctype="multipart/form-data" ><input type="hidden" name="t" value="<?=$cTemp?>"><input type="hidden" name="l" value=""></form>
						<div id="tabcurrent" class=" item widget weather clearfix">
							<h5 class="th5">Weather</h5>
							<div class="tickerbld meter">
								<? if($cTemp=="C"){?>
									<div class="temp"><strong>&deg;C&nbsp;</strong><a href="index.php?t=F&amp;l=<?=$cLoc?>" id="atemp" onClick="ChangeT('F')" class="link2"><strong>&nbsp;&deg;F</strong></a></div><div class="tickerbld"><img src="img/image-meter.jpg" alt="" /></div>
									<?} else { ?>
									<div class="temp"><strong>&deg;F&nbsp;</strong><a href="index.php?t=C&amp;l=<?=$cLoc?>" id="atemp" onClick="ChangeT('C')" class="link2"><strong>&nbsp;&deg;C</strong></a></div><div class="tickerbld"><img src="img/image-meter.jpg" alt="" /></div>
								<? } ?>
							</div>
							<div class="data databox">
								<h6 id="rsslocation" class="location"><?=$location?></h6>
								<div class="cur">
									<span>Currently:</span>
									<span id="rssdescription" class="link1 description"><?=$description?></span>
									<span class="tickerimg link"><img id="rssimage" src="img/image-cloud.png" alt="<?=$link?>" /></span>
								</div>
								<h6>Forcast:</h6>
								<div class="forcast">
									<div id="rssforecast1" class="tickercnt">
										<?=html_entity_decode($forecast1)?>
									</div>
									<div id="rssforecast2" class="tickercnt">
										<?=html_entity_decode($forecast2)?>
									</div>
								</div>
								<h6>Last Updated:</h6>
								<div class="lastdate">
									<span id="rssdate"><?=html_entity_decode($pubDate)?></span>
								</div>
								<script type="text/javascript">
									<? if($cTemp=="C"){ ?>
										new rssticker_ajax("<?=$cLoc?>C",1800, "ddbox", "bbcclass", 3500, "date+description", " C")
									<? } else { ?>
										new rssticker_ajax("<?=$cLoc?>F",1800, "ddbox", "bbcclass", 3500, "date+description", " F")
									<? } ?>
									function ChangeT(cVal){
										cLoc = document.getElementById('sloc');
										document.frm.t.value = cVal;
										document.frm.l.value = cLoc.options[cLoc.selectedIndex].value;
										document.frm.submit();
									}
									function ChangeL(){
										cLoc = document.getElementById('sloc');
										document.frm.l.value = cLoc.options[cLoc.selectedIndex].value;
										document.frm.submit();
									}
								</script>
								<select name="sloc" id="sloc" class="textbox1" disabled>
									<optgroup label="Ecuador">
										<option value="Y01" <?=($cLoc=='Y01'? 'selected' : '')?>>Quito</option>
										<option value="Y02" <?=($cLoc=='Y02'? 'selected' : '')?>>Cayambe</option>
										<option value="Y03" <?=($cLoc=='Y03'? 'selected' : '')?>>Cuenca</option>
										<option value="Y04" <?=($cLoc=='Y04'? 'selected' : '')?>>Galapagos Island</option>
										<option value="Y05" <?=($cLoc=='Y05'? 'selected' : '')?>>Guayaquil</option>
										<option value="Y06" <?=($cLoc=='Y06'? 'selected' : '')?>>Loja</option>
										<option value="Y07" <?=($cLoc=='Y07'? 'selected' : '')?>>Manta</option>
									</optgroup>
									<optgroup label="Peru">
										<option value="Y51" <?=($cLoc=='Y51'? 'selected' : '')?>>Lima</option>
										<option value="Y52" <?=($cLoc=='Y52'? 'selected' : '')?>>Chiclayo</option>
										<option value="Y53" <?=($cLoc=='Y53'? 'selected' : '')?>>Cusco</option>
										<option value="Y54" <?=($cLoc=='Y54'? 'selected' : '')?>>Iquitos</option>
										<option value="Y55" <?=($cLoc=='Y55'? 'selected' : '')?>>Nazca</option>
										<option value="Y56" <?=($cLoc=='Y56'? 'selected' : '')?>>Puerto Maldonado</option>
										<option value="Y57" <?=($cLoc=='Y57'? 'selected' : '')?>>Puno</option>
										<option value="Y58" <?=($cLoc=='Y58'? 'selected' : '')?>>Trujillo</option>
									</optgroup>
								</select>
								<script>
									obj = document.getElementById('atemp');
									obj.href="#";
									obj = document.getElementById('sloc');
									obj.disabled=false;
								</script>
							</div>
						</div>
					</aside>
				</div>
			</div>
			<footer>
				<div class="wrap">
					<div class="brown-divider"></div>
					<div class="clearfix three-box">
						<div>
							<img src="img/logo-stanford-travel.png" alt="" />
							<p class="tag">
								"The world's leader in upper-class travel experiences"
							</p>
							<p>
								This site is independently owned and operated by Stanford Travel Systems, Incorporated
								California Seller of Travel Registration # 2065584-40
								Copyright 2002 by Stanford Travel Systems, Incorporated. All Rights Reserved.
							</p>
							<p>Email Please <strong>Use Our Reservation Page</strong></p>
							<p>(877) 213 - 1688 <strong>TOLL FREE</strong></p>
						</div>
						<div>
							<ul>
								<li><a href="#">Home</a></li>
								<li><a href="#">Terms of Use</a></li>
								<li><a href="#">FAQ</a></li>
								<li><a href="#">Testimonials</a></li>
								<li><a href="#">Reservations</a></li>
							</ul>
						</div>
						<div>
							<ul>
								<li><a href="#">Travel to Machu Picchu - Tours</a></li>
								<li><a href="#">Travel to the Nazca - Tours</a></li>
								<li><a href="#">Travel to the Amazon - Tours</a></li>
								<li><a href="#">Travel to Lake Titcaca</a></li>
							</ul>
						</div>
					</div>
					<div class="copy clearfix">
						<div>
							<img src="img/image-cards.png" alt="" />
							<div>Copyright © 2006, Stanford Travel Systems Inc.</div>
						</div>
						<div>
							<a href="#"><img src="img/icon-facebook.png" alt="" /></a>
							<a href="#"><img src="img/icon-twitter.png" alt="" /></a>
							<a href="#"><img src="img/icon-wordpress.png" alt="" /></a>
							<div>Site Design by: <a href="http://www.appealinteractive.com" target="_blank">APPEAL INTERACTIVE</a></div>
						</div>
					</div>
				</div>
			</footer>
			
			<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
			<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.9.1.min.js"><\/script>')</script>
			<script src="js/plugins.js"></script>
			<script src="js/main.js"></script>
		</body>
	</html>

<?php
include_once("php/verytop.php");

$cThisFile = 'reservations.php';

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
?>
	
	<!DOCTYPE html>
	<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
	<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
	<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
	<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
		<head>
			<meta charset="utf-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
			<title>Contact Form for Email and Reservations</title>
			<meta name="description" content="">
			<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

			<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

			<link rel="stylesheet" href="css/normalize.css">
			<link rel="stylesheet" href="css/main.css">
			
<link rel="stylesheet" href="css/styles.css">
<link rel="stylesheet" href="css/responsive.css">
			<script src="js/vendor/modernizr-2.6.2.min.js"></script>
            <script type="text/javascript" src="/js/ganalytics.js"></script>
		</head>
		<body class="tours-page">
			
			<header>
				<div class="wrap">
					<img src="img/logo-machu-picchu.png" alt="Machu Picchu Travel" />
					<p>Luxury and first-class travel to  Machu Picchu and the Amazon  in Peru. Tours 
					through the Amazon and up to machu Picchu</p>
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
<!-- #EndLibraryItem --><div id="red-divider">
				<div class="wrap"></div>
			</div>
			<div id="content">
				<div class="wrap">
				  <article class="cuzco clearfix">
						<div></div>
						<h2 class="th7">CONTACT US </h2>
					<div class="left" style="width:100%;">
                    
		
		
        <table width="100%" border="0" cellpadding="3" cellspacing="1" style="background-color: #ded9bd">
        <tr><td>
        <h3 class="th8">RESERVATIONS &amp; CONTACT FORM</h3>
        </td></tr>
                  <tr>
                    <td  class="content">
                      
                      <p> 
                       <strong>Email:</strong> 

                      <strong>Please Use This Contact Form </strong><br>
                      <br>
                      <span ><strong  >Contact &amp; Literature Request Form</strong><br>
Please fill out the appropriate literature request and contact form from below for courteous and prompt handling by one of our customer care specialists.</span><br>      
                    </p>
                    <div style="font-family:Verdana, Geneva, Tahoma, sans-serif; font-size: 12px; color: black;
">
<?php
$nFrm = 2;
$e = isset($_POST['e']) ? $_POST['e'] : (isset($_GET['e']) ? $_GET['e'] : $nFrm );
if(isset($_GET['s']) && $_GET['s']==1 && $e==$nFrm)
$msg[$nFrm] = "<span style='color:#0000FF'><br>Thank you!<br>Your information has been submitted.<br><br></span>";
if(isset($_GET['s']) && $_GET['s']==0 && $e==$nFrm)
$msg[$nFrm] = "<span style='color:#DD0000'><br>Error processing contact form!<br><br><br></span>";
//	$msg[$nFrm] = "<span class='usererr".$nFrm."'>Error processing contact form!</span>";

$bEmail[$nFrm] = false;
$bTAEmail[$nFrm] = false;
$name = '';
$email = '';
$dayphone = '';
$evphone = '';
$fax = '';
$comments = '';

$TA_name = '';
$TA_email = '';
$TA_dayphone = '';
$TA_evphone = '';
$TA_fax = '';
$TA_comments = '';

$k = isset($_POST['k']) ? $_POST['k'] : (isset($_GET['k']) ? $_GET['k'] : '' );
if($k!='' && $e==$nFrm){
	include_once('php/cookie.php');
	$kpin = substr($k,8);
	sess_start("temp/",$kpin);
	sess_close();
	
	if(strlen($cErr)>1)
		$msg[$nFrm] = "<span style='color:#DD0000'><br>".$cErr."<br><br></span>";
	else
		$msg[$nFrm] = "<span style='color:#DD0000'><br>You have errors! Please review your form and send it again.<br><br></span>";
	
	if($email=='' && $TA_email=='')
		$bEmail[$nFrm] = true;
	else if($email!='' && !validEmail(trim(urldecode($email))))
		$bEmail[$nFrm] = true;
	else if($TA_email!='' && !validEmail(trim(urldecode($TA_email))))
		$bTAEmail[$nFrm] = true;

	$bSec1 = true;
	$bSec2 = false;
	if($name=='' && $email=='' && ($TA_name!='' || $TA_email!='')){
		$bSec1 = false;
		$bSec2 = true;
	}

}

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

<form name="frm<?=$nFrm?>" id="contact" action="<?=$cThisFile?>" method="post" onSubmit="return checkForm(this,fieldRequired<?=$nFrm?>,selFld<?=$nFrm?>)"> 
<input type="hidden" name="r" value="<?=$cAuth.$cTFile?>" />
<input type="hidden" name="f" value="<?=$cThisFile?>">
<input type="hidden" name="e" value="<?=$nFrm?>">

                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td>

						<table cellspacing="1" cellpadding="4" border="0" width="100%">
                  <tbody>
                    <tr>
                    <td  width="50%" style="padding-left:25px;">Address: <br>
                      800 Grand Ave, Suite AG-4, <br>
                      Carlsbad, California, 92008 <br>
                      <br>
                      Toll Free: 877.213.1688 <br>
                      Tel: 760.230.0670 <br>
                      Fax: 760.942.0351 <br>
                      <br>
              </td>
                    <td   width="50%" valign="top"  >

                      <p><strong><br>Contact Us About a Packaged Tour <br> </strong><br>
                        If you are a consumer interested in learning more about
                          the services we offer, please submit one of the two
                          forms below.</p></td>
                  </tr>
                  <tr  >
                    <td height="3" colspan="2"><img height="3" width="1" src="images/spacer.gif"><hr style="height: 3"></td>
                    </tr>
                </tbody></table>
			
                      <table  border="0" cellpadding="3" cellspacing="1"   style="margin: 24px">
<?php
if($msg[$nFrm]!=''){
?>
						<tr>
							<td></td>
							<td><?=$msg[$nFrm]?></td>
						</tr>
<?php
}
?>
                        <tr >
                          <td   style="height: 20px; text-align: left; width: 24%;" id="lname">Full Name:</td>
                          <td width="60%"     style="height: 20px; text-align: left;">
							  <input type="text" id="name" style="width: 247px;" name="name" value="<?=urldecode($name)?>" onBlur="if(this.value!='') document.getElementById('lname').style.color='#000000'" />
                          </td>
                        </tr>
                        <tr>
                          <td height="20" style="text-align: left; width: 24%;" id="lemail">Email:</td>
                          <td style="text-align: left"    >
							  <input type="text" id="email" style="width: 244px; <?=($email=='' && $k!='' && $e==$nFrm) || ($bEmail[$nFrm] && $k!='' && $e==$nFrm)?'color:#FF0000':''?>" name="email" value="<?=urldecode($email)?>" onBlur="if(this.value!='') document.getElementById('lemail').style.color='#000000'" />
                          </td>
                        </tr>
                        <tr  >
                          <td height="20" style="text-align: left; width: 24%"  >Day Phone:</td>
                          <td style="text-align: left"><span  >
                            <input name="dayphone" type="text" id="dayphone" value="<?=$dayphone?>">
                          </span></td>
                        </tr>
                        <tr  >
                          <td height="20" style="text-align: left; width: 24%"    >Evening
                            Phone:</td>
                          <td style="text-align: left"><span  >
                            <input name="evphone" type="text" id="evphone" value="<?=$evphone?>">
                          </span></td>
                        </tr>
                        <tr  >
                          <td height="20" style="text-align: left; width: 24%"  >Fax:</td>
                          <td style="text-align: left"><span  >
                            <input name="fax" type="text" id="fax" value="<?=$fax?>">
                          </span></td>
                        </tr>
                        <tr  >
                          <td height="20" style="text-align: left; width: 24%"    >Questions
                            / Comments:</td>
                          <td style="text-align: left"><span  >
                            <textarea rows="5" name="comments" id="comments" style="width: 490px"><?=urldecode($comments)?></textarea>
                          </span></td>
                        </tr>
                        <tr  >
                          <td height="3" colspan="2" style="text-align: left"><img src="images/spacer.gif" width="1" height="3"></td>
                        </tr>
                      </table></td>
                  </tr>
				  <tr><td>

					<table width="100%" cellspacing="1" cellpadding="4" border="0">
                  		<tbody>
		                    <tr>
        				      <td><strong>TRAVEL AGENT ONLY:</strong></td>
		                    </tr>
		                </tbody>
					</table>

                      <table  border="0" cellpadding="3" cellspacing="1"   style="margin: 24px">
                        <tr  >
                          <td height="20" style="width: 24%; text-align: left;" id="lTA_name" >Full Name:</td>
                          <td width="60%" style="text-align: left"    >
							  <input name="TA_name" type="text" id="TA_name" style="width: 247px;" onBlur="if(this.value!='') document.getElementById('lTA_name').style.color='#000000'" />
                          </td>
                        </tr>
                        <tr>
                          <td height="20" style="width: 24%; text-align: left;" id="lTA_email" >Email:</td>
                          <td style="text-align: left"    >
							  <input name="TA_email" type="text" id="TA_email" style="width: 244px; <?=($TA_email=='' && $k!='' && $e==$nFrm) || ($bTAEmail[$nFrm] && $k!='' && $e==$nFrm)?'color:#FF0000':''?>" value="<?=urldecode($TA_email)?>" onBlur="if(this.value!='') document.getElementById('lTA_email').style.color='#000000'" />
                          </td>
                        </tr>
                        <tr  >
                          <td height="20" style="width: 24%; text-align: left"  >Day Phone:</td>
                          <td style="text-align: left"><span  >
                            <input name="TA_dayphone" type="text" id="TA_dayphone" value="<?=$TA_dayphone?>">
                          </span></td>
                        </tr>
                        <tr  >
                          <td     style="height: 20px; width: 24%; text-align: left;">Evening
                            Phone:</td>
                          <td style="height: 20px; text-align: left;"><span  >
                            <input name="TA_evphone" type="text" id="TA_evphone" value="<?=$TA_evphone?>">
                          </span></td>
                        </tr>
                        <tr  >
                          <td height="20" style="width: 24%; text-align: left"  >Fax:</td>
                          <td style="text-align: left"><span  >
                            <input name="TA_fax" type="text" id="TA_fax" value="<?=$TA_fax?>">
                          </span></td>
                        </tr>
                        <tr  >
                          <td height="20" style="width: 24%; text-align: left"    >Questions
                            / Comments:</td>
                          <td style="text-align: left"><span  >
                            <textarea rows="5" name="TA_comments" id="TA_comments" style="width: 490px"><?=urldecode($TA_comments)?></textarea>
                          </span></td>
                        </tr>
                        <tr  >
                          <td height="20" style="width: 24%; text-align: left"    >&nbsp;
							  </td>
                          <td style="text-align: left; <?=$k!='' && $e==$nFrm?'color:#FF0000':''?>"><br><br>
                          To show you're human, please enter the 
							  code you see below:<br>
							  <br>



						<table width="100%" cellpadding="0" cellspacing="0" align="center">
							<tr> 
							  <td align="right" nowrap height="58px" width="225px">
								  <font id="captcha<?=$nFrm?>"><img src="images/image.php?size=6&sess=<?=$pinCode?>&b=<?=$nFrm?>&r=<?=$cAuth.$cTFile?>"></font></td>
							  <td>&nbsp;  </td>
							  <td><a onClick="reLoad<?=$nFrm?>('<?=$pinCode?>','<?=$nFrm?>')" href="javascript: void(0)"><img title="Get a new Security Code" src="images/reload.png"></a></td>
							  <td>&nbsp;  </td>
							  <td  ><br><?=$vImage->showCodBox(1); ?><font class="TXTblack11treb"><br />(code is Case-Sensitive)</font></td>
							</tr>
						</table>
						
						
                    		</td>
                        </tr>
                        <tr  >
                          <td height="3" colspan="2" style="text-align: left"><img src="images/spacer.gif" width="1" height="3"></td>
                        </tr>
                      </table>
                      
                      </td></tr>
                  <tr>
                    <td align="center"  ></td>
                  </tr>
                  <tr>
                    <td align="center">&nbsp;



						</td>
                  </tr>
                  <tr>
                    <td><div align="center">
						<div style="display:none">
						<input type="text" name="fee" value="">
						</div>
                      <br>
						CLICK THIS BUTTON TO SEND REQUEST 
						<input type="submit" name="Submit" value="Request Information">
						</div>
						
						
						<div style="font-size:10px;">
                    	<br>Privacy Policy: We do not have mailing lists 
						and your information will not be transferred or sold, 
						and will only be used to service your request.&nbsp; 
						</div>


						</td>
                  </tr>
                </table>
<input type="hidden" name="form_avar" value="vImageCodP">
<input type="hidden" name="form_amsg" value="'Your Security Code'">
<input type="hidden" name="form_aval" value="''">
<input type="hidden" name="form_aftp" value="'G'">
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
document.getElementById('captcha'+b).innerHTML = '<img src="images/spacer.gif">';
var rnr=Math.floor(Math.random()*1001)
str = "sess="+sess+"&b="+b+"&n="+rnr;
document.getElementById('captcha'+b).innerHTML = '<img src="images/image.php?size=3&'+str+'&b=<?=$nFrm?>&r=<?=$cAuth.$cTFile?>">';
}

function checkForm(obj,fieldRequired<?=$nFrm?>,selFld<?=$nFrm?>){
	if(document.getElementById('name').value=='' && document.getElementById('email').value=='' && document.getElementById('TA_name').value=='' && document.getElementById('TA_email').value==''){
		document.getElementById('name').focus();
		alert('Please complete the Full Name and the Email address!');
		return false;
	}
	if(document.getElementById('name').value!='' && document.getElementById('email').value=='' && document.getElementById('TA_name').value=='' && document.getElementById('TA_email').value==''){
		document.getElementById('lemail').style.color = '#FF0000';
		document.getElementById('email').focus();
		alert('Please complete the Email address!');
		return false;
	}
	if(document.getElementById('name').value=='' && document.getElementById('email').value!='' && document.getElementById('TA_name').value=='' && document.getElementById('TA_email').value==''){
		document.getElementById('name').style.color = '#FF0000';
		document.getElementById('name').focus();
		alert('Please complete the Full address!');
		return false;
	}
	if(document.getElementById('name').value=='' && document.getElementById('email').value=='' && document.getElementById('TA_name').value!='' && document.getElementById('TA_email').value==''){
		document.getElementById('TA_email').style.color = '#FF0000';
		document.getElementById('TA_email').focus();
		alert('Please complete the Email address!');
		return false;
	}
	if(document.getElementById('name').value=='' && document.getElementById('email').value=='' && document.getElementById('TA_name').value=='' && document.getElementById('TA_email').value!=''){
		document.getElementById('TA_name').style.color = '#FF0000';
		document.getElementById('TA_name').focus();
		alert('Please complete the Full address!');
		return false;
	}
	return formCheck(obj,fieldRequired<?=$nFrm?>,selFld<?=$nFrm?>);
}
-->
</script>
</div>
                    </td>
                  </tr>
                  
          <tr>
                    <td height="3" style="background-color: #e3dec0"><img src="images/spacer.gif" width="1" height="3"></td>
          </tr>
                </table>	
					</div>
					</article>
				</div><!-- #BeginLibraryItem "/Library/ToursCascade.lbi" --><div class="tours wrap clearfix">
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
				</div><!-- #EndLibraryItem --></div><!-- #BeginLibraryItem "/Library/page_footer.lbi" --><footer> 
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
		</body>
	</html>

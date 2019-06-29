<?php
global $cookieName, $cookiePath, $deleteCookiesOnSuccess;
global $email_to, $email_subject, $antispam_answer, $antispam_question, $phone_number;

$email_to = "email@sdmarineelectric.com"; // your email address
$email_subject = "Contact Form SDME"; // email subject line
//$GLOBALS['thankyou'] = "thankyou.htm"; // thank you page (currently not used 6-2-2019)

// if you update the question on the form -
// you need to update the questions answer below
$antispam_answer = "25";

$antispam_question = "Using only numbers, what is 5 x 5 ?";

/*$antispam_questions = array(
    array("Using only numbers, what is 5 x 5 ?", "25"),
    array("", "")
    );
*/
$phone_number = "(619) 745-5393";


$cookieName = "CONTACT_FORMS";
$cookiePath = "/"; //the cookie will be available within the entire domain
$deleteCookiesOnSuccess = true;
?>
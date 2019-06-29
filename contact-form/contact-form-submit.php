
<?php
    //use this at the top of every php page
    include_once( $_SERVER['DOCUMENT_ROOT'] . "/header.php" );
   
//included file contains form settings
\Header\RequireFromRoot("contact-form/contact-settings.php");

//SAVE THE POSTED VARIABLES TO THE BROWSER AS COOKIES
//THIS MUST BE CALLED BEFORE HEADER GETS SENT. THIS MEANS BEFORE ANY HTML IS SENT OUT TO THE BROWSER.
//SO PLEASE DONT ECHO ANYTHING YET, BECAUSE IT MIGHT CAUSE THE HEADER TO BE SENT
$timeToExpire =  time()+60*60*24*30; //will set the cookie to expire in 30 days.
foreach($_POST as $key => $value)
{
    $cookieNameIndexed = $cookieName . "[$key]";
    //echo "setting cookie: $cookieNameIndexed = $value" . $nl;
    //echo "Value type is " . gettype($value) . $nl;
    setcookie($cookieNameIndexed, $value, $timeToExpire, $cookiePath);
}
//DONE MODIFYING HEADER. YOU CAN NOW SEND HTML.

function IncludeInHead() {
    ?>
    <script src="/contact-form/contact-form-validation.js"></script>
	<script>
    required.add('Full_Name','NOT_EMPTY','Full Name');
	required.add('Email_Address','EMAIL','Email Address');
	required.add('Your_Message','NOT_EMPTY','Your Message');
	required.add('AntiSpam','NOT_EMPTY','Anti-Spam Question');
	</script>
    <link rel="stylesheet" href="/contact-form/contact-form.css">
	<?php
}

function IncludeContent()
{
global $antispam_question, $antispam_answer;
global $email_to, $email_subject;
global $phone_number;
global $cookieName, $cookiePath;
global $deleteCookiesOnSuccess;

$nl = "\r\n<br />";
    if ($_SERVER["HTTP_HOST"]=="localhost") {
        //testing environment
        ECHO "TESTING ENVIRONMENT: localhost$nl";
        echo "    page file script name: " . $_SERVER["REQUEST_URI"] . $nl;
    } else {
        //production environments
    }

    function died($error) {
        echo "<div class='Errors_In_Post_Vars'>";
        echo "Sorry, but there were error(s) found with the form you submitted. ";
        echo "These errors appear below:<br /><br />";
        echo $error."<br /><br />";
        echo "Please browser back button to go back and fix these errors.<br /><br />";
        echo "</div>";
        die();
    }

    if (!isset($_POST['submit'])) {

        died("Form was not yet submitted. ");

    } else {
        if ($_SERVER["HTTP_HOST"]=="localhost") {
            //testing environment
            echo "    Form was posted with the following \$_POST variable(s):...$nl";
            print_r($_POST);
        } else {
            //production environments
        }

        //CHECK ALL THE EXPECTED POSTED VARIABLES ARE HERE
        if(!isset($_POST['Full_Name']) ||
            !isset($_POST['Email_Address']) ||
            !isset($_POST['Telephone_Number']) ||
            !isset($_POST['Your_Message']) ||
            !isset($_POST['AntiSpam'])
        ) {
            died('Sorry, there appears to be a problem with your form submission.');
        }

        $full_name = $_POST['Full_Name']; // required
        $email_from = $_POST['Email_Address']; // required
        $telephone = $_POST['Telephone_Number']; // not required
        $comments = $_POST['Your_Message']; // required
        $antispam = $_POST['AntiSpam']; // required

        $error_message = "";

        $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
        if(preg_match($email_exp,$email_from)==0) {
            $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
        }
        if(strlen($full_name) < 1) {
            $error_message .= 'Your Name does not appear to be valid.<br />';
        }
        if(strlen($comments) < 0) {
            $error_message .= 'The Comments you entered do not appear to be valid.<br />';
        }

        if($antispam <> $antispam_answer) {
            $error_message .= 'The Anti-Spam answer you entered is not correct.<br />';
        }

        if(strlen($error_message) > 0) {
            died($error_message);
        }
        $email_message = "Form details below.\r\n";

        function clean_string($string) {
            $bad = array("content-type","bcc:","to:","cc:");
            return str_replace($bad,"",$string);
        }

        $email_message .= "Full Name: ".clean_string($full_name)."\r\n";
        $email_message .= "Email: ".clean_string($email_from)."\r\n";
        $email_message .= "Telephone: ".clean_string($telephone)."\r\n";
        $email_message .= "Message: ".clean_string($comments)."\r\n";


        // create email headers
        /*$headers = 'From: '.$email_from."\r\n".
            .S
            'X-Mailer: PHP/' . phpversion();
        */
        $headers = "MIME-VERSION: 1.0\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8\r\n";
        //$headers .= 'Reply-To: '.$email_from."\r\n";
        $headers .= "From: $email_from\r\n";

        // EDIT THE 2 LINES BELOW AS REQUIRED


        $result = mail($email_to, $email_subject, $email_message, $headers);



        if ($result || $_SERVER["HTTP_HOST"]=="localhost"){

            if ($deleteCookiesOnSuccess) {
                if ($_SERVER["HTTP_HOST"] == "localhost") {
                    echo "Message will never be sent on localhost. So simulating it is sent..." . $nl;
                }
                ?>
                <div class="message-result">
                    Message successfully sent. Thank you for contacting us. We will be in touch with you very soon.<br>
                </div>

                <script type="text/javascript">
                    <?php
                    //Create a javascript from php, and insert it straight into the body, to be loaded any time after the page is loaded.
                    //requires jquery. Delete a cookie
                    echo "//the following javascript lines requires jquery\r\n";

                    if (isset($_COOKIE[$cookieName])) {
                        foreach ($_COOKIE[$cookieName] as $name => $value) {
                            $cookieNameStr = "$cookieName" . "[$name]";
                            //assumes this function is defined elsewhere (currently in every-page.js, but this may change)
                            echo "delete_cookie('$cookieNameStr', '$cookiePath');\r\n";
                        }
                    }
                    ?>
                </script>
                <?php
            } else {
                echo "Warning: deleteCookiesOnSuccess = $deleteCookiesOnSuccess. You request cookies will not be deleted. This is good for debugging though." . $nl;
            }
            //echo "sent message to $email_to";
            //echo "message: $email_message";
            //echo "email_subject: $email_subject";
            //echo "headers: $headers";
        } else {
            ?>
            <div class="message-failed-result">
                Failed to send email. Please call us at <?= $phone_number ?>
            </div>


            <?php
        }

    }  //end check for form post
} //end function

\Header\RequireFromRoot ("index-template.php");
?>

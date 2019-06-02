
<?php

function died($error)
{
    // your error code can go here
    echo "We are very sorry, but there were error(s) found with the form you submitted. ";
    echo "These errors appear below.<br /><br />";
    echo $error . "<br /><br />";
    echo "Please go back and fix these errors.<br /><br />";
    die();
}

function clean_string($string)
{
    $bad = array("content-type", "bcc:", "to:", "cc:", "href");
    return str_replace($bad, "", $string);
}


function IncludeContent()
{

$nl = "\r\n<br>";
    if ($_SERVER["HTTP_HOST"]=="localhost") {
        //testing environment
        ECHO "TESTING ENVIRONMENT: localhost$nl";
        echo "page file script name: " . $_SERVER["REQUEST_URI"] . $nl;
    } else {
        //production environments
    }

    if (!isset($_POST['submit'])) {
        //form was not yet submitted. Present form
        ?>
        <div>
            <form name="contactform" method="post" action="<?=$_SERVER["REQUEST_URI"] ?>">
                <label for="first_name">First Name *</label>
                <input type="text" name="first_name" maxlength="60" size="60">
                <br>
                <label for="last_name">Last Name*</label>
                <input type="text" name="last_name" maxlength="60" size="60">
                <br>
                <label for="email">Email Address *</label>
                <input type="text" name="email" maxlength="80" size="80">
                <br>
                <label for="telephone">Telephone Number</label>
                <input type="text" name="telephone" maxlength="30" size="30">
                <br>
                <label for="message">Message *</label>
                <br>
                <textarea name="message" maxlength="1000" cols="25" rows="6"></textarea>
                <br>
                <input type="submit" name="submit" value="submit">
                <br>
            </form>


        </div>
        <?php
    } else {
        echo "form submitted...";
        print_r($_POST);


        // validation expected data exists
        if (!isset($_POST['first_name']) ||
            !isset($_POST['last_name']) ||
            !isset($_POST['email']) ||
            !isset($_POST['telephone']) ||
            !isset($_POST['message'])) {
            died('We are sorry, but there appears to be a problem with the form you submitted.');
        }


        $first_name = $_POST['first_name']; // required
        $last_name = $_POST['last_name']; // required
        $email_from = $_POST['email']; // required
        $telephone = $_POST['telephone']; // not required
        $message = $_POST['message']; // required

        $error_message = "";
        $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

        if (!preg_match($email_exp, $email_from)) {
            $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
        }

        $string_exp = "/^[A-Za-z .'-]+$/";

        if (!preg_match($string_exp, $first_name)) {
            $error_message .= 'The First Name you entered does not appear to be valid.<br />';
        }

        if (!preg_match($string_exp, $last_name)) {
            $error_message .= 'The Last Name you entered does not appear to be valid.<br />';
        }

        if (strlen($message) < 0) {
            $error_message .= 'The message you entered do not appear to be valid.<br />';
        }

        if (strlen($error_message) > 0) {
            died($error_message);
        }

        $email_message = "Form details below.\n\n";




        $email_message .= "First Name: " . clean_string($first_name) . "\n";
        $email_message .= "Last Name: " . clean_string($last_name) . "\n";
        $email_message .= "Email: " . clean_string($email_from) . "\n";
        $email_message .= "Telephone: " . clean_string($telephone) . "\n";
        $email_message .= "Message: " . clean_string($message) . "\n";

        // create email headers
        /*$headers = 'From: '.$email_from."\r\n".
            .
            'X-Mailer: PHP/' . phpversion();
        */
        $headers = "MIME-VERSION: 1.0\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8\r\n";
        //$headers .= 'Reply-To: '.$email_from."\r\n";
        $headers .= "From: $email_from\r\n";

        // EDIT THE 2 LINES BELOW AS REQUIRED
        $email_to = "email@sdmarineelectric.com";
        $email_subject = "Contact Form - SDME";

        $result = mail($email_to, $email_subject, $email_message, $headers);

        if ($result) {
            echo "Thank you for contacting us. We will be in touch with you very soon.";
        } else {
            echo "Failed to send email. Please call us.";
        }

    }  //end check for form post
} //end function

include "index-template.php";
?>


<?php

include_once( $_SERVER['DOCUMENT_ROOT'] . "/header.php" );
//included file contains form settings
\Header\RequireFromRoot("contact-form/contact-settings.php");


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

function get_cookie_value($field_name) {
    //gets the value of a cookie that is ready for displaying in html
    global $cookieName;
    if (isset($_COOKIE[$cookieName])) {
        if (isset($_COOKIE[$cookieName][$field_name])) {
            return htmlspecialchars($_COOKIE[$cookieName][$field_name]);
         } else {
            return "";
        }
    } else {
        return "";
    }
}

function IncludeContent()
{
    global $antispam_question;
    global $cookieName;

    $nl = "\r\n<br />";

    if ($_SERVER["HTTP_HOST"]=="localhost") {
        //testing environment
        ECHO "TESTING ENVIRONMENT: localhost$nl";
        echo "  page file script name: " . $_SERVER["REQUEST_URI"] . $nl;
    } else {
        //production environments
    }


    // after the page reloads, print them out
    //echo "Read Cookies: <br />\r\n";
    if (isset($_COOKIE[$cookieName])) {
        
        foreach ($_COOKIE[$cookieName] as $name => $value) {
            $name = htmlspecialchars($name);
            $value = htmlspecialchars($value);
            if ($_SERVER["HTTP_HOST"]=="localhost") {
                //if there are cookies print them out
                echo "$name : $value <br />\n";
            }
            //otherwise read them and store them in memory
            $CONTACT_FORMS_COOKIE[$name] = $value;
        }
    } else { 
            echo "No Cookie Named \$_COOKIE[$cookieName] found";
    }


        ?>
        <form name="contactform" method="post" action="/contact-form/contact-form-submit.php" onsubmit="return validate.check(this)">
                <table class="contactform">
                    <tr>
                        <td colspan="2">

                            <div class="contactformheader">Contact Us Form</div>

                            <div class="contactformmessage">Fields marked with <span class="required_star"> * </span> are mandatory.</div>

                        </td>
                    </tr>
                    <tr>
                        <td valign="top">
                            <label for="Full_Name" class="required">Full Name<span class="required_star"> * </span></label>
                        </td>
                        <td valign="top">
                            <input value="<?=get_cookie_value('Full_Name'); ?>" type="text" name="Full_Name" id="Full_Name" maxlength="80" style="width:230px" >
                        </td>
                    </tr>
                    <tr>
                        <td valign="top">
                            <label for="Email_Address" class="required">Email Address<span class="required_star"> * </span></label>
                        </td>
                        <td valign="top">
                            <input  value="<?=get_cookie_value('Email_Address'); ?>" type="text" name="Email_Address" id="Email_Address" maxlength="100" style="width:230px">
                        </td>
                    </tr>
                    <tr>
                        <td valign="top">
                            <label for="Telephone_Number" class="not-required">Telephone Number</label>
                        </td>
                        <td valign="top">
                            <input type="text"  value="<?=get_cookie_value('Telephone_Number'); ?>" name="Telephone_Number" id="Telephone_Number" maxlength="100" style="width:230px">
                        </td>
                    </tr>
                    <tr>
                        <td valign="top">
                            <label for="Your_Message" class="required">Your Message<span class="required_star"> * </span></label>
                        </td>
                        <td valign="top">
                            <!--a "value" of a textarea goes inside html tag, not in the value property, unlike the input tag-->
                            <textarea style="width:230px;height:160px" name="Your_Message" id="Your_Message" maxlength="2000"><?=get_cookie_value('Your_Message'); ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align:center" >
                            <div class="antispammessage">
                                To help prevent automated spam, please answer this question
                                <br /><br />
                                <div class="antispamquestion">
                                    <span class="required_star"> * </span>
                                    <?= $antispam_question ?>

                                    <input type="text" name="AntiSpam" id="AntiSpam" maxlength="100" style="width:30px">
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align:center" >
                            <br /><br />
                            <!--ADDED NAME PROPERTY BY JP-->
                            <input type="submit" name="submit" value=" Submit Form " style="width:200px;height:40px">
                            <br /><br />
                        </td>
                    </tr>
                </table>
            </form>

<?php

} //end function

 \Header\RequireFromRoot("index-template.php");
?>

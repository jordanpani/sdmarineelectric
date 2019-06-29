<?php
    //use this at the top of every php page
   include_once( $_SERVER['DOCUMENT_ROOT'] . "/header.php" );
   
function IncludeInHead() {
    ?>
    <script>
    </script>
    <style type="text/css">
        .bullets li {
            margin: 10px;
        }
    </style>
    <?php
}
function IncludeContent() {
?>
<div>


    <h1 style="text-align: center; ">WHY SHOULD YOU CHOOSE US?</h1>
    <div class="row">
        <img class="col-4" style="margin: auto; padding: 30px; " src="/images-new/ABYC-medium.png" >
        <ul class="bullets col-6">
            <li>Do not use a land electrician who is who is not familiar with working with safe and proper practices of the marine environment. We have experience doing electrical in marine environments.</li>
            <li>We are qualified to provide installations and repairs that meet the strict safety standards and practices of the American Boat and Yacht Council.</li>
            <li>We are certified and insured.</li>
            <li>We can diagnose and attempt to repair many problems with your existing electrical system.</li>
            <li>If we find your electrical or electronics needs replacement, or if you desire new equipment, we can install it for you.</li>
            <li>We are mobile and will come to you.</li>
            <li>We can provide free estimates, and for a limited time we are offering 50% discounts on labor.</li>
        </ul>
    </div>

</h1>
<?php
}

\Header\RequireFromRoot ("index-template.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!--<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">-->
    <title>San Diego Marine Electric</title>
    <meta name="description" content="San Diego Marine Electric">
    <meta name="keywords" content="San Diego Marine Electric">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * {
            box-sizing: border-box;
        }

        .row::after {
            content: "";
            clear: both;
            display: block;
        }

        [class*="col-"] {
            float: left;
            padding: 15px;
        }

        html {
            font-family: "Lucida Sans", sans-serif;
        }

        .header {
            background-color: #9933cc;
            color: #ffffff;
            padding: 15px;
        }


        .menu ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        .menu li {
            padding: 8px;
            margin-bottom: 7px;
            background-color: #33b5e5;
            color: #ffffff;
            box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
        }

        .menu li:hover {
            background-color: #0099cc;
        }


        .aside {
            background-color: #33b5e5;
            padding: 15px;
            color: #ffffff;
            text-align: center;
            font-size: 14px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
        }

        .footer {
            background-color: #0099cc;
            color: #ffffff;
            text-align: center;
            font-size: 12px;
            padding: 15px;
        }

        /* For desktop: */
        .col-1 {width: 8.33%;}
        .col-2 {width: 16.66%;}
        .col-3 {width: 25%;}
        .col-4 {width: 33.33%;}
        .col-5 {width: 41.66%;}
        .col-6 {width: 50%;}
        .col-7 {width: 58.33%;}
        .col-8 {width: 66.66%;}
        .col-9 {width: 75%;}
        .col-10 {width: 83.33%;}
        .col-11 {width: 91.66%;}
        .col-12 {width: 100%;}

        @media only screen and (max-width: 768px) {
            /* For mobile phones: */
            [class*="col-"] {
                width: 100%;
            }
        }
    </style>
    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

    <?php
    /*
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/main.css">

    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/responsive.css">
    */
    ?>

    <link rel="stylesheet" href="css/home-page.css">

    <?php
    /*
    <script src="js/vendor/modernizr-2.6.2.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script src="js/main.js"></script>
        <script src="js/plugins.js"></script>


    <script type="text/javascript" src="/js/ganalytics.js"></script>
    */
    ?>
    <!-- jQuery -->
    <script src="http://code.jquery.com/jquery-latest.min.js"></script>


    <!--FOR MENU-->


    <script src="https://s3.amazonaws.com/menumaker/menumaker.min.js" type="text/javascript"></script>
    <script src="menu-main/script.js"></script>
    <!-- Icon Library -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="menu-main/styles.css"
    <!--END FOR MENU:-->


</head>
<body>

<header>
    <div class="wrap">
        <img src="images-new/logo-home-header.gif" alt="Machu Picchu Travel" />
        <p>Marine Electricians Serving the San Diego Area</p>
        <div>
            <span style="display: block">Call Toll Free</span>
            <span>(619) 745-5393</span>
        </div>
    </div>
</header>



<!-- #EndLibraryItem -->





<div id="content" style="    background-color: #ebe9d5;
    background-image: url('/img/bg-header.jpg');
    background-repeat: repeat;
    background-position: top left;
    height: 135px;">
    <div style="width: 100%; background-color: #42a6bd; height: 52px; z-index: 1; position:relative">

        <div style="left: 50%;position:absolute;top: 0px;width: 1000px;margin: 0 0 0 -500px">
            <nav id="menu" >
                <div id="cssmenu" >
                    <ul>
                        <li class="active"><a href="#"><i class="fa fa-fw fa-home"></i> Home</a></li>
                        <li><a href="http://sdmarineelectric.com/services"><i class="fa fa-fw fa-bars"></i> Services</a></li>
                        <li><a href="#"><i class="fa fa-fw fa-phone"></i> Contact</a></li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>


    <div class="white-top" style="position: absolute; top:0px;">

    </div>

    <div style="position:relative">
        <div class="white-top" style="position: absolute; top:0px;"></div>
        <img src="images-new/home-slide-show/image-slide01-medium-size.gif" alt="" style="width: 100%"/>

        <div id="black-bottom" style="background-color: rgba(0, 0, 0, 0.53);
    bottom: 0px;
    box-sizing: border-box;
    color: rgb(34, 34, 34);
    display: block;
    height: 30px;
    left: 0px;
    position: absolute;
    text-size-adjust: 100%;
    width: 100%;
    z-index: 998;">

        </div>

    </div>

    <div id="blue-divider-1"
         style="
box-shadow: rgba(0, 0, 0, 0.3) 0px 5px 5px 0px;
box-sizing: border-box;
color: rgb(34, 34, 34);
background-color: #42a6bd;
display: block;
position:relative;
font-family: Verdana, Arial, sans-serif;
font-size: 13px;
height: 20px;
line-height: 18.2px;
text-size-adjust: 100%;
width: 100%;
">
    </div>

    <?php IncludeContent(); ?>

    <div id="blue-divider" style="

color: rgb(34, 34, 34);
background-color: #42a6bd;

font-family: Verdana, Arial, sans-serif;
font-size: 13px;
height: 20px;
width: 100%;
">
    </div>

    <footer >


        <div id="footer" style="width: 100%; margin: 0px 0px 0px 0px">

        </div>
    </footer>

</div> <!--content-->






</body>
</html>

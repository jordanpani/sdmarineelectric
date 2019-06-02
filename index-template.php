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

    <link rel="stylesheet" href="css/home-page.css">

    <!-- jQuery -->
    <script src="http://code.jquery.com/jquery-latest.min.js"></script>


    <!--FOR MENU-->


    <script src="https://s3.amazonaws.com/menumaker/menumaker.min.js" type="text/javascript"></script>
    <script src="menu-main/script.js"></script>
    <!-- Icon Library -->
    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">-->
    <link rel="stylesheet" href="menu-main/styles.css"
    <!--END FOR MENU:-->


</head>
<body>


<!-- #EndLibraryItem -->







    <header>
    <nav id="cssmenu" >
        <ul>
            <li class="active"><a href="/"><i class="fa fa-fw fa-home"></i> Home</a></li>
            <li><a href="/services"><i class="fa fa-fw fa-bars"></i> Services</a></li>
            <li><a href="/contact"><i class="fa fa-fw fa-phone"></i> Contact</a></li>
        </ul>
    </nav>



    <div style="position:relative">
        <div class="white-top" style="position: absolute; top:0px;"></div>
        <!--<img src="images-new/home-slide-show/image-slide01-medium-size.gif" alt="" style="width: 100%"/>-->

            <div class="row" style="width: 100%;
                background-image: url(/images-new/home-slide-show/image-slide01-medium-size.gif);
                background-repeat: no-repeat;
                min-height: 244px;
                background-size: cover;
            ">
                <div class="col-6" style="height: 100%;">
                    <img class="" src="images-new/logo-home-header.gif" alt="Machu Picchu Travel" style="max-width: 100%; height: auto; float: left; left: 15%">
                </div>

                <div class="col-6">
                    <p>Marine Electricians Serving the San Diego Area</p>
                    <span style="display: block">Call Toll Free</span>
                    <span>(619) 745-5393</span>
                </div>

            </div>





        <div id="black-bottom" style="background-color: rgba(0, 0, 0, 0.53);
    bottom: 0px;
    box-sizing: border-box;
    color: rgb(34, 34, 34);
    display: block;
    height: 10px;
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
    </header>
<div id="content" style="    background-color: #ebe9d5;
    background-image: url('/img/bg-header.jpg');
    background-repeat: repeat;
    background-position: top left;
    ">
    <?php IncludeContent(); ?>

</div> <!--content-->



    <footer >

        <div id="blue-divider" style="

color: rgb(34, 34, 34);
background-color: #42a6bd;

font-family: Verdana, Arial, sans-serif;
font-size: 13px;
height: 20px;
width: 100%;
">
        </div>

        <div id="footer" style="width: 100%; margin: 0px 0px 0px 0px">

        </div>
    </footer>








</body>
</html>

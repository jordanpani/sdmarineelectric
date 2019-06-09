<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!--<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">-->
    <title>San Diego Marine Electric</title>
    <meta name="description" content="San Diego Marine Electric">
    <meta name="keywords" content="San Diego Marine Electric">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="/js/every-page.js"></script>
    <!-- jQuery -->
    <script src="http://code.jquery.com/jquery-latest.min.js"></script>


    <link rel="stylesheet" href="/css-new/every-page.css">
    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

    <link rel="stylesheet" href="/css/home-page.css">


    <!--FOR MENU-->


    <script src="https://s3.amazonaws.com/menumaker/menumaker.min.js" type="text/javascript"></script>
    <script src="/menu-main/script.js"></script>
    <!-- Icon Library -->
    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">-->
    <link rel="stylesheet" href="/menu-main/styles.css"
    <!--END FOR MENU:-->

    <?php
        if (function_exists("IncludeInHead")) {
            IncludeInHead();
        } else {
            echo "<!--Message: IncludeInHead() not found.-->";
        }
        ?>
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
                    <img class="" src="/images-new/logo-home-header-v2.png" alt="San Diego Marine Electric" style="max-width: 100%; height: auto; float: left; left: 15%">
                </div>

                <div class="header-info col-6">
                        <div class="header-info-background">
                            <div class="slogan">Marine Electricians Serving the San Diego Area</div>
                            <div class="call">Call Us</div>
                            <div class="phone"><a href="tel:6197455393">(619) 745-5393</a></div>
                        </div>
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

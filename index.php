<?php
function IncludeContent() {
?>
    <div id="categories" class="row" >


        <div class="category col-4" >

            <div class="category-title"><a href="#">TROUBLESHOOTING</a></div>
            <div class="img-container">
                <img src="images-new/multimeter-troubleshooting.gif">
            </div>
            <div class="category-description">
                We can diagnose and repair many of your problems and save you money in process. <a href="/trouble-shooting">Learn more.</a>
            </div>
        </div>
        <div class="category col-4" >

            <div class="category-title"><a href="#">INSTALLATION</a></div>
            <div class="img-container">
                <img src="images-new/Repairs.gif">
            </div>
            <div class="category-description">
                We can replace or install new electronics or upgrade your electrical systems to your specifications. <a href="/installation">Learn More.</a>
            </div>
        </div>
        <div class="category col-4" >
            <div class="category-title"><a href="#">MAINTENANCE</a></div>
            <div class="img-container">
                <img src="images-new/battery-generic.gif">
            </div>
            <div class="category-description">
                Regular inspection and maintenance can find problems before they become a serious issue. <a href="/maintenance">Learn More.</a>
            </div>
        </div>

    </div>
<?php
}

include "index-template.php";
?>

<?php
/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 4/1/2019
 * Time: 10:01 AM
 */
require_once __DIR__.'/_session.php';
require_once __DIR__.'/_session_index.php';

$MENU_LEFT = 'h-index';

require_once __DIR__.'/controller/indexController.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once __DIR__.'/_main_css.php';?>

</head>
<body>
<!-- loader -->
<?php //require_once __DIR__.'/_main_loader.php';?>

<div class="page-full container">

    <!-- top menu -->
    <?php require_once __DIR__.'/_main_menutop.php';?>

    <div style="margin-top: -80px;">
        <div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
            <div class="carousel-inner" id="TestGame">
                <div class="carousel-item active">
                    <img src="./images/photo-banner-1.png" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="./images/photo-banner-2.png" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="./images/photo-banner-3.png" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="./images/photo-banner-4.png" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="./images/photo-banner-5.png" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="./images/photo-banner-6.png" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="./images/photo-banner-7.png" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="./images/photo-banner-8.png" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="./images/photo-banner-9.png" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="./images/photo-banner-10.png" class="d-block w-100" alt="...">
                </div>
            </div>
            <a class="slide-register" href="/index-register.php">
                <img class="image-zoom" src="./images/Application-Icon.png">
            </a>
        </div>
    </div>

    <div class="page-content shadow mt-3 p-3 mb-5 bg-white rounded">
        <div class="p-5">
            <?php echo $WEB_HOME;?>
        </div>
    </div>

</div>

<footer class="footer">
    <?php require_once __DIR__.'/_main_footer.php';?>
</footer>


<?php require_once __DIR__.'/_main_script.php';?>





<script>
    //slide image
    $(document).ready(function(){
        $('.carousel').carousel({
            interval: 2000
        })
    });

</script>

</body>
</html>

<?php
/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 4/1/2019
 * Time: 12:54 PM
 */
$MENU_LEFT = 'h-connect';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once __DIR__.'/_main_css.php';?>

</head>
<body>
<!-- loader -->
<?php require_once __DIR__.'/_main_loader.php';?>

<div class="page-full container">

    <!-- top menu -->
    <?php require_once __DIR__.'/_main_menutop.php';?>

    <div class="pb-5 mb-5 page-background" style="margin-top: -80px;">

        <div class="pt-5 pl-5 col-lg-12">
            <h5 class="pt-5">ติดต่อเราได้ที่</h5>
            <hr>
        </div>
        <div class="row p-5 text-center">

            <div class="col-lg-4">
                <div class="bg-white shadow-lg p-5 m-3 rounded">
                    <a href="https://web.facebook.com/bridge2inventor" target="_blank">
                        <p class="btn btn-primary image-zoom" style="width: 80px;"><i class="fa fa-facebook fa-3x"></i></p>
                        <p>Bridge2Investor</p>
                    </a>
                </div>

            </div>
            <div class="col-lg-4">
                <div class="bg-white shadow-lg p-5 m-3 rounded">
                    <a href="mailto:Nat.tanon@live.com" target="_blank">
                        <p class="btn btn-danger image-zoom" style="width: 80px;"><i class="fa fa-envelope fa-3x"></i></p>
                        <p>Mail:nat.tanon@live.com</p>
                    </a>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="bg-white shadow-lg p-5 m-3 rounded">
                    <p class="btn btn-dark image-zoom" style="width: 80px;"><i class="fa fa-volume-control-phone fa-3x"></i></p>
                    <p>โทร : 045-353312</p>
                </div>
            </div>

        </div>


        <div class="pt-3 pl-5 col-lg-12">
            <h5 class="pt-5">โดยความร่วมมือของ</h5>
            <hr>
        </div>
        <div class="row p-5 text-center">
            <div class="col-lg-4">
                <div class="bg-white shadow-lg p-1 m-1 rounded">
                    <img class="image-zoom rounded-circle alert-secondary" src="images/bridgestone-logo.png" alt="Bridgestone">
                    <h5 class="h-c pt-1 font-weight-bold">บริษัทไทยบริดจสโตน จำกัด</h5>
                    <p>&nbsp;</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="bg-white shadow-lg p-1 m-1 rounded">
                    <img class="image-zoom rounded-circle alert-secondary" src="images/ubon-logo.png" alt="Ubu">
                    <h5 class="h-c pt-1 font-weight-bold">มหาวิทยาลัยอุบลราชธานี</h5>
                    <p>คณะวิศวกรรมศาสตร์และคณะวิทยาศาสาตร์</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="bg-white shadow-lg p-1 m-1 rounded">
                    <img class="image-zoom rounded-circle alert-secondary" src="images/naresuan-logo.png" alt="Naresuan">
                    <h5 class="h-c pt-1 font-weight-bold">มหาวิทยาลัยนเรศวร</h5>
                    <p>คณะวิศวกรรมศาสตร์และคณะวิทยาศาสาตร์</p>
                </div>
            </div>

        </div>



    </div>

</div>

<footer class="footer">
    <?php require_once __DIR__.'/_main_footer.php';?>
</footer>

<?php require_once __DIR__.'/_main_script.php';?>



</body>
</html>

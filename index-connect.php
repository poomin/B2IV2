<?php
/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 4/1/2019
 * Time: 12:54 PM
 */
require_once __DIR__.'/_session.php';
require_once __DIR__.'/_session_index.php';

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
                <div class="bg-white shadow-lg p-3 m-1 rounded">
                    <a href="https://web.facebook.com/bridge2inventor" target="_blank">
                        <p class="btn btn-primary image-zoom" style="width: 80px;"><i class="fa fa-facebook fa-3x"></i></p>
                        <p></p>
                        <p>Bridge2Inventor</p>
                    </a>
                    <p>&nbsp;</p>
                </div>

            </div>
            <div class="col-lg-4">
                <div class="bg-white shadow-lg p-3 m-1 rounded">
                    <p class="btn btn-danger image-zoom" style="width: 80px;"><i class="fa fa-envelope fa-3x"></i></p>
                    <p></p>
                    <p>
                        <span> ศูนย์อบรมที่ 1 </span>
                        <a href="mailto:Nat.tanon@live.com" target="_blank">
                             Nat.tanon@live.com &nbsp;
                        </a>
                    </p>
                    <p>
                        <span> ศูนย์อบรมที่ 2 </span>
                        <a href="mailto:Nutchanartj@nu.ac.th" target="_blank">
                            Nutchanartj@nu.ac.th
                        </a>
                    </p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="bg-white shadow-lg pt-3 pl-3 pr-3 m-1 rounded">
                    <p class="btn btn-dark image-zoom" style="width: 80px;"><i class="fa fa-volume-control-phone fa-3x"></i></p>
                    <p>
                        <span>ศูนย์อบรมที่ 1 : 045-353300 ต่อ 3399</span><br>
                        <small> ( คุณคอยจิตร์,คุณเฉลิมชัย ) </small>
                    </p>
                    <p>
                        <span>ศูนย์อบรมที่ 2 : 055-963951</span><br>
                        <small>( คุณนุชนารถ ) </small>
                    </p>
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
                    <img class="image-zoom w-50 rounded" src="images/logo-brigestone.png" alt="Bridgestone">
                    <h5 class="h-c pt-1 font-weight-bold">บริษัทไทยบริดจสโตน จำกัด</h5>
                    <p>&nbsp;</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="bg-white shadow-lg p-1 m-1 rounded">
                    <img class="image-zoom w-50 rounded" src="images/logo-ubu.png" alt="Ubu">
                    <h5 class="h-c pt-1 font-weight-bold">มหาวิทยาลัยอุบลราชธานี</h5>
                    <p>คณะวิศวกรรมศาสตร์และคณะวิทยาศาสาตร์</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="bg-white shadow-lg p-1 m-1 rounded">
                    <img class="image-zoom w-50 rounded" src="images/logo-nu.png" alt="Naresuan">
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

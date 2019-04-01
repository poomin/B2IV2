<?php
/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 4/1/2019
 * Time: 12:26 PM
 */

$MENU_LEFT = 'h-news';

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

        <div class="pt-5">
            <p>&nbsp;</p>
        </div>
        <div class="alert-warning shadow-lg p-3 m-5 rounded">
            <div class="post-body row">
                <div class="col-4 border-0">
                    <img class="image-zoom rounded" src="images/news.png" alt="B2i new" style="width: 250px; height: auto;">
                </div>
                <div class="col-8 border-0">
                    <h5>เปิดรับสมัครแล้ว!!! Bridge 2 Inventor 2019</h5>
                    <hr>
                    <p>อีกหนึ่งกิจกรรมดีๆ เพื่อเสริมสร้างสังคมไทยไร้อุบัติเหตุ พร้อาส่งมอบความรับและความปลอดภัยในการเดินทางผ่านเทคโนโลยีและความคิดสร้างสรรค์ บริดจสโตน พร้อมด้วยมหาวิทยาลัยอุบลราชธานี และมหาวิทยาลัยนเรศวร ขอเชิญน้องๆ ระดับ มัธยมศึกษาตอนปลาย จากทั่วทั้งประเทศ แท้คทีมเข้าร่วมเวทีประกวดสิ่งประดิษฐ์จากคอมพิวเตอรืสมองกลฝังตัว ในหัวข้อ "นวัตกรรมเพื่อความปลอดภัยในการเดินทาง"</p>
                </div>
            </div>
            <hr>
            <div class="post-footer">
                    <span class="text-dark">
                        <i class="fa fa-calendar"></i> 27/03/2019
                        <i class="fa fa-eye" style="padding-left: 10px;"></i> 10
                        <i class="fa fa-comments" style="padding-left: 10px;"></i> 5
                        <i class="fa fa-pencil" style="padding-left: 10px;"></i> ประกาศ
                    </span>
            </div>
        </div>

    </div>



</div>
<footer class="footer">
    <?php require_once __DIR__.'/_main_footer.php';?>
</footer>

<script src="./jquery/jquery.min.js"></script>
<script src="./bootstrap/js/bootstrap.min.js"></script>
<script src="./js/loader.js"></script>

</body>
</html>

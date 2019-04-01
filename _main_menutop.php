<?php
/**
 * Created by PhpStorm.
 * User: PF0T4E5G
 * Date: 28/3/2562
 * Time: 06:47 หลังเที่ยง
 */
?>
<div class="page-menu" style="margin-top: -20px;">
    <nav class="navbar navbar-expand-lg">
        <!--<div class="container">-->
        <a href="/index.php" style="z-index: 10;">
            <img class="image-zoom" src="./images/B2i-logo.png" style="width: 160px;">
        </a>
        <div class="collapse navbar-collapse" style="margin-top: -50px;">
            <ul class="nav nav-fill w-100">
                <li class="nav-item">

                </li>
                <li class="nav-item">
                    <a class="nav-link a-menu <?php echo $MENU_LEFT == 'h-index'?'active':'';?>" href="/index.php">หน้าแรก</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link a-menu <?php echo $MENU_LEFT == 'h-information'?'active':'';?>" href="/index-information.php">คลังข้อมูล</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link a-menu <?php echo $MENU_LEFT == 'h-hall'?'active':'';?>" href="/index-hall.php">HALL OFF FAME</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link a-menu <?php echo $MENU_LEFT == 'h-news'?'active':'';?>" href="/index-news.php">ข่าว / ประกาศ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link a-menu <?php echo $MENU_LEFT == 'h-connect'?'active':'';?>" href="/index-connect.php">ติดต่อเรา</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link a-menu <?php echo $MENU_LEFT == 'h-login'?'active':'';?>" href="/index-login.php">สมัคร/เข้าสู่ระบบ</a>
                </li>
            </ul>
        </div>
        <!--</div>-->
    </nav>
</div>

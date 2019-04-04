<?php
/**
 * Created by PhpStorm.
 * User: PF0T4E5G
 * Date: 28/3/2562
 * Time: 06:47 หลังเที่ยง
 */
if(!isset($LOGIN_USER_ID)){
    $LOGIN_USER_ID = '';
    $LOGIN_USER_USERNAME = '';
    $LOGIN_USER_ROLE = '';
    $LOGIN_USER_IMAGE = '/images/profile.png';
}

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
                    <a class="nav-link a-menu <?php echo $MENU_LEFT == 'h-hall'?'active':'';?>" href="/index-hall.php">HALL OF FAME</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link a-menu <?php echo $MENU_LEFT == 'h-news'?'active':'';?>" href="/index-news.php">ข่าว / ประกาศ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link a-menu <?php echo $MENU_LEFT == 'h-connect'?'active':'';?>" href="/index-connect.php">ติดต่อเรา</a>
                </li>

                <?php if($LOGIN_USER_ID==''): ?>
                <li class="nav-item">
                    <a class="nav-link a-menu <?php echo $MENU_LEFT == 'h-login'?'active':'';?>" href="/index-login.php">สมัคร/เข้าสู่ระบบ</a>
                </li>
                <?php else: ?>
                    <li class="dropdown">

                        <a class="nav-link a-menu dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-user"></i>
                            <?php echo $LOGIN_USER_USERNAME; ?>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-item text-center">
                                <a href="/lprofile.php">
                                    <img class="rounded-circle" src="<?php echo $LOGIN_USER_IMAGE;?>" style="width: 110px; height: 110px;">
                                </a>
                            </li>
                            <div class="dropdown-divider"></div>
                            <li class="dropdown-item">
                                <a class="font-weight-bold" href="/_session_logout.php">
                                    <i class="fa fa-lock"></i>
                                    Log out
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php endif;?>


            </ul>
        </div>
        <!--</div>-->
    </nav>
</div>

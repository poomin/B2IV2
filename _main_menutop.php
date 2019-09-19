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
    <nav class="navbar navbar-expand-lg navbar-light bg-light bg-transparent" style="z-index: 10;">
        <div >
            <div class="row">
                <div class="col-md-12 col-8">
                    <img class="img-fluid image-zoom" src="./images/B2i-logo.png">
                </div>
            </div>

        </div>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" style="margin-top: -50px;" id="navbarNavDropdown">
<!--            <ul class="nav nav-fill w-100">-->
            <ul class="navbar-nav" style="background-color: #F2F2F2;">
                <li class="nav-item">
                    <a class="nav-link a-menu <?php echo $MENU_LEFT == 'h-index'?'active':'';?>" href="/index.php">หน้าแรก</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link a-menu <?php echo $MENU_LEFT == 'h-information'?'active':'';?>" href="/index-information.php">คลังข้อมูล</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link a-menu <?php echo $MENU_LEFT == 'h-hall'?'active':'';?>" href="/index-hall.php">HALL FOR FAME</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link a-menu <?php echo $MENU_LEFT == 'h-picture'?'active':'';?>" href="/index-picture.php">ภาพกิจกรรม</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link a-menu <?php echo $MENU_LEFT == 'h-video'?'active':'';?>" href="/index-video.php">วิดีโอกิจกรรม</a>
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
                    <li class="nav-item dropdown">

                        <a class="nav-link a-menu dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-user"></i>
                            <?php echo $LOGIN_USER_USERNAME; ?>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-item text-center">
                                <a href="/lprofile.php">
                                    <img class="rounded-circle" src="<?php echo $LOGIN_USER_IMAGE;?>" style="width: 110px; height: 110px;">
                                    <p>Profile</p>
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

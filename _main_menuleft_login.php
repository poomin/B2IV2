<?php
/**
 * Created by PhpStorm.
 * User: PF0T4E5G
 * Date: 28/3/2562
 * Time: 06:48 หลังเที่ยง
 */

$COUNT_QUESTION = isset($COUNT_QUESTION)?$COUNT_QUESTION:0;
?>
<div class="sidebar-sticky">

    <?php if(isset($LOGIN_USER_ROLE) && ($LOGIN_USER_ROLE=='admin' || $LOGIN_USER_ROLE=='company') ): ?>
    <ul class="nav flex-column">

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>จัดการเว็บไซด์</span>
            <div class="d-flex align-items-center text-muted">
                <i class="fa fa-home"></i>
            </div>
        </h6>

        <li class="nav-item">
            <a class="nav-link a-nav <?php echo $MENU_LEFT == 'image'?'active':'';?>" href="/limage.php">
                <i class="fa fa-file-image-o"></i>
                Home image
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link a-nav <?php echo $MENU_LEFT == 'info'?'active':'';?>" href="/linfo.php">
                <i class="fa fa-file-text-o"></i>
                Home info
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link a-nav <?php echo $MENU_LEFT == 'information'?'active':'';?>" href="/linformation.php">
                <i class="fa fa-file-text-o"></i>
                คลังข้อมูล
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link a-nav <?php echo $MENU_LEFT == 'picture'?'active':'';?>" href="/lpicture.php">
                <i class="fa fa-image"></i>
                ภาพกิจกรรม
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link a-nav <?php echo $MENU_LEFT == 'hall'?'active':'';?>" href="/lhall.php">
                <i class="fa fa-file-video-o"></i>
                Hall for fame
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link a-nav <?php echo $MENU_LEFT == 'post'?'active':'';?>" href="/lpost.php">
                <i class="fa fa-newspaper-o"></i>
                ข่าว / ประกาศ
            </a>
        </li>

    </ul>
    <?php endif; ?>

    <?php if(isset($LOGIN_USER_ROLE) && ($LOGIN_USER_ROLE=='admin' || $LOGIN_USER_ROLE=='board' || $LOGIN_USER_ROLE=='company') ): ?>
    <ul class="nav flex-column mb-2">
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>จัดการข้อมูลทั่วไปของสมาชิก</span>
            <div class="d-flex align-items-center text-muted">
                <i class="fa fa-wrench"></i>
            </div>
        </h6>

        <li class="nav-item">
            <a class="nav-link a-nav <?php echo $MENU_LEFT == 'user'?'active':'';?>" href="/luser.php">
                <i class="fa fa-users"></i>
                จัดการสมาชิก
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link a-nav <?php echo $MENU_LEFT == 'lquestion'?'active':'';?>" href="/lquestion.php">
                <i class="fa fa-question-circle-o"></i>
                ถาม-ตอบ
                <?php if($COUNT_QUESTION>0):?>
                    <span class="badge badge-danger"><?php echo $COUNT_QUESTION;?></span>
                <?php endif;?>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link a-nav <?php echo $MENU_LEFT == 'school'?'active':'';?>" href="/lschool.php">
                <i class="fa fa-university"></i>
                จัดการโรงเรียน
            </a>
        </li>

    </ul>
    <?php endif; ?>

    <?php if(isset($LOGIN_USER_ROLE) && ($LOGIN_USER_ROLE=='admin') ): ?>

        <ul class="nav flex-column mb-2">
            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                <span>อบรม</span>
                <div class="d-flex align-items-center text-muted">
                    <i class="fa fa-sticky-note"></i>
                </div>
            </h6>

            <li class="nav-item">
                <a class="nav-link a-nav <?php echo $MENU_LEFT == 'training-set'?'active':'';?>" href="/ltraining.php">
                    <i class="fa fa-edit"></i>
                    สร้าง/จัดการ
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link a-nav <?php echo $MENU_LEFT == 'training-list'?'active':'';?>" href="/ltrainings.php">
                    <i class="fa fa-sticky-note-o"></i>
                    สมาชิกเข้าร่วม
                </a>
            </li>

        </ul>


    <ul class="nav flex-column mb-2">
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>จัดการโครงการ</span>
            <div class="d-flex align-items-center text-muted">
                <i class="fa fa-gears"></i>
            </div>
        </h6>

        <li class="nav-item">
            <a class="nav-link a-nav <?php echo $MENU_LEFT == 'create'?'active':'';?>" href="/lmain.php">
                <i class="fa fa-gear"></i>
                Active / สร้างโครงการ
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link a-nav <?php echo $MENU_LEFT == 'manage'?'active':'';?>" href="/lmanage.php">
                <i class="fa fa-gear"></i>
                กำหนดโครงการ
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link a-nav <?php echo $MENU_LEFT == 'rate'?'active':'';?>" href="/lrate.php">
                <i class="fa fa-balance-scale"></i>
                ตรวจโครงการ
            </a>
        </li>

    </ul>
    <?php endif; ?>

    <?php if(isset($LOGIN_USER_ROLE) && ($LOGIN_USER_ROLE=='admin' || $LOGIN_USER_ROLE=='board' || $LOGIN_USER_ROLE=='company') ): ?>
    <ul class="nav flex-column mb-2">
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>โครงการส่งเข้าประกวด</span>
            <div class="d-flex align-items-center text-muted">
                <i class="fa fa-list"></i>
            </div>
        </h6>

        <li class="nav-item">
            <a class="nav-link a-nav <?php echo $MENU_LEFT == 'process'?'active':'';?>" href="/lprocess.php">
                <i class="fa fa-check-square"></i>
                โครงการที่ดำเนินการอยู่
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link a-nav <?php echo $MENU_LEFT == 'score'?'active':'';?>" href="/lscore.php">
                <i class="fa fa-balance-scale"></i>
                ตรวจสอบ / ให้คะแนน
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link a-nav <?php echo $MENU_LEFT == 'history'?'active':'';?>" href="/lhistory.php">
                <i class="fa fa-reorder"></i>
                ประวัติโครงการ
            </a>
        </li>

    </ul>
    <?php endif; ?>

    <?php if(isset($LOGIN_USER_ROLE) && ($LOGIN_USER_ROLE=='student' || $LOGIN_USER_ROLE=='teacher') ): ?>
    <ul class="nav flex-column mb-2">
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>โครงการ</span>
            <div class="d-flex align-items-center text-muted">
                <i class="fa fa-mortar-board"></i>
            </div>
        </h6>

        <?php if(isset($LOGIN_USER_ROLE) && ($LOGIN_USER_ROLE=='teacher') ): ?>
        <li class="nav-item">
            <a class="nav-link a-nav <?php echo $MENU_LEFT == 'ucreate'?'active':'';?>" href="/ucreate.php">
                <i class="fa fa-plus-circle"></i>
                สร้างทีม/โครงการ
            </a>
        </li>
        <?php endif; ?>

        <li class="nav-item">
            <a class="nav-link a-nav <?php echo $MENU_LEFT == 'uprocess'?'active':'';?>" href="/uprocess.php">
                <i class="fa fa-check-square"></i>
                โครงการที่ดำเนินการอยู่
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link a-nav <?php echo $MENU_LEFT == 'ucheck'?'active':'';?>" href="/ucheck.php">
                <i class="fa fa-calendar"></i>
                โครงการ(โรงเรียน)
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link a-nav <?php echo $MENU_LEFT == 'upost'?'active':'';?>" href="/upost.php">
                <i class="fa fa-envelope-o"></i>
                อบรม
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link a-nav <?php echo $MENU_LEFT == 'uquestion'?'active':'';?>" href="/uquestion.php">
                <i class="fa fa-question-circle-o"></i>
                ถาม-ตอบ
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link a-nav <?php echo $MENU_LEFT == 'uhistory'?'active':'';?>" href="/uhistory.php">
                <i class="fa fa-reorder"></i>
                ประวัติโครงการที่เคยเข้าร่วม
            </a>
        </li>

    </ul>
    <?php endif; ?>

</div>

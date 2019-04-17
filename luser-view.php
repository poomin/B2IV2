<?php
/**
 * Created by PhpStorm.
 * User: PF0T4E5G
 * Date: 7/4/2562
 * Time: 04:56 ก่อนเที่ยง
 */

require_once __DIR__.'/_session.php';
require_once __DIR__.'/_session_login.php';


$MENU_LEFT = 'user';

require_once __DIR__.'/controller/userViewController.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once __DIR__.'/_main_css.php';?>
</head>
<body>

<!-- loader -->
<?php require_once __DIR__.'/_main_loader.php';?>


<div class="page-full container-fluid">

    <!-- top menu -->
    <?php require_once __DIR__.'/_main_menutop.php';?>

    <div class="pb-5 mb-5" style="margin-top: -80px;">

        <div class="row">

            <!-- left menu -->
            <div class="col-3 p-5">
                <?php require_once __DIR__.'/_main_menuleft_login.php';?>
            </div>

            <!-- page body -->
            <div class="col-9 p-5 bg-white">

                <div class="p-0">
                    <h2 class="h-c"><i class="fa fa-user icon-zoom"></i> View User</h2>
                    <hr class="style1">
                </div>

                <div class="p-0">

                    <!-- show image -->
                    <div class="text-center pb-3">
                        <img class="rounded-circle" id="imageShow" src="<?php echo $this_user_image;?>" alt="image" style="width: 200px; height: 200px;">
                    </div>

                    <hr>
                    <form class="profile-validation">


                        <div class="form-group">
                            <label class="label-control">Username</label>
                            <input class="form-control" type="text" name="username" value="<?php echo $this_user_username; ?>" disabled>
                            <div class="invalid-feedback">
                                Please input username!
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="label-control">Password</label>
                                <input id="inputPassword" class="form-control" type="password" name="password" value="*********" disabled>
                                <div class="invalid-feedback">
                                    Please input password!
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="label-control">Confirm password</label>
                                <input id="inputConfirm" class="form-control" type="password" name="confirm" value="*********" disabled>
                                <div class="invalid-feedback">
                                    Confirm password,these don't match!
                                </div>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <hr>

                        <div class="form-group pt-3">
                            <label class="label-control" for="idSchool">โรงเรียน / สถานศึกษา </label>
                            <input id="idSchool" class="form-control" type="text" name="school" value="<?php echo $this_user_schoolname;?>" disabled>
                        </div>

                        <p>คำนำหน้าชื่อ</p>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="name_title" id="idNameTitleMiss" value="นางสาว" <?php echo $this_user_name_title=='นางสาว'?'checked':''; ?> disabled>
                            <label class="form-check-label" for="idNameTitleMiss">นางสาว</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="name_title" id="idNameTitleMrs" value="นาง" <?php echo $this_user_name_title=='นาง'?'checked':''; ?> disabled>
                            <label class="form-check-label" for="idNameTitleMrs">นาง</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="name_title" id="idNameTitleMr" value="นาย" <?php echo $this_user_name_title=='นาย'?'checked':''; ?>  disabled>
                            <label class="form-check-label" for="idNameTitleMr">นาย</label>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="label-control">ชื่อ</label>
                                <input class="form-control" type="text" name="name" value="<?php echo $this_user_name;?>" disabled>
                                <div class="invalid-feedback">
                                    Please input name!
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="label-control">นามสกุล</label>
                                <input class="form-control" type="text" name="surname" value="<?php echo $this_user_surname;?>" disabled>
                                <div class="invalid-feedback">
                                    Please input surname!
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="label-control">Email</label>
                            <input class="form-control" type="email" name="email" value="<?php echo $this_user_email;?>" disabled>
                            <div class="invalid-feedback">
                                Please input email!
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="label-control">ภาค</label>
                            <input class="form-control" type="text" name="email" value="<?php echo $this_user_schoolregion;?>" disabled>
                        </div>

                        <p>สถานะ</p>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="role" id="idRoleStudent" value="student" <?php echo $this_user_role=='student'?'checked':'';?> disabled>
                            <label class="form-check-label" for="idRoleStudent">นักเรียน / นักศึกษา</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="role" id="idRoleTeacher" value="teacher" <?php echo $this_user_role=='teacher'?'checked':'';?> disabled>
                            <label class="form-check-label" for="idRoleTeacher">ครู / อาจารย์</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="role" id="idRoleBoard" value="board" <?php echo $this_user_role=='board'?'checked':'';?> disabled>
                            <label class="form-check-label" for="idRoleBoard">กรรมการ</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="role" id="idRoleCompany" value="company" <?php echo $this_user_role=='company'?'checked':'';?> disabled>
                            <label class="form-check-label" for="idRoleCompany">ผู้ดูแลระบบทั่วไป</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="role" id="idRoleAdmin" value="" <?php echo $this_user_role=='admin'?'checked':'';?> disabled >
                            <label class="form-check-label" for="idRoleAdmin">Admin</label>
                        </div>


                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

<footer class="footer">
    <?php require_once __DIR__.'/_main_footer.php';?>
</footer>

<!-- main script -->
<?php require_once __DIR__.'/_main_script.php';?>

</body>
</html>
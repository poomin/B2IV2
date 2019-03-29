<?php
/**
 * Created by PhpStorm.
 * User: PF0T4E5G
 * Date: 28/3/2562
 * Time: 07:02 หลังเที่ยง
 */


$MENU_LEFT = 'profile'



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once __DIR__.'/_main_css.php';?>
</head>
<body>

<!-- loader -->
<div id="ajax-page-loader" class="show fullscreen">
    <div class="circular">
        <img src="./images/ajax-loader.gif">
    </div>
</div>


<div class="page-full container-fluid">

    <!-- top menu -->
    <?php require_once __DIR__.'/_main_menutop_login.php';?>

    <div class="pb-5 mb-5" style="margin-top: -80px;">

        <div class="row">

            <!-- left menu -->
            <div class="col-3 p-5">
                <?php require_once __DIR__.'/_main_menuleft_login.php';?>
            </div>

            <!-- page body -->
            <div class="col-9 p-5 bg-white">

                <div class="p-0">
                    <h2 class="h-c"><i class="fa fa-user icon-zoom"></i> Profile</h2>
                    <hr class="style1">
                </div>
                <div>

                    <form class="form-horizontal" method="post">

                        <div class="form-group">
                            <div class="col-xs-12">
                                <label class="label-control">Username</label>
                                <input class="form-control" type="text" value="<?=$_SESSION['username'];?>" disabled>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-6">
                                <label class="label-control">Password</label>
                                <input class="form-control" type="password" value="xxxxxxxx" disabled>
                            </div>
                            <div class="col-xs-6">
                                <label class="label-control">Confirm password</label>
                                <input class="form-control" type="password" value="xxxxxxxx" disabled>
                            </div>
                        </div>

                        <div class="text-center">
                            <a class="btn btn-sm sr-button btn-warning" data-toggle="modal" data-target=".modalEditPassword">Edit</a>
                        </div>
                        <hr>

                        <div class="form-group">
                            <div class="col-xs-6">
                                <label class="label-control">First Name</label>
                                <input class="form-control" type="text" name="name" value="<?=$_SESSION['name'];?>" required>
                            </div>
                            <div class="col-xs-6">
                                <label class="label-control">Last Name</label>
                                <input class="form-control" type="text" name="surname" value="<?=$_SESSION['surname'];?>" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-12">
                                <label class="label-control">Email</label>
                                <input class="form-control" type="email" name="email" value="<?=$_SESSION['email'];?>" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-12">
                                <label class="label-control">สถานะ</label> <br>
                                <input name="role" type="radio" value="student" <?=$_SESSION['role']=='student'?'checked':''?> disabled> นักเรียน / นักศึกษา <br>
                                <input name="role" type="radio" value="teacher" <?=$_SESSION['role']=='teacher'?'checked':''?> disabled> ครู / อาจารย์
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-12">
                                <label class="label-control">โรงเรียน / สถานศึกษา</label>
                                <div class="row-fluid">
                                    <select  name="schoolname" class="selectpicker form-control" data-live-search="true">
                                        <option value=""></option>
                                        <option value="ubut1">ubu1</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-12">
                                <label class="label-control">ภาค</label>
                                <select class="form-control" name="schoolregion">
                                    <option value="กลาง">กลาง</option>
                                    <option value="เหนือ">เหนือ</option>
                                    <option value="ตะวันออก">ตะวันออก</option>
                                    <option value="ตะวันตก">ตะวันตก</option>
                                    <option value="ตะวันออกเฉียงเหนือ">ตะวันออกเฉียงเหนือ</option>
                                    <option value="ใต้">ใต้</option>
                                </select>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-lg sr-button btn-success">SEND</button>
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
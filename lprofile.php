<?php
/**
 * Created by PhpStorm.
 * User: PF0T4E5G
 * Date: 28/3/2562
 * Time: 07:02 หลังเที่ยง
 */
require_once __DIR__.'/_session.php';
require_once __DIR__.'/_session_login.php';


$MENU_LEFT = 'profile';

require_once __DIR__.'/controller/profileController.php';

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
                    <h2 class="h-c"><i class="fa fa-user icon-zoom"></i> Profile</h2>
                    <hr class="style1">
                </div>
                <div>

                    <form class="profile-validation" method="post" novalidate>


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

                        <div class="text-center">
                            <button type="button" class="btn btn-warning">Edit</button>
                        </div>

                        <hr>


                        <div class="form-group pt-3">
                            <label class="label-control" for="idSchool">โรงเรียน / สถานศึกษา </label>
                            <select id="idSchool" name="school_name" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Please select a school ..." required>
                                <?php foreach ($SCHOOLS as $item): ?>
                                    <option value="<?php echo $item['school_name'];?>"  <?php echo $item['school_name']==$this_user_schoolname?'selected':'';?> >
                                        <?php echo $item['school_name'].'('.$item['province'].')';?>
                                    </option>
                                <?php endforeach;?>
                            </select>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="label-control">ชื่อ</label>
                                <input class="form-control" type="text" name="name" value="<?php echo $this_user_name;?>" required>
                                <div class="invalid-feedback">
                                    Please input name!
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="label-control">นามสกุล</label>
                                <input class="form-control" type="text" name="surname" value="<?php echo $this_user_surname;?>" required>
                                <div class="invalid-feedback">
                                    Please input surname!
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="label-control">Email</label>
                            <input class="form-control" type="email" name="email" value="<?php echo $this_user_email;?>" required>
                            <div class="invalid-feedback">
                                Please input email!
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="label-control" for="idSchoolRegion">ภาค</label>
                            <select class="form-control" id="idSchoolRegion" name="schoolregion">
                                <option value="กลาง" <?php echo $this_user_schoolregion=='กลาง'?'selected':''; ?> >กลาง</option>
                                <option value="เหนือ" <?php echo $this_user_schoolregion=='เหนือ'?'selected':''; ?> >เหนือ</option>
                                <option value="ตะวันออก" <?php echo $this_user_schoolregion=='ตะวันออก'?'selected':''; ?> >ตะวันออก</option>
                                <option value="ตะวันตก" <?php echo $this_user_schoolregion=='ตะวันตก'?'selected':''; ?> >ตะวันตก</option>
                                <option value="ตะวันออกเฉียงเหนือ" <?php echo $this_user_schoolregion=='ตะวันออกเฉียงเหนือ'?'selected':''; ?> >ตะวันออกเฉียงเหนือ</option>
                                <option value="ใต้" <?php echo $this_user_schoolregion=='ใต้'?'selected':''; ?> >ใต้</option>
                            </select>
                        </div>

                        <p>สถานะ</p>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="role" id="idRoleStudent" value="student" checked disabled>
                            <label class="form-check-label" for="idRoleStudent">
                                <?php
                                    if($this_user_role=='admin'){
                                        echo "Admin";
                                    }elseif($this_user_role=='company'){
                                        echo "บริษัท / มหาวิทยาลัย";
                                    }elseif($this_user_role=='board'){
                                        echo "กรรมการ";
                                    }elseif($this_user_role=='teacher'){
                                        echo "ครู / อาจารย์";
                                    }elseif($this_user_role=='admin'){
                                        echo "นักเรียน / นักศึกษา";
                                    }
                                ?>
                            </label>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-lg btn-success">SAVE EDIT</button>
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

<script>
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            var formProfile = document.getElementsByClassName('profile-validation');
            var validation = Array.prototype.filter.call(formProfile, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>

</body>
</html>
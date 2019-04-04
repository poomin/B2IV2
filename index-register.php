<?php
/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 4/1/2019
 * Time: 2:59 PM
 */
require_once __DIR__.'/_session.php';

$MENU_LEFT = 'h-login';
require_once __DIR__.'/controller/registerController.php';


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

    <div class="pb-5 mb-5 bg-white" style="margin-top: -80px;">


        <div class="row justify-content-center" style="padding-top: 50px;">

            <!-- alert status -->
            <div class="col-12">
                <?php require_once __DIR__.'/_alert.php';?>
            </div>

            <div class="alert alert-success col-8" role="alert" hidden>
                <h4 class="alert-heading">เร็วๆนี้!</h4>
                <hr>
                <p class="mb-0">ขออภัย ทางระบบยังไม่เปิดให้สมัครสมาชิกในขณะนี้ ทางทีมงานจะเปิดให้สมัครสมาชิกและยื่นเสนอโครงการภายในวันที่ <strong> 22 เมษายน 2562 </strong> ทางทีมงานขอขอบคุณที่ท่านให้ความสมใจกับโครงการ Bridge 2 Inventor 2019</p>
            </div>

            <div class="col-6">
                <form class="register-validation" method="post" novalidate>

                    <div class="text-center pb-3">
                        <h3 class="h-c">สมัครสมาชิก</h3>
                        <hr>
                    </div>

                    <div class="form-group pt-3">
                        <label class="label-control" for="idSchool">โรงเรียน / สถานศึกษา
                            <button class="btn btn-success btn-sm" type="button" data-toggle="modal" data-target="#modalAddSchool">
                                <i class="fa fa-plus"></i>
                            </button>
                        </label>
                        <select id="idSchool" name="school_name" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Please select a school ..." required>
                            <?php foreach ($SCHOOLS as $item): ?>
                                <option value="<?php echo $item['school_name'];?>">
                                    <?php echo $item['school_name'].'('.$item['province'].')';?>
                                </option>
                            <?php endforeach;?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="label-control">Username</label>
                        <input class="form-control" type="text" name="username" required>
                        <div class="invalid-feedback">
                            Please input username!
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="label-control">Password</label>
                            <input id="inputPassword" class="form-control" type="password" name="password" required>
                            <div class="invalid-feedback">
                                Please input password!
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="label-control">Confirm password</label>
                            <input id="inputConfirm" class="form-control" type="password" name="confirm" required>
                            <div class="invalid-feedback">
                                Confirm password,these don't match!
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="label-control">ชื่อ</label>
                            <input class="form-control" type="text" name="name" required>
                            <div class="invalid-feedback">
                                Please input name!
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="label-control">นามสกุล</label>
                            <input class="form-control" type="text" name="surname" required>
                            <div class="invalid-feedback">
                                Please input surname!
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="label-control">Email</label>
                        <input class="form-control" type="email" name="email" required>
                        <div class="invalid-feedback">
                            Please input email!
                        </div>
                    </div>

                    <p>สถานะ</p>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="role" id="idRoleStudent" value="student" checked>
                        <label class="form-check-label" for="idRoleStudent">นักเรียน / นักศึกษา</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="role" id="idRoleTeacher" value="teacher">
                        <label class="form-check-label" for="idRoleTeacher">ครู / อาจารย์</label>
                    </div>

                    <div class="form-group">
                        <label class="label-control" for="idSchoolRegion">ภาค</label>
                        <select class="form-control" id="idSchoolRegion" name="schoolregion">
                            <option value="กลาง">กลาง</option>
                            <option value="เหนือ">เหนือ</option>
                            <option value="ตะวันออก">ตะวันออก</option>
                            <option value="ตะวันตก">ตะวันตก</option>
                            <option value="ตะวันออกเฉียงเหนือ">ตะวันออกเฉียงเหนือ</option>
                            <option value="ใต้">ใต้</option>
                        </select>
                    </div>
                    <div class="text-center">
                        <input type="text" name="fn" value="insertUser" hidden>
                        <button type="submit" class="btn btn-lg sr-button btn-success">Register</button>
                        <hr>
                        <a href="/index-login.php">เข้าสู่ระบบ</a>
                    </div>

                </form>
            </div>
        </div>

    </div>

</div>

<footer class="footer">
    <?php require_once __DIR__.'/_main_footer.php';?>
</footer>

<?php require_once __DIR__.'/_main_script.php';?>


<script>
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var formRegister = document.getElementsByClassName('register-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(formRegister, function(form) {
                form.addEventListener('submit', function(event) {
                    if ( document.getElementById("inputPassword").value != document.getElementById("inputConfirm").value ) {
                        $('#inputConfirm').val('');
                        $('#inputConfirm').focus();
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    else if (form.checkValidity() === false) {
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


<?php require_once __DIR__.'/modal_school_add.php';?>

</html>

<?php
/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 4/1/2019
 * Time: 12:37 PM
 */
require_once __DIR__.'/_session.php';
require_once __DIR__.'/_session_index.php';

require_once __DIR__.'/_session.php';


$MENU_LEFT = 'h-login';
require_once __DIR__.'/controller/loginController.php';

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

        <div class="row justify-content-center" style="padding-top: 50px; min-height: 550px;">

            <!-- alert status -->
            <div class="col-12">
                <?php require_once __DIR__.'/_alert.php';?>
            </div>

            <div class="col-6">
                <form class="login-validation" method="post" novalidate>

                    <div class="text-center pb-3">
                        <h3 class="h-c">เข้าสู่ระบบ</h3>
                        <hr>
                    </div>

                    <div class="form-group">
                        <label class="label-control">Username</label>
                        <input class="form-control" type="text" name="username" required>
                        <div class="invalid-feedback">
                            Please input username!
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="label-control">Password</label>
                        <input class="form-control" type="password" name="password" required>
                        <div class="invalid-feedback">
                            Please input password!
                        </div>
                    </div>

                    <div class="text-center">
                        <input type="text" name="fn" value="login" hidden>
                        <button type="submit" class="btn btn-lg sr-button btn-success">Login</button>
                        <hr>
                        <a href="/index-register.php">สมัครสมาชิก</a>
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
            var formLogin = document.getElementsByClassName('login-validation');
            var validation = Array.prototype.filter.call(formLogin, function(form) {
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

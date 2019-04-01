<?php
/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 4/1/2019
 * Time: 12:37 PM
 */

$MENU_LEFT = 'h-login';


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
            <div class="col-6">
                <form class="form-horizontal" method="post">

                    <div class="text-center pb-3">
                        <h3 class="h-c">เข้าสู่ระบบ</h3>
                        <hr>
                    </div>

                    <div class="form-group">
                        <label class="label-control">Username</label>
                        <input class="form-control" type="text" name="username" required>
                    </div>

                    <div class="form-group">
                        <label class="label-control">Password</label>
                        <input class="form-control" type="password" name="password" required>
                    </div>

                    <div class="text-center">
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


<script src="./jquery/jquery.min.js"></script>
<script src="./bootstrap/js/bootstrap.min.js"></script>
<script src="./js/loader.js"></script>

</body>
</html>

<?php
/**
 * Created by PhpStorm.
 * User: PF0T4E5G
 * Date: 28/3/2562
 * Time: 07:02 หลังเที่ยง
 */

require_once __DIR__ . '/_session.php';
require_once __DIR__ . '/_session_login.php';

$MENU_LEFT = 'uquestion';

require_once __DIR__.'/controller/uquestionAddController.php';


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    require_once __DIR__ . '/_main_css.php';
    ?>

</head>
<body>

<!-- loader -->
<?php require_once __DIR__ . '/_main_loader.php'; ?>


<div class="page-full container-fluid">

    <!-- top menu -->
    <?php require_once __DIR__ . '/_main_menutop.php'; ?>

    <div class="pb-5 mb-5" style="margin-top: -80px;">

        <div class="row">

            <!-- left menu -->
            <div class="col-3 p-5">
                <?php require_once __DIR__ . '/_main_menuleft_login.php'; ?>
            </div>

            <!-- page body -->
            <div class="col-9 p-5 bg-white">

                <div class="p-0">
                    <h2 class="h-c"><i class="fa fa-question-circle-o icon-zoom"></i> ถาม-ตอบ </h2>
                    <hr class="style1">
                </div>

                <!-- alert status -->
                <div class="p-1">
                    <?php require_once __DIR__.'/_alert.php';?>
                </div>

                <div class="p-0">

                    <form class="register-validation" method="post" novalidate>

                        <div class="form-group">
                            <label class="label-control">หัวข้อถาม-ตอบ</label>
                            <select class="form-control" id="idTitle" name="title" required>
                                <option value="">กรุณาเลือก</option>
                                <option value="สอบถามเกี่ยวกับการทำงานของระบบ(website)">สอบถามเกี่ยวกับระบบ(website)</option>
                                <option value="สอบถามเกี่ยวกับกำหนดการ">สอบถามเกี่ยวกับกำหนดการต่างๆ</option>
                                <option value="สอบถามทั่วไป">สอบถามทั่วไป</option>
                            </select>
                            <div class="invalid-feedback">
                                กรุณาเลือกหัวข้อสอบถาม
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="label-control">รายละเอียด</label>
                            <textarea class="form-control" id="idDetail" name="detail" rows="5" required></textarea>
                            <div class="invalid-feedback">
                                กรุณากรอกรายละเอียด
                            </div>
                        </div>

                        <div class="text-center">
                            <input type="text" name="fn" value="addQuestion" hidden>
                            <button type="submit" class="btn btn-lg sr-button btn-success">ส่งคำถาม</button>
                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

<footer class="footer">
    <?php require_once __DIR__ . '/_main_footer.php'; ?>
</footer>


<!-- main script -->
<?php
require_once __DIR__ . '/_main_script.php';
?>



<script>
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var formRegister = document.getElementsByClassName('register-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(formRegister, function(form) {
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
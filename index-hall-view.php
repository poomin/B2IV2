<?php
/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 4/1/2019
 * Time: 12:25 PM
 */

require_once __DIR__.'/_session.php';
require_once __DIR__.'/_session_index.php';

$MENU_LEFT = 'h-hall';

require_once __DIR__.'/controller/indexHallView.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once __DIR__.'/_main_css.php';?>

    <link rel="stylesheet" href="/lib/froala/css/froala_style.css">

</head>
<body>

<!-- loader -->
<?php require_once __DIR__.'/_main_loader.php';?>

<div class="page-full container">

    <!-- top menu -->
    <?php require_once __DIR__.'/_main_menutop.php';?>

    <div class="pb-5 mb-5 page-background" style="margin-top: -80px;">


        <div class="p-5">
            <div class="card shadow p-4 bg-white rounded">
                <div class="row">
                    <div class="col-6">
                        <div class="bg-danger">
                            <div class="p-4">
                                <img class="image-zoom rounded w-100" alt="hall of fame" src="<?php echo $this_image; ?>">
                            </div>

                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-center">
                            <h3><?php echo $this_project_name_en; ?></h3>
                            <h4><?php echo $this_project_name; ?></h4>
                        </div>
                        <hr class="style1">
                        <div class="p-0">

                            <p><strong>อาจารย์ที่ปรึกษา</strong></p>
                            <p><?php echo $this_adviser_name; ?></p>

                            <p><strong>นักเรียน/นักศึกษา</strong></p>
                            <?php
                            if($this_student_1!='')echo '<p>'.$this_student_1.'</p>';
                            if($this_student_2!='')echo '<p>'.$this_student_2.'</p>';
                            if($this_student_3!='')echo '<p>'.$this_student_3.'</p>';
                            if($this_student_4!='')echo '<p>'.$this_student_4.'</p>';
                            ?>

                        </div>
                    </div>
                </div>

                <?php if ($this_detail!=''): ?>

                    <hr class="style1">

                    <div class="pt-2 pr-5 pl-5 pb-5">
                        <p><strong>รายละเอียด</strong></p>
                        <div class="fr-view">
                            <?php echo $this_detail;?>
                        </div>
                    </div>

                <?php endif; ?>

            </div>
        </div>


    </div>
</div>

<footer class="footer">
    <?php require_once __DIR__.'/_main_footer.php';?>
</footer>

<?php require_once __DIR__.'/_main_script.php';?>



</body>
</html>

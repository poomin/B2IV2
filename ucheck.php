<?php
/**
 * Created by PhpStorm.
 * User: PF0T4E5G
 * Date: 28/3/2562
 * Time: 07:02 หลังเที่ยง
 */
require_once __DIR__.'/_session.php';
require_once __DIR__.'/_session_login.php';

$MENU_LEFT = 'ucheck';

require_once __DIR__.'/controller/userCheckController.php';

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
                    <div class="text-center p-2">
                        <h4 class="font-weight-bolder h-c"><?php echo $this_main_name.' '.$this_main_year;?></h4>
                        <h4 class="h-c">( <?php echo $this_main_name_en.' '.$this_main_year;?> )</h4>
                    </div>
                    <hr class="style1">
                </div>

                <!-- alert status -->
                <div class="p-0">
                    <?php require_once __DIR__.'/_alert.php';?>
                </div>


                <div class="p-2">
                    <h3><?php echo $this_school_name;?></h3>
                    <p><?php echo $this_address.' '.$this_sub.' '.$this_district.' '.$this_province.' '.$this_code;?></p>
                </div>

                <div class="p-0">

                    <table class="this-table table table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>โครงการ (th)</th>
                            <th>โครงการ (en)</th>
                            <th>ที่ปรึกษาโครงการ</th>
                            <th>โรงเรียน</th>
                            <th>ภาค</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($PROJECTS as $key=>$item):?>
                            <tr>
                                <td><?php echo ($key+1); ?></td>
                                <td><?php echo $item['name']; ?></td>
                                <td><?php echo $item['name_en']; ?></td>
                                <td><?php echo $item['ADVISER']; ?></td>
                                <td><?php echo $item['project_school']; ?></td>
                                <td><?php echo $item['project_region']; ?></td>
                            </tr>
                        <?php endforeach;?>
                        </tbody>
                    </table>

                </div>

                <div class="text-right m-3 text-danger">
                    **กำหนดให้สร้างโครงการได้โรงเรียนละ 2 โครงการ
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
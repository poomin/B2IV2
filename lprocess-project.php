<?php
/**
 * Created by PhpStorm.
 * User: PF0T4E5G
 * Date: 28/3/2562
 * Time: 07:02 หลังเที่ยง
 */
require_once __DIR__.'/_session.php';
require_once __DIR__.'/_session_index.php';

$MENU_LEFT = 'process';

require_once  __DIR__.'/controller/processProjectController.php';


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
                    <h2 class="h-c"><i class="fa fa-plus-circle icon-zoom"></i> ทีม/โครงการ</h2>
                    <hr class="style1">
                </div>

                <!-- alert status -->
                <div class="p-0">
                    <?php require_once __DIR__.'/_alert.php';?>
                </div>

                <div class="text-center p-2">
                    <h4 class="font-weight-bolder"><?php echo $this_main_name.' '.$this_main_year;?></h4>
                    <h4>( <?php echo $this_main_name_en.' '.$this_main_year;?> )</h4>
                </div>
                <hr>
                <div class="pr-5 pl-5">
                    <form class="form-validation" method="post" novalidate>

                        <div class="form-group">
                            <label class="label-control">ชื่อโครงการ</label>
                            <input class="form-control" type="text" name="name" value="<?php echo $this_pro_name;?>" disabled>
                            <div class="invalid-feedback">
                                กรุณากรอกชื่อโครงการ
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="label-control">ชื่อโครงการ(ภาษาอังกฤษ)</label>
                            <input class="form-control" type="text" name="name_en" value="<?php echo $this_pro_name_en;?>" disabled >
                            <div class="invalid-feedback">
                                กรุณากรอกชื่อโครงการ (ภาษาอังกฤษ)
                            </div>
                        </div>
                        <!-- cherry 190819 -->
                        <div class="form-group pt-3">
                            <label class="label-control" for="idSchool">โรงเรียน / สถานศึกษา </label>
                            <select id="idSchool" name="school_name" class="form-control" disabled>
                                <option value=""><?php echo $this_school;?></option>
                            </select>
                        </div>

                        <div class="form-group pt-3 pb-3">
                            <label class="label-control">อาจารย์ / ที่ปรึกษาโครงการ</label>
                            <input class="form-control" type="text" name="adviser" value="<?php echo $this_name_title.''.$this_name.' '.$this_surname;?>" disabled>
                            <div class="invalid-feedback">
                                กรุณากรอก อาจารย์ / ที่ปรึกษาโครงการ
                            </div>
                        </div>

                        <p>นักเรียน / นักศึกษา </p>
                        <div class="pb-2" id="devShowStudentSelect">

                            <?php foreach ($MEMBERS as $key=>$item):?>
                            <div class="form-row pb-2" id="studentId<?php echo $item['user_id'];?>">
                                <div class="col-8">
                                    <input type="text" class="form-control" value="<?php echo $item['name_title'].''.$item['name'].' '.$item['surname'].' ( '.$item['schoolname'].' )';?>" disabled>
                                </div>
                            </div>
                            <?php endforeach;?>
                        </div>

                        <div class="form-group pt-3">
                            <label class="label-control" for="idSchoolRegion">ภาค</label>
                            <select class="form-control" id="idSchoolRegion" name="region" disabled>
                                <option value=""> <?php echo $this_region; ?> </option>
                            </select>
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
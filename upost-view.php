<?php
/**
 * Created by PhpStorm.
 * User: PF0T4E5G
 * Date: 28/3/2562
 * Time: 07:02 หลังเที่ยง
 */

require_once __DIR__ . '/_session.php';
require_once __DIR__ . '/_session_login.php';

$MENU_LEFT = 'upost';
$MONTH_TH = ["","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม"];
require_once __DIR__.'/controller/upostViewController.php';


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    require_once __DIR__ . '/_main_css.php';
    ?>

    <link rel="stylesheet" href="/lib/froala/css/froala_style.css">

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
                    <h2 class="h-c"><i class="fa fa-envelope-o icon-zoom"></i> ยืนยันเข้าร่วมอบรม</h2>
                    <hr class="style1">
                </div>

                <!-- alert status -->
                <div class="p-1">
                    <?php require_once __DIR__.'/_alert.php';?>
                </div>

                <div class="p-0">

                    <div class="card p-2">
                        <div class="fr-view">
                            <?php echo $this_t_detail;?>
                        </div>
                    </div>

                    <hr class="style1">
                    <div id="alertTrainingConfirm" class="card p-4 <?php echo $this_t_confirm=='Y'?'alert-success':'alert-danger'; ?>">
                        <div class="form-inline offset-3">
                            <div class="custom-control custom-radio my-1 mr-sm-2">
                                <input name="training_confirm" value="Y" type="radio" class="custom-control-input" id="trainingConfirmYId" <?php echo $this_t_confirm=='Y'?'checked':''; ?> disabled>
                                <label class="custom-control-label" for="trainingConfirmYId"> ยืนยันเข้าร่วมอบรม </label>
                            </div>
                            <div class="custom-control custom-radio my-1 mr-sm-2 ml-5">
                                <input name="training_confirm" value="N" type="radio" class="custom-control-input" id="trainingConfirmNId" <?php echo $this_t_confirm=='N'?'checked':''; ?> disabled>
                                <label class="custom-control-label" for="trainingConfirmNId"> ไม่เข้าร่วมอบรม </label>
                            </div>
                        </div>
                    </div>
                    <div class="pt-3">
                        <div class="form-group">
                            <label for="confirmStateId" class="font-weight-bold text-primary">
                                สถานที่จัดอมรม
                            </label>
                            <select id="confirmStateId" class="form-control">
                                <option value=""><?php echo $this_t_state; ?></option>
                            </select>
                        </div>
                    </div>

                    <!-- check in -->
                    <?php if($this_checkin_active=='Y'):?>
                        <hr class="style1">
                        <p class="font-weight-bold text-primary">Check in โรงแรม</p>
                        <div class="card p-3">
                        <div class="">
                            <pre><?php echo $this_checkin_detail; ?></pre>
                        </div>
                        <div class="form-row">

                            <div class="form-group col-md-2">
                                <label for="checkInDId">วันที่</label>
                                <select class="form-control" id="checkInDId">
                                    <option value=""><?php echo $c_d;?></option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="checkInMId">เดือน</label>
                                <select class="form-control" id="checkInMId">
                                    <option value=""><?php echo $MONTH_TH[$c_m];?></option>
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="checkInYId">ปี</label>
                                <select class="form-control" id="checkInYId">
                                    <option value=""><?php echo $c_y;?></option>
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="checkInHId">เวลา</label>
                                <select class="form-control" id="checkInHId">
                                    <option value=""><?php echo $c_h; ?></option>
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="checkInNId">นาที</label>
                                <select class="form-control" id="checkInNId">
                                    <option value=""><?php echo $c_n; ?></option>
                                </select>
                            </div>

                        </div>
                    </div>
                    <?php endif;?>

                    <!-- teacher -->
                    <?php if(count($TEACHER)>0):?>
                        <hr class="style1">
                        <p class="font-weight-bold text-primary">อาจารย์ / ที่ปรึกษาโครงการ</p>
                        <?php foreach ($TEACHER as $key=>$item):?>
                            <div class="card p-3" style="background-color: whitesmoke;">
                                <div class="form-row">
                                    <div class="form-group col-md-2">
                                        <label for="confirmNameTitleIdT_<?php echo ($key+1); ?>">คำนำหน้าชื่อ</label>
                                        <select id="confirmNameTitleIdT_<?php echo ($key+1); ?>"
                                                class="form-control">
                                            <option value=""> <?php echo $item['name_title'];?></option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-5">
                                        <label for="confirmNameIdT_<?php echo ($key+1); ?>">ชื่อ</label>
                                        <input type="text" class="form-control"
                                               id="confirmNameIdT_<?php echo ($key+1); ?>" placeholder="ชื่อ"
                                               value="<?php echo $item['name']; ?>" disabled>
                                    </div>
                                    <div class="form-group col-md-5">
                                        <label for="confirmSurnameIdT_<?php echo ($key+1); ?>">นามสกุล</label>
                                        <input type="text" class="form-control"
                                               id="confirmSurnameIdT_<?php echo ($key+1); ?>" placeholder="นามสกุล"
                                               value="<?php echo $item['surname']; ?>" disabled>
                                    </div>
                                </div>

                                <div class="form-row pt-2">
                                    <div class="form-group col-md-6">
                                        <label for="confirmClassIdT_<?php echo ($key+1); ?>">ตำแหน่ง</label>
                                        <input type="text" class="form-control"
                                               id="confirmClassIdT_<?php echo ($key+1); ?>" placeholder="ตำแหน่ง อาจารย์,ดร.,รศ.ดร.,ผศ.ดร."
                                               value="<?php echo $item['member_class']; ?>" disabled>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="confirmPhoneIdT_<?php echo ($key+1); ?>">เบอร์โทร</label>
                                        <input type="text" class="form-control"
                                               id="confirmPhoneIdT_<?php echo ($key+1); ?>" placeholder="เบอร์โทร"
                                               value="<?php echo $item['phone']; ?>" disabled>
                                    </div>
                                </div>

                                <?php if($this_t_shirt=='Y'):?>
                                <div class="form-inline pt-2">
                                    <div class="form-group mr-3">
                                        <label class="col-form-label"> ขนาดเสื้อ:</label>
                                    </div>
                                    <?php foreach ($SHIRT_SIZE as $k=>$i): ?>
                                        <div class="custom-control custom-radio my-1 mr-sm-2">
                                            <input name="shirt_sizeT_<?php echo ($key+1); ?>" value="<?php echo $i; ?>"
                                                   type="radio" class="custom-control-input" id="trainingShirt<?php echo $i; ?>IdT_<?php echo ($key+1); ?>"
                                                <?php echo $i==$item['shirt_size']?'checked':''; ?>  disabled>
                                            <label class="custom-control-label mr-3"
                                                   for="trainingShirt<?php echo $i; ?>IdT_<?php echo ($key+1); ?>">
                                                <?php echo $i; ?>
                                            </label>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <?php endif;?>

                                <div class="form-inline pt-2">
                                    <div class="custom-control custom-radio my-1 mr-sm-2">
                                        <input name="vegetarianT_<?php echo ($key+1); ?>" value="Y" type="radio" class="custom-control-input"
                                               id="trainingVegetarianYIdT_<?php echo ($key+1); ?>" <?php echo $item['vegetarian']=='Y'?'checked':''; ?> disabled>
                                        <label class="custom-control-label" for="trainingVegetarianYIdT_<?php echo ($key+1); ?>"> รับประทานมังสวิรัติ </label>
                                    </div>
                                    <div class="custom-control custom-radio my-1 mr-sm-2 ml-5">
                                        <input name="vegetarianT_<?php echo ($key+1); ?>" value="N" type="radio" class="custom-control-input"
                                               id="trainingVegetarianNIdT_<?php echo ($key+1); ?>" <?php echo $item['vegetarian']=='N'?'checked':''; ?> disabled>
                                        <label class="custom-control-label" for="trainingVegetarianNIdT_<?php echo ($key+1); ?>"> รับประทานปกติทั่วไป </label>
                                    </div>
                                </div>

                                <input id="confirmUserIdT_<?php echo ($key+1); ?>" value="<?php echo $item['user_id'];?>" hidden>

                            </div>
                        <?php endforeach;?>

                    <?php endif;?>

                    <!-- student -->
                    <?php if(count($STUDENT)>0):?>
                        <hr class="style1">
                        <p class="font-weight-bold text-primary">นักเรียน</p>
                        <?php foreach ($STUDENT as $key=>$item):?>
                            <div class="card p-3 mt-2" style="background-color: whitesmoke;">
                                <div class="form-row">
                                    <div class="form-group col-md-2">
                                        <label for="confirmNameTitleIdS_<?php echo ($key+1); ?>">คำนำหน้าชื่อ</label>
                                        <select id="confirmNameTitleIdS_<?php echo ($key+1); ?>"
                                                class="form-control">
                                            <option value=""><?php echo $item['name_title']; ?></option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-5">
                                        <label for="confirmNameIdS_<?php echo ($key+1); ?>">ชื่อ</label>
                                        <input type="text" class="form-control"
                                               id="confirmNameIdS_<?php echo ($key+1); ?>" placeholder="ชื่อ"
                                               value="<?php echo $item['name']; ?>" disabled>
                                    </div>
                                    <div class="form-group col-md-5">
                                        <label for="confirmSurnameIdS_<?php echo ($key+1); ?>">นามสกุล</label>
                                        <input type="text" class="form-control"
                                               id="confirmSurnameIdS_<?php echo ($key+1); ?>" placeholder="นามสกุล"
                                               value="<?php echo $item['surname']; ?>" disabled>
                                    </div>
                                </div>

                                <div class="form-row pt-2">
                                    <div class="form-group col-md-6">
                                        <label for="confirmClassIdS_<?php echo ($key+1); ?>">ชั้น</label>
                                        <input type="text" class="form-control"
                                               id="confirmClassIdS_<?php echo ($key+1); ?>" placeholder="ม.1/1"
                                               value="<?php echo $item['member_class']; ?>" disabled>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="confirmPhoneIdS_<?php echo ($key+1); ?>">เบอร์โทร</label>
                                        <input type="text" class="form-control"
                                               id="confirmPhoneIdS_<?php echo ($key+1); ?>" placeholder="เบอร์โทร"
                                               value="<?php echo $item['phone']; ?>" disabled>
                                    </div>
                                </div>

                                <?php if($this_t_shirt=='Y'):?>
                                <div class="form-inline pt-2">
                                    <div class="form-group mr-3">
                                        <label class="col-form-label"> ขนาดเสื้อ:</label>
                                    </div>
                                    <?php foreach ($SHIRT_SIZE as $k=>$i): ?>
                                        <div class="custom-control custom-radio my-1 mr-sm-2">
                                            <input name="shirt_sizeS_<?php echo ($key+1); ?>" value="<?php echo $i; ?>"
                                                   type="radio" class="custom-control-input" id="trainingShirt<?php echo $i; ?>IdS_<?php echo ($key+1); ?>"
                                                <?php echo $i==$item['shirt_size']?'checked':''; ?> disabled>
                                            <label class="custom-control-label mr-3"
                                                   for="trainingShirt<?php echo $i; ?>IdS_<?php echo ($key+1); ?>">
                                                <?php echo $i; ?>
                                            </label>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <?php endif;?>

                                <div class="form-inline pt-2">
                                    <div class="custom-control custom-radio my-1 mr-sm-2">
                                        <input name="vegetarianS_<?php echo ($key+1); ?>" value="Y" type="radio" class="custom-control-input"
                                               id="trainingVegetarianYIdS_<?php echo ($key+1); ?>" <?php echo $item['vegetarian']=='Y'?'checked':''; ?> disabled>
                                        <label class="custom-control-label" for="trainingVegetarianYIdS_<?php echo ($key+1); ?>"> รับประทานมังสวิรัติ </label>
                                    </div>
                                    <div class="custom-control custom-radio my-1 mr-sm-2 ml-5">
                                        <input name="vegetarianS_<?php echo ($key+1); ?>" value="N" type="radio" class="custom-control-input"
                                               id="trainingVegetarianNIdS_<?php echo ($key+1); ?>" <?php echo $item['vegetarian']=='N'?'checked':''; ?> disabled>
                                        <label class="custom-control-label" for="trainingVegetarianNIdS_<?php echo ($key+1); ?>"> รับประทานปกติทั่วไป </label>
                                    </div>
                                </div>

                                <input id="confirmUserIdS_<?php echo ($key+1); ?>" value="<?php echo $item['user_id'];?>" hidden>

                            </div>
                        <?php endforeach;?>

                    <?php endif;?>

                    <!-- driver -->
                    <?php if($this_t_group=='PASS'):?>
                        <hr class="style1">
                        <div class="pt-3">
                        <div class="form-group">
                            <label for="confirmDriverId" class="font-weight-bold text-primary">เจ้าหน้าที่ยานพาหนะโรงเรียน</label>
                            <textarea rows="3" class="form-control" id="confirmDriverId" placeholder="1. ชื่อ - สกุล" disabled><?php echo $this_t_driver;?></textarea>
                        </div>
                    </div>
                    <?php endif;?>


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

</body>
</html>
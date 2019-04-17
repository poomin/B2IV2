<?php
/**
 * Created by PhpStorm.
 * User: PF0T4E5G
 * Date: 28/3/2562
 * Time: 07:02 หลังเที่ยง
 */

require_once __DIR__.'/_session.php';
require_once __DIR__.'/_session_login.php';


$MENU_LEFT = 'manage';

require_once __DIR__.'/controller/manageController.php';

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

                    <div class="row">
                        <div class="col-8">
                            <h2 class="h-c"><i class="fa fa-gear icon-zoom"></i> กำหนดโครงการ</h2>
                        </div>
                        <div class="col-4 text-right">
                            <a class="btn btn-success btn-sm" href="/lmanage-phase.php" data-toggle="tooltip" title="Add face">
                                <i class="fa fa-plus"></i> Add Face
                            </a>
                        </div>
                    </div>

                    <hr class="style1">
                </div>

                <!-- alert status -->
                <div class="p-1">
                    <?php require_once __DIR__.'/_alert.php';?>
                </div>

                <div class="p-0 text-center">
                    <h5 class="font-weight-bolder"><?php echo $this_main_year.' '.$this_main_name.' ('.$this_main_name_en.')'; ?></h5>
                </div>
                <hr>

                <?php foreach ($PHASE as $key=>$item) : ?>

                <div class="shadow-lg p-3 m-5 rounded">
                    <div class="text-center">
                        <h5>Phase <?php echo $item['sq']; ?> </h5>
                        <hr>
                    </div>
                    <div class="row">
                        <div class="col-4 text-right">
                            <strong>หัวข้อ: </strong>
                        </div>
                        <div class="col-8">
                            <p><?php echo $item['title'];?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4 text-right">
                            <strong>รายละเอียด: </strong>
                        </div>
                        <div class="col-8">
                            <p>in page....</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4 text-right">
                            <strong>ไฟล์อัพโหลด: </strong>
                        </div>
                        <div class="col-8">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="upload_doc" id="idUploadDoc" value="Y" <?php echo $item['upload_doc']=='Y'?'checked':''; ?> >
                                <label class="form-check-label" for="idUploadDoc">Doc</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="upload_pdf" id="idUploadPdf" value="Y" <?php echo $item['upload_pdf']=='Y'?'checked':''; ?> >
                                <label class="form-check-label" for="idUploadPdf">Pdf</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="upload_image" id="idUploadImage" value="Y" <?php echo $item['upload_image']=='Y'?'checked':''; ?> >
                                <label class="form-check-label" for="idUploadImage">Image</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="upload_video" id="idUploadVideo" value="Y" <?php echo $item['upload_video']=='Y'?'checked':''; ?> >
                                <label class="form-check-label" for="idUploadImage">Video</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4 text-right">
                            <label class="col-form-label"><strong>วันที่ดำเนินการ: </strong></label>
                        </div>
                        <div class="col-8">
                            <div class="form-inline">
                                <label class="label-control"> เริ่ม <i class="fa fa-calendar ml-1"></i> </label>
                                <label class="col-form-label ml-2 font-weight-bolder"> <?php echo $item['date_start']==''?'':date('d/m/Y',strtotime($item['date_start'])); ?> </label>
                                <label class="label-control ml-5"> หมดเขต <i class="fa fa-calendar ml-1"></i> </label>
                                <label class="label-control ml-2 font-weight-bolder"> <?php echo $item['date_end']==''?'':date('d/m/Y',strtotime($item['date_end'])); ?> </div>
                            </div>

                        </div>
                    <hr>
                    <div class="row">
                        <div class="col-12 text-center">
                            <a class="btn btn-warning btn-sm" href="/lmanage-phase.php?sq=<?php echo $item['sq'];?>" data-toggle="tooltip" title="Edit setup">
                                <i class="fa fa-edit"></i>
                                Edit setup
                            </a>
                        </div>

                    </div>

                    <hr class="style1">

                    <div class="text-center">
                        <h5>เกณฑ์การให้คะแนน</h5>
                    </div>
                    <div class="row">
                        <div class="col-4 text-right">
                            <label class="col-form-label"><strong>ระยะเวลาตรวจให้คะแนน: </strong></label>
                        </div>
                        <div class="col-8">
                            <div class="form-inline">
                                <label class="label-control"> เริ่ม <i class="fa fa-calendar ml-1"></i> </label>
                                <label class="col-form-label ml-2 font-weight-bolder"> <?php echo $item['score_date_start']==''?'':date('d/m/Y',strtotime($item['score_date_start'])); ?> </label>
                                <label class="label-control ml-5"> หมดเขต <i class="fa fa-calendar ml-1"></i> </label>
                                <label class="label-control ml-2 font-weight-bolder"> <?php echo $item['score_date_end']==''?'':date('d/m/Y',strtotime($item['score_date_end'])); ?> </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-4 text-right">
                            <strong>เกณฑ์การให้คะแนน: </strong>
                        </div>
                        <div class="col-8">
                            <p> <?php echo $item['c_score']; ?> ข้อ</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4 text-right">
                            <strong>คณะกรรม: </strong>
                        </div>
                        <div class="col-8">
                            <p>คณะกรรมการ <?php echo $item['c_board']; ?> ท่าน</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 text-center">
                            <a class="btn btn-warning btn-sm" href="lmanage-score.php?sq=<?php echo $item['sq'];?>" data-toggle="tooltip" title="Edit Score">
                                <i class="fa fa-edit"></i>
                                Edit
                            </a>
                        </div>
                    </div>


                    <?php if(count($PHASE)-1<=$key): ?>
                    <hr>
                    <div class="text-center">
                        <button class="btn btn-danger btn-lg" type="button" data-toggle="tooltip" title="Delete phase"
                                onclick="showModalDelete('<?php echo $item['id'];?>','<?php echo 'Phase '.$item['sq'];?>');">Delete</button>
                    </div>

                    <?php endif;?>

                </div>

                <?php endforeach;?>

            </div>

        </div>

    </div>

</div>

<footer class="footer">
    <?php require_once __DIR__.'/_main_footer.php';?>
</footer>

<!-- modal -->
<?php require_once __DIR__.'/modal_delete.php';?>

<!-- main script -->
<?php require_once __DIR__.'/_main_script.php';?>

</body>
</html>
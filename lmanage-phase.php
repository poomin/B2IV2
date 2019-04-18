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

require_once __DIR__.'/controller/managePhaseController.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once __DIR__.'/_main_css.php';?>
    <?php require_once __DIR__.'/_datepicker_css.php';?>
    <?php require_once __DIR__.'/_froala_css.php';?>
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
                    <h2 class="h-c"><i class="fa fa-gear icon-zoom"></i> กำหนดโครงการ</h2>
                    <hr class="style1">
                </div>

                <!-- alert status -->
                <div class="p-0">
                    <?php require_once __DIR__.'/_alert.php';?>
                </div>

                <div class="p-0 text-center">
                    <h5 class="font-weight-bolder"><?php echo $this_main_year.' '.$this_main_name.' ('.$this_main_name_en.')'; ?></h5>
                </div>
                <hr>

                <div class="m-0">

                    <!-- sq / phase -->
                    <div class="form-group row">
                        <label for="attrSqId" class="col-sm-3 col-form-label font-weight-bolder text-right">รอบที่ (phase) : </label>
                        <div class="col-sm-9">
                            <input type="text" name="sq" class="form-control" id="attrSqId" value="<?php echo $this_sq;?>" disabled>
                        </div>
                    </div>

                    <!-- title -->
                    <div class="form-group row">
                        <label for="attrTitleId" class="col-sm-3 col-form-label font-weight-bolder text-right">หัวข้อ :</label>
                        <div class="col-sm-9">
                            <input id="attrTitleId" type="text" name="title" class="form-control"  value="<?php echo $this_title;?>">
                        </div>
                    </div>

                    <!-- upload -->
                    <div class="form-inline">
                        <div class="col-sm-3 text-right">
                            <p class="font-weight-bolder pt-2" > ไฟล์อัพโหลด:</p>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="upload_doc" id="idUploadDoc" value="Y" <?php echo $this_doc=='Y'?'checked':'';?> >
                            <label class="form-check-label" for="idUploadDoc">Doc</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="upload_pdf" id="idUploadPdf" value="Y" <?php echo $this_pdf=='Y'?'checked':'';?> >
                            <label class="form-check-label" for="idUploadPdf">Pdf</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="upload_image" id="idUploadImage" value="Y" <?php echo $this_image=='Y'?'checked':'';?> >
                            <label class="form-check-label" for="idUploadImage">Image</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="upload_video" id="idUploadVideo" value="Y" <?php echo $this_video=='Y'?'checked':'';?> >
                            <label class="form-check-label" for="idUploadImage">Video</label>
                        </div>
                    </div>

                    <!-- date -->
                    <div class="row">
                        <div class="col-3 text-right">
                            <p class="font-weight-bolder pt-2" > วันที่ดำเนินการ:</p>
                        </div>
                        <div class="col-4">
                            <div class="form-inline">
                                <label class="my-1 mr-2" for="idDateStart"> เริ่ม <i class="fa fa-calendar ml-1"></i></label>
                                <input type="text" class="datepicker form-control" id="idDateStart" value="<?php echo $this_date_start;?>">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-inline">
                                <label class="my-1 mr-2" for="idDateEnd"> สิ้นสุด <i class="fa fa-calendar ml-1"></i></label>
                                <input type="text" class="datepicker form-control" id="idDateEnd" value="<?php echo $this_date_end;?>">
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-3 text-right">
                        <p class="font-weight-bolder pt-2" > รายละเอียด:</p>
                    </div>
                    <div class="col-9"></div>
                </div>

                <div class="p-0">
                    <div id="editor">
                        <div id='edit'>
                            <?php echo $this_detail;?>
                        </div>
                    </div>
                </div>

                <div class="text-center pt-5">
                    <input id="attrMainId" type="text" name="main_id" value="<?php echo $this_main_id;?>" hidden>
                    <button class="btn btn-success btn-lg" type="button" onclick="createPhase();"> SAVE </button>
                </div>


            </div>

        </div>

    </div>

</div>

<footer class="footer">
    <?php require_once __DIR__.'/_main_footer.php';?>
</footer>


<!-- main script -->
<?php
require_once __DIR__.'/_main_script.php';
require_once __DIR__.'/_datepicker_script.php';
require_once __DIR__.'/_froala_script.php';
?>


<script>
    $(function() {
        $('#edit').froalaEditor({
            heightMin: 250,
        });
        $('.datepicker').datepicker({
            format: 'dd/mm/yyyy',
            language: 'th',
            orientation: 'bottom'
        });
    });

    function createPhase() {
        var mainId = $('#attrMainId').val();
        var sq = $('#attrSqId').val();
        var title = $('#attrTitleId').val();
        var pdf = ($('#idUploadPdf').prop('checked'))?'Y':'N';
        var doc = ($('#idUploadDoc').prop('checked'))?'Y':'N';
        var image = ($('#idUploadImage').prop('checked'))?'Y':'N';
        var video = ($('#idUploadVideo').prop('checked'))?'Y':'N';
        var dateStart = $('#idDateStart').val();
        var dateEnd = $('#idDateEnd').val();

        if(title=='') {
            alert("Please input title.");
            $('#attrTitleId').focus();
        }else if(dateStart==''){
            alert("Please input date start.");
            $('#idDateStart').focus();
        }else if(dateEnd==''){
            alert("Please input date end.");
            $('#idDateEnd').focus();
        }else {

            var text = $('#edit').froalaEditor('html.get');
            var req = $.ajax({
                type: 'POST',
                url: './service/API.php',
                data: {
                    fn: 'insertUpdatePhase',
                    mainId: mainId,
                    sq: sq,
                    title: title,
                    detail: text,
                    image: image,
                    doc: doc,
                    pdf: pdf,
                    video: video,
                    dateStart: dateStart,
                    dateEnd : dateEnd
                },
                dataType: 'JSON'
            });
            req.done(function (res) {
                if(res.status){
                    alert('save complete...');
                    window.location.href = '/lmanage-phase.php?sq='+sq;
                }else{
                    alert('save false!!!!');
                }
            });
        }

    }


</script>

</body>
</html>
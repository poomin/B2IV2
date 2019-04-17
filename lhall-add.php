<?php
/**
 * Created by PhpStorm.
 * User: PF0T4E5G
 * Date: 28/3/2562
 * Time: 07:02 หลังเที่ยง
 */
require_once __DIR__.'/_session.php';
require_once __DIR__.'/_session_login.php';

$MENU_LEFT = 'hall';

require_once __DIR__.'/controller/hallAddController.php';


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    require_once __DIR__.'/_main_css.php';
    require_once __DIR__.'/_froala_css.php';
    ?>


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
                    <h2 class="h-c"><i class="fa fa-file-video-o icon-zoom"></i>Hall of fame</h2>
                    <hr class="style1">
                </div>
                <div class="p-0">

                    <!-- show image -->
                    <div class="text-center pb-3">
                        <img id="imageShow" src="<?php echo $this_image;?>" alt="image" style="width: 300px;">
                    </div>
                    <!-- form upload image -->
                    <div id="loadFileImage" class="text-center">
                        <div class="form-inline" id="show_progressBar_image" hidden>
                            <div class="progress" style="float:left; width: 90%; margin-right: 5px;">
                                <div id="progressBar_image" class="progress-bar" role="progressbar"
                                     aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
                                     style="width: 0%;">0%
                                </div>
                            </div>
                            <button type="button" class="btn btn-danger btn-sm"
                                    onclick="cancelUploadFile()">
                                <span class="fa fa-remove"></span>
                            </button>
                        </div>
                        <div id="image">
                            <div class="box-img-ready">
                                <label class="rounded alert-info p-2" style="cursor: pointer;" for="file_image">
                                    <h4 id="upload_image"><span class="label"><i class="fa fa-upload"></i> Image Upload</span></h4>
                                    <input id="file_image" accept="image/*" type="file" style="display:none;" onchange="showLoadImage(this)">
                                </label>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="form-group">
                        <label class="label-control">ชื่อโครงการ (TH)</label>
                        <input id="idInputNameTh" class="form-control" type="text" name="name" value="<?php echo $this_project_name;?>" >
                    </div>
                    <div class="form-group">
                        <label class="label-control">ชื่อโครงการ (EN)</label>
                        <input id="idInputNameEn" class="form-control" type="text" name="name_en" value="<?php echo $this_project_name_en;?>" >
                    </div>

                    <div class="form-group">
                        <label class="label-control">อาจารย์ / ที่ปรึกษาโครงการ</label>
                        <input id="idInputAdviser" class="form-control" type="text" name="adviser" value="<?php echo $this_adviser;?>" >
                    </div>

                    <div class="row">
                        <div class="form-group col-6">
                            <label class="label-control">1. นักเรียน/นักศึกษา</label>
                            <input id="idInputStudent1" class="form-control" type="text" name="student_1" value="<?php echo $this_student_1;?>" >
                        </div>
                        <div class="form-group col-6">
                            <label class="label-control">2. นักเรียน/นักศึกษา</label>
                            <input id="idInputStudent2" class="form-control" type="text" name="student_2" value="<?php echo $this_student_2;?>" >
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-6">
                            <label class="label-control">3. นักเรียน/นักศึกษา</label>
                            <input id="idInputStudent3" class="form-control" type="text" name="student_3" value="<?php echo $this_student_3;?>" >
                        </div>
                        <div class="form-group col-6">
                            <label class="label-control">4. นักเรียน/นักศึกษา</label>
                            <input id="idInputStudent4" class="form-control" type="text" name="student_4" value="<?php echo $this_student_4;?>" >
                        </div>
                    </div>

                    <div class="p-0 pt-3">
                        <p>รายละเอียดโครงการ</p>
                        <div id="editor">
                            <div id='edit'>
                                <?php echo $this_detail;?>
                            </div>
                        </div>
                    </div>

                    <div class="text-center pt-3">
                        <?php if($this_hall_id==''): ?>
                            <button class="btn btn-lg btn-success" type="button" onclick="addHall();"> SAVE HALL </button>
                        <?php else: ?>
                            <input id="idInputHallId" type="text" name="hall_id" value="<?php echo $this_hall_id; ?>" hidden>
                            <button class="btn btn-lg btn-warning" type="button" onclick="editHall();"> EDIT HALL </button>
                        <?php endif; ?>
                    </div>


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
require_once __DIR__.'/_froala_script.php';
?>


<script>
    var ajax_image;
    function showLoadImage(input) {
        if (input.files && input.files[0]) {
            ajax_image = new XMLHttpRequest();

            $('#show_progressBar_image').removeAttr('hidden');
            var progressBar = "progressBar_image";

            var form_data = new FormData();
            form_data.append("fileToUpload", input.files[0]);
            ajax_image.upload.addEventListener("progress", progressHandler, false);
            ajax_image.addEventListener("load", completeHandler, false);
            ajax_image.addEventListener("error", errorHandler, false);
            ajax_image.addEventListener("abort", abortHandler, false);
            ajax_image.open("POST","/upload/upload_file.php?type=hall");
            ajax_image.send(form_data);

            function progressHandler(event) {
                var percent = (event.loaded / event.total) * 100;
                $("#" + progressBar).css('width', Math.round(percent) + "%");
                $("#" + progressBar).html(Math.round(percent) + "%");
            }

            function completeHandler(event) {
                var data_return = JSON.parse(event.target.responseText);
                if (data_return['status'] == 'ok') {
                    var src = '/upload/hall/'+data_return['new_name'];
                    $('#imageShow').attr('src',src);

                    $('#show_progressBar_image').attr('hidden',true);
                    $("#" + progressBar).css('width', "0%");
                    $("#" + progressBar).html("0%");

                    $('#loadFileImage').addClass('hidden');
                    $('#saveLoadFileImage').removeClass('hidden');


                } else {
                    ajax_image.abort();
                    alert("Error:" + data_return['message']);
                    $("#" + progressBar).css('width', "0%");
                    $("#" + progressBar).html("0%");
                }
            }

            function errorHandler(event) {
                ajax_image.abort();
                alert("Upload Failed");
                $('#show_progressBar_image').attr('hidden',true);
                $("#" + progressBar).css('width', "0%");
                $("#" + progressBar).html("0%");

            }

            function abortHandler(event) {
                ajax_image.abort();
                alert("Upload Aborted");
                $('#show_progressBar_image').attr('hidden',true);
                $("#" + progressBar).css('width', "0%");
                $("#" + progressBar).html("0%");
            }

        }
        else {
            alert("Not found file input!!!");
        }

    }
    function cancelUploadFile() {
        ajax_image.abort();
        $('#show_progressBar_image').attr('hidden',true);
        $("#file_image").val("");
    }

    $(function() {
        $('#edit').froalaEditor({
            heightMin: 250,
        });
    });

    function addHall() {
        var idInputNameTh = $('#idInputNameTh').val();
        var idInputNameEn = $('#idInputNameEn').val();
        var image = $('#imageShow').attr('src');
        var idInputAdviser = $('#idInputAdviser').val();
        var idInputStudent1 = $('#idInputStudent1').val();
        var idInputStudent2 = $('#idInputStudent2').val();
        var idInputStudent3 = $('#idInputStudent3').val();
        var idInputStudent4 = $('#idInputStudent4').val();
        if(idInputNameTh==''){
            alert("Please input data !!");
        }else{
            var text = $('#edit').froalaEditor('html.get');
            var req = $.ajax({
                type: 'POST',
                url: './service/API.php',
                data: {
                    fn: 'addHall',
                    project_name: idInputNameTh,
                    project_name_en: idInputNameEn,
                    image: image,
                    adviser_name: idInputAdviser,
                    student_1: idInputStudent1,
                    student_2: idInputStudent2,
                    student_3: idInputStudent3,
                    student_4: idInputStudent4,
                    detail: text
                },
                dataType: 'JSON'
            });
            req.done(function (res) {
                if(res.status){
                    alert('save hall complete...');
                    window.location.href = '/lhall-add.php?hid='+res.id;
                }else{
                    alert('save hall false!!!!');
                }
            });
        }
    }

    function editHall() {
        var idInputHallId = $('#idInputHallId').val();
        var idInputNameTh = $('#idInputNameTh').val();
        var idInputNameEn = $('#idInputNameEn').val();
        var image = $('#imageShow').attr('src');
        var idInputAdviser = $('#idInputAdviser').val();
        var idInputStudent1 = $('#idInputStudent1').val();
        var idInputStudent2 = $('#idInputStudent2').val();
        var idInputStudent3 = $('#idInputStudent3').val();
        var idInputStudent4 = $('#idInputStudent4').val();
        if(idInputNameTh==''){
            alert("Please input data !!");
        }else{
            var text = $('#edit').froalaEditor('html.get');
            var req = $.ajax({
                type: 'POST',
                url: './service/API.php',
                data: {
                    fn: 'editHall',
                    hall_id: idInputHallId,
                    project_name: idInputNameTh,
                    project_name_en: idInputNameEn,
                    image: image,
                    adviser_name: idInputAdviser,
                    student_1: idInputStudent1,
                    student_2: idInputStudent2,
                    student_3: idInputStudent3,
                    student_4: idInputStudent4,
                    detail: text
                },
                dataType: 'JSON'
            });
            req.done(function (res) {
                if(res.status){
                    alert('Edit hall complete...');
                    window.location.href = '/lhall-add.php?hid='+idInputHallId;
                }else{
                    alert('Edit hall false!!!!');
                }
            });
        }
    }


</script>

</body>
</html>
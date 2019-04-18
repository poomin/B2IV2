<?php
/**
 * Created by PhpStorm.
 * User: PF0T4E5G
 * Date: 28/3/2562
 * Time: 07:02 หลังเที่ยง
 */
require_once __DIR__.'/_session.php';
require_once __DIR__.'/_session_login.php';

$MENU_LEFT = 'image';

require_once __DIR__.'/controller/imageController.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once __DIR__.'/_main_css.php';?>
</head>
<body>

<!-- loader -->
<?php //require_once __DIR__.'/_main_loader.php';?>


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
                    <h2 class="h-c"><i class="fa fa-file-image-o icon-zoom"></i> Home image</h2>
                    <hr class="style1">
                </div>

                <!-- alert status -->
                <div class="p-1">
                    <?php require_once __DIR__.'/_alert.php';?>
                </div>
                <div class="p-0">
                    <a href="#">Download Background image</a>
                </div>

                <div class="p-0">
                    <div class="row">
                        <?php foreach ($IMAGES as $key=>$item): ?>
                        <div class="col-3 p-2">
                            <div class="card">
                                <img src="<?php echo $item['web_image'];?>" class="card-img-top" alt="web image" >
                                <div class="card-footer text-center">
                                    <?php
                                    $item_id = $item['id'];
                                    $img = $item['web_image'];
                                    $item_text = "<br><div class=\'text-center\'><img src=\'$img\' style=\'height: 150px;\' ></div>";
                                    ?>
                                    <button class="btn btn-danger btn-sm" data-toggle="tooltip" title="Delete image"
                                            onclick="showModalDelete('<?php echo $item_id;?>','<?php echo $item_text;?>');" >
                                        <i class="fa fa-remove"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <hr>

                <div class="p-0">

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
                                    <input id="file_image" web_id="<?php echo $SET_WEB;?>" accept="image/*" type="file" style="display:none;" onchange="showLoadImage(this)">
                                </label>
                            </div>
                        </div>
                    </div>

                </div>

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


<script>
    var ajax_image;
    function showLoadImage(input) {
        if (input.files && input.files[0]) {
            ajax_image = new XMLHttpRequest();

            $('#show_progressBar_image').removeAttr('hidden');
            var progressBar = "progressBar_image";
            var web_id = input.getAttribute("web_id");

            var form_data = new FormData();
            form_data.append("fileToUpload", input.files[0]);
            ajax_image.upload.addEventListener("progress", progressHandler, false);
            ajax_image.addEventListener("load", completeHandler, false);
            ajax_image.addEventListener("error", errorHandler, false);
            ajax_image.addEventListener("abort", abortHandler, false);
            ajax_image.open("POST","/upload/upload_file.php?type=web");
            ajax_image.send(form_data);

            function progressHandler(event) {
                var percent = (event.loaded / event.total) * 100;
                $("#" + progressBar).css('width', Math.round(percent) + "%");
                $("#" + progressBar).html(Math.round(percent) + "%");
            }

            function completeHandler(event) {
                var data_return = JSON.parse(event.target.responseText);
                if (data_return['status'] == 'ok') {
                    var src = '/upload/web/'+data_return['new_name'];
                    //$('#imageShow').attr('src',src+'?'+(Math.floor((Math.random()*10000)+1)));

                    $('#show_progressBar_image').attr('hidden',true);
                    $("#" + progressBar).css('width', "0%");
                    $("#" + progressBar).html("0%");

                    $('#loadFileImage').addClass('hidden');
                    $('#saveLoadFileImage').removeClass('hidden');

                    updateImage(web_id,src);

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
    function updateImage(wid,src) {
        var req = $.ajax({
            type: 'POST',
            url: '/service/API.php',
            data: {
                fn: 'addWebImage',
                wid: wid,
                src: src
            },
            dataType: 'JSON'
        });
        req.done(function (res) {
            if(res.status){
                alert('Update image success.');
                window.location.reload();
            }else{
                alert('Update image false!!!!');
            }
        });
    }

</script>

</body>
</html>
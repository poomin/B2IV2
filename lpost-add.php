<?php
/**
 * Created by PhpStorm.
 * User: PF0T4E5G
 * Date: 28/3/2562
 * Time: 07:02 หลังเที่ยง
 */

require_once __DIR__.'/_session.php';
require_once __DIR__.'/_session_login.php';

$MENU_LEFT = 'post';

require_once __DIR__.'/controller/postAddController.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once __DIR__.'/_main_css.php';?>

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
                    <h2 class="h-c"><i class="fa fa-newspaper-o icon-zoom"></i> เพิ่ม ข่าว / ประกาศ</h2>
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
                                    <input id="file_image" user_id="<?php echo $this_user_id;?>" accept="image/*" type="file" style="display:none;" onchange="showLoadImage(this)">
                                </label>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="form-group">
                        <label class="label-control">Type</label>
                        <select id="idSelectType" class="form-control" name="type">
                            <option value="ข่าว" <?php echo $this_news_type=='ข่าว'?'selected':'';?> >ข่าว</option>
                            <option value="ประกาศ" <?php echo $this_news_type=='ประกาศ'?'selected':'';?> >ประกาศ</option>
                            <option value="บทความ" <?php echo $this_news_type=='บทความ'?'selected':'';?> >บทความ</option>
                        </select>

                    </div>

                    <div class="form-group">
                        <label class="label-control">Title</label>
                        <input id="idInputTitle" class="form-control" type="text" name="title" value="<?php echo $this_title;?>" >
                    </div>


                    <div class="p-0 pt-5">
                        <div id="editor">
                            <div id='edit'>
                                <?php echo $this_detail;?>
                            </div>
                        </div>
                    </div>

                    <div class="text-center pt-4">

                        <?php if($this_function=='edit'): ?>
                            <input id="idInputNewsId" type="text" name="news_id" value="<?php echo $this_news_id; ?>" hidden>
                            <button type="button" class="btn btn-lg btn-warning" onclick="editNews();">EDIT NEWS</button>
                        <?php else: ?>
                            <button type="button" class="btn btn-lg btn-success" onclick="addNews();">SAVE NEWS</button>
                        <?php endif;?>

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
            $('#show_progressBar_image').removeAttr('hidden');
            ajax_image = new XMLHttpRequest();
            var progressBar = "progressBar_image";

            var form_data = new FormData();
            form_data.append("fileToUpload", input.files[0]);
            ajax_image.upload.addEventListener("progress", progressHandler, false);
            ajax_image.addEventListener("load", completeHandler, false);
            ajax_image.addEventListener("error", errorHandler, false);
            ajax_image.addEventListener("abort", abortHandler, false);
            ajax_image.open("POST","/upload/upload_file.php?type=news");
            ajax_image.send(form_data);

            function progressHandler(event) {
                var percent = (event.loaded / event.total) * 100;
                $("#" + progressBar).css('width', Math.round(percent) + "%");
                $("#" + progressBar).html(Math.round(percent) + "%");
            }

            function completeHandler(event) {
                var data_return = JSON.parse(event.target.responseText);
                if (data_return['status'] == 'ok') {
                    var src = '/upload/news/'+data_return['new_name'];
                    $('#imageShow').attr('src',src+'?'+(Math.floor((Math.random()*10000)+1)));

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

    function addNews() {
        var title = $('#idInputTitle').val();
        var image = $('#imageShow').attr('src');
        var type = $('#idSelectType').val();
        if(title==''){
            alert("Please input title !!");
        }else{
            var text = $('#edit').froalaEditor('html.get');
            var req = $.ajax({
                type: 'POST',
                url: './service/API.php',
                data: {
                    fn: 'addNews',
                    title: title,
                    image: image,
                    detail: text,
                    type: type
                },
                dataType: 'JSON'
            });
            req.done(function (res) {
                if(res.status){
                    alert('save news complete...');
                    window.location.href = '/lpost-add.php?id='+res.id;
                }else{
                    alert('save news false!!!!');
                }
            });
        }
    }

    function editNews() {
        var title = $('#idInputTitle').val();
        var image = $('#imageShow').attr('src');
        var type = $('#idSelectType').val();
        var news_id = $('#idInputNewsId').val();
        if(title==''){
            alert("Please input title !!");
        }else{
            var text = $('#edit').froalaEditor('html.get');
            var req = $.ajax({
                type: 'POST',
                url: './service/API.php',
                data: {
                    fn: 'editNews',
                    newsId: news_id,
                    title: title,
                    image: image,
                    detail: text,
                    type: type
                },
                dataType: 'JSON'
            });
            req.done(function (res) {
                if(res.status){
                    alert('Edit news complete...');
                    window.location.href = '/lpost-add.php?id='+news_id;
                }else{
                    alert('Edit news false!!!!');
                }
            });
        }
    }



</script>

</body>
</html>
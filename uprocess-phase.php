<?php
/**
 * Created by PhpStorm.
 * User: PF0T4E5G
 * Date: 28/3/2562
 * Time: 07:02 หลังเที่ยง
 */
require_once __DIR__.'/_session.php';
require_once __DIR__.'/_session_login.php';

$MENU_LEFT = 'uprocess';

require_once __DIR__.'/controller/userPhaseUploadController.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once __DIR__.'/_main_css.php';?>

    <link rel="stylesheet" href="/lib/froala/css/froala_style.css">

    <?php require_once __DIR__.'/_datatable_css.php';?>

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

                <!-- show detail phase setup -->
                <div class="p-0">
                    <div class="fr-view">
                        <?php echo $this_mp_detail;?>
                    </div>
                    <div>
                        <p>ระยะเวลา <?php echo date('d/m/Y',strtotime($this_mp_start)).' - '.date('d/m/Y',strtotime($this_mp_end));?></p>
                    </div>
                </div>

                <hr>

                <!-- show project header -->
                <div class="p-0">
                    <div class="text-center p-1">
                        <h5 class="font-weight-bolder h-c"><?php echo $this_pro_name;?></h5>
                        <h5 class="h-c">( <?php echo $this_pro_name_en;?> )</h5>
                        <?php
                        if(strtoupper($_STATUS)=='FAIL')$classT='text-danger';
                        if(strtoupper($_STATUS)=='PASS')$classT='text-success';
                        if(strtoupper($_STATUS)=='OPEN')$classT='text-primary';
                        if(strtoupper($_STATUS)=='WAIT')$classT='text-warning';
                        ?>
                        <p class="font-weight-bolder <?php echo $classT;?>">Status: <?php echo strtoupper(strtoupper($_STATUS));?></p>
                    </div>
                    <hr class="style1">
                </div>

                <!-- alert status -->
                <div class="p-0">
                    <?php require_once __DIR__.'/_alert.php';?>
                </div>

                <?php if($this_phase_status=="PASS"):?>
                <div class="pt-1">
                    <div class="alert alert-success" role="alert">
                        <h4 class="alert-heading">Pass</h4>
                        <hr>
                        <pre><?php echo $this_phase_message;?></pre>
                    </div>
                </div>
                <?php endif;?>

                <!-- upload doc -->
                <?php if(strtoupper($this_mp_doc)=='Y'): ?>
                <div class="pt-3">
                    <div class="p-3">
                        <h5>อัพโหลดเอกสาร (word,powerpoint)</h5>
                    </div>

                    <table class="this-table table table-striped table-bordered w-100">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>File upload</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($DOCS as $key=>$item): ?>
                            <tr>
                                <td><?php echo ($key+1); ?></td>
                                <td>
                                    <a href="<?php echo $item['upload_path'];?>" target="_blank">
                                    <?php echo $item['upload_name']; ?>
                                    </a>
                                </td>
                                <td>
                                    <?php if(strtoupper($_STATUS)=='OPEN'): ?>
                                    <button class="btn btn-danger btn-sm" type="button" data-toggle="tooltip" title="Delete Doc"
                                            onclick="showModalDelete('<?php echo $item['id'];?>','<?php echo $item['upload_name'];?>');">
                                        <i class="fa fa-remove"></i>
                                    </button>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach;?>
                        </tbody>
                    </table>

                    <?php if(strtoupper($_STATUS)=='OPEN'): ?>
                    <!-- show name file -->
                    <form method="post" id="formDocId" hidden>
                        <div class="form-row">
                            <div class="offset-3 col">
                                <input id="nameDocId" type="text" name="nameFile" class="form-control" placeholder="File name" required>
                            </div>
                            <div class="col">
                                <input type="text" name="phase_id" value="<?php echo $this_phase_id; ?>" hidden>
                                <input type="text" name="type" value="DOC" hidden>
                                <input id="pathDocId" type="text" name ="path" value="" hidden>
                                <input type="text" name ="fn" value="addDoc" hidden>
                                <button class="btn btn-success" type="submit">Save</button>
                                <button class="btn btn-secondary" type="button" onclick="cancelSaveDoc();">Cancel</button>
                            </div>
                        </div>
                    </form>
                    <!-- form upload doc -->
                    <div id="uploadDocId" class="text-center pt-3">
                        <div class="form-inline" id="show_progressBar_doc" hidden>
                            <div class="progress" style="float:left; width: 90%; margin-right: 5px;">
                                <div id="progressBar_doc" class="progress-bar" role="progressbar"
                                     aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
                                     style="width: 0%;">0%
                                </div>
                            </div>
                            <button type="button" class="btn btn-danger btn-sm"
                                    onclick="cancelUploadDoc()">
                                <span class="fa fa-remove"></span>
                            </button>
                        </div>
                        <div id="showButtonDoc">
                            <div class="box-img-ready">
                                <label class="rounded alert-info p-2" style="cursor: pointer;" for="file_doc">
                                    <h5 id="upload_doc">
                                        <span class="label"><i class="fa fa-file-powerpoint-o"></i> Upload</span>
                                    </h5>
                                    <input id="file_doc" accept=".pot,.potm,.potx,.pps,.ppsm,.ppsx,.ppt,.pptm,.pptx,.doc,.docm,.docx,.dot" type="file" style="display:none;" onchange="showLoadDoc(this)">
                                </label>
                            </div>
                        </div>
                    </div>
                    <?php endif;?>

                    <hr class="style1">
                </div>
                <?php endif;?>

                <!-- upload PDF -->
                <?php if(strtoupper($this_mp_pdf)=='Y'): ?>
                <div class="pt-3">
                    <div class="p-3">
                        <h5>อัพโหลดเอกสาร (PDF)</h5>
                    </div>

                    <table class="this-table table table-striped table-bordered w-100">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>File upload</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($PDFS as $key=>$item): ?>
                            <tr>
                                <td><?php echo ($key+1); ?></td>
                                <td>
                                    <a href="<?php echo $item['upload_path'];?>" target="_blank">
                                    <?php echo $item['upload_name']; ?>
                                    </a>
                                </td>
                                <td>
                                    <?php if(strtoupper($_STATUS)=='OPEN'): ?>
                                    <button class="btn btn-danger btn-sm" type="button" data-toggle="tooltip" title="Delete Pdf"
                                            onclick="showModalDelete('<?php echo $item['id'];?>','<?php echo $item['upload_name'];?>');">
                                        <i class="fa fa-remove"></i>
                                    </button>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach;?>
                        </tbody>
                    </table>

                    <?php if(strtoupper($_STATUS)=='OPEN'): ?>
                    <!-- show name file -->
                    <form method="post" id="formPdfId" hidden>
                        <div class="form-row">
                            <div class="offset-3 col">
                                <input id="namePdfId" type="text" name="nameFile" class="form-control" placeholder="File name" required>
                            </div>
                            <div class="col">
                                <input type="text" name="phase_id" value="<?php echo $this_phase_id; ?>" hidden>
                                <input type="text" name="type" value="PDF" hidden>
                                <input id="pathPdfId" type="text" name ="path" value="" hidden>
                                <input type="text" name ="fn" value="addPdf" hidden>
                                <button class="btn btn-success" type="submit">Save</button>
                                <button class="btn btn-secondary" type="button" onclick="cancelSavePdf();">Cancel</button>
                            </div>
                        </div>
                    </form>
                    <!-- form upload pdf -->
                    <div id="uploadPdfId" class="text-center pt-3">
                        <div class="form-inline" id="show_progressBar_pdf" hidden>
                            <div class="progress" style="float:left; width: 90%; margin-right: 5px;">
                                <div id="progressBar_pdf" class="progress-bar" role="progressbar"
                                     aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
                                     style="width: 0%;">0%
                                </div>
                            </div>
                            <button type="button" class="btn btn-danger btn-sm"
                                    onclick="cancelUploadPdf()">
                                <span class="fa fa-remove"></span>
                            </button>
                        </div>
                        <div id="showButtonPdf">
                            <div class="box-img-ready">
                                <label class="rounded alert-info p-2" style="cursor: pointer;" for="file_pdf">
                                    <h5 id="upload_pdf">
                                        <span class="label"><i class="fa fa-file-pdf-o"></i> Upload</span>
                                    </h5>
                                    <input id="file_pdf" accept="application/pdf" type="file" style="display:none;" onchange="showLoadPdf(this)">
                                </label>
                            </div>
                        </div>
                    </div>
                    <?php endif;?>

                    <hr class="style1">
                </div>
                <?php endif;?>

                <!-- upload Image -->
                <?php if(strtoupper($this_mp_img)=='Y'): ?>
                <div class="pt-3">
                    <div class="p-3">
                        <h5>อัพโหลดรูปภาพ (PNG,JPG)</h5>
                    </div>

                    <table class="this-table table table-striped table-bordered w-100">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>File upload</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($IMAGES as $key=>$item): ?>
                            <tr>
                                <td><?php echo ($key+1); ?></td>
                                <td class="text-center">
                                    <img class="img-thumbnail rounded" src="<?php echo $item['upload_path'];?>" style="height: 80px;">
                                </td>
                                <td>
                                    <a href="<?php echo $item['upload_path'];?>" target="_blank">
                                    <?php echo $item['upload_name']; ?>
                                    </a>
                                </td>
                                <td>
                                    <?php if(strtoupper($_STATUS)=='OPEN'): ?>
                                    <button class="btn btn-danger btn-sm" type="button" data-toggle="tooltip" title="Delete Pdf"
                                            onclick="showModalDelete('<?php echo $item['id'];?>','<?php echo $item['upload_name'];?>');">
                                        <i class="fa fa-remove"></i>
                                    </button>
                                    <?php endif;?>
                                </td>
                            </tr>
                        <?php endforeach;?>
                        </tbody>
                    </table>

                    <?php if(strtoupper($_STATUS)=='OPEN'): ?>
                    <!-- show name file -->
                    <form method="post" id="formImageId" hidden>
                        <div class="form-row">
                            <div class="offset-4 col-3 text-center">
                                <img id="imgImageId" class="img-thumbnail rounded" src="/upload/news/null.png" style="height: 120px;">
                            </div>
                        </div>
                        <div class="form-row pt-3">
                            <div class="offset-3 col">
                                <input id="nameImageId" type="text" name="nameFile" class="form-control" placeholder="File name" required>
                            </div>
                            <div class="col">
                                <input type="text" name="phase_id" value="<?php echo $this_phase_id; ?>" hidden>
                                <input type="text" name="type" value="IMAGE" hidden>
                                <input id="pathImageId" type="text" name ="path" value="" hidden>
                                <input type="text" name ="fn" value="addImage" hidden>
                                <button class="btn btn-success" type="submit">Save</button>
                                <button class="btn btn-secondary" type="button" onclick="cancelSaveImage();">Cancel</button>
                            </div>
                        </div>
                    </form>
                    <!-- form upload Image -->
                    <div id="uploadImageId" class="text-center pt-3">
                        <div class="form-inline" id="show_progressBar_image" hidden>
                            <div class="progress" style="float:left; width: 90%; margin-right: 5px;">
                                <div id="progressBar_image" class="progress-bar" role="progressbar"
                                     aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
                                     style="width: 0%;">0%
                                </div>
                            </div>
                            <button type="button" class="btn btn-danger btn-sm"
                                    onclick="cancelUploadImage()">
                                <span class="fa fa-remove"></span>
                            </button>
                        </div>
                        <div id="showButtonImage">
                            <div class="box-img-ready">
                                <label class="rounded alert-info p-2" style="cursor: pointer;" for="file_image">
                                    <h5 id="upload_image">
                                        <span class="label"><i class="fa fa-file-image-o"></i> Upload</span>
                                    </h5>
                                    <input id="file_image" accept="image/*" type="file" style="display:none;" onchange="showLoadImage(this)">
                                </label>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>

                    <hr class="style1">
                </div>
                <?php endif;?>

                <!-- upload rul youtube -->
                <?php if(strtoupper($this_mp_video)=='Y'): ?>
                <div class="pt-3">
                    <div class="p-3">
                        <h5>อัพโหลดวีดีโอ (url youtube)</h5>
                    </div>

                    <table class="this-table table table-striped table-bordered w-100">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Video</th>
                            <th>File upload</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($VIDEOS as $key=>$item): ?>
                            <tr>
                                <td><?php echo ($key+1); ?></td>
                                <td class="text-center">
                                    <div class="embed-responsive embed-responsive-16by9">
                                        <iframe id="videoShow" class="embed-responsive-item" src="<?php echo $item['upload_path'];?>" ></iframe>
                                    </div>
                                </td>
                                <td>
                                    <a href="<?php echo $item['upload_path'];?>" target="_blank">
                                    <?php echo $item['upload_name']; ?>
                                    </a>
                                </td>
                                <td>
                                    <?php if(strtoupper($_STATUS)=='OPEN'): ?>
                                    <button class="btn btn-danger btn-sm" type="button" data-toggle="tooltip" title="Delete Pdf"
                                            onclick="showModalDelete('<?php echo $item['id'];?>','<?php echo $item['upload_name'];?>');">
                                        <i class="fa fa-remove"></i>
                                    </button>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach;?>
                        </tbody>
                    </table>

                    <?php if(strtoupper($_STATUS)=='OPEN'): ?>
                    <form method="post" id="formVideoId" hidden>
                        <div class="form-row">
                            <div class="offset-4 col-3 text-center">
                                <div class="embed-responsive embed-responsive-16by9">
                                    <iframe id="videoShow" class="embed-responsive-item" src="" ></iframe>
                                </div>
                            </div>
                        </div>
                        <div class="form-row pt-3">
                            <div class="offset-3 col">
                                <input id="file_video" type="text" name="nameFile" class="form-control" placeholder="File name" required>
                            </div>
                            <div class="col">
                                <input type="text" name="phase_id" value="<?php echo $this_phase_id; ?>" hidden>
                                <input type="text" name="type" value="VIDEO" hidden>
                                <input id="pathVideoId" type="text" name ="path" value="" hidden>
                                <input type="text" name ="fn" value="addVideo" hidden>
                                <button class="btn btn-success" type="submit">Save</button>
                                <button class="btn btn-secondary" type="button" onclick="cancelSaveVideo();">Cancel</button>
                            </div>
                        </div>
                    </form>
                    <div class="text-center" id="uploadVideoId">
                        <button class="btn btn-info btn-lg" type="button" onclick="showLoadVideo();">
                            <i class="fa fa-file-video-o"></i> Upload
                        </button>
                    </div>
                    <?php endif; ?>

                    <hr class="style1">
                </div>
                <?php endif;?>



            </div>

        </div>

    </div>

</div>

<footer class="footer">
    <?php require_once __DIR__.'/_main_footer.php';?>
</footer>

<!-- modal -->
<?php

require_once __DIR__.'/modal_delete.php';

require_once __DIR__.'/modal_youtube.php';

?>


<!-- main script -->
<?php require_once __DIR__.'/_main_script.php';?>

<?php require_once __DIR__.'/_datatable_script.php';?>

<script>

    $(document).ready(function() {
        $('.this-table').DataTable();
    } );


    var ajax_doc;
    function showLoadDoc(input) {
        if (input.files && input.files[0]) {
            $('#show_progressBar_doc').attr('hidden',false);
            $('#showButtonDoc').attr('hidden',true);

            ajax_doc = new XMLHttpRequest();
            var progressBar = "progressBar_doc";

            var _name = input.files[0].name;
            var cut_name = _name.split('.');
            var name_file = cut_name[0];

            var form_data = new FormData();
            form_data.append("fileToUpload", input.files[0]);
            ajax_doc.upload.addEventListener("progress", progressHandler, false);
            ajax_doc.addEventListener("load", completeHandler, false);
            ajax_doc.addEventListener("error", errorHandler, false);
            ajax_doc.addEventListener("abort", abortHandler, false);
            ajax_doc.open("POST","/upload/upload_file.php?type=doc");
            ajax_doc.send(form_data);

            function progressHandler(event) {
                var percent = (event.loaded / event.total) * 100;
                $("#" + progressBar).css('width', Math.round(percent) + "%");
                $("#" + progressBar).html(Math.round(percent) + "%");
            }

            function completeHandler(event) {
                var data_return = JSON.parse(event.target.responseText);
                if (data_return['status'] == 'ok') {

                    var path = '/upload/doc/'+data_return['new_name'];

                    $('#show_progressBar_doc').attr('hidden',true);
                    $('#showButtonDoc').attr('hidden',false);
                    $('#uploadDocId').attr('hidden',true);
                    $('#formDocId').attr('hidden',false);

                    //set for save
                    $('#nameDocId').val(name_file);
                    $('#pathDocId').val(path);


                    $("#" + progressBar).css('width', "0%");
                    $("#" + progressBar).html("0%");

                } else {
                    ajax_doc.abort();
                    alert("Error:" + data_return['message']);
                    $("#" + progressBar).css('width', "0%");
                    $("#" + progressBar).html("0%");
                }
            }

            function errorHandler(event) {
                ajax_doc.abort();
                alert("Upload Failed");
                $('#show_progressBar_doc').attr('hidden',true);
                $("#" + progressBar).css('width', "0%");
                $("#" + progressBar).html("0%");

            }

            function abortHandler(event) {
                ajax_doc.abort();
                alert("Upload Aborted");
                $('#show_progressBar_doc').attr('hidden',true);
                $("#" + progressBar).css('width', "0%");
                $("#" + progressBar).html("0%");
            }
        }
        else {
            alert("Not found file input!!!");
        }
    }
    function cancelUploadDoc() {
        ajax_doc.abort();
        $('#show_progressBar_doc').attr('hidden',true);
        $("#file_doc").val("");
    }
    function cancelSaveDoc() {
        $("#file_doc").val("");
        $('#uploadDocId').attr('hidden',false);
        $('#formDocId').attr('hidden',true);
    }

    var ajax_pdf;
    function showLoadPdf(input) {
        if (input.files && input.files[0]) {
            $('#show_progressBar_pdf').attr('hidden',false);
            $('#showButtonPdf').attr('hidden',true);

            ajax_pdf = new XMLHttpRequest();
            var progressBar = "progressBar_pdf";

            var _name = input.files[0].name;
            var cut_name = _name.split('.');
            var name_file = cut_name[0];

            var form_data = new FormData();
            form_data.append("fileToUpload", input.files[0]);
            ajax_pdf.upload.addEventListener("progress", progressHandler, false);
            ajax_pdf.addEventListener("load", completeHandler, false);
            ajax_pdf.addEventListener("error", errorHandler, false);
            ajax_pdf.addEventListener("abort", abortHandler, false);
            ajax_pdf.open("POST","/upload/upload_file.php?type=pdf");
            ajax_pdf.send(form_data);

            function progressHandler(event) {
                var percent = (event.loaded / event.total) * 100;
                $("#" + progressBar).css('width', Math.round(percent) + "%");
                $("#" + progressBar).html(Math.round(percent) + "%");
            }

            function completeHandler(event) {
                var data_return = JSON.parse(event.target.responseText);
                if (data_return['status'] == 'ok') {

                    var path = '/upload/pdf/'+data_return['new_name'];

                    $('#show_progressBar_pdf').attr('hidden',true);
                    $('#showButtonPdf').attr('hidden',false);
                    $('#uploadPdfId').attr('hidden',true);
                    $('#formPdfId').attr('hidden',false);

                    //set for save
                    $('#namePdfId').val(name_file);
                    $('#pathPdfId').val(path);


                    $("#" + progressBar).css('width', "0%");
                    $("#" + progressBar).html("0%");

                } else {
                    ajax_pdf.abort();
                    alert("Error:" + data_return['message']);
                    $("#" + progressBar).css('width', "0%");
                    $("#" + progressBar).html("0%");
                }
            }

            function errorHandler(event) {
                ajax_pdf.abort();
                alert("Upload Failed");
                $('#show_progressBar_pdf').attr('hidden',true);
                $("#" + progressBar).css('width', "0%");
                $("#" + progressBar).html("0%");

            }

            function abortHandler(event) {
                ajax_pdf.abort();
                alert("Upload Aborted");
                $('#show_progressBar_pdf').attr('hidden',true);
                $("#" + progressBar).css('width', "0%");
                $("#" + progressBar).html("0%");
            }
        }
        else {
            alert("Not found file input!!!");
        }
    }
    function cancelUploadPdf() {
        ajax_pdf.abort();
        $('#show_progressBar_pdf').attr('hidden',true);
        $("#file_pdf").val("");
    }
    function cancelSavePdf() {
        $("#file_pdf").val("");
        $('#uploadPdfId').attr('hidden',false);
        $('#formPdfId').attr('hidden',true);
    }

    var ajax_image;
    function showLoadImage(input) {
        if (input.files && input.files[0]) {
            $('#show_progressBar_image').attr('hidden',false);
            $('#showButtonImage').attr('hidden',true);

            ajax_image = new XMLHttpRequest();
            var progressBar = "progressBar_image";

            var _name = input.files[0].name;
            var cut_name = _name.split('.');
            var name_file = cut_name[0];

            var form_data = new FormData();
            form_data.append("fileToUpload", input.files[0]);
            ajax_image.upload.addEventListener("progress", progressHandler, false);
            ajax_image.addEventListener("load", completeHandler, false);
            ajax_image.addEventListener("error", errorHandler, false);
            ajax_image.addEventListener("abort", abortHandler, false);
            ajax_image.open("POST","/upload/upload_file.php?type=image");
            ajax_image.send(form_data);

            function progressHandler(event) {
                var percent = (event.loaded / event.total) * 100;
                $("#" + progressBar).css('width', Math.round(percent) + "%");
                $("#" + progressBar).html(Math.round(percent) + "%");
            }

            function completeHandler(event) {
                var data_return = JSON.parse(event.target.responseText);
                if (data_return['status'] == 'ok') {

                    var path = '/upload/image/'+data_return['new_name'];

                    $('#imgImageId').attr('src',path);
                    $('#show_progressBar_image').attr('hidden',true);
                    $('#showButtonImage').attr('hidden',false);
                    $('#uploadImageId').attr('hidden',true);
                    $('#formImageId').attr('hidden',false);

                    //set for save
                    $('#nameImageId').val(name_file);
                    $('#pathImageId').val(path);


                    $("#" + progressBar).css('width', "0%");
                    $("#" + progressBar).html("0%");

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
    function cancelUploadImage() {
        ajax_image.abort();
        $('#show_progressBar_image').attr('hidden',true);
        $("#file_image").val("");
    }
    function cancelSaveImage() {
        $("#file_image").val("");
        $('#uploadImageId').attr('hidden',false);
        $('#formImageId').attr('hidden',true);
    }

    function showLoadVideo() {
        $('#input_youtube').val('');
        $('#modalURLYoutube').modal();
    }
    function addUrlYoutube() {
        $('#modalURLYoutube').modal('hide');
        var src = $('#input_youtube').val();
        var src = cutUrlYoutube(src);
        if(src=='no'){
            alert("กรุณาตรวจสอบ URL");
        }else{
            $('#videoShow').attr('src',src);
            $('#pathVideoId').attr('value',src);
            $('#uploadVideoId').attr('hidden',true);
            $('#formVideoId').attr('hidden',false);
        }
    }
    function cutUrlYoutube(str) {
        var str2 = "embed";
        if(str.indexOf(str2) != -1){
            return str;
        }else{
            var cut = str.split('?v=');
            if(cut.length >1){
                return 'https://www.youtube.com/embed/'+cut['1'];
            }else{
                return 'no';
            }
        }
    }
    function cancelSaveVideo() {
        $("#file_video").val("");
        $('#uploadVideoId').attr('hidden',false);
        $('#formVideoId').attr('hidden',true);
    }


</script>

</body>
</html>
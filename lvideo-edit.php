<?php
/**
 * Created by PhpStorm.
 * User: PF0T4E5G
 * Date: 28/3/2562
 * Time: 07:02 หลังเที่ยง
 */
require_once __DIR__.'/_session.php';
require_once __DIR__.'/_session_login.php';

$MENU_LEFT = 'video';

require_once __DIR__.'/controller/videoEditController.php';

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
                    <h2 class="h-c"><i class="fa fa-video-camera icon-zoom"></i> วิดีโอกิจกรรม </h2>
                    <hr class="style1">
                </div>

                <!-- alert status -->
                <div class="p-1">
                    <?php require_once __DIR__.'/_alert.php';?>
                </div>

                <div class="p-0">
                    <div class="row">
                        <?php foreach ($VIDEOS as $key=>$item): ?>
                            <div class="col-6 p-2">
                                <div class="card">
                                    <div class="embed-responsive embed-responsive-16by9">
                                        <iframe class="embed-responsive-item" src="<?php echo $item['video_path'];?>" allowfullscreen></iframe>
                                    </div>
                                    <div class="card-footer text-center">
                                        <?php
                                        $item_id = $item['id'];
                                        $item_path = $item['video_path'];
                                        $item_text = "video id:".$item_id;
                                        ?>
                                        <button class="btn btn-danger btn-sm" data-toggle="tooltip" title="Delete video"
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

                    <div class="text-center">
                        <button class="btn btn-primary btn-lg" type="button" onclick="showEmbed()">
                            <i class="fa fa-video-camera"></i> upload video Tag (< >)
                        </button>
                    </div>

                </div>

                <hr>

                <div class="p-0">
                    <div class="mb-3">
                        <h5><u> รายละเอียดวิดีโอกิจกรรม </u></h5>
                    </div>
                    <form method="post">
                        <div class="form-group">
                            <label for="titleInputId">Title</label>
                            <input name="title" type="text" class="form-control" id="titleInputId" value="<?php echo $this_title;?>">
                        </div>

                        <div class="form-group">
                            <label for="detailInputId">Detail</label>
                            <textarea name="detail" class="form-control" id="detailInputId" rows="3"><?php echo $this_detail;?></textarea>
                        </div>
                        <div class="text-center">
                            <input type="text" name="fn" value="editVideo" hidden>
                            <button class="btn btn-success btn-lg" type="submit"> <i class="fa fa-save"></i> Save</button>
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

<!-- modal -->
<?php require_once __DIR__.'/modal_delete.php';
        require_once __DIR__.'/modal_embed.php';
?>



<!-- main script -->
<?php require_once __DIR__.'/_main_script.php';?>


<script>

    function showEmbed() {
        $('#modalEmbed').modal();
    }
    function addEmbed() {
        $('#modalEmbed').modal('hide');
        var src = $('#input_embed').val();
        var src = cutEmbed(src);
        if(src=='' || src==undefined){
            alert("กรุณาตรวจสอบแทก");
        }else{
            var form = $(document.createElement('form'));
            $(form).attr("method","POST");
            $(form).attr('hidden',true);
            var input_fn = $("<input>")
                .attr("type","text")
                .attr("name","fn")
                .attr("value","addVideo");
            $(form).append($(input_fn));

            var input_title = $("<input>")
                .attr("type","text")
                .attr("name","src")
                .attr("value",src);
            $(form).append($(input_title));

            form.appendTo( document.body );
            $(form).submit();
        }
    }
    function cutEmbed(str) {
        var iframe= document.createElement('div');
        iframe.innerHTML = str;
        var src = $(iframe).find("iframe").first().attr("src");
        console.log(src);
        if(src==undefined){
            return '';
        }else{
            return  src;
        }
    }

</script>

</body>
</html>
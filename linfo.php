<?php
/**
 * Created by PhpStorm.
 * User: PF0T4E5G
 * Date: 28/3/2562
 * Time: 07:02 หลังเที่ยง
 */
require_once __DIR__.'/_session.php';
require_once __DIR__.'/_session_login.php';

$MENU_LEFT = 'info'



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once __DIR__.'/_main_css.php';?>

    <?php require_once __DIR__.'/_froala_css.php';?>
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
                    <h2 class="h-c"><i class="fa fa-file-text-o icon-zoom"></i> Home info</h2>
                    <hr class="style1">
                </div>

                <div class="p-0 pt-5">
                    <div id="editor">
                        <div id='edit'>

                        </div>
                    </div>
                </div>
                <hr>
                <div class="text-center">
                    <input id="webId" type="text" name="web_id" value="<?php echo isset($SET_WEB)?$SET_WEB:'';?>" hidden>
                    <button class="btn btn-success" type="button" onclick="saveText();"> Save </button>
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

<?php require_once __DIR__.'/_froala_script.php';?>

<script>

    $(function() {
        $('#edit').froalaEditor({
            heightMin: 250,
        });
        getText();
    });
    function saveText() {
        var web_id = $('#webId').val();
        var text = $('#edit').froalaEditor('html.get');
        var req = $.ajax({
            type: 'POST',
            url: './service/API.php',
            data: {
                fn: 'addEditWebInfo',
                web_id: web_id,
                web_home: text
            },
            dataType: 'JSON'
        });
        req.done(function (res) {
            if(res.status){
                alert('save data complete...');
                window.location.href = '/linfo.php';
            }else{
                alert('save data false!!!!');
            }
        });
    }
    function getText() {
        var web_id = $('#webId').val();
        var req = $.ajax({
            type: 'POST',
            url: './service/API.php',
            data: {
                fn: 'getWebInfo',
                web_id: web_id
            },
            dataType: 'JSON'
        });
        req.done(function (res) {
            if(res.status){
                var text = res.data;
                $('#edit').froalaEditor('html.set',text);
            }else{
                alert('get data false!!!!');
            }
        });
    }


</script>

</body>
</html>
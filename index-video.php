<?php
/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 4/1/2019
 * Time: 12:25 PM
 */

require_once __DIR__.'/_session.php';
require_once __DIR__.'/_session_index.php';

$MENU_LEFT = 'h-video';

require_once __DIR__.'/controller/indexVideo.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once __DIR__.'/_main_css.php';?>

</head>
<body>

<!-- loader -->
<?php //require_once __DIR__.'/_main_loader.php';?>

<div class="page-full container">

    <!-- top menu -->
    <?php require_once __DIR__.'/_main_menutop.php';?>

    <div class="page-background mb-5" style="margin-top: -80px;">

        <div class="row p-5" id="showVideoId">

            <?php foreach ($ACTIVITY as $key=>$item): ?>

                <div class="col-6 pb-3">
                    <div class="p-3 card">
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" src="<?php echo $item['video'];?>" allowfullscreen></iframe>
                        </div>
                        <p class="text-truncate pt-3" style="cursor: pointer;" onclick="clickLink('<?php echo $item['id'];?>');">
                            <?php echo $item['title'];?>
                        </p>
                    </div>
                </div>

            <?php endforeach; ?>

        </div>



        <div class="row pr-5 pl-5 pb-2">
            <button id="loadPageId" attr="1" class="btn btn-info btn-lg btn-block" type="button" onclick="loadMore()" > Load More </button>
        </div>

    </div>


</div>

<footer class="footer">
    <?php require_once __DIR__.'/_main_footer.php';?>
</footer>

<?php require_once __DIR__.'/_main_script.php';?>

<script>
    function clickLink(id) {
        window.location.href = "/index-video-view.php?vid="+id;
    }

    function loadMore() {
        $('#loadPageId').attr('disabled',true);
        $('#loadPageId').html("Load ....... ");
        var count = $('#loadPageId').attr('attr');
        var req = $.ajax({
            type: 'POST',
            url: './service/API.php',
            data: {
                fn: 'loadVideo',
                page: count
            },
            dataType: 'JSON'
        });
        req.done(function (res) {
            if(res.status){
                var result = res.result;
                var str = '';
                console.log(res);
                for(var i = (result.length -1) ; i>=0;i--){

                    str+='<div class="col-6 pb-3">';
                    str+='<div class="p-3 card">';
                    str+='<div class="embed-responsive embed-responsive-16by9">';
                    str+='<iframe class="embed-responsive-item" src="'+result[i].video+'" allowfullscreen></iframe>';
                    str+='</div>';
                    str+='<p class="text-truncate pt-3" style="cursor: pointer;" onclick="clickLink('+result[i].id+');">';
                    str+= result[i].title;
                    str+='</p>';
                    str+='</div>';
                    str+='</div>';
                }
                if(str==''){
                    $('#loadPageId').attr('disabled',true);
                    $('#loadPageId').html("Load Max");
                }else{
                    if(result.length < 9 ){
                        $('#loadPageId').attr('disabled',true);
                        $('#loadPageId').html("Load Max");
                    }else {
                        $('#loadPageId').attr('disabled',false);
                        $('#loadPageId').html("Load More");
                    }
                    $('#loadPageId').attr('attr',(parseInt(count)+1));
                    $('#showVideoId').append(str);
                }

            }else{
                alert('Load video false!!!!');
            }
        });
    }
</script>

</body>
</html>

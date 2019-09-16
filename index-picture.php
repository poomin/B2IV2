<?php
/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 4/1/2019
 * Time: 12:25 PM
 */

require_once __DIR__.'/_session.php';
require_once __DIR__.'/_session_index.php';

$MENU_LEFT = 'h-picture';

require_once __DIR__.'/controller/indexPicture.php';

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

        <div class="row p-5" id="showHallId">

            <?php foreach ($ACTIVITY as $key=>$item): ?>

                <div class="col-4 pb-3" onclick="clickLink('<?php echo $item['id'];?>');">
                    <div class="p-3 card">
                        <div class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <?php foreach ($item['pictures'] as $k=>$i): ?>
                                    <div class="carousel-item <?php echo $k<=0?'active':'';?>">
                                        <img src="<?php echo $i['picture_path'];?>" class="d-block w-100" alt="...">
                                    </div>
                                <?php endforeach;?>
                            </div>
                        </div>
                        <p class="text-truncate pt-3"><?php echo $item['title'];?></p>
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
        window.location.href = "/index-picture-view.php?hid="+id;
    }

    function loadMore() {
        $('#loadPageId').attr('disabled',true);
        $('#loadPageId').html("Load ....... ");
        var count = $('#loadPageId').attr('attr');
        var req = $.ajax({
            type: 'POST',
            url: './service/API.php',
            data: {
                fn: 'loadPicture',
                page: count
            },
            dataType: 'JSON'
        });
        req.done(function (res) {
            if(res.status){
                var result = res.result;
                var pic;
                var str = '';
                console.log(res);
                for(var i = (result.length -1) ; i>=0;i--){
                    pic = result[i].pictures;

                    str+='<div class="col-4 pb-3" onclick="clickLink('+result[i].id+');">';
                    str+='<div class="p-3 card">';
                    str+='<div class="carousel slide" data-ride="carousel">';
                    str+='<div class="carousel-inner">';
                    for(var j = (pic.length -1); j>=0;j--){
                        str+='<div class="carousel-item '+(j==((pic.length -1))?'active':'')+'">';
                        str+='<img src="'+pic[j].picture_path+'" class="d-block w-100" alt="...">';
                        str+='</div>';
                    }
                    str+='</div>';
                    str+='</div>';
                    str+='<p class="text-truncate pt-3">'+result[i].title+'</p>';
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
                    $('#showHallId').append(str);
                }

            }else{
                alert('Load hall of fame false!!!!');
            }
        });
    }
</script>

</body>
</html>

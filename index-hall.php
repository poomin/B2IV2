<?php
/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 4/1/2019
 * Time: 12:25 PM
 */

require_once __DIR__.'/_session.php';
require_once __DIR__.'/_session_index.php';

$MENU_LEFT = 'h-hall';


require_once __DIR__.'/controller/indexHall.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once __DIR__.'/_main_css.php';?>

</head>
<body>

<!-- loader -->
<?php require_once __DIR__.'/_main_loader.php';?>

<div class="page-full container">

    <!-- top menu -->
    <?php require_once __DIR__.'/_main_menutop.php';?>

    <div class="page-background mb-5" style="margin-top: -80px;">

        <div class="row p-5" id="showHallId">

            <?php foreach ($HALLS as $key=>$item): ?>

                <div class="col-4 pt-5">
                    <div class="card-hover position-relative card shadow p-4 bg-white rounded" onclick="clickLink('<?php echo $item['id'];?>');">
                        <img class="card-image card-img-top rounded" alt="image hall" src="<?php echo $item['image']; ?>">
                        <div class="card-middle p-4 position-absolute">
                            <div class="text">
                                <p class="text-truncate"><strong><?php echo $item['project_name_en']; ?></strong></p>
                                <p class="text-truncate"><strong><?php echo $item['project_name']; ?></strong></p>
                            </div>
                        </div>
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
        window.location.href = "/index-hall-view.php?hid="+id;
    }

    function loadMore() {
        $('#loadPageId').attr('disabled',true);
        $('#loadPageId').html("Load ....... ");
        var count = $('#loadPageId').attr('attr');
        var req = $.ajax({
            type: 'POST',
            url: './service/API.php',
            data: {
                fn: 'loadHall',
                page: count
            },
            dataType: 'JSON'
        });
        req.done(function (res) {
            if(res.status){
                var result = res.result;
                var str = '';
                for(var i = (result.length -1) ; i>=0;i--){
                    str+= '<div class="col-4 pt-5">';
                    str+= '<div class="card-hover position-relative card shadow p-4 bg-white rounded" onclick="clickLink(\''+result[i].id+'\');">';
                    str+= '<img class="card-image card-img-top rounded" alt="image hall" src="'+result[i].image+'">';
                    str+= '<div class="card-middle p-4 position-absolute">';
                    str+= '<div class="text">';
                    str+= '<p class="text-truncate"><strong>'+result[i].project_name_en+'</strong></p>';
                    str+= '<p class="text-truncate"><strong>'+result[i].project_name+'</strong></p>';
                    str+= '</div>';
                    str+= '</div>';
                    str+= '</div>';
                    str+= '</div>';

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

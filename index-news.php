<?php
/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 4/1/2019
 * Time: 12:26 PM
 */

require_once __DIR__.'/_session.php';
require_once __DIR__.'/_session_index.php';

$MENU_LEFT = 'h-news';

require_once __DIR__.'/controller/indexNewsController.php';

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

    <div class="pb-5 mb-5 page-background" style="margin-top: -80px;">

        <div class="pt-2">
            <p>&nbsp;</p>
        </div>
        <div class="p-0" id="showLoadPageId">

            <?php foreach ($NEWS as $key=>$item):?>
                <div class="alert-warning shadow-lg p-3 m-5 rounded">
                    <div class="post-body row">
                        <div class="col-12 col-md-4 border-0 text-center">
                            <img class="image-zoom rounded" src="<?php echo $item['image'];?>" alt="B2i new" style="width: 250px; height: auto;">
                        </div>
                        <div class="col-12 col-md-8 border-0">
                            <h5 class="font-weight-bolder"><?php echo $item['title'];?></h5>
                            <hr>
                            <p>
                                <span class="crop-text">
                                    <?php echo strip_tags($item['detail']);?>
                                </span>
                                <a href="/index-news-read.php?nid=<?php echo $item['id'];?>">อ่านต่อ</a>
                            </p>
                        </div>
                    </div>
                    <hr>
                    <div class="post-footer">
                    <span class="text-dark">
                        <i class="fa fa-calendar"></i> <?php echo date('d/m/Y',strtotime($item['create_at']));?>
                        <i class="fa fa-eye" style="padding-left: 10px;"></i> <?php echo $item['view_count'];?>
                        <i class="fa fa-comments" style="padding-left: 10px;"></i> <?php echo $item['comment_count'];?>
                        <i class="fa fa-pencil" style="padding-left: 10px;"></i> <?php echo $item['news_type'];?>
                    </span>
                    </div>
                </div>
            <?php endforeach;?>
        </div>

        <div class="pr-5 pl-5 pb-2">
            <button id="loadPageId" attr="1" class="btn btn-info btn-lg btn-block" type="button" onclick="loadMore()" > Load More </button>
        </div>



    </div>



</div>
<footer class="footer">
    <?php require_once __DIR__.'/_main_footer.php';?>
</footer>

<?php require_once __DIR__.'/_main_script.php';?>

<script>

    function convertDate(inputFormat) {
        function pad(s) { return (s < 10) ? '0' + s : s; }
        var d = new Date(inputFormat);
        return [pad(d.getDate()), pad(d.getMonth()+1), d.getFullYear()].join('/');
    }

    function loadMore() {
        $('#loadPageId').attr('disabled',true);
        $('#loadPageId').html("Load ....... ");
        var count = $('#loadPageId').attr('attr');
        var req = $.ajax({
            type: 'POST',
            url: './service/API.php',
            data: {
                fn: 'loadNews',
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

                    str+= '<div class="alert-warning shadow-lg p-3 m-5 rounded">';
                    str+= '<div class="post-body row">';
                    str+= '<div class="col-4 border-0 text-center">';
                    str+= '<img class="image-zoom rounded" src="'+result[i].image+'" alt="B2i new" style="width: 250px; height: auto;">';
                    str+= '</div>';
                    str+= '<div class="col-8 border-0">';
                    str+= '<h5 class="font-weight-bolder">'+result[i].title+'</h5>';
                    str+= '<hr>';
                    str+= '<p>';
                    str+= '<span class="crop-text">'+jQuery(result[i].detail).text()+'</span>';
                    str+= '<a href="/index-news-read.php?nid='+result[i].id+'">อ่านต่อ</a>';
                    str+= '</p>';
                    str+= '</div>';
                    str+= '</div>';
                    str+= '<hr>';
                    str+= '<div class="post-footer">';
                    str+= '<span class="text-dark">';
                    str+= '<i class="fa fa-calendar"></i> '+convertDate(result[i].create_at);
                    str+= '<i class="fa fa-eye" style="padding-left: 10px;"></i>'+result[i].view_count;
                    str+= '<i class="fa fa-comments" style="padding-left: 10px;"></i>'+result[i].comment_count;
                    str+= '<i class="fa fa-pencil" style="padding-left: 10px;"></i>'+result[i].news_type;
                    str+= '</span>';
                    str+= '</div>';
                    str+= '</div>';

                }
                if(str==''){
                    $('#loadPageId').attr('disabled',true);
                    $('#loadPageId').html("Load Max");
                }else{
                    if(result.length < 10 ){
                        $('#loadPageId').attr('disabled',true);
                        $('#loadPageId').html("Load Max");
                    }else {
                        $('#loadPageId').attr('disabled',false);
                        $('#loadPageId').html("Load More");
                    }
                    $('#loadPageId').attr('attr',(parseInt(count)+1));
                    $('#showLoadPageId').append(str);
                }

            }else{
                alert('Load Page false!!!!');
            }
        });
    }
</script>

</body>
</html>

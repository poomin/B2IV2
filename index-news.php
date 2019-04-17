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
        <div class="p-0">


            <?php foreach ($NEWS as $key=>$item):?>
                <div class="alert-warning shadow-lg p-3 m-5 rounded">
                    <div class="post-body row">
                        <div class="col-4 border-0 text-center">
                            <img class="image-zoom rounded" src="<?php echo $item['image'];?>" alt="B2i new" style="width: 250px; height: auto;">
                        </div>
                        <div class="col-8 border-0">
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



    </div>



</div>
<footer class="footer">
    <?php require_once __DIR__.'/_main_footer.php';?>
</footer>

<?php require_once __DIR__.'/_main_script.php';?>


</body>
</html>

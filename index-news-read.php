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

require_once __DIR__.'/controller/indexNewsReadController.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once __DIR__.'/_main_css.php';?>

    <link rel="stylesheet" href="/lib/froala/css/froala_style.css">

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
        <!-- news -->
        <div class="p-0">
            <div class="shadow-lg p-3 m-5 bg-white rounded">
                <div class="post-body pt-5">
                    <div class="border-0 text-center">
                        <img class="image-zoom img-fluid rounded" src="<?php echo $this_image;?>" alt="B2i new" style="width: 350px; height: auto;">
                    </div>
                    <div class="border-0 m-5">
                        <div class="p-0">
                            <h5 class="font-weight-bolder"><?php echo $this_title;?></h5>
                        </div>
                        <hr>
                        <div class="p-0 fr-view">
                            <?php echo $this_detail;?>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="post-footer">
                    <span class="text-dark">
                        <i class="fa fa-calendar"></i> <?php echo date('d/m/Y',strtotime($this_create_at));?>
                        <i class="fa fa-eye" style="padding-left: 10px;"></i> <?php echo $this_view_count;?>
                        <i class="fa fa-comments" style="padding-left: 10px;"></i> <?php echo $this_comment_count;?>
                        <i class="fa fa-pencil" style="padding-left: 10px;"></i> <?php echo $this_new_type;?>
                    </span>
                </div>
            </div>
        </div>

        <!-- comment -->
        <?php foreach ($COMMENTS as $key=>$item): ?>
            <div class="p-0">
                <div class="shadow-lg p-3 mr-5 ml-5 mb-4 bg-white rounded">
                    <div class="post-body row">
                        <div class="col-2 border-0 text-center">
                            <img class="image-zoom rounded-circle" src="<?php echo $item['image_path'];?>" alt="B2i new" style="width: 80px; height: 80px;">
                        </div>
                        <div class="col-10 border-0">
                            <div class="p-0">
                                <p class="font-weight-bolder"><?php echo $item['username']; ?></p>
                            </div>
                            <hr>
                            <div class="p-0">
                                <?php echo $item['comment'];?>
                            </div>
                        </div>
                    </div>
                    <div class="post-footer text-right">
                    <span class="text-dark">
                        <i class="fa fa-calendar"></i> <?php echo date('d/m/Y',strtotime($item['create_at']));?>
                    </span>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>


        <!-- add Comment -->
        <div class="p-0">
            <div class="alert-secondary shadow-lg p-3 mr-5 ml-5 rounded">

                <div class="row">
                    <div class="offset-1 col-2 border-0 text-center">
                        <div class="pt-3">
                            <img class="image-zoom rounded-circle" src="<?php echo $LOGIN_USER_IMAGE;?>" alt="B2i new" style="width: 100px; height: 100px;">
                        </div>
                        <div class="pt-3">
                            <strong style="padding-top: 30px;"><?php echo $LOGIN_USER_USERNAME; ?></strong>
                        </div>
                    </div>
                    <div class="col-7 border-0">
                        <div class="p-0">
                            <h5 class="font-weight-bolder">Comment</h5>
                        </div>
                        <hr>

                        <?php if($LOGIN_USER_ID == ''): ?>
                            <div class="p-0">
                                <textarea class="form-control" rows="4"></textarea>
                            </div>
                            <div class="pt-3 text-center">
                                <a href="/index-login.php" class="btn btn-warning">Please Login</a>
                            </div>
                        <?php else: ?>
                            <form method="post">
                                <div class="p-0">
                                    <textarea name="comment" class="form-control" rows="4" required></textarea>
                                </div>
                                <div class="pt-3 text-center">
                                    <input type="text" name="fn" value="addComment" hidden>
                                    <input type="text" name="user_id" value="<?php echo $LOGIN_USER_ID;?>" hidden>
                                    <button class="btn btn-info" type="submit">send comment</button>
                                </div>
                            </form>
                        <?php endif;?>

                    </div>
                </div>
                <hr>
                <div class="post-footer text-right">
                    <span class="text-dark">
                        <i class="fa fa-calendar"></i> <?php echo date('d/m/Y');?>
                    </span>
                </div>
            </div>
        </div>


    </div>



</div>
<footer class="footer">
    <?php require_once __DIR__.'/_main_footer.php';?>
</footer>

<?php require_once __DIR__.'/_main_script.php';?>


</body>
</html>

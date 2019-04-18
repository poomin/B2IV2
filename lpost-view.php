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

require_once __DIR__.'/controller/postViewController.php';

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
                    <div class="row">
                        <div class="col-8">
                            <h2 class="h-c"><i class="fa fa-newspaper-o icon-zoom"></i> ข่าว / ประกาศ</h2>
                        </div>
                        <div class="col-4 text-right">
                            <a class="btn btn-success btn-sm" href="/lpost-add.php" type="button" data-toggle="tooltip" title="Add news">
                                <i class="fa fa-plus"></i> Add
                            </a>
                        </div>
                    </div>

                    <hr class="style1">
                </div>

                <!-- alert status -->
                <div class="p-1">
                    <?php require_once __DIR__.'/_alert.php';?>
                </div>


                <div class="p-0">

                    <!-- news -->
                    <div class="p-0">
                        <div class="shadow-lg p-3 ml-5 mb-5 mr-5 bg-white rounded">
                            <div class="post-body">
                                <div class="border-0 text-center">
                                    <img class="image-zoom rounded" src="<?php echo $this_image;?>" alt="B2i new" style="width: 350px; height: auto;">
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
                                        <div class="p-0 row">
                                            <div class="col-6">
                                                <p class="font-weight-bolder"><?php echo $item['username']; ?></p>
                                            </div>
                                            <div class="col-6 text-right">
                                                <?php
                                                $item_id = $item['id'];
                                                $item_text = $item['comment'];
                                                ?>
                                                <button class="btn btn-danger btn-sm" type="button" data-toggle="tooltip" title="Delete comment"
                                                        onclick="showModalDelete('<?php echo $item_id;?>','<?php echo $item_text;?>');">
                                                    <i class="fa fa-remove"></i>
                                                </button>
                                            </div>

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

                </div>

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

?>



<!-- main script -->
<?php

require_once __DIR__.'/_main_script.php';

?>

</body>
</html>
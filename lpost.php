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

require_once __DIR__.'/controller/postController.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once __DIR__.'/_main_css.php';?>

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

                <div class="p-0">
                    <h2 class="h-c"><i class="fa fa-newspaper-o icon-zoom"></i> ข่าว / ประกาศ</h2>
                    <hr class="style1">
                </div>

                <!-- alert status -->
                <div class="p-1">
                    <?php require_once __DIR__.'/_alert.php';?>
                </div>

                <div class="text-right mb-2">
                    <a class="btn btn-success btn-sm" href="/lpost-add.php" type="button" data-toggle="tooltip" title="Add news">
                        <i class="fa fa-plus"></i> Add
                    </a>
                </div>

                <div class="p-0">

                    <table class="this-table table table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Type</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($NEWS as $key=>$item): ?>
                            <tr class="<?php echo $item['news_pin']=='Y'?'alert-danger':'';?> ">
                                <td> <?php echo ($key+1); ?> </td>
                                <td class="text-center">
                                    <img class="image-zoom rounded" src="<?php echo $item['image']; ?>" style="width: 150px;">

                                </td>
                                <td> <?php echo $item['title']; ?> </td>
                                <td> <?php echo $item['news_type']; ?> </td>
                                <td> <?php echo date('d/m/Y',strtotime($item['create_at'])); ?> </td>
                                <td>
                                    <?php
                                    $item_id = $item['id'];
                                    $item_text = 'หัวข้อข่าว <strong>'.$item['title'].'</strong>';
                                    $item_tack = $item['news_pin'];
                                    ?>

                                    <button class="btn btn-primary btn-sm" type="button" data-toggle="tooltip" title="ปักหมุด"
                                            onclick="showModalTack('<?php echo $item_id;?>','<?php echo $item_text;?>','<?php echo $item_tack;?>');" >
                                        <i class="fa fa-thumb-tack"></i>
                                    </button>
                                    <a class="btn btn-info btn-sm" href="./lpost-view.php?nid=<?php echo $item['id'];?>" data-toggle="tooltip" title="View news">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a class="btn btn-warning btn-sm" href="/lpost-add.php?id=<?php echo $item['id'];?>" data-toggle="tooltip" title="Edit news">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    <button class="btn btn-danger btn-sm" type="button" data-toggle="tooltip" title="Delete news"
                                            onclick="showModalDelete('<?php echo $item_id;?>','<?php echo $item_text;?>');">
                                        <i class="fa fa-remove"></i>
                                    </button>

                                </td>
                            </tr>
                        <?php endforeach;?>
                        </tbody>
                    </table>

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
require_once __DIR__.'/modal_tack.php';

?>



<!-- main script -->
<?php

require_once __DIR__.'/_main_script.php';
require_once __DIR__.'/_datatable_script.php';

?>

<script>
    $(document).ready(function() {
        $('.this-table').DataTable();
    } );
</script>

</body>
</html>
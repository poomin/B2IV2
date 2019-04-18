<?php
/**
 * Created by PhpStorm.
 * User: PF0T4E5G
 * Date: 28/3/2562
 * Time: 07:02 หลังเที่ยง
 */
require_once __DIR__.'/_session.php';
require_once __DIR__.'/_session_login.php';

$MENU_LEFT = 'hall';

require_once __DIR__.'/controller/hallController.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>

    <?php
    require_once __DIR__.'/_main_css.php';

    require_once __DIR__.'/_datatable_css.php';
    ?>

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
                    <div class="row">
                        <div class="col-8">
                            <h2 class="h-c"><i class="fa fa-file-video-o icon-zoom"></i> Hall of fame</h2>
                        </div>
                        <div class="col-4 text-right">
                            <a class="btn btn-success btn-sm" href="lhall-add.php">
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

                    <table class="this-table table table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ( $HALLS as $key=>$item): ?>
                            <tr>
                                <td> <?php echo ($key+1);?> </td>
                                <td class="text-center">
                                    <img class="image-zoom rounded" src="<?php echo $item['image']; ?>" style="width: 150px;">
                                </td>

                                <td> <?php echo $item['project_name']; ?> </td>
                                <td> <?php echo date('d/m/Y',strtotime($item['create_at'])); ?> </td>
                                <td>
                                    <?php
                                    $item_id = $item['id'];
                                    $item_text = '<strong>'.$item['project_name'].'('.$item['project_name_en'].')'.'</strong>';
                                    ?>
                                    <a class="btn btn-warning btn-sm" href="/lhall-add.php?hid=<?php echo $item['id'];?>" data-toggle="tooltip" title="Edit hall">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    <button class="btn btn-danger btn-sm" type="button" data-toggle="tooltip" title="Delete hall"
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
<?php require_once __DIR__.'/modal_delete.php'; ?>


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
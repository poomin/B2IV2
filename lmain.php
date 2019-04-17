<?php
/**
 * Created by PhpStorm.
 * User: PF0T4E5G
 * Date: 28/3/2562
 * Time: 07:02 หลังเที่ยง
 */
require_once __DIR__.'/_session.php';
require_once __DIR__.'/_session_login.php';

$MENU_LEFT = 'create';

require_once __DIR__.'/controller/mainProject.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once __DIR__.'/_main_css.php';?>
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
                    <div class="row">
                        <div class="col-8">
                            <h2 class="h-c"><i class="fa fa-gear icon-zoom"></i> Active / สร้างโครงการ</h2>
                        </div>
                        <div class="col-4 text-right">
                            <button class="btn btn-success btn-sm" type="button" data-toggle="modal" data-target="#modalAddMainProject">
                                <i class="fa fa-plus"></i> Add
                            </button>
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
                            <th>Year</th>
                            <th>Name(TH)</th>
                            <th>Name(EN)</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($MAINS as $key=>$item): ?>
                            <tr class="<?php echo $item['main_status']=='Y'?'alert-success':'';?> ">
                                <td> <?php echo ($key+1); ?> </td>
                                <td> <?php echo $item['main_year']; ?> </td>
                                <td> <?php echo $item['name']; ?> </td>
                                <td> <?php echo $item['name_en']; ?> </td>
                                <td> <?php echo $item['main_status']=='Y'?'ดำเนินการ':'ปิด'; ?> </td>
                                <td>
                                    <?php
                                    $item_id = $item['id'];
                                    $item_name = $item['name'];
                                    $item_name_en  = $item['name_en'];
                                    $item_text = '<strong>'.$item_name.' ('.$item_name_en.')</strong>';
                                    $item_active = $item['main_status'];
                                    $item_year = $item['main_year'];
                                    ?>

                                    <button class="btn btn-primary btn-sm" type="button" data-toggle="tooltip" title="active"
                                            onclick="showModalActive('<?php echo $item_id;?>','<?php echo $item_text;?>','<?php echo $item_active;?>');" >
                                        <i class="fa fa-thumb-tack"></i>
                                    </button>
                                    <button class="btn btn-warning btn-sm" data-toggle="tooltip" title="Edit project"
                                            onclick="showModalMainProjectEdit('<?php echo $item_id;?>','<?php echo $item_year;?>','<?php echo $item_name;?>','<?php echo $item_name_en;?>')">
                                        <i class="fa fa-edit"></i>
                                    </button>

                                    <button class="btn btn-danger btn-sm" type="button" data-toggle="tooltip" title="Delete project"
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
require_once __DIR__.'/modal_main_project_active.php';
require_once __DIR__.'/modal_main_project_add.php';
require_once __DIR__.'/modal_main_project_edit.php';
?>

<!-- main script -->
<?php require_once __DIR__.'/_main_script.php';?>

</body>
</html>
<?php
/**
 * Created by PhpStorm.
 * User: PF0T4E5G
 * Date: 28/3/2562
 * Time: 07:02 หลังเที่ยง
 */
require_once __DIR__.'/_session.php';
require_once __DIR__.'/_session_login.php';

$MENU_LEFT = 'training-list';

require_once __DIR__.'/controller/trainingsListController.php';

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
                            <h2 class="h-c"><i class="fa fa-sticky-note-o icon-zoom"></i> สมาชิกเข้าร่วมอบรม </h2>
                        </div>
                        <div class="col-4 text-right">
                            <a class="btn btn-success btn-sm" href="ltraining-add.php">
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
                            <th>Detail</th>
                            <th>School</th>
                            <th>Region</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ( $TRAINING as $key=>$item): ?>
                            <tr>
                                <td> <?php echo ($key+1);?> </td>
                                <td> <?php echo $item['name']; ?> </td>
                                <td> <?php echo $item['school']; ?> </td>
                                <td> <?php echo $item['region']; ?> </td>
                                <td>
                                    <?php
                                    $i_t_status = $item['training_status'];
                                    $i_class = 'text-secondary';
                                    $i_text = 'ยังไม่ยืนยันเข้าร่วมอบรม';
                                    if($i_t_status=='PASS'){
                                        $i_class = 'text-success';
                                        $i_text = 'ยืนยันเรียบร้อย';
                                    }
                                    elseif ($i_t_status=='FAIL'){
                                        $i_class = 'text-danger';
                                        $i_text = 'ไม่อนุมัติ';
                                    }
                                    elseif ($i_t_status=='WAIT'){
                                        $i_class = 'text-warning';
                                        $i_text = 'รอการตรวจสอบจาก Admin';
                                    }
                                    ?>
                                    <span class="font-weight-bold <?php echo $i_class; ?>">
                                        <?php echo $i_text; ?>
                                    </span>
                                </td>
                                <td>
                                    <a class="btn btn-success btn-sm" href="ltrainings-active.php?tid=<?php echo $item['id'];?>" data-toggle="tooltip" title="Active Training" target="_blank">
                                        <i class="fa fa-check"></i>
                                    </a>
                                    <a class="btn btn-warning btn-sm" href="ltrainings-edit.php?tid=<?php echo $item['id'];?>" data-toggle="tooltip" title="Edit Training" target="_blank">
                                        <i class="fa fa-edit"></i>
                                    </a>
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
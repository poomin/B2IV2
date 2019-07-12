<?php
/**
 * Created by PhpStorm.
 * User: PF0T4E5G
 * Date: 28/3/2562
 * Time: 07:02 หลังเที่ยง
 */

require_once __DIR__ . '/_session.php';
require_once __DIR__ . '/_session_login.php';

$MENU_LEFT = 'upost';

require_once __DIR__.'/controller/upostController.php';


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    require_once __DIR__ . '/_main_css.php';
    require_once __DIR__ . '/_datatable_css.php';
    ?>

</head>
<body>

<!-- loader -->
<?php require_once __DIR__ . '/_main_loader.php'; ?>


<div class="page-full container-fluid">

    <!-- top menu -->
    <?php require_once __DIR__ . '/_main_menutop.php'; ?>

    <div class="pb-5 mb-5" style="margin-top: -80px;">

        <div class="row">

            <!-- left menu -->
            <div class="col-3 p-5">
                <?php require_once __DIR__ . '/_main_menuleft_login.php'; ?>
            </div>

            <!-- page body -->
            <div class="col-9 p-5 bg-white">

                <div class="p-0">
                    <h2 class="h-c"><i class="fa fa-envelope-o icon-zoom"></i> ยืนยันอบรม </h2>
                    <hr class="style1">
                </div>
                <div>
                    <table class="this-table table table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Project</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ( $TRAINING as $key=>$item): ?>
                            <tr>
                                <td> <?php echo ($key+1);?> </td>
                                <td>
                                    <a href="upost-confirm.php?tid=<?php echo $item['training_id'];?>&pid=<?php echo $item['project_id'];?>">
                                        <?php echo $item['training_title']; ?>
                                    </a>
                                </td>
                                <td> <?php echo $item['project_name']; ?> </td>
                                <td>
                                    <?php
                                        $i_class = 'text-secondary';
                                        $i_text = 'ยังไม่ยืนยันเข้าร่วมอบรม';
                                        if($item['confirm']=='PASS'){
                                            $i_class = 'text-success';
                                            $i_text = 'ยืนยันเรียบร้อย';
                                        }
                                        elseif ($item['confirm']=='FAIL'){
                                            $i_class = 'text-danger';
                                            $i_text = 'ไม่อนุมัติ';
                                        }
                                        elseif ($item['confirm']=='WAIT'){
                                            $i_class = 'text-warning';
                                            $i_text = 'รอการตรวจสอบจาก Admin';
                                        }
                                    ?>
                                    <span class="font-weight-bold <?php echo $i_class; ?>">
                                        <?php echo $i_text; ?>
                                    </span>
                                </td>
                            </tr>
                        <?php endforeach;?>
                        </tbody>
                    </table>
                </div>


                <div class="p-1" style="margin-top: 100px;">
                    <h4 class="h-c"><i class="fa fa-envelope-o icon-zoom"></i> อบรมที่เคยเข้าร่วม </h4>
                    <hr class="style1">
                </div>
                <div>
                    <table class="this-table table table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Project</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ( $TRAINING_HISTORY as $key=>$item): ?>
                            <tr>
                                <td> <?php echo ($key+1);?> </td>
                                <td>
                                    <a href="upost-view.php?tid=<?php echo $item['id'];?>">
                                        <?php echo $item['training_title']; ?>
                                    </a>
                                </td>
                                <td> <?php echo $item['training_status']=="PASS"?$item['name']:'บุคคลทั่วไป'; ?> </td>
                                <td>
                                    <?php
                                    $i_class = 'text-secondary';
                                    $i_text = 'ยังไม่ยืนยันเข้าร่วมอบรม';
                                    if($item['training_status']=='PASS'){
                                        $i_class = 'text-success';
                                        $i_text = 'ยืนยันเรียบร้อย';
                                    }
                                    elseif ($item['training_status']=='FAIL'){
                                        $i_class = 'text-danger';
                                        $i_text = 'ไม่อนุมัติ';
                                    }
                                    elseif ($item['training_status']=='WAIT'){
                                        $i_class = 'text-warning';
                                        $i_text = 'รอการตรวจสอบจาก Admin';
                                    }
                                    ?>
                                    <span class="font-weight-bold <?php echo $i_class; ?>">
                                        <?php echo $i_text; ?>
                                    </span>
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
    <?php require_once __DIR__ . '/_main_footer.php'; ?>
</footer>


<!-- main script -->
<?php
require_once __DIR__ . '/_main_script.php';
require_once __DIR__ . '/_datatable_script.php';
?>



<script>
    $(document).ready(function() {
        $('.this-table').DataTable();
    } );
</script>

</body>
</html>
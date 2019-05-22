<?php
/**
 * Created by PhpStorm.
 * User: PF0T4E5G
 * Date: 28/3/2562
 * Time: 07:02 หลังเที่ยง
 */
require_once __DIR__.'/_session.php';
require_once __DIR__.'/_session_login.php';

$MENU_LEFT = 'uprocess';

require_once __DIR__.'/controller/userPhaseController.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once __DIR__.'/_main_css.php';?>
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
                    <div class="text-center p-2">
                        <h4 class="font-weight-bolder h-c"><?php echo $this_main_name.' '.$this_main_year;?></h4>
                        <h4 class="h-c">( <?php echo $this_main_name_en.' '.$this_main_year;?> )</h4>
                    </div>
                    <hr class="style1">
                </div>

                <!-- alert status -->
                <div class="p-0">
                    <?php require_once __DIR__.'/_alert.php';?>
                </div>



                <div class="p-0">

                    <table class="this-table table table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Project</th>
                            <?php foreach ($TABLE_HEADER as $key=>$item): ?>
                                <th><?php echo $item['title']; ?></th>
                            <?php endforeach;?>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($PROJECTS as $key=>$item):?>
                            <tr>
                                <td><?php echo ($key+1); ?></td>
                                <td>
                                    <a href="/ucreate.php?pid=<?php echo $item['id']; ?>"><?php echo $item['name'];?></a>
                                </td>
                                <?php foreach ($item['phase_state'] as $k=>$i):?>
                                <td>
                                    <?php
                                    $i_text = strtoupper($i);
                                    $i_class= 'text-secondary';
                                    $i_sq = ($k+1);
                                    $i_pro_id = $item['id'];
                                    if($i=='open'){
                                        $i_class = 'text-primary';
                                    }elseif($i=='fail'){
                                        $i_class = 'text-danger';
                                    }elseif($i=='pass'){
                                        $i_class = 'text-success';
                                    }elseif($i=='wait'){
                                        $i_class = 'text-warning';
                                    }
                                    ?>
                                    <a class="<?php echo $i_class;?> font-weight-bolder" href="/uprocess-phase.php?pid=<?php echo $i_pro_id;?>&nsq=<?php echo $i_sq; ?>"><?php echo $i_text;?></a>
                                </td>
                                <?php endforeach;?>
                                <td>
                                    <button class="btn btn-danger btn-sm" type="button" data-toggle="tooltip" title="Delete user"
                                            onclick="showModalDelete('<?php echo $item['id'];?>','<?php echo $item['name'];?>');">
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
<?php require_once __DIR__.'/modal_delete.php';?>


<!-- main script -->
<?php require_once __DIR__.'/_main_script.php';?>



</body>
</html>
<?php
/**
 * Created by PhpStorm.
 * User: PF0T4E5G
 * Date: 28/3/2562
 * Time: 07:02 หลังเที่ยง
 */

require_once __DIR__.'/_session.php';
require_once __DIR__.'/_session_index.php';

$MENU_LEFT = 'rate';

require_once  __DIR__.'/controller/rateController.php';

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

                <div class="p-0 text-center">
                    <h2 class="h-c"> <?php echo $this_main_name_en . ' ('.$this_main_year.')'; ?></h2>
                    <h4 class="h-c"> <?php echo $this_main_name. ' ('.$this_main_year.')'; ?></h4>

                    <hr class="style1">
                </div>

                <div class="text-center">
                    <h5 class="text-primary"> กำหนดโครงการที่ผ่าน/ไม่ผ่าน การคัดเลือก (ADMIN) </h5>
                </div>
                <div class="pt-2">

                    <table class="this-table table table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>ขั้นดำเนินการ</th>
                            <th>วันที่เริ่ม</th>
                            <th>วันที่สิ้นสุด</th>
                            <th>โครงการทั้งหมด</th>
                            <th>ผ่านคัดเลือก</th>
                            <th>ไม่ผ่านคัดเลือก</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($PHASES as $key=>$item): ?>
                        <tr>
                            <td><?php echo ($key+1);?></td>
                            <td>
                                <a href="/lrate-list.php?mid=<?php echo $this_main_id; ?>&sq=<?php echo $item['sq']; ?>">
                                    <?php echo $item['title'];?>
                                </a>
                            </td>
                            <td><?php echo (isset($item['score_date_start']))?date('d/m/Y',strtotime($item['score_date_start'])):''; ?> </td>
                            <td><?php echo (isset($item['score_date_end']))?date('d/m/Y',strtotime($item['score_date_end'])):''; ?> </td>
                            <td>
                                <a class="text-secondary" href="#">
                                    <h4><?php echo $item['count_all'];?></h4>
                                </a>
                            </td>
                            <td>
                                <a class="text-success" href="#">
                                    <h4><?php echo $item['count_pass'];?></h4>
                                </a>
                            </td>
                            <td>
                                <a class="text-danger" href="#">
                                    <h4><?php echo $item['count_fail'];?></h4>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
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


<!-- main script -->
<?php require_once __DIR__.'/_main_script.php';?>

<?php require_once __DIR__.'/_datatable_script.php';?>

<script>
    $(document).ready(function() {
        $('.this-table').DataTable();
    } );
</script>

</body>
</html>
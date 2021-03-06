<?php
/**
 * Created by PhpStorm.
 * User: PF0T4E5G
 * Date: 28/3/2562
 * Time: 07:02 หลังเที่ยง
 */
require_once __DIR__.'/_session.php';
require_once __DIR__.'/_session_login.php';

$MENU_LEFT = 'lquestion';
require_once __DIR__.'/controller/questionController.php';

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
                    <div class="col-8">
                        <h2 class="h-c"><i class="fa fa-question-circle-o icon-zoom"></i> ถาม - ตอบ </h2>
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
                            <th>Title</th>
                            <th>Detail</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($QUESTIONS as $key=>$item): ?>
                            <tr>
                                <td> <?php echo ($key+1); ?> </td>
                                <td> <?php echo $item['title']; ?> </td>
                                <td>
                                    <?php echo strlen($item['detail'])<50?$item['detail']:substr($item['detail'],0,50) . ' ...';?>
                                </td>
                                <td> <?php echo date('d/m/Y H:i',strtotime($item['create_at'])); ?> </td>
                                <td>
                                    <a class="btn <?php echo $item['admin_read']=='N'?'btn-danger':'btn-secondary';?> btn-sm" href="/lquestion-view.php?qid=<?php echo $item['id']; ?>"
                                       data-toggle="tooltip" title="View question">
                                        <i class="fa fa-eye"></i>
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
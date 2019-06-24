<?php
/**
 * Created by PhpStorm.
 * User: PF0T4E5G
 * Date: 28/3/2562
 * Time: 07:02 หลังเที่ยง
 */

require_once __DIR__.'/_session.php';
require_once __DIR__.'/_session_index.php';

$MENU_LEFT = 'score';
$PHASE_STATUS['DOC'] = false;
$PHASE_STATUS['PDF'] = false;
$PHASE_STATUS['IMAGE'] = false;
$PHASE_STATUS['VIDEO'] = false;
require_once  __DIR__.'/controller/scoreViewController.php';

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

                <!-- alert status -->
                <div class="p-1">
                    <?php require_once __DIR__.'/_alert.php';?>
                </div>


                <div class="p-0 text-center">
                    <h2 class="h-c"> <?php echo $this_main_name_en . ' ('.$this_main_year.')'; ?></h2>
                    <h4 class="h-c"> <?php echo $this_main_name. ' ('.$this_main_year.')'; ?></h4>

                    <hr class="style1">
                </div>

                <div class="pt-3">
                    <h3 class="h-c font-weight-bolder"><?php echo $this_pro_name.' ('.$this_pro_en.')';?></h3>
                    <h5 class="font-weight-bolder"><?php echo 'โรงเรียน'.$this_pro_school; ?></h5>
                    <p><?php echo $this_pro_address ?></p>
                </div>
                <hr>

                <div class="pt-2 text-center">
                    <h4 class="text-primary"><?php echo $this_phase_name; ?></h4>
                    <p>
                        <small>ระยะเวลาตรวจสอบ/ให้คะแนน
                            <strong><?php echo $this_phase_score_start; ?></strong> -
                            <strong><?php echo $this_phase_score_end; ?></strong>
                        </small>
                    </p>
                </div>

                <form class="pt-1" method="post">

                    <div class="p-0">
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>เกณฑ์การให้คะแนน</th>
                                <th>คะแนนเต็ม</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i_sum=0;?>
                            <?php foreach ($SCORE as $key => $item): ?>
                                <tr>
                                    <td><?php echo ($key+1);?></td>
                                    <td><?php echo $item['score_text'];?></td>
                                    <td><?php echo $item['score_point'];?></td>
                                    <td>
                                        <input name="score_point_<?php echo ($key+1);?>" class="inputNumberFormat changeSum form-control" fmax="<?php echo $item['score_point'];?>" value="<?php echo $item['score'];?>" type="text" required>
                                        <input name="score_id_<?php echo ($key+1);?>" type="text" value="<?php echo $item['id'];?>" hidden>
                                    </td>
                                </tr>
                            <?php
                            $i_sum += is_numeric($item['score'])?$item['score']:0;
                                ?>
                            <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>

                    <div class="text-center">
                        <h5>คะแนนรวม
                            <span class="font-weight-bold text-danger" id="sumScoreId">
                                <?php echo $i_sum;?>
                            </span>
                        </h5>
                    </div>

                    <?php if( $this_score_edit ):?>
                    <div class="text-center">
                        <input name="count" value="<?php echo count($SCORE);?>" hidden>
                        <input name="fn" value="addScore" hidden>
                        <button class="btn btn-success" type="submit">บันทึกคะแนน</button>
                    </div>
                    <?php else: ?>
                        <div class="alert alert-warning" role="alert">
                            <strong class="alert-heading">Warning</strong>
                            <span>ไม่สามารถตรวจให้คะแนนได้ เนื่องจากไม่ได้รับสิทธิในการตรวจสอบจาก Admin หรือ ไม่อยู่ในช่วงเวลาในการตรวจให้คะแนนโครงการ</span>
                        </div>
                    <?php endif; ?>

                    <hr>
                </form>

                <div class="pt-0">
                    <!-- upload doc -->
                    <?php if( $PHASE_STATUS['DOC'] ): ?>
                        <div class="pt-3">
                            <div class="p-3">
                                <h5 class="h-c"> <u> เอกสาร (word,powerpoint) </u></h5>
                            </div>

                            <table class="this-table table table-striped table-bordered w-100">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>File upload</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($PHASES['DOC']as $k=>$i): ?>
                                    <tr>
                                        <td><?php echo ($k+1); ?></td>
                                        <td>
                                            <a href="<?php echo $i['upload_path'];?>" target="_blank">
                                                <?php echo $i['upload_name']; ?>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach;?>
                                </tbody>
                            </table>

                            <hr>
                        </div>
                    <?php endif;?>

                    <!-- upload PDF -->
                    <?php if( $PHASE_STATUS['PDF'] ): ?>
                        <div class="pt-3">
                            <div class="p-3">
                                <h5 class="h-c"> <u> เอกสาร (PDF) </u> </h5>
                            </div>

                            <table class="this-table table table-striped table-bordered w-100">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>File upload</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($PHASES['PDF'] as $k=>$i): ?>
                                    <tr>
                                        <td><?php echo ($k+1); ?></td>
                                        <td>
                                            <a href="<?php echo $i['upload_path'];?>" target="_blank">
                                                <?php echo $i['upload_name']; ?>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach;?>
                                </tbody>
                            </table>
                            <hr>
                        </div>
                    <?php endif;?>

                    <!-- upload Image -->
                    <?php if( $PHASE_STATUS['IMAGE'] ): ?>
                        <div class="pt-3">
                            <div class="p-3">
                                <h5 class="h-c"> <u>รูปภาพ (PNG,JPG)</u></h5>
                            </div>

                            <table class="this-table table table-striped table-bordered w-100">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>File upload</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($PHASES['IMAGE'] as $k=>$i): ?>
                                    <tr>
                                        <td><?php echo ($k+1); ?></td>
                                        <td class="text-center">
                                            <img class="img-thumbnail rounded" src="<?php echo $i['upload_path'];?>" style="height: 80px;">
                                        </td>
                                        <td>
                                            <a href="<?php echo $i['upload_path'];?>" target="_blank">
                                                <?php echo $i['upload_name']; ?>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach;?>
                                </tbody>
                            </table>
                            <hr>
                        </div>
                    <?php endif;?>

                    <!-- upload rul youtube -->
                    <?php if( $PHASE_STATUS['VIDEO'] ): ?>
                        <div class="pt-3">
                            <div class="p-3">
                                <h5 class="h-c"><u> วีดีโอ (url youtube) </u></h5>
                            </div>

                            <table class="this-table table table-striped table-bordered w-100">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Video</th>
                                    <th>File upload</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($PHASES['VIDEO'] as $k=>$i): ?>
                                    <tr>
                                        <td><?php echo ($k+1); ?></td>
                                        <td class="text-center">
                                            <div class="embed-responsive embed-responsive-16by9">
                                                <iframe id="videoShow" class="embed-responsive-item" src="<?php echo $i['upload_path'];?>" ></iframe>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="<?php echo $i['upload_path'];?>" target="_blank">
                                                <?php echo $i['upload_name']; ?>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach;?>
                                </tbody>
                            </table>
                            <hr>
                        </div>
                    <?php endif;?>

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
        $('.this-table').DataTable({
            "lengthChange": false,
            "info": false
        });
    } );

    $('.changeSum').on('change',function () {
        var sum = 0;
        var score;
        $('.changeSum').each(function () {
            score = $(this).val();
            if(score!='' && score!=undefined){
                sum+= parseFloat(score);
            }
        });
        $('#sumScoreId').html(sum);
    })
</script>

</body>
</html>
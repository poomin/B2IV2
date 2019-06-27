<?php
/**
 * Created by PhpStorm.
 * User: PF0T4E5G
 * Date: 28/3/2562
 * Time: 07:02 หลังเที่ยง
 */

require_once __DIR__.'/_session.php';
require_once __DIR__.'/_session_login.php';

$MENU_LEFT = 'rate';
$BOARD = [];
require_once  __DIR__.'/controller/rateViewController.php';

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

                <?php $i_SCORE_SUM =0; $i_COUNT_BOARD = 0; ?>
                <div class="p-0">
                    <?php foreach ($BOARD as $key=>$item): ?>
                        <div class="pt-3">
                            <h5 class="h-c"><?php echo $item['name_title'].''.$item['name'].'  '.$item['surname'].' ('.$item['schoolname'].')'; ?></h5>
                        </div>
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
                            <?php foreach ($item['scores'] as $k => $i): ?>
                                <tr>
                                    <td><?php echo ($k+1);?></td>
                                    <td><?php echo $i['score_text'];?></td>
                                    <td><?php echo $i['score_point'];?></td>
                                    <td class="font-weight-bold"><?php echo $i['score'];?></td>
                                </tr>
                                <?php
                                $i_sum += is_numeric($i['score'])?$i['score']:0;
                                ?>
                            <?php endforeach;?>
                            <tr>
                                <td class="text-right" colspan="3">รวม</td>
                                <td class="font-weight-bold"><?php echo $i_sum;?></td>
                                <?php $i_SCORE_SUM+=$i_sum;$i_COUNT_BOARD++;?>
                            </tr>
                            </tbody>
                        </table>
                    <?php endforeach; ?>
                </div>

                <hr>
                <form class="pt-3" method="post">

                    <div class="form-group">
                        <label class="label-control">คะแนนรวมทั้งหมด</label>
                        <input class="form-control font-weight-bold" type="text"value="<?php echo $i_SCORE_SUM/ ($i_COUNT_BOARD>0?$i_COUNT_BOARD:1);?>" disabled>
                    </div>

                    <p>สถานะ</p>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="phase_status" id="idPhaseStatusNon" value="NON" <?php echo $this_phase_status=='NON'?'checked':''; ?> >
                        <label class="form-check-label font-weight-bold text-secondary" for="idPhaseStatusNon">ยังไม่ได้ตรวจสอบ</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="phase_status" id="idPhaseStatusPass" value="PASS" <?php echo $this_phase_status=='PASS'?'checked':''; ?> >
                        <label class="form-check-label font-weight-bold text-success" for="idPhaseStatusPass">ผ่านการคัดเลือก</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="phase_status" id="idPhaseStatusFail" value="FAIL" <?php echo $this_phase_status=='FAIL'?'checked':''; ?> >
                        <label class="form-check-label font-weight-bold text-danger" for="idPhaseStatusFail">ไม่ผ่าน</label>
                    </div>

                    <div class="form-group">
                        <label class="label-control">รายละเอียดเพิ่มเติม</label>
                        <textarea class="form-control" rows="4" name="message" required><?php echo $this_phase_message; ?></textarea>
                    </div>

                    <div class="text-center">
                        <input name="fn" value="sendPhase"  hidden>
                        <button class="btn btn-success">บันทึก</button>
                    </div>


                </form>

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
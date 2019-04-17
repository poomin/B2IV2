<?php
/**
 * Created by PhpStorm.
 * User: PF0T4E5G
 * Date: 28/3/2562
 * Time: 07:02 หลังเที่ยง
 */

require_once __DIR__.'/_session.php';
require_once __DIR__.'/_session_login.php';


$MENU_LEFT = 'manage';

require_once __DIR__.'/controller/manageScoreController.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once __DIR__.'/_main_css.php';?>
    <?php require_once __DIR__.'/_datepicker_css.php';?>
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
                    <h2 class="h-c"><i class="fa fa-gear icon-zoom"></i> เกณฑ์การให้คะแนน</h2>
                    <hr class="style1">
                </div>

                <!-- alert status -->
                <div class="p-0">
                    <?php require_once __DIR__.'/_alert.php';?>
                </div>

                <div class="p-0 text-center">
                    <h5 class="font-weight-bolder"><?php echo $this_main_year.' '.$this_main_name.' ('.$this_main_name_en.')'; ?></h5>
                </div>
                <hr>

                <div class="m-0">

                    <div class="text-center pt-2 pb-4">
                        <h5 class="font-weight-bolder">ระยะเวลาตรวจโครงการ</h5>
                    </div>

                    <!-- sq / phase -->
                    <div class="form-group row">
                        <label for="attrSqId" class="col-sm-3 col-form-label font-weight-bolder text-right">รอบที่ (phase) : </label>
                        <div class="col-sm-9">
                            <input type="text" name="sqS" class="form-control" id="attrSqId" value="<?php echo $this_sq;?>" disabled>
                        </div>
                    </div>

                    <!-- title -->
                    <div class="form-group row">
                        <label for="attrTitleId" class="col-sm-3 col-form-label font-weight-bolder text-right">หัวข้อ :</label>
                        <div class="col-sm-9">
                            <input id="attrTitleId" type="text" name="title" class="form-control"  value="<?php echo $this_title;?>" disabled>
                        </div>
                    </div>

                    <!-- date -->
                    <form class="row" method="post">
                        <div class="col-3 text-right">
                            <p class="font-weight-bolder pt-2" > ระยะเวลาตรวจสอบโครงการ:</p>
                        </div>
                        <div class="col-4">
                            <div class="form-inline">
                                <label class="my-1 mr-2" for="idDateStart"> เริ่ม <i class="fa fa-calendar ml-1"></i></label>
                                <input type="text" class="datepicker form-control" name="dateStart" id="idDateStart" value="<?php echo $this_date_start;?>" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-inline">
                                <label class="my-1 mr-2" for="idDateEnd"> สิ้นสุด <i class="fa fa-calendar ml-1"></i></label>
                                <input type="text" class="datepicker form-control" name="dateStop" id="idDateEnd" value="<?php echo $this_date_end;?>" required>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="text-center mt-2">
                                <input type="text" name="phase_id" value="<?php echo $this_phase_id;?>" hidden>
                                <input type="text" name="fn" value="updatePhase" hidden>
                                <button class="btn btn-success btn-sm" type="submit"> SAVE </button>
                            </div>
                        </div>
                    </form>

                </div>

                <hr class="style1">
                <div class="text-center pt-5">
                    <h5 class="font-weight-bolder">เกณฑ์การให้คะแนน</h5>
                </div>
                <div class="pt-3">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">เกณฑ์</th>
                            <th scope="col">คะแนนเต็ม</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($SCORES as $key=>$item):?>
                            <tr>
                                <td><?php echo ($key+1); ?></td>
                                <td id="textTdId<?php echo $item['id'];?>"><?php echo $item['score_text']; ?></td>
                                <td id="scoreTdId<?php echo $item['id'];?>"><?php echo $item['score_point']; ?></td>
                                <td>
                                    <button class="btn btn-warning btn-sm" type="button" data-toggle="tooltip" title="Edit score" onclick="editScore('<?php echo $item['id'];?>')"><i class="fa fa-edit"></i></button>
                                    <button class="btn btn-danger btn-sm" type="button" data-toggle="tooltip" title="Delete score"
                                            onclick="showModalDelete('<?php echo 'score-'.$item['id'];?>','<?php echo $item['score_text'];?>');">
                                        <i class="fa fa-remove"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach;?>
                        </tbody>
                    </table>
                    <form class="pt-3" method="post">
                        <div class="form-row">
                            <div class="form-group col-md-8">
                                <label for="attrScoreTextId">เกณฑ์</label>
                                <input type="text" class="form-control" id="attrScoreTextId" name="score_text" placeholder="เกณฑ์" required>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="attrScorePointId">คะแนนเต็ม</label>
                                <input type="text" class="form-control" id="attrScorePointId" name="score_point" placeholder="0" required>
                            </div>
                            <div class="col-auto my-2">
                                <label></label>
                                <div>
                                    <input id="scoreId" type="text" name="score_id" value="" hidden>
                                    <input id="fnId" type="text" name="fn" value="addScore" hidden>
                                    <input type="text" name="sqS" value="<?php echo $this_sq;?>" hidden>
                                    <input type="text" name="main_id" value="<?php echo $this_main_id;?>" hidden>
                                    <button id="btnSubmit" class="btn btn-success" type="submit">SAVE</button>
                                    <button id="btnClear" class="btn btn-secondary" type="button" onclick="clearScore();" hidden>CLEAR</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>


                <hr class="style1">
                <div class="text-center pt-5">
                    <h5 class="font-weight-bolder">คณะกรรมการ</h5>
                </div>
                <div class="pt-3">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">กรรมการ</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($BOARDS as $key=>$item):?>
                            <tr>
                                <td><?php echo ($key+1); ?></td>
                                <td><?php echo $item['name'].' '.$item['surname']; ?></td>
                                <td>
                                    <button class="btn btn-danger btn-sm" type="button" data-toggle="tooltip" title="Delete score"
                                            onclick="showModalDelete('<?php echo 'board-'.$item['id'];?>','<?php echo $item['name'].' '.$item['surname'];?>');">
                                        <i class="fa fa-remove"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach;?>
                        </tbody>
                    </table>

                    <form class="pt-3" method="post">
                        <div class="form-row">
                            <div class="form-group col-md-8">
                                <label for="attrBoardId">กรรมการ</label>
                                <select id="attrBoardId" name="user_id" class="selectpicker form-control" data-live-search="true" title="Please select a board ..." required>
                                    <?php foreach ($USERS as $item): ?>
                                        <option value="<?php echo $item['id'];?>">
                                            <?php echo $item['name'].' '.$item['surname'];?>
                                        </option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                            <div class="col-auto my-2">
                                <label></label>
                                <div>
                                    <input type="text" name="fn" value="addBoard" hidden>
                                    <input type="text" name="sqS" value="<?php echo $this_sq;?>" hidden>
                                    <input type="text" name="main_id" value="<?php echo $this_main_id;?>" hidden>
                                    <button class="btn btn-success" type="submit">SAVE</button>
                                </div>
                            </div>
                        </div>
                    </form>

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
<?php
require_once __DIR__.'/_main_script.php';
require_once __DIR__.'/_datepicker_script.php';
?>


<script>
    $(function() {
        $('.datepicker').datepicker({
            format: 'dd/mm/yyyy',
            language: 'th',
            orientation: 'bottom'
        });
    });

    function editScore(id) {
        var text = $('#textTdId'+id).text();
        var score = $('#scoreTdId'+id).text();

        $('#attrScoreTextId').val(text);
        $('#attrScorePointId').val(score);
        $('#btnSubmit').removeClass('btn-success');
        $('#btnSubmit').addClass('btn-warning');
        $('#btnSubmit').text('EDIT');
        $('#btnClear').attr('hidden',false);

        $('#fnId').val('editScore');
        $('#scoreId').val(id);
    }

    function clearScore() {
        $('#attrScoreTextId').val('');
        $('#attrScorePointId').val('');
        $('#btnSubmit').removeClass('btn-warning');
        $('#btnSubmit').addClass('btn-success');
        $('#btnSubmit').text('SAVE');
        $('#btnClear').attr('hidden',true);
        $('#fnId').val('addScore');
    }

</script>

</body>
</html>
<?php
/**
 * Created by PhpStorm.
 * User: PF0T4E5G
 * Date: 28/3/2562
 * Time: 07:02 หลังเที่ยง
 */

require_once __DIR__.'/_session.php';
require_once __DIR__.'/_session_login.php';

$MENU_LEFT = 'training-set';

require_once __DIR__.'/controller/trainingAddController.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once __DIR__.'/_main_css.php';?>
    <?php require_once __DIR__.'/_datepicker_css.php';?>
    <?php require_once __DIR__.'/_froala_css.php';?>

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
                    <h2 class="h-c"><i class="fa fa-edit icon-zoom"></i> เพิ่ม/แก้ไข อบรม</h2>
                    <hr class="style1">
                </div>
                <div class="p-0">

                    <!-- alert status -->
                    <div class="p-0">
                        <?php require_once __DIR__.'/_alert.php';?>
                    </div>

                    <div class="mt-3 text-info">
                        <h3><i class="fa fa-gear icon-zoom"></i> Setting </h3>
                        <hr>
                    </div>

                    <!-- project -->
                    <div class="form-group">
                        <label class="label-control" for="trainingProjectInputId">โครงการ</label>
                        <select class="form-control" id="trainingProjectInputId">
                            <option value="<?php echo $this_main_pro_id; ?>" selected> <?php echo $this_main_pro_name; ?> </option>
                        </select>
                    </div>
                    <div class="form-group offset-1">
                        <label class="label-control" for="trainingGroupInputId">กำหนดผู้เข้าร่วมโครงการ</label>
                        <select class="form-control" id="trainingGroupInputId">
                            <option value="PASS" <?php echo $this_t_group=='PASS'?'selected':'';?> > ทีมที่ผ่านเข้ารอบ </option>
                            <option value="TEACHER" <?php echo $this_t_group=='TEACHER'?'selected':'';?> > ครู (ที่ไม่ผ่านเข้ารอบ) </option>
                            <option value="STUDENT" <?php echo $this_t_group=='STUDENT'?'selected':'';?> > นักเรียน (ที่ไม่ผ่านเข้ารอบ) </option>
                            <option value="ALL" <?php echo $this_t_group=='ALL'?'selected':'';?> > ทั้งหมด </option>
                        </select>
                    </div>
                    <div class="form-group offset-1">
                        <label class="label-control" for="trainingPhaseInputId">Phase โครงการ</label>
                        <select class="form-control" id="trainingPhaseInputId">
                            <?php foreach ($PHASE as $key=>$item): ?>
                                <option value="<?php echo $item['sq']; ?>" <?php echo $item['sq']==$this_t_sq?'selected':''; ?> > ขั้นที่ <?php echo $item['sq'].' '. $item['title'];?> </option>
                            <?php endforeach;?>
                        </select>
                    </div>

                    <hr>
                    <!-- shirt -->
                    <div class="p-3" style="background-color: gainsboro;">
                        <div class="form-inline">
                            <div class="form-group mr-3">
                                <label class="col-form-label">เสื้อ:</label>
                            </div>
                            <div class="custom-control custom-radio my-1 mr-sm-2">
                                <input name="shirt_active" value="Y" type="radio" class="custom-control-input" id="trainingShirtYId" <?php echo $this_t_shirt=='Y'?'checked':''; ?> >
                                <label class="custom-control-label" for="trainingShirtYId"> มีการจัดทำเสื้อ </label>
                            </div>
                            <div class="custom-control custom-radio my-1 mr-sm-2">
                                <input name="shirt_active" value="N" type="radio" class="custom-control-input" id="trainingShirtNId" <?php echo $this_t_shirt=='N'?'checked':''; ?> >
                                <label class="custom-control-label" for="trainingShirtNId"> ไม่มีการจัดทำเสื้อ</label>
                            </div>
                        </div>

                        <div class="form-inline offset-1">
                            <div class="form-group mr-3">
                                <label class="col-form-label"> ขนาดเสื้อ:</label>
                            </div>
                            <?php
                            $SHIRT_SIZE = ['3S','2S','S','M','L','XL','XXL','3XL'];
                            ?>
                            <?php foreach ($SHIRT_SIZE as $key=>$item): ?>
                                <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                    <input name="shirt_size" value="<?php echo $item; ?>" type="checkbox" class="custom-control-input" id="trainingShirt<?php echo $item; ?>Id" <?php echo in_array($item,$this_t_shirts)?'checked':''; ?> >
                                    <label class="custom-control-label mr-3" for="trainingShirt<?php echo $item; ?>Id"> <?php echo $item; ?> </label>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <hr>
                    <!-- date -->
                    <div class="form-inline pt-3">
                        <div class="form-group mr-3">
                            <label class="col-form-label"> วันที่เปิดให้ยืนยัน: </label>
                        </div>
                        <div class="col-4">
                            <div class="form-inline">
                                <label class="my-1 mr-2" for="trainingDateStartId"> เริ่ม <i class="fa fa-calendar ml-1"></i></label>
                                <input type="text" class="datepicker form-control" id="trainingDateStartId" value="<?php echo $this_t_start;?>">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-inline">
                                <label class="my-1 mr-2" for="trainingDateEndId"> สิ้นสุด <i class="fa fa-calendar ml-1"></i></label>
                                <input type="text" class="datepicker form-control" id="trainingDateEndId" value="<?php echo $this_t_end;?>">
                            </div>
                        </div>
                    </div>

                    <hr>
                    <!-- state -->
                    <div class="mt-3 mb-1 p-3" style="background-color: gainsboro;">
                        <div class="text-dark" id="trainingStateShowId">

                            <?php foreach ($this_t_state as $key=>$item): ?>
                                <div id="stateId<?php echo ($key+1); ?>">
                                    <span class="trainingNameClass"><?php echo $item;?></span>
                                    <span class="ml-2 text-danger" style="cursor: pointer;" onclick="fnDeleteState(<?php echo ($key+1); ?>);">
                                        <i class="fa fa-remove icon-zoom"></i>
                                    </span>
                                </div>
                            <?php endforeach;?>

                        </div>
                        <hr>
                        <div class="form-row">
                            <label class="col-form-label text-dark"> สถานที่จัดอบรม </label>
                            <div class="col">
                                <input id="trainingStateNameId" type="text" class="form-control" placeholder="สถานที่จัดอบรม">
                            </div>
                            <button type="button" class="btn btn-success" onclick="fnAddState()">Add</button>
                        </div>
                    </div>

                    <hr>
                    <!-- check in -->
                    <div class="p-3">
                        <div class="form-inline">
                            <div class="form-group mr-3">
                                <label class="col-form-label">Check in โรงแรม:</label>
                            </div>
                            <div class="custom-control custom-radio my-1 mr-sm-2">
                                <input name="check_in_active" value="Y" type="radio" class="custom-control-input" id="checkInYId" <?php echo $this_checkIn_status=='Y'?'checked':''; ?> >
                                <label class="custom-control-label" for="checkInYId"> มี </label>
                            </div>
                            <div class="custom-control custom-radio my-1 mr-sm-2">
                                <input name="check_in_active" value="N" type="radio" class="custom-control-input" id="checkInNId" <?php echo $this_checkIn_status=='N'?'checked':''; ?> >
                                <label class="custom-control-label" for="checkInNId"> ไม่มี </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="checkInDetailId">รายละเอียด check in โรงแรม</label>
                            <textarea class="form-control" id="checkInDetailId" rows="3" <?php echo $this_checkIn_status=='Y'?'':'disabled'; ?>><?php echo $this_checkIn_detail;?></textarea>
                        </div>
                    </div>

                    <hr>
                    <!-- description -->
                    <div class="form-group pt-3">
                        <label class="label-control" for="trainingTitleId">หัวข้อการอบรม</label>
                        <input id="trainingTitleId" class="form-control" type="text" value="<?php echo $this_t_title;?>" >
                    </div>
                    <p>รายละเอียดการอบรม</p>
                    <div class="p-0">
                        <div id="editor">
                            <div id='edit'> <?php echo $this_t_detail;?>
                            </div>
                        </div>
                    </div>
                    <div class="text-center pt-4">
                        <?php if($tid==''):?>
                            <button type="button" class="btn btn-lg btn-success" onclick="fnAddTraining()"> SAVE </button>
                        <?php else: ?>
                            <input id="trainingIdId" value="<?php echo $tid;?>" type="text" hidden>
                            <button type="button" class="btn btn-lg btn-warning" onclick="fnEditTraining()"> EDIT </button>
                        <?php endif;?>


                    </div>


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
require_once __DIR__.'/_datepicker_script.php';
require_once __DIR__.'/_froala_script.php';
?>



<script>
    $(function() {
        $('#edit').froalaEditor({
            heightMin: 250,
        });
        $('.datepicker').datepicker({
            format: 'dd/mm/yyyy',
            language: 'th',
            orientation: 'bottom'
        });
    });

    function fnDomInput(name , value) {
        var domHtml = $('<input>')
            .attr("type","text")
            .attr("name",name)
            .attr("value",value);
        return domHtml;
    }
    function fnDomTextarea(name,value) {
        var domHtml = $('<textarea>')
            .attr("type","text")
            .attr("name",name)
            .html(value);
        return domHtml;
    }

    //change shirt active
    $('input[type=radio][name=shirt_active]').change(function() {
        if (this.value == 'Y') {
            $('input[type=checkbox][name=shirt_size]').each(function () {
                $(this).removeAttr('disabled');
            });
        }
        else if (this.value == 'N') {
            $('input[type=checkbox][name=shirt_size]').each(function () {
                $(this).attr("disabled",true);
            });
        }
    });

    //change check in
    $('input[type=radio][name=check_in_active]').change(function() {
        if (this.value == 'Y') {
            $('#checkInDetailId').attr('disabled',false);
        }
        else if (this.value == 'N') {
            $('#checkInDetailId').attr('disabled',true);
        }
    });

    //add state
    function fnAddState() {
        var trainingName = $('#trainingStateNameId').val();
        if(trainingName==='' || trainingName===undefined){
            $('#trainingStateNameId').focus();
        }else{
            var numRan = Math.floor((Math.random() * 100) + 1);
            var str = '<div id="stateId'+numRan+'">' +
                '<span class="trainingNameClass">'+trainingName+'</span>' +
                '<span class="ml-2 text-danger" style="cursor: pointer;" onclick="fnDeleteState('+numRan+');">' +
                '<i class="fa fa-remove icon-zoom"></i>' +
                '</span>' +
                '</div>';
            $('#trainingStateShowId').append(str);
            $('#trainingStateNameId').val("");
        }
    }
    //delete state
    function fnDeleteState(id) {
        $('#stateId'+id).remove();
    }

    function fnAddTraining() {
        var main_id = $('#trainingProjectInputId').val()
        var training_group = $('#trainingGroupInputId').val();
        var main_phase = $('#trainingPhaseInputId').val();
        var shirt_active = $('input[type=radio][name=shirt_active]:checked').val();
        var date_start = $('#trainingDateStartId').val();
        var date_end = $('#trainingDateEndId').val();
        var training_title = $('#trainingTitleId').val();

        var checkIn_active = $('input[type=radio][name=check_in_active]:checked').val();
        var checkIn_detail = $('#checkInDetailId').val();

        var shirt_size = [];
        $('input[type=checkbox][name=shirt_size]:checked').each(function () {
            shirt_size.push($(this).val());
        });

        var training_list = [];
        $('.trainingNameClass').each(function () {
            training_list.push($(this).text());
        });

        if(date_start==='' || date_start===undefined){
            $('#trainingDateStartId').focus();
        }
        else if(date_end==='' || date_end===undefined){
            $('#trainingDateEndId').focus();
        }
        else if(training_list.length<=0){
            $('#trainingStateNameId').focus();
        }
        else if(training_title===undefined || training_title===''){
            $('#trainingTitleId').focus();
        }

        else{
            var text = $('#edit').froalaEditor('html.get');

            var text_size = "";
            if(shirt_size.length>0){
                text_size = shirt_size.join(":");
            }

            var text_state = "";
            if(training_list.length>0){
                text_state = training_list.join(":");
            }

            var form = $(document.createElement('form'));
            $(form).attr("method","POST");
            $(form).attr('hidden',true);

            $(form).append(fnDomInput("main_id",main_id));
            $(form).append(fnDomInput("sq",main_phase));
            $(form).append(fnDomInput("training_group",training_group));
            $(form).append(fnDomInput("shirt_active",shirt_active));
            $(form).append(fnDomInput("shirt_list",text_size));
            $(form).append(fnDomInput("state_list",text_state));
            $(form).append(fnDomInput("date_start",date_start));
            $(form).append(fnDomInput("date_end",date_end));
            $(form).append(fnDomInput("training_title",training_title));
            $(form).append(fnDomTextarea("training_detail",text));
            $(form).append(fnDomInput("checkin_active",checkIn_active));
            $(form).append(fnDomTextarea("checkin_detail",checkIn_detail));
            $(form).append(fnDomInput("fn","addTraining"));
            form.appendTo(document.body );
            $(form).submit();


        }

    }
    function fnEditTraining() {
        var main_id = $('#trainingProjectInputId').val()
        var training_group = $('#trainingGroupInputId').val();
        var main_phase = $('#trainingPhaseInputId').val();
        var shirt_active = $('input[type=radio][name=shirt_active]:checked').val();
        var date_start = $('#trainingDateStartId').val();
        var date_end = $('#trainingDateEndId').val();
        var training_title = $('#trainingTitleId').val();

        var checkIn_active = $('input[type=radio][name=check_in_active]:checked').val();
        var checkIn_detail = $('#checkInDetailId').val();

        var shirt_size = [];
        $('input[type=checkbox][name=shirt_size]:checked').each(function () {
            shirt_size.push($(this).val());
        });

        var training_list = [];
        $('.trainingNameClass').each(function () {
            training_list.push($(this).text());
        });

        if(date_start==='' || date_start===undefined){
            $('#trainingDateStartId').focus();
        }
        else if(date_end==='' || date_end===undefined){
            $('#trainingDateEndId').focus();
        }
        else if(training_list.length<=0){
            $('#trainingStateNameId').focus();
        }
        else if(training_title===undefined || training_title===''){
            $('#trainingTitleId').focus();
        }

        else{
            var text = $('#edit').froalaEditor('html.get');

            var text_size = "";
            if(shirt_size.length>0){
                text_size = shirt_size.join(":");
            }

            var text_state = "";
            if(training_list.length>0){
                text_state = training_list.join(":");
            }

            var form = $(document.createElement('form'));
            $(form).attr("method","POST");
            $(form).attr('hidden',true);

            $(form).append(fnDomInput("main_id",main_id));
            $(form).append(fnDomInput("sq",main_phase));
            $(form).append(fnDomInput("training_group",training_group));
            $(form).append(fnDomInput("shirt_active",shirt_active));
            $(form).append(fnDomInput("shirt_list",text_size));
            $(form).append(fnDomInput("state_list",text_state));
            $(form).append(fnDomInput("date_start",date_start));
            $(form).append(fnDomInput("date_end",date_end));
            $(form).append(fnDomInput("training_title",training_title));
            $(form).append(fnDomTextarea("training_detail",text));
            $(form).append(fnDomInput("checkin_active",checkIn_active));
            $(form).append(fnDomTextarea("checkin_detail",checkIn_detail));
            $(form).append(fnDomInput("fn","editTraining"));
            form.appendTo(document.body );
            $(form).submit();


        }

    }






</script>

</body>
</html>
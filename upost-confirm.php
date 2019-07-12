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
$MONTH_TH = ["","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม"];
require_once __DIR__.'/controller/upostConfirmController.php';


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    require_once __DIR__ . '/_main_css.php';
    ?>

    <link rel="stylesheet" href="/lib/froala/css/froala_style.css">

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
                    <h2 class="h-c"><i class="fa fa-envelope-o icon-zoom"></i> ยืนยันเข้าร่วมอบรม</h2>
                    <hr class="style1">
                </div>

                <!-- alert status -->
                <div class="p-1">
                    <?php require_once __DIR__.'/_alert.php';?>
                </div>

                <div class="p-0">

                    <div class="card p-2">
                        <div class="fr-view">
                            <?php echo $this_t_detail;?>
                        </div>
                    </div>

                    <hr class="style1">
                    <div id="alertTrainingConfirm" class="card p-4 <?php echo $this_t_confirm=='Y'?'alert-success':'alert-danger'; ?>">
                        <div class="form-inline offset-3">
                            <div class="custom-control custom-radio my-1 mr-sm-2">
                                <input name="training_confirm" value="Y" type="radio" class="custom-control-input" id="trainingConfirmYId" <?php echo $this_t_confirm=='Y'?'checked':''; ?> >
                                <label class="custom-control-label" for="trainingConfirmYId"> ยืนยันเข้าร่วมอบรม </label>
                            </div>
                            <div class="custom-control custom-radio my-1 mr-sm-2 ml-5">
                                <input name="training_confirm" value="N" type="radio" class="custom-control-input" id="trainingConfirmNId" <?php echo $this_t_confirm=='N'?'checked':''; ?> >
                                <label class="custom-control-label" for="trainingConfirmNId"> ไม่เข้าร่วมอบรม </label>
                            </div>
                        </div>
                    </div>
                    <div class="pt-3">
                        <div class="form-group">
                            <label for="confirmStateId" class="font-weight-bold text-primary">
                                สถานที่จัดอมรม
                            </label>
                            <select id="confirmStateId" class="form-control">
                                <option value="">กรุณาเลือกศูนย์อบรม</option>
                                <?php foreach ($STATE as $k=>$i):?>
                                    <option value="<?php echo $i;?>" <?php echo $i==$this_t_state?'selected':''; ?> > <?php echo $i;?> </option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>

                    <!-- check in -->
                    <?php if($this_checkin_active=='Y'):?>
                        <hr class="style1">
                        <p class="font-weight-bold text-primary">Check in โรงแรม</p>
                        <div class="card p-3">
                        <div class="">
                            <pre><?php echo $this_checkin_detail; ?></pre>
                        </div>
                        <div class="form-row">

                            <div class="form-group col-md-2">
                                <label for="checkInDId">วันที่</label>
                                <select class="form-control" id="checkInDId">
                                    <?php for($i=1;$i<=31;$i++): ?>
                                    <option value="<?php echo $i;?>" <?php echo $i==$c_d?'selected':''; ?> ><?php echo $i;?></option>
                                    <?php endfor;?>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="checkInMId">เดือน</label>
                                <select class="form-control" id="checkInMId">
                                    <?php for($i=1;$i<=12;$i++): ?>
                                        <option value="<?php echo $i;?>" <?php echo $i==$c_m?'selected':''; ?> ><?php echo $MONTH_TH[$i];?></option>
                                    <?php endfor;?>
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="checkInYId">ปี</label>
                                <select class="form-control" id="checkInYId">
                                    <?php $d = intval(date('Y'));?>
                                    <?php for($i= $d;$i>($d-5);$i--): ?>
                                        <option value="<?php echo $i;?>" <?php echo $i==$c_y?'selected':''; ?> ><?php echo $i;?></option>
                                    <?php endfor;?>
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="checkInHId">เวลา</label>
                                <select class="form-control" id="checkInHId">
                                    <?php for($i=1;$i<=24;$i++): ?>
                                        <option value="<?php echo $i;?>" <?php echo $i==$c_h?'selected':''; ?>><?php echo $i;?></option>
                                    <?php endfor;?>
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="checkInNId">นาที</label>
                                <select class="form-control" id="checkInNId">
                                    <?php for($i=1;$i<=59;$i++): ?>
                                        <option value="<?php echo $i;?>" <?php echo $i==$c_n?'selected':''; ?>><?php echo $i;?></option>
                                    <?php endfor;?>
                                </select>
                            </div>

                        </div>
                    </div>
                    <?php endif;?>

                    <!-- teacher -->
                    <?php if(count($TEACHER)>0):?>
                        <hr class="style1">
                        <p class="font-weight-bold text-primary">อาจารย์ / ที่ปรึกษาโครงการ</p>
                        <?php foreach ($TEACHER as $key=>$item):?>
                            <div class="card p-3" style="background-color: whitesmoke;">
                                <div class="form-row">
                                    <div class="form-group col-md-2">
                                        <label for="confirmNameTitleIdT_<?php echo ($key+1); ?>">คำนำหน้าชื่อ</label>
                                        <select id="confirmNameTitleIdT_<?php echo ($key+1); ?>"
                                                class="form-control">
                                            <option value="นาย" <?php echo $item['name_title']=='นาย'?'selected':''; ?> > นาย </option>
                                            <option value="นางสาว" <?php echo $item['name_title']=='นางสาว'?'selected':''; ?> > นางสาว </option>
                                            <option value="นาง" <?php echo $item['name_title']=='นาง'?'selected':''; ?> > นาง </option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-5">
                                        <label for="confirmNameIdT_<?php echo ($key+1); ?>">ชื่อ</label>
                                        <input type="text" class="form-control"
                                               id="confirmNameIdT_<?php echo ($key+1); ?>" placeholder="ชื่อ"
                                               value="<?php echo $item['name']; ?>">
                                    </div>
                                    <div class="form-group col-md-5">
                                        <label for="confirmSurnameIdT_<?php echo ($key+1); ?>">นามสกุล</label>
                                        <input type="text" class="form-control"
                                               id="confirmSurnameIdT_<?php echo ($key+1); ?>" placeholder="นามสกุล"
                                               value="<?php echo $item['surname']; ?>">
                                    </div>
                                </div>

                                <div class="form-row pt-2">
                                    <div class="form-group col-md-6">
                                        <label for="confirmClassIdT_<?php echo ($key+1); ?>">ตำแหน่ง</label>
                                        <input type="text" class="form-control"
                                               id="confirmClassIdT_<?php echo ($key+1); ?>" placeholder="ตำแหน่ง อาจารย์,ดร.,รศ.ดร.,ผศ.ดร."
                                               value="<?php echo $item['member_class']; ?>">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="confirmPhoneIdT_<?php echo ($key+1); ?>">เบอร์โทร</label>
                                        <input type="text" class="form-control"
                                               id="confirmPhoneIdT_<?php echo ($key+1); ?>" placeholder="เบอร์โทร"
                                               value="<?php echo $item['phone']; ?>">
                                    </div>
                                </div>

                                <?php if($this_t_shirt=='Y'):?>
                                <div class="form-inline pt-2">
                                    <div class="form-group mr-3">
                                        <label class="col-form-label"> ขนาดเสื้อ:</label>
                                    </div>
                                    <?php foreach ($SHIRT_SIZE as $k=>$i): ?>
                                        <div class="custom-control custom-radio my-1 mr-sm-2">
                                            <input name="shirt_sizeT_<?php echo ($key+1); ?>" value="<?php echo $i; ?>"
                                                   type="radio" class="custom-control-input" id="trainingShirt<?php echo $i; ?>IdT_<?php echo ($key+1); ?>"
                                                <?php echo $i==$item['shirt_size']?'checked':''; ?> >
                                            <label class="custom-control-label mr-3"
                                                   for="trainingShirt<?php echo $i; ?>IdT_<?php echo ($key+1); ?>">
                                                <?php echo $i; ?>
                                            </label>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <?php endif;?>

                                <div class="form-inline pt-2">
                                    <div class="custom-control custom-radio my-1 mr-sm-2">
                                        <input name="vegetarianT_<?php echo ($key+1); ?>" value="Y" type="radio" class="custom-control-input"
                                               id="trainingVegetarianYIdT_<?php echo ($key+1); ?>" <?php echo $item['vegetarian']=='Y'?'checked':''; ?> >
                                        <label class="custom-control-label" for="trainingVegetarianYIdT_<?php echo ($key+1); ?>"> รับประทานมังสวิรัติ </label>
                                    </div>
                                    <div class="custom-control custom-radio my-1 mr-sm-2 ml-5">
                                        <input name="vegetarianT_<?php echo ($key+1); ?>" value="N" type="radio" class="custom-control-input"
                                               id="trainingVegetarianNIdT_<?php echo ($key+1); ?>" <?php echo $item['vegetarian']=='N'?'checked':''; ?> >
                                        <label class="custom-control-label" for="trainingVegetarianNIdT_<?php echo ($key+1); ?>"> รับประทานปกติทั่วไป </label>
                                    </div>
                                </div>

                                <input id="confirmUserIdT_<?php echo ($key+1); ?>" value="<?php echo $item['user_id'];?>" hidden>

                            </div>
                        <?php endforeach;?>

                    <?php endif;?>

                    <!-- student -->
                    <?php if(count($STUDENT)>0):?>
                        <hr class="style1">
                        <p class="font-weight-bold text-primary">นักเรียน</p>
                        <?php foreach ($STUDENT as $key=>$item):?>
                            <div class="card p-3 mt-2" style="background-color: whitesmoke;">
                                <div class="form-row">
                                    <div class="form-group col-md-2">
                                        <label for="confirmNameTitleIdS_<?php echo ($key+1); ?>">คำนำหน้าชื่อ</label>
                                        <select id="confirmNameTitleIdS_<?php echo ($key+1); ?>"
                                                class="form-control">
                                            <option value="นาย" <?php echo $item['name_title']=='นาย'?'selected':''; ?> > นาย </option>
                                            <option value="นางสาว" <?php echo $item['name_title']=='นางสาว'?'selected':''; ?> > นางสาว </option>
                                            <option value="นาง" <?php echo $item['name_title']=='นาง'?'selected':''; ?> > นาง </option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-5">
                                        <label for="confirmNameIdS_<?php echo ($key+1); ?>">ชื่อ</label>
                                        <input type="text" class="form-control"
                                               id="confirmNameIdS_<?php echo ($key+1); ?>" placeholder="ชื่อ"
                                               value="<?php echo $item['name']; ?>">
                                    </div>
                                    <div class="form-group col-md-5">
                                        <label for="confirmSurnameIdS_<?php echo ($key+1); ?>">นามสกุล</label>
                                        <input type="text" class="form-control"
                                               id="confirmSurnameIdS_<?php echo ($key+1); ?>" placeholder="นามสกุล"
                                               value="<?php echo $item['surname']; ?>">
                                    </div>
                                </div>

                                <div class="form-row pt-2">
                                    <div class="form-group col-md-6">
                                        <label for="confirmClassIdS_<?php echo ($key+1); ?>">ชั้น</label>
                                        <input type="text" class="form-control"
                                               id="confirmClassIdS_<?php echo ($key+1); ?>" placeholder="ม.1/1"
                                               value="<?php echo $item['member_class']; ?>">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="confirmPhoneIdS_<?php echo ($key+1); ?>">เบอร์โทร</label>
                                        <input type="text" class="form-control"
                                               id="confirmPhoneIdS_<?php echo ($key+1); ?>" placeholder="เบอร์โทร"
                                               value="<?php echo $item['phone']; ?>">
                                    </div>
                                </div>

                                <?php if($this_t_shirt=='Y'):?>
                                <div class="form-inline pt-2">
                                    <div class="form-group mr-3">
                                        <label class="col-form-label"> ขนาดเสื้อ:</label>
                                    </div>
                                    <?php foreach ($SHIRT_SIZE as $k=>$i): ?>
                                        <div class="custom-control custom-radio my-1 mr-sm-2">
                                            <input name="shirt_sizeS_<?php echo ($key+1); ?>" value="<?php echo $i; ?>"
                                                   type="radio" class="custom-control-input" id="trainingShirt<?php echo $i; ?>IdS_<?php echo ($key+1); ?>"
                                                <?php echo $i==$item['shirt_size']?'checked':''; ?> >
                                            <label class="custom-control-label mr-3"
                                                   for="trainingShirt<?php echo $i; ?>IdS_<?php echo ($key+1); ?>">
                                                <?php echo $i; ?>
                                            </label>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <?php endif;?>

                                <div class="form-inline pt-2">
                                    <div class="custom-control custom-radio my-1 mr-sm-2">
                                        <input name="vegetarianS_<?php echo ($key+1); ?>" value="Y" type="radio" class="custom-control-input"
                                               id="trainingVegetarianYIdS_<?php echo ($key+1); ?>" <?php echo $item['vegetarian']=='Y'?'checked':''; ?> >
                                        <label class="custom-control-label" for="trainingVegetarianYIdS_<?php echo ($key+1); ?>"> รับประทานมังสวิรัติ </label>
                                    </div>
                                    <div class="custom-control custom-radio my-1 mr-sm-2 ml-5">
                                        <input name="vegetarianS_<?php echo ($key+1); ?>" value="N" type="radio" class="custom-control-input"
                                               id="trainingVegetarianNIdS_<?php echo ($key+1); ?>" <?php echo $item['vegetarian']=='N'?'checked':''; ?> >
                                        <label class="custom-control-label" for="trainingVegetarianNIdS_<?php echo ($key+1); ?>"> รับประทานปกติทั่วไป </label>
                                    </div>
                                </div>

                                <input id="confirmUserIdS_<?php echo ($key+1); ?>" value="<?php echo $item['user_id'];?>" hidden>

                            </div>
                        <?php endforeach;?>

                    <?php endif;?>

                    <!-- driver -->
                    <?php if($this_t_group=='PASS'):?>
                        <hr class="style1">
                        <div class="pt-3">
                        <div class="form-group">
                            <label for="confirmDriverId" class="font-weight-bold text-primary">เจ้าหน้าที่ยานพาหนะโรงเรียน</label>
                            <textarea rows="3" class="form-control" id="confirmDriverId" placeholder="1. ชื่อ - สกุล"><?php echo $this_t_driver;?></textarea>
                        </div>
                    </div>
                    <?php endif;?>


                    <div class="text-center row pt-3">
                        <div class="offset-3 col-6">
                            <?php if($this_t_group=='PASS'): ?>
                                <button class="btn btn-success btn-block btn-lg" type="button" onclick="fnConfirmTrainingGroupPass()" > ยืนยันข้อมูล </button>
                            <?php elseif($this_t_group=='TEACHER'):?>
                                <button class="btn btn-success btn-block btn-lg" type="button" onclick="fnConfirmTrainingGroupTeacher()" > ยืนยันข้อมูล </button>
                            <?php elseif($this_t_group=='STUDENT'):?>
                                <button class="btn btn-success btn-block btn-lg" type="button" onclick="fnConfirmTrainingGroupStudent()" > ยืนยันข้อมูล </button>
                            <?php endif;?>
                        </div>
                    </div>


                </div>

            </div>

        </div>

    </div>

</div>
<div class="valueDefaultId" hidden>
    <input id="defaultTrainingGroupId" value="<?php echo $this_t_group; ?>" hidden>
    <input id="defaultCheckInActiveId" value="<?php echo $this_checkin_active; ?>" hidden>
    <input id="defaultMainTrainingIdId" value="<?php echo $this_m_t_id; ?>" hidden>
    <input id="defaultProjectIdId" value="<?php echo $this_pro_id; ?>" hidden>

    <input id="defaultShirtActiveId" value="<?php echo $this_t_shirt; ?>" hidden>

    <input id="defaultCountTeacherId" value="<?php echo count($TEACHER); ?>" hidden>
    <input id="defaultCountStudentId" value="<?php echo count($STUDENT); ?>" hidden>


</div>

<footer class="footer">
    <?php require_once __DIR__ . '/_main_footer.php'; ?>
</footer>


<!-- main script -->
<?php
require_once __DIR__ . '/_main_script.php';
?>



<script>

    //for post
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

    //for date checkin
    function fnGetDateCheckIn(){
        var d = $("#checkInDId").val();
        var m = $("#checkInMId").val();
        var y = $("#checkInYId").val();

        var h = $("#checkInHId").val();
        var n = $("#checkInNId").val();

        return d+"-"+m+"-"+y+" "+h+":"+n;
    }

    $('input:radio[name=training_confirm]').on('change',function () {
        var value = $("input[name='training_confirm']:checked").val();
        if(value==='Y'){
            $('#alertTrainingConfirm').removeClass("alert-danger");
            $('#alertTrainingConfirm').addClass("alert-success");
        }else{
            $('#alertTrainingConfirm').removeClass("alert-success");
            $('#alertTrainingConfirm').addClass("alert-danger");
        }

    });


</script>

<?php if($this_t_group=='PASS'): ?>
    <script>
        function fnConfirmTrainingGroupPass() {
            var arrSend = [];
            var arrAtr = {};
            var mainTrainingId = $("#defaultMainTrainingIdId").val();
            var mainTrainingGroup = $("#defaultTrainingGroupId").val();
            var projectId = $("#defaultProjectIdId").val();
            var trainingConfirm = $("input[name='training_confirm']:checked").val();
            var trainingState = $("#confirmStateId").val();

            var checkinDateTime = "";
            var checkinActive = $("#defaultCheckInActiveId").val();
            if(checkinActive==='Y'){
                checkinDateTime = fnGetDateCheckIn();
            }

            var driver = "";
            if(mainTrainingGroup==='PASS'){
                driver = $("#confirmDriverId").val();
            }

            //shirt
            var shirtActive = $("#defaultShirtActiveId").val();

            if( trainingState==='' || trainingState===undefined  ){
                alert("กรุณาเลือกศูนย์อบรม");
                $("#confirmStateId").focus();
            }
            else{
                var i =1;
                var nameTitle="",name="",surname="" ,txtClass="",phone="",shirt="",vegetarian="",userId;
                var check = true;
                //sol teacher
                var countTeacher = $("#defaultCountTeacherId").val();
                for (i=1;i<=countTeacher;i++){

                    name = $("#confirmNameIdT_"+i).val();
                    surname = $("#confirmSurnameIdT_"+i).val();

                    if(name==='' || name===undefined){
                        check=false;
                        $("#confirmNameIdT_"+i).focus();
                        break;
                    }
                    else if(surname==='' || surname===undefined){
                        check=false;
                        $("#confirmSurnameIdT_"+i).focus();
                        break;
                    }
                    else{

                        nameTitle = $("#confirmNameTitleIdT_"+i).val();
                        txtClass = $("#confirmClassIdT_"+i).val();
                        phone = $("#confirmPhoneIdT_"+i).val();
                        userId = $("#confirmUserIdT_"+i).val();
                        vegetarian = $("input[name='vegetarianT_"+i+"']:checked").val();

                        shirt = "";
                        if(shirtActive==='Y'){
                            shirt = $("input[name='shirt_sizeT_"+i+"']:checked").val();
                            if(shirt===undefined){
                                shirt="";
                            }
                        }

                        arrAtr = {};
                        arrAtr['user_id'] = userId;
                        arrAtr['name_title'] = nameTitle;
                        arrAtr['name'] = name;
                        arrAtr['surname'] = surname;
                        arrAtr['member_type'] = 'TEACHER';
                        arrAtr['member_class'] = txtClass;
                        arrAtr['phone'] = phone;
                        arrAtr['size'] = shirt;
                        arrAtr['vegetarian']= vegetarian;
                        arrSend.push(arrAtr);

                    }//end else check name , surname

                }//end for teacher

                if(check){
                    //sol student
                    var countStudent = $("#defaultCountStudentId").val();
                    for (i=1;i<=countStudent;i++){

                        name = $("#confirmNameIdS_"+i).val();
                        surname = $("#confirmSurnameIdS_"+i).val();

                        if(name==='' || name===undefined){
                            check=false;
                            $("#confirmNameIdS_"+i).focus();
                            break;
                        }
                        else if(surname==='' || surname===undefined){
                            check=false;
                            $("#confirmSurnameIdS_"+i).focus();
                            break;
                        }
                        else{

                            nameTitle = $("#confirmNameTitleIdS_"+i).val();
                            txtClass = $("#confirmClassIdS_"+i).val();
                            phone = $("#confirmPhoneIdS_"+i).val();
                            userId = $("#confirmUserIdS_"+i).val();
                            vegetarian = $("input[name='vegetarianS_"+i+"']:checked").val();

                            shirt = "";
                            if(shirtActive==='Y'){
                                shirt = $("input[name='shirt_sizeS_"+i+"']:checked").val();
                                if(shirt===undefined){
                                    shirt="";
                                }
                            }

                            arrAtr = {};
                            arrAtr['user_id'] = userId;
                            arrAtr['name_title'] = nameTitle;
                            arrAtr['name'] = name;
                            arrAtr['surname'] = surname;
                            arrAtr['member_type'] = 'STUDENT';
                            arrAtr['member_class'] = txtClass;
                            arrAtr['phone'] = phone;
                            arrAtr['size'] = shirt;
                            arrAtr['vegetarian']= vegetarian;
                            arrSend.push(arrAtr);

                        }//end else check name , surname

                    }//end for teacher
                }

                if(check){

                    var form = $(document.createElement('form'));
                    $(form).attr("method","POST");
                    $(form).attr('hidden',true);

                    var raw = {};
                    raw['main_training_id'] = mainTrainingId;
                    raw['project_id'] = projectId;
                    raw['training_confirm'] = trainingConfirm;
                    raw['training_state'] = trainingState;
                    raw['checkin_datetime'] = checkinDateTime;
                    raw['driver'] = driver;
                    var rawJson = JSON.stringify(raw);
                    $(form).append(fnDomInput("training",rawJson));

                    var memberJSON = JSON.stringify(arrSend);
                    $(form).append(fnDomInput("member",memberJSON));

                    $(form).append(fnDomInput("fn","addConfirmPass"));
                    form.appendTo(document.body );
                    $(form).submit();


                }//end check
            }//end else

        }
    </script>
<?php elseif($this_t_group=='TEACHER'):?>
    <script>
        function fnConfirmTrainingGroupTeacher() {
            var arrSend = [];
            var arrAtr = {};
            var mainTrainingId = $("#defaultMainTrainingIdId").val();
            var mainTrainingGroup = $("#defaultTrainingGroupId").val();
            var projectId = $("#defaultProjectIdId").val();
            var trainingConfirm = $("input[name='training_confirm']:checked").val();
            var trainingState = $("#confirmStateId").val();

            var checkinDateTime = "";
            var checkinActive = $("#defaultCheckInActiveId").val();
            if(checkinActive==='Y'){
                checkinDateTime = fnGetDateCheckIn();
            }

            //shirt
            var shirtActive = $("#defaultShirtActiveId").val();

            if( trainingState==='' || trainingState===undefined  ){
                alert("กรุณาเลือกศูนย์อบรม");
                $("#confirmStateId").focus();
            }
            else{
                var i =1;
                var nameTitle="",name="",surname="" ,txtClass="",phone="",shirt="",vegetarian="",userId;
                var check = true;
                //sol teacher
                var countTeacher = $("#defaultCountTeacherId").val();
                for (i=1;i<=countTeacher;i++){

                    name = $("#confirmNameIdT_"+i).val();
                    surname = $("#confirmSurnameIdT_"+i).val();

                    if(name==='' || name===undefined){
                        check=false;
                        $("#confirmNameIdT_"+i).focus();
                        break;
                    }
                    else if(surname==='' || surname===undefined){
                        check=false;
                        $("#confirmSurnameIdT_"+i).focus();
                        break;
                    }
                    else{

                        nameTitle = $("#confirmNameTitleIdT_"+i).val();
                        txtClass = $("#confirmClassIdT_"+i).val();
                        phone = $("#confirmPhoneIdT_"+i).val();
                        userId = $("#confirmUserIdT_"+i).val();
                        vegetarian = $("input[name='vegetarianT_"+i+"']:checked").val();

                        shirt = "";
                        if(shirtActive==='Y'){
                            shirt = $("input[name='shirt_sizeT_"+i+"']:checked").val();
                            if(shirt===undefined){
                                shirt="";
                            }
                        }

                        arrAtr = {};
                        arrAtr['user_id'] = userId;
                        arrAtr['name_title'] = nameTitle;
                        arrAtr['name'] = name;
                        arrAtr['surname'] = surname;
                        arrAtr['member_type'] = 'TEACHER';
                        arrAtr['member_class'] = txtClass;
                        arrAtr['phone'] = phone;
                        arrAtr['size'] = shirt;
                        arrAtr['vegetarian']= vegetarian;
                        arrSend.push(arrAtr);

                    }//end else check name , surname

                }//end for teacher

                if(check){

                    var form = $(document.createElement('form'));
                    $(form).attr("method","POST");
                    $(form).attr('hidden',true);

                    var raw = {};
                    raw['main_training_id'] = mainTrainingId;
                    raw['project_id'] = projectId;
                    raw['training_confirm'] = trainingConfirm;
                    raw['training_state'] = trainingState;
                    raw['checkin_datetime'] = checkinDateTime;

                    var rawJson = JSON.stringify(raw);
                    $(form).append(fnDomInput("training",rawJson));

                    var memberJSON = JSON.stringify(arrSend);
                    $(form).append(fnDomInput("member",memberJSON));

                    $(form).append(fnDomInput("fn","addConfirmTeacher"));
                    form.appendTo(document.body );
                    $(form).submit();


                }//end check
            }//end else

        }
    </script>
<?php elseif($this_t_group=='STUDENT'):?>
    <script>
        function fnConfirmTrainingGroupStudent() {
            var arrSend = [];
            var arrAtr = {};
            var mainTrainingId = $("#defaultMainTrainingIdId").val();
            var mainTrainingGroup = $("#defaultTrainingGroupId").val();
            var projectId = $("#defaultProjectIdId").val();
            var trainingConfirm = $("input[name='training_confirm']:checked").val();
            var trainingState = $("#confirmStateId").val();

            var checkinDateTime = "";
            var checkinActive = $("#defaultCheckInActiveId").val();
            if(checkinActive==='Y'){
                checkinDateTime = fnGetDateCheckIn();
            }

            //shirt
            var shirtActive = $("#defaultShirtActiveId").val();

            if( trainingState==='' || trainingState===undefined  ){
                alert("กรุณาเลือกศูนย์อบรม");
                $("#confirmStateId").focus();
            }
            else{
                var i =1;
                var nameTitle="",name="",surname="" ,txtClass="",phone="",shirt="",vegetarian="",userId;
                var check = true;

                //sol student
                var countStudent = $("#defaultCountStudentId").val();
                for (i=1;i<=countStudent;i++){

                    name = $("#confirmNameIdS_"+i).val();
                    surname = $("#confirmSurnameIdS_"+i).val();

                    if(name==='' || name===undefined){
                        check=false;
                        $("#confirmNameIdS_"+i).focus();
                        break;
                    }
                    else if(surname==='' || surname===undefined){
                        check=false;
                        $("#confirmSurnameIdS_"+i).focus();
                        break;
                    }
                    else{

                        nameTitle = $("#confirmNameTitleIdS_"+i).val();
                        txtClass = $("#confirmClassIdS_"+i).val();
                        phone = $("#confirmPhoneIdS_"+i).val();
                        userId = $("#confirmUserIdS_"+i).val();
                        vegetarian = $("input[name='vegetarianS_"+i+"']:checked").val();

                        shirt = "";
                        if(shirtActive==='Y'){
                            shirt = $("input[name='shirt_sizeS_"+i+"']:checked").val();
                            if(shirt===undefined){
                                shirt="";
                            }
                        }

                        arrAtr = {};
                        arrAtr['user_id'] = userId;
                        arrAtr['name_title'] = nameTitle;
                        arrAtr['name'] = name;
                        arrAtr['surname'] = surname;
                        arrAtr['member_type'] = 'STUDENT';
                        arrAtr['member_class'] = txtClass;
                        arrAtr['phone'] = phone;
                        arrAtr['size'] = shirt;
                        arrAtr['vegetarian']= vegetarian;
                        arrSend.push(arrAtr);

                    }//end else check name , surname

                }//end for teacher

                if(check){

                    var form = $(document.createElement('form'));
                    $(form).attr("method","POST");
                    $(form).attr('hidden',true);

                    var raw = {};
                    raw['main_training_id'] = mainTrainingId;
                    raw['project_id'] = projectId;
                    raw['training_confirm'] = trainingConfirm;
                    raw['training_state'] = trainingState;
                    raw['checkin_datetime'] = checkinDateTime;
                    var rawJson = JSON.stringify(raw);
                    $(form).append(fnDomInput("training",rawJson));

                    var memberJSON = JSON.stringify(arrSend);
                    $(form).append(fnDomInput("member",memberJSON));

                    $(form).append(fnDomInput("fn","addConfirmStudent"));
                    form.appendTo(document.body );
                    $(form).submit();


                }//end check
            }//end else

        }
    </script>
<?php endif;?>

</body>
</html>
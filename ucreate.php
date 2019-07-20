<?php
/**
 * Created by PhpStorm.
 * User: PF0T4E5G
 * Date: 28/3/2562
 * Time: 07:02 หลังเที่ยง
 */
require_once __DIR__.'/_session.php';
require_once __DIR__.'/_session_login.php';

$MENU_LEFT = 'ucreate';

require_once __DIR__.'/controller/userCreateController.php';
//edit disabled 190719 เอาออก

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
                    <h2 class="h-c"><i class="fa fa-plus-circle icon-zoom"></i> สร้างทีม/โครงการ</h2>
                    <hr class="style1">
                </div>

                <!-- alert status -->
                <div class="p-0">
                    <?php require_once __DIR__.'/_alert.php';?>
                </div>

                <div class="text-center p-2">
                    <h4 class="font-weight-bolder"><?php echo $this_main_name.' '.$this_main_year;?></h4>
                    <h4>( <?php echo $this_main_name_en.' '.$this_main_year;?> )</h4>
                </div>
                <hr>
                <div class="pr-5 pl-5">
                    <form class="form-validation" method="post" novalidate>

                        <div class="form-group">
                            <label class="label-control">ชื่อโครงการ</label>
                            <input class="form-control" type="text" name="name" value="<?php echo $this_pro_name;?>" required <?php echo $DISABLE;?> >
                            <div class="invalid-feedback">
                                กรุณากรอกชื่อโครงการ
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="label-control">ชื่อโครงการ(ภาษาอังกฤษ)</label>
                            <input class="form-control" type="text" name="name_en" value="<?php echo $this_pro_name_en;?>" required <?php echo $DISABLE;?> >
                            <div class="invalid-feedback">
                                กรุณากรอกชื่อโครงการ (ภาษาอังกฤษ)
                            </div>
                        </div>
                        <!-- cherry 190819 -->
                        <div class="form-group pt-3">
                            <label class="label-control" for="idSchool">โรงเรียน / สถานศึกษา </label>
                            <select id="idSchool" name="school_name" class="selectpicker form-control" data-live-search="true" title="Please select a school ..." required <?php echo $DISABLE;?> >
                                <?php foreach ($SCHOOLS as $item): ?>
                                    <option value="<?php echo $item['school_name'];?>" <?php echo $item['school_name']==$this_school?'selected':'';?> >
                                        <?php echo $item['school_name'].'('.$item['province'].')';?>
                                    </option>
                                <?php endforeach;?>
                            </select>
                        </div>

                        <div class="form-group pt-3 pb-3">
                            <label class="label-control">อาจารย์ / ที่ปรึกษาโครงการ</label>
                            <input class="form-control" type="text" name="adviser" value="<?php echo $this_name_title.''.$this_name.' '.$this_surname;?>" required >
                            <div class="invalid-feedback">
                                กรุณากรอก อาจารย์ / ที่ปรึกษาโครงการ
                            </div>
                        </div>

                        <p>นักเรียน / นักศึกษา </p>
                        <div class="pb-2" id="devShowStudentSelect">

                            <?php foreach ($MEMBERS as $key=>$item):?>
                            <div class="form-row pb-2" id="studentId<?php echo $item['user_id'];?>">
                                <div class="col-8">
                                    <input type="text" class="form-control" value="<?php echo $item['name_title'].''.$item['name'].' '.$item['surname'].' ( '.$item['schoolname'].' )';?>" disabled>
                                </div>

                                <div class="col-4">
                                    <button class="btn btn-danger" type="button" onclick="deleteStudent('<?php echo $item['user_id'];?>');" <?php echo $DISABLE;?> >
                                        <i class="fa fa-remove"></i>
                                    </button>
                                </div>
                            </div>
                            <?php endforeach;?>



                        </div>
                        <div class="form-row pt-2 pb-3">
                            <div class="col-8">
                                <select id="selectStudentId" name="student_id" class="selectpicker form-control" data-live-search="true" title="Please select a Student ..." <?php echo $DISABLE;?>>
                                    <?php foreach ($STUDENTS as $key=>$item):?>
                                        <option value="<?php echo $item['id'];?>">
                                            <?php echo  $item['name_title'].''.$item['name'].' '.$item['surname'].' ( โรงเรียน'.$item['schoolname'].')'; ?>
                                        </option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                            <div class="col-4">
                                <button class="btn btn-success" type="button" data-toggle="tooltip" title="Add student"
                                onclick="selectStudent()" <?php echo $DISABLE;?>>
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>


                        </div>

                        <div class="form-group pt-3">
                            <label class="label-control" for="idSchoolRegion">ภาค</label>
                            <select class="form-control" id="idSchoolRegion" name="region" <?php echo $DISABLE;?>>
                                <option value="กลาง" <?php echo $this_region=='กลาง'?'selected':'' ?> >กลาง</option>
                                <option value="เหนือ" <?php echo $this_region=='เหนือ'?'selected':'' ?>>เหนือ</option>
                                <option value="ตะวันออก" <?php echo $this_region=='ตะวันออก'?'selected':'' ?>>ตะวันออก</option>
                                <option value="ตะวันตก" <?php echo $this_region=='ตะวันตก'?'selected':'' ?>>ตะวันตก</option>
                                <option value="ตะวันออกเฉียงเหนือ" <?php echo $this_region=='ตะวันออกเฉียงเหนือ'?'selected':'' ?>>ตะวันออกเฉียงเหนือ</option>
                                <option value="ใต้" <?php echo $this_region=='ใต้'?'selected':'' ?>>ใต้</option>
                            </select>
                        </div>

                        <hr class="style1 mt-5">

                        <div class="text-center pt-2">

                            <input type="text" name="main_id" value="<?php echo $this_main_id;?>" hidden>
                            <?php
                            $studentList = '';
                            foreach ($MEMBERS as $key=>$item){
                                if($key==0){
                                    $studentList.=''.$item['user_id'];
                                }else{
                                    $studentList.='-'.$item['user_id'];
                                }
                            }?>
                            <input id="studentListId" type="text" name="studentList" value="<?php echo $studentList; ?>" hidden>

                            <!-- cherry -->
                            <?php if($PHASE_EDIT): ?>
                                <?php if($EDIT):?>
                                    <input type="text" name="pro_id" value="<?php echo $PID;?>" hidden>
                                    <input type="text" name="fn" value="editProject" hidden>
                                    <button type="submit" class="btn btn-lg sr-button btn-warning" <?php echo $DISABLE;?> >UPDATE</button>
                                <?php else: ?>
                                    <input type="text" name="fn" value="createProject" hidden>
                                    <button type="submit" class="btn btn-lg sr-button btn-success" <?php echo $DISABLE;?> >CREATE</button>
                                <?php endif;?>

                            <?php else: ?>
                                <div class="alert alert-danger" role="alert">
                                    <h4 class="alert-heading"> หมดเวลารับสมัครโครงการ </h4>
                                </div>
                            <?php endif;?>


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


<!-- main script -->
<?php require_once __DIR__.'/_main_script.php';?>

<script>
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var formValidation = document.getElementsByClassName('form-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(formValidation, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();

    function selectStudent() {
        var student_id = $('#selectStudentId :selected').val();
        var student_text= $('#selectStudentId :selected').text();
        $('#selectStudentId').selectpicker('val',0);

        var studentList = $('#studentListId').val();
        var strSplit  = studentList.split('-');

        if(student_id != ''){
            if(studentList==''){
                $('#studentListId').attr('value',student_id);
                student_text = student_text.trim();
                htmlStudent(student_id,student_text);
            }else{
                var check = true;
                for(var i=0;i<strSplit.length;i++){
                    if(strSplit[i]== student_id){
                        check = false;
                    }
                }
                if(check){
                    studentList+='-'+student_id;
                    $('#studentListId').attr('value',studentList);
                    student_text = student_text.trim();
                    htmlStudent(student_id,student_text);
                }else{
                    alert("มีข้อมูลนักเรียนแล้ว");
                }
            }
        }
    }
    function deleteStudent(id) {
        var studentList = $('#studentListId').val();
        if(studentList==id){
            $('#studentListId').attr('value','');
        }else{
            var strSplit  = studentList.split('-');
            var value = '';
            var check = true;
            for(var i=0;i<strSplit.length;i++){
                if(strSplit[i]!= id){
                    if(check){
                        value+=''+strSplit[i];
                    }else{
                        value+='-'+strSplit[i];
                    }
                    check = false;
                }
            }
            $('#studentListId').attr('value',value);
        }
        $('#studentId'+id).remove();

    }
    function htmlStudent(id,text) {
        var str = '';
        str+='<div class="form-row pb-2" id="studentId'+id+'">';
        str+='<div class="col-8">';
        str+='<input type="text" class="form-control" value="'+text+'" disabled>';
        str+='</div>';
        str+='<div class="col-4">';
        str+='<button class="btn btn-danger" type="button" data-toggle="tooltip" title="Delete student" onclick="deleteStudent(\''+id+'\')" >';
        str+='<i class="fa fa-remove"></i>';
        str+='</button>';
        str+='</div>';
        str+='</div>';

        $('#devShowStudentSelect').append(str);
    }

    function ff() {
        var studentList = $('#studentListId').val();
        alert(studentList);
    }

</script>

</body>
</html>
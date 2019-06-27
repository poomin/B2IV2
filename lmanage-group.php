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

require_once __DIR__.'/controller/manageGroupController.php';

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
                    <h2 class="h-c"><i class="fa fa-gear icon-zoom"></i> กำหนดกลุ่มกรรมการตรวจโครงการ</h2>
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

                    <table class="this-table table table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>โครงการ</th>
                            <th>โรงเรียน</th>
                            <th>ภาค</th>
                            <th>กลุ่มกรรมการ</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($PROJECT as $key=>$item): ?>
                            <tr class="font-14">
                                <td> <?php echo ($key+1); ?> </td>
                                <td> <?php echo $item['name']; ?> </td>
                                <td> <?php echo $item['project_school']; ?> </td>
                                <td> <?php echo $item['project_region']; ?> </td>
                                <td>
                                    <?php foreach ($GROUPS as $k=>$i):?>
                                        <div class="form-check">
                                            <input name="listCheck" class="form-check-input" type="checkbox"
                                                   value="<?php echo $item['id'].'-'.$i['id']; ?>"
                                                   id="defaultCheck<?php echo $item['id'].'_'.$i['id']; ?>"
                                                   <?php echo in_array($i['id'],$item['map'])?'checked':'';?>
                                            >
                                            <label class="form-check-label" for="defaultCheck<?php echo $item['id'].'_'.$i['id']; ?>">
                                                <?php echo $i['group_name']; ?>
                                            </label>
                                        </div>
                                    <?php endforeach;?>
                                </td>
                            </tr>
                        <?php endforeach;?>
                        </tbody>
                    </table>

                    <div class="text-center">
                        <button class="btn btn-success btn-lg" type="button" onclick="saveListGroupSet()">บันทึกข้อมูล</button>
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
require_once __DIR__.'/_datatable_script.php';
?>


<script>
    $(document).ready(function() {
        $('.this-table').DataTable();
    } );

    function saveListGroupSet() {
        var listActive = [];
        var listAll = [];
        $.each($("input[name='listCheck']"), function(){
            listAll.push($(this).val());
        });
        $.each($("input[name='listCheck']:checked"), function(){
            listActive.push($(this).val());
        });

        var dataAll = "-";
        var dataActive = "-";
        if(listActive.length>0){
            dataActive = listActive.join(":");
        }
        if(dataAll.length>0){
            dataAll = listAll.join(":");
        }

        var form = $(document.createElement('form'));
        $(form).attr("method","POST");
        $(form).attr('hidden',true);

        var input_active = $('<input>')
            .attr("type","text")
            .attr("name","active")
            .attr("value",dataActive);
        $(form).append($(input_active));

        var input_all = $('<input>')
            .attr("type","text")
            .attr("name","all")
            .attr("value",dataAll);
        $(form).append($(input_all));

        var input_fn = $('<input>')
            .attr("type","text")
            .attr("name","fn")
            .attr("value","addMap");
        $(form).append($(input_fn));

        form.appendTo(document.body );
        $(form).submit();

    }

</script>

</body>
</html>
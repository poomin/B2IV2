<?php
/**
 * Created by PhpStorm.
 * User: PF0T4E5G
 * Date: 28/3/2562
 * Time: 07:02 หลังเที่ยง
 */
require_once __DIR__.'/_session.php';
require_once __DIR__.'/_session_login.php';

$MENU_LEFT = 'picture';

require_once __DIR__.'/controller/pictureController.php';

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
                    <h2 class="h-c"><i class="fa fa-image icon-zoom"></i> ภาพกิจกรรม </h2>
                    <hr class="style1">
                </div>

                <!-- alert status -->
                <div class="p-1">
                    <?php require_once __DIR__.'/_alert.php';?>
                </div>

                <div class="text-right mb-2">
                    <button class="btn btn-success btn-sm" type="button" data-toggle="tooltip" title="Add Picture" onclick="showModalCreateActivityPicture()">
                        <i class="fa fa-plus"></i> Add
                    </button>
                </div>

                <div class="p-0">

                    <table class="this-table table table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $c=1; foreach ($PICTURES as $key=>$item): ?>
                            <tr>
                                <td> <?php echo ($c++); ?> </td>
                                <td> <?php echo $item['title']; ?> </td>
                                <td> <?php echo date('d/m/Y',strtotime($item['create_at'])); ?> </td>
                                <td>
                                    <?php
                                    $item_id = $item['id'];
                                    $item_text = 'ภาพกิจกรรม <strong>'.$item['title'].'</strong>';
                                    ?>

                                    <a class="btn btn-info btn-sm" href="./lpicture-view.php?pid=<?php echo $item['id'];?>" data-toggle="tooltip" title="View picture">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a class="btn btn-warning btn-sm" href="/lpicture-edit.php?pid=<?php echo $item['id'];?>" data-toggle="tooltip" title="Edit picture">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    <button class="btn btn-danger btn-sm" type="button" data-toggle="tooltip" title="Delete picture"
                                            onclick="showModalDelete('<?php echo $item_id;?>','<?php echo $item_text;?>');">
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
<?php

require_once __DIR__.'/modal_delete.php';
require_once __DIR__.'/modal_picture.php';

?>



<!-- main script -->
<?php

require_once __DIR__.'/_main_script.php';
require_once __DIR__.'/_datatable_script.php';

?>

<script>
    $(document).ready(function() {
        $('.this-table').DataTable();
    } );

    function showModalCreateActivityPicture() {
        $("#modalCreateActivityPicture").modal();
    }
    
    function createActivityPicture() {
        var title = $("#input_activity_title").val();
        if(title=='' || title==undefined){
            alert("Please input 'ชื่อภาพกิจกรรม'")
        }else{
            var form = $(document.createElement('form'));
            $(form).attr("method","POST");
            $(form).attr('hidden',true);
            var input_fn = $("<input>")
                .attr("type","text")
                .attr("name","fn")
                .attr("value","create");
            $(form).append($(input_fn));

            var input_title = $("<input>")
                .attr("type","text")
                .attr("name","title")
                .attr("value",title);
            $(form).append($(input_title));

            form.appendTo( document.body );
            $(form).submit();
        }


    }
</script>

</body>
</html>
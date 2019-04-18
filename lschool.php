<?php
/**
 * Created by PhpStorm.
 * User: PF0T4E5G
 * Date: 28/3/2562
 * Time: 07:02 หลังเที่ยง
 */
require_once __DIR__.'/_session.php';
require_once __DIR__.'/_session_login.php';

$MENU_LEFT = 'school';

require_once __DIR__.'/controller/schoolController.php';

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
                    <div class="row">
                        <div class="col-8">
                            <h2 class="h-c"><i class="fa fa-university icon-zoom"></i> จัดการโรงเรียน</h2>
                        </div>
                        <div class="col-4 text-right">
                            <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#modalAddSchool">
                                <i class="fa fa-plus"></i> Add
                            </button>
                        </div>
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
                            <th>โรงเรียน</th>
                            <th>ที่อยู่</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($SCHOOLS as $key=>$item): ?>
                            <tr>
                                <td><?php echo ($key+1);?></td>
                                <td><?php echo $item['school_name'].' ('.$item['province'].')';?></td>
                                <td>
                                    <?php
                                    $item_address = '';

                                    if(isset($item['address']) && isset($item['address'])!=''){
                                        $item_address .= $item['address'].' ';
                                    }
                                    if(isset($item['subdistrict']) && isset($item['subdistrict'])!=''){
                                        $item_address .= 'ต.'.$item['subdistrict'].' ';
                                    }
                                    if(isset($item['district']) && isset($item['district'])!=''){
                                        $item_address .= 'อ.'.$item['district'].' ';
                                    }
                                    if(isset($item['province']) && isset($item['province'])!=''){
                                        $item_address .= 'จ.'.$item['province'].' ';
                                    }
                                    if(isset($item['code']) && isset($item['code'])!=''){
                                        $item_address .= ' '.$item['code'].' ';
                                    }
                                    echo $item_address;
                                    ?>
                                </td>
                                <td>
                                    <button class="btn btn-warning btn-sm" type="button" data-toggle="tooltip" title="Edit school"
                                    onclick="showModalSchoolEdit('<?php echo $item['id'];?>','<?php echo $item['school_name'];?>','<?php echo $item['address'];?>','<?php echo $item['subdistrict'];?>','<?php echo $item['district'];?>','<?php echo $item['province'];?>','<?php echo $item['code'];?>');" >
                                        <i class="fa fa-edit"></i>
                                    </button>

                                    <?php if (isset($LOGIN_USER_ROLE) && $LOGIN_USER_ROLE=='admin'): ?>
                                    <?php
                                    $item_id = $item['id'];
                                    $item_text = '<strong>โรงเรียน '.$item['school_name'].'</strong> จังหวัด '.$item['province'];
                                    ?>
                                    <button class="btn btn-danger btn-sm" type="button" data-toggle="tooltip" title="Delete school"
                                            onclick="showModalDelete('<?php echo $item_id;?>','<?php echo $item_text;?>');" >
                                        <i class="fa fa-remove"></i>
                                    </button>
                                    <?php endif;?>
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
<?php require_once __DIR__.'/modal_delete.php';?>


<!-- main script -->
<?php require_once __DIR__.'/_main_script.php';?>

<?php require_once __DIR__.'/_datatable_script.php';?>

<?php require_once __DIR__.'/modal_school_add.php';?>

<?php require_once __DIR__.'/modal_school_edit.php';?>

<script>
    $(document).ready(function() {
        $('.this-table').DataTable();
    } );
</script>

</body>
</html>
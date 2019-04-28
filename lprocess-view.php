<?php
/**
 * Created by PhpStorm.
 * User: PF0T4E5G
 * Date: 28/3/2562
 * Time: 07:02 หลังเที่ยง
 */

require_once __DIR__.'/_session.php';
require_once __DIR__.'/_session_index.php';

$MENU_LEFT = 'process';

require_once  __DIR__.'/controller/processViewController.php';

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
                <div class="pt-2">

                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <?php foreach ($PHASES as $key=>$item): ?>
                                <?php if($key==0):?>
                                    <a class="nav-fill nav-item nav-link active"  data-toggle="tab" role="tab" href="#nav-<?php echo $item['sq'];?>" id="nav-<?php echo $item['sq'];?>-tab" aria-controls="nav-<?php echo $item['sq'];?>" aria-selected="true"><?php echo 'รอบที่ '.$item['sq'].' '.$item['title'];?></a>
                                <?php else:?>
                                    <a class="nav-fill nav-item nav-link" data-toggle="tab" role="tab" href="#nav-<?php echo $item['sq'];?>" id="nav-<?php echo $item['sq'];?>-tab" aria-controls="nav-<?php echo $item['sq'];?>" aria-selected="false"><?php echo 'รอบที่ '.$item['sq'].' '.$item['title'];?></a>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    </nav>

                    <div class="tab-content" id="nav-tabContent">
                        <?php foreach ($PHASES as $key=>$item): ?>
                        <div class="tab-pane fade <?php echo $key==0?'show active':''; ?>" id="nav-<?php echo $item['sq'];?>" role="tabpanel" aria-labelledby="nav-<?php echo $item['sq'];?>-tab">
                            <div class="p-1">

                                <!-- show message -->
                                <?php
                                    if(strtoupper($item['phase_status'])=="PASS"){
                                        $i_class = 'alert-success';
                                        $i_header = 'PASS';
                                        $i_text = 'โครงการได้ผ่านการตรวจคัดเลือกจากคณะกรรมเป็นที่เรียบร้อยแล้ว';
                                        $i_message = $item['phase_message'];
                                    }elseif (strtoupper($item['phase_status'])=="FAIL"){
                                        $i_class = 'alert-danger';
                                        $i_header = 'FAIL!';
                                        $i_text = 'โครงการไม่ผ่านการตรวจคัดเลือกจากคณะกรรมการ';
                                        $i_message = $item['phase_message'];
                                    }else{
                                        $i_class = 'alert-secondary';
                                        $i_header = 'NON';
                                        $i_text = 'โครงการยังไม่มีการดำเนินการไดไดจากคณะกรรมการหรือยังไม่เปิดให้ดำเนินการ';
                                        $i_message = $item['phase_message'];
                                    }
                                ?>
                                <div class="alert <?php echo $i_class; ?>" role="alert">
                                    <h4 class="alert-heading"><?php echo $i_header; ?></h4>
                                    <p><?php echo $i_message;?></p>
                                    <hr>
                                    <p class="mb-0">
                                        <small><?php echo $i_text;?></small>
                                    </p>
                                </div>

                                <!-- upload doc -->
                                <?php if(strtoupper($item['upload_doc'])=='Y'): ?>
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
                                            <?php foreach ($item['DOC'] as $k=>$i): ?>
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
                                <?php if(strtoupper($item['upload_pdf'])=='Y'): ?>
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
                                            <?php foreach ($item['PDF'] as $k=>$i): ?>
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
                                <?php if(strtoupper($item['upload_image'])=='Y'): ?>
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
                                            <?php foreach ($item['IMAGE'] as $k=>$i): ?>
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
                                <?php if(strtoupper($item['upload_video'])=='Y'): ?>
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
                                            <?php foreach ($item['VIDEO'] as $k=>$i): ?>
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
                        <?php endforeach; ?>
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
<?php require_once __DIR__.'/_main_script.php';?>

<?php require_once __DIR__.'/_datatable_script.php';?>

<script>
    $(document).ready(function() {
        $('.this-table').DataTable({
            "lengthChange": false,
            "info": false
        });
    } );
</script>

</body>
</html>
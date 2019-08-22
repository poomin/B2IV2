<?php
/**
 * Created by PhpStorm.
 * User: PF0T4E5G
 * Date: 28/3/2562
 * Time: 07:02 หลังเที่ยง
 */
require_once __DIR__.'/_session.php';
require_once __DIR__.'/_session_login.php';

$MENU_LEFT = 'lquestion';
require_once __DIR__.'/controller/questionViewController.php';

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
                    <div class="col-8">
                        <h2 class="h-c"><i class="fa fa-question-circle-o icon-zoom"></i> ถาม - ตอบ </h2>
                    </div>

                    <hr class="style1">
                </div>

                <!-- alert status -->
                <div class="p-1">
                    <?php require_once __DIR__.'/_alert.php';?>
                </div>

                <div class="col-12">
                    <div class="alert alert-info" role="alert">
                        <p> <strong><?php echo $this_title;?></strong> <i class="fa fa-calendar ml-2"></i> <small><?php echo $this_create_at;?></small> </p>
                        <hr>
                        <p class="mb-0">
                            <?php echo str_replace("\n","<br>",$this_detail);?>
                        </p>
                    </div>
                </div>

                <div class="pt-3 pb-1">
                    <h3>Comment</h3>
                </div>

                <?php foreach ($COMMENTS as $key=>$item): ?>
                    <?php
                    $i_create_at = $item['create_at'];
                    $i_comment = $item['comment_text'];
                    $i_name = 'Admin';
                    $i_class = 'text-right';
                    $i_alert = 'alert-warning';
                    if($item['user_id']!=$LOGIN_USER_ID){
                        $i_name = 'คุณ '.$item['name'].' '.$item['surname'];
                        $i_class = '';
                        $i_alert = 'alert-success';
                    }
                    ?>
                    <div class="col-12 <?php echo $i_class; ?>">
                        <div class="alert <?php echo $i_alert; ?>" role="alert">
                            <p> <strong> <?php echo $i_name; ?></strong> <i class="fa fa-calendar ml-2"></i> <?php echo $i_create_at; ?> </p>
                            <hr>
                            <p class="mb-0"><?php echo $i_comment; ?></p>
                        </div>
                    </div>

                <?php endforeach; ?>

                <div class="offset-1 col-10 pt-5">
                    <div class="alert alert-secondary" role="alert">
                        <p> <h2> Comment </h2> </p>
                        <hr>
                        <div class="mb-0">
                            <form method="post">

                                <div class="form-group">
                                    <label class="label-control">รายละเอียด</label>
                                    <textarea class="form-control" id="idComment" name="comment" rows="5" required></textarea>
                                </div>

                                <div class="text-center">
                                    <input type="text" name="fn" value="addComment" hidden>
                                    <button type="submit" class="btn btn-lg sr-button btn-primary">comment</button>
                                </div>

                            </form>
                        </div>
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

?>

<script>

</script>

</body>
</html>
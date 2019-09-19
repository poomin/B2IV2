<?php
/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 4/1/2019
 * Time: 12:25 PM
 */

require_once __DIR__.'/_session.php';
require_once __DIR__.'/_session_index.php';

$MENU_LEFT = 'h-video';

require_once __DIR__.'/controller/indexVideoView.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once __DIR__.'/_main_css.php';?>

    <link rel="stylesheet" href="/lib/froala/css/froala_style.css">

</head>
<body>

<!-- loader -->
<?php //require_once __DIR__.'/_main_loader.php';?>

<div class="page-full container">

    <!-- top menu -->
    <?php require_once __DIR__.'/_main_menutop.php';?>

    <div class="pb-5 mb-5 page-background" style="margin-top: -80px;">


        <div class="p-5">
            <div class="card shadow p-4 bg-white rounded">

                <div class="p-5">

                    <?php foreach ($VIDEOS as $key=>$item):?>
                    <div class="embed-responsive embed-responsive-16by9 mb-2">
                        <iframe class="embed-responsive-item" src="<?php echo $item['video_path'];?>" allowfullscreen></iframe>
                    </div>
                    <?php endforeach;?>

                </div>

                <hr class="style1">

                <div class="pt-2 pr-5 pl-5 pb-5">
                    <h4><strong><?php echo $this_title;?></strong></h4>
                    <div class="p-3">
                        <pre><?php echo $this_detail;?></pre>
                    </div>
                    <div class="pt-2">
                        <hr>
                        <i class="fa fa-calendar"></i> <?php echo $this_date; ?>
                    </div>
                </div>

            </div>
        </div>


    </div>
</div>

<footer class="footer">
    <?php require_once __DIR__.'/_main_footer.php';?>
</footer>

<?php require_once __DIR__.'/_main_script.php';?>



</body>
</html>

<?php
/**
 * Created by PhpStorm.
 * User: PF0T4E5G
 * Date: 28/3/2562
 * Time: 06:49 หลังเที่ยง
 */
?>

<script src="./jquery/jquery.min.js"></script>
<script src="./bootstrap/js/popper.js"></script>
<script src="./bootstrap/js/bootstrap.min.js"></script>
<script src="./bootstrap/js/bootstrap-select.js"></script>
<script src="./bootstrap/js/bootstrap-validate.js"></script>

<script src="./js/loader.js"></script>
<script>

    $(window).bind("load", function () {
        setTimeout(function () {
            $('#ajax-page-loader').remove();
        }, 100);
    });
</script>

<?php
/**
 * Created by PhpStorm.
 * User: PF0T4E5G
 * Date: 7/4/2562
 * Time: 10:00 หลังเที่ยง
 */

?>

<div class="modal fade" id="modalURLYoutube" tabindex="-1" role="dialog" aria-labelledby="modalLabelYoutube" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header alert-danger">
                <h5 class="modal-title" id="modalLabelYoutube"> Modal Add Youtube</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input class="form-control" id="input_youtube" type="text" value="">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="addUrlYoutube();">Add</button>
            </div>

        </div>
    </div>
</div>

<?php
/**
 * Created by PhpStorm.
 * User: PF0T4E5G
 * Date: 7/4/2562
 * Time: 10:00 หลังเที่ยง
 */

?>

<div class="modal fade" id="modalCreateActivityVideo" tabindex="-1" role="dialog" aria-labelledby="modalLabelCreateActivityVideo" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabelCreateActivityVideo"> วิดีโอกิจกรรม</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>ชื่อกิจกรรม</p>
                <input rows="4" class="form-control" id="input_activity_title" value="">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="createActivityVideo();">Create</button>
            </div>

        </div>
    </div>
</div>

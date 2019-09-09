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
                <h5 class="modal-title" id="modalLabelYoutube"> Modal Add Video Youtube</h5>
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

<div class="modal fade" id="modalURLGoogle" tabindex="-1" role="dialog" aria-labelledby="modalLabelGoogle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header alert-success">
                <h5 class="modal-title" id="modalLabelGoogle"> Modal Add Video Google</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <textarea rows="4" class="form-control" id="input_google" value=""></textarea>
                <p>ฝังรายการ</p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="addUrlGoogle();">Add</button>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="modalURLFacebook" tabindex="-1" role="dialog" aria-labelledby="modalLabelFacebook" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header alert-primary">
                <h5 class="modal-title" id="modalLabelFacebook"> Modal Add Video Facebook</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <textarea rows="4" class="form-control" id="input_facebook" value=""></textarea>
                <p>ฝังรายการ</p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="addUrlFacebook();">Add</button>
            </div>

        </div>
    </div>
</div>

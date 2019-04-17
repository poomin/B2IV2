<?php
/**
 * Created by PhpStorm.
 * User: PF0T4E5G
 * Date: 7/4/2562
 * Time: 10:00 หลังเที่ยง
 */

?>

<div class="modal fade" id="modalTack" tabindex="-1" role="dialog" aria-labelledby="modalLabelTack" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header alert-primary">
                <h5 class="modal-title" id="modalLabelTack"> Modal Tack</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div>
                    <p><span id="modalTackText"> </span> </p>
                </div>
                <form class="formModalTack pt-3" method="post">
                    <input id="idRadioPinN" name="news_pin" type="radio" value="N"> ไม่ปักหมุด
                    <input id="idRadioPinY" name="news_pin" type="radio" value="Y" > ปักหมุด

                    <div style="padding-top: 30px;">
                        <input id="modalTackConfirm_checkbox" type="checkbox" value="Y" onchange="checkboxConfirmTack();" > ยืนยัน
                    </div>



                    <div class="data-send" hidden>
                        <input id="modalTackIdInput" type="text" name="tack_id" value="" hidden>
                        <input type="text" name="fn" value="modalTack" hidden>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button id="modalTackConfirm_btn" type="submit" class="btn btn-primary" disabled>Tack</button>
                    </div>

                </form>

            </div>

        </div>
    </div>
</div>

<script>
    function showModalTack(id,text,pin) {
        $('#modalTackConfirm_btn').attr('disabled',true);

        $('#modalTackIdInput').val(id);
        $('#modalTackText').html(text);

        if(pin=='N'){
            $('#idRadioPinN').attr('checked',true);
        }else{
            $('#idRadioPinY').attr('checked',true);
        }

        $('#modalTack').modal();
    }


    function checkboxConfirmTack() {
        var check = $('#modalTackConfirm_checkbox').prop('checked');
        if(check){
            $('#modalTackConfirm_btn').removeAttr('disabled');
        }else {
            $('#modalTackConfirm_btn').attr('disabled',true);
        }
    }
</script>

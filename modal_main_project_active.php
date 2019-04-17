<?php
/**
 * Created by PhpStorm.
 * User: PF0T4E5G
 * Date: 7/4/2562
 * Time: 10:00 หลังเที่ยง
 */

?>

<div class="modal fade" id="modalActive" tabindex="-1" role="dialog" aria-labelledby="modalLabelActive" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header alert-primary">
                <h5 class="modal-title" id="modalLabelActive"> Modal Active</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div>
                    <p><span id="modalActiveText"> </span> </p>
                </div>
                <form class="formModalActive pt-3" method="post">
                    <input id="idRadioActiveN" name="status" type="radio" value="N"> Enable
                    <input id="idRadioActiveY" name="status" type="radio" value="Y" > Active

                    <div style="padding-top: 30px;">
                        <input id="modalActiveConfirm_checkbox" type="checkbox" value="Y" onchange="checkboxConfirmActive();" > ยืนยัน
                    </div>



                    <div class="data-send" hidden>
                        <input id="modalActiveIdInput" type="text" name="active_id" value="" hidden>
                        <input type="text" name="fn" value="modalActive" hidden>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button id="modalActiveConfirm_btn" type="submit" class="btn btn-primary" disabled>Active</button>
                    </div>

                </form>

            </div>

        </div>
    </div>
</div>

<script>
    function showModalActive(id,text,active) {
        $('#modalActiveConfirm_btn').attr('disabled',true);

        $('#modalActiveIdInput').val(id);
        $('#modalActiveText').html(text);

        if(active=='N'){
            $('#idRadioActiveN').attr('checked',true);
        }else{
            $('#idRadioActiveY').attr('checked',true);
        }

        $('#modalActive').modal();
    }


    function checkboxConfirmActive() {
        var check = $('#modalActiveConfirm_checkbox').prop('checked');
        if(check){
            $('#modalActiveConfirm_btn').removeAttr('disabled');
        }else {
            $('#modalActiveConfirm_btn').attr('disabled',true);
        }
    }
</script>

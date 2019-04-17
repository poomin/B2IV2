<?php
/**
 * Created by PhpStorm.
 * User: PF0T4E5G
 * Date: 7/4/2562
 * Time: 10:00 หลังเที่ยง
 */

?>

<div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="modalLabelDelete" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header alert-danger">
                <h5 class="modal-title" id="modalLabelDelete"> Modal Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div>
                    <p> ต้องการลบข้อมูล <span id="modalDeleteText"> </span> </p>
                </div>

                <div style="padding-top: 30px;">
                    <input id="modalDeleteConfirm_checkbox" type="checkbox" value="Y" onchange="checkboxConfirmDelete();" > ยืนยันการลบข้อมูล
                </div>

                <form class="formModalDelete pt-3" method="post">

                    <div class="data-send" hidden>
                        <input id="modalDeleteIdInput" type="text" name="delete_id" value="" hidden>
                        <input type="text" name="fn" value="modalDelete" hidden>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button id="modalDeleteConfirm_btn" type="submit" class="btn btn-primary" disabled>Delete</button>
                    </div>

                </form>

            </div>

        </div>
    </div>
</div>

<script>
    function showModalDelete(id,text) {
        $('#modalDeleteConfirm_btn').attr('disabled',true);
        $('#modalDeleteConfirm_checkbox').prop('checked',false);

        $('#modalDeleteIdInput').val(id);
        $('#modalDeleteText').html(text);

        $('#modalDelete').modal();
    }


    function checkboxConfirmDelete() {
        var check = $('#modalDeleteConfirm_checkbox').prop('checked');
        if(check){
            $('#modalDeleteConfirm_btn').removeAttr('disabled');
        }else {
            $('#modalDeleteConfirm_btn').attr('disabled',true);
        }
    }
</script>

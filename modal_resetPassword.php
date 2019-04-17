<?php
/**
 * Created by PhpStorm.
 * User: PF0T4E5G
 * Date: 7/4/2562
 * Time: 02:34 ก่อนเที่ยง
 */
?>

<div class="modal fade" id="modalResetPassword" tabindex="-1" role="dialog" aria-labelledby="modalLabelResetPassword" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header alert-warning">
                <h5 class="modal-title" id="modalLabelResetPassword"> Reset Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="formModalResetPassword" method="post" novalidate>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="label-control">New Password</label>
                            <input id="modalInputPassword" class="form-control" type="password" name="password" required>
                            <div class="invalid-feedback">
                                Please input password!
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="label-control">Confirm password</label>
                            <input id="modalInputConfirm" class="form-control" type="password" name="confirm"  required>
                            <div class="invalid-feedback">
                                Confirm password,these don't match!
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>

                    <div class="data-send" hidden>
                        <input type="text" name="fn" value="modalResetPassword" hidden>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>

                </form>

            </div>

        </div>
    </div>
</div>

<script>

    (function() {
        'use strict';
        window.addEventListener('load', function() {
            var formProfile = document.getElementsByClassName('formModalResetPassword');
            var validation = Array.prototype.filter.call(formProfile, function(form) {
                form.addEventListener('submit', function(event) {
                    if ( document.getElementById("modalInputPassword").value != document.getElementById("modalInputConfirm").value ) {
                        $('#modalInputConfirm').val('');
                        $('#modalInputConfirm').focus();
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    else if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();

</script>



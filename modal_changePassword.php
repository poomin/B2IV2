<?php
/**
 * Created by PhpStorm.
 * User: PF0T4E5G
 * Date: 7/4/2562
 * Time: 02:34 ก่อนเที่ยง
 */
?>

<div class="modal fade" id="modalChangePassword" tabindex="-1" role="dialog" aria-labelledby="modalLabelChangePassword" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header alert-warning">
                <h5 class="modal-title" id="modalLabelChangePassword"> Change Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="formModalChangePassword" method="post" novalidate>

                    <div class="form-group">
                        <label class="label-control">Old Password</label>
                        <input class="form-control" type="password" name="pass" required>
                        <div class="invalid-feedback">
                            Please input username!
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="label-control">New Password</label>
                            <input id="modalInputChangePassword" class="form-control" type="password" name="password" required>
                            <div class="invalid-feedback">
                                Please input password!
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="label-control">Confirm password</label>
                            <input id="modalInputChangeConfirm" class="form-control" type="password" name="confirm"  required>
                            <div class="invalid-feedback">
                                Confirm password,these don't match!
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>

                    <div class="data-send" hidden>
                        <input type="text" name="fn" value="modalChangePassword" hidden>
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
            var formProfile = document.getElementsByClassName('formModalChangePassword');
            var validation = Array.prototype.filter.call(formProfile, function(form) {
                form.addEventListener('submit', function(event) {
                    if ( document.getElementById("modalInputChangePassword").value != document.getElementById("modalInputChangeConfirm").value ) {
                        $('#modalInputChangeConfirm').val('');
                        $('#modalInputChangeConfirm').focus();
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



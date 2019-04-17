<?php
/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 4/1/2019
 * Time: 3:07 PM
 */

/*
 * modal for add school
 * fn = insertSchool
 * name = name school
 * address = address
 * subdistrict = sub district
 * district = district
 * province = province
 * code = code
 */

?>

<div id="modalAddMainProject" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myModalAddMainProject">
    <div class="modal-dialog modal-lg" role="document">
        <form class="modal-content MainProject-validation" method="post" novalidate>
            <div class="modal-header alert-success">
                <h4 class="modal-title font-weight-bold" id="myModalAddMainProject"> สร้างโครงการ </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body m-1">

                <div class="form-group row">
                    <label for="addMainProjectYearId" class="text-right font-weight-bold col-sm-3 col-form-label">ปี:</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="addMainProjectYearId" name="year" value=""  type="text" placeholder="ค.ศ." required>
                        <div class="invalid-feedback">
                            Please input year!
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="addMainProjectNameId" class="text-right font-weight-bold col-sm-3 col-form-label">ชื่อโครงการ:</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="addMainProjectNameId" name="name" value="" type="text"  placeholder="ชื่อ" required>
                        <div class="invalid-feedback">
                            Please input  name project (TH)
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="addMainProjectNameEnId" class="text-right font-weight-bold col-sm-3 col-form-label">Name Project:</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="addMainProjectNameEnId" name="name_en" value="" type="text"  placeholder="Name" required>
                        <div class="invalid-feedback">
                            Please input  name project (EN)
                        </div>
                    </div>
                </div>

            </div>

            <div class="modal-footer">
                <input type="text" name="fn" value="insertMainProject" hidden>
                <button type="submit" class="btn btn-success">บันทึก</button>
            </div>
        </form>
    </div>
</div>
<script>

    (function() {
        'use strict';
        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var formMainProject = document.getElementsByClassName('MainProject-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(formMainProject, function(form) {
                form.addEventListener('submit', function(event) {
                     if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();


</script>

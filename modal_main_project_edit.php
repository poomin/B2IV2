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

<div id="modalEditMainProject" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myModalEditMainProject">
    <div class="modal-dialog modal-lg" role="document">
        <form class="modal-content editMainProject-validation" method="post" novalidate>
            <div class="modal-header alert-warning">
                <h4 class="modal-title font-weight-bold" id="myModalEditMainProject"> สร้างโครงการ </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body m-1">

                <div class="form-group row">
                    <label for="editMainProjectYearId" class="text-right font-weight-bold col-sm-3 col-form-label">ปี:</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="editMainProjectYearId" name="year" value=""  type="text" placeholder="ค.ศ." required>
                        <div class="invalid-feedback">
                            Please input year!
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="editMainProjectNameId" class="text-right font-weight-bold col-sm-3 col-form-label">ชื่อโครงการ:</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="editMainProjectNameId" name="name" value="" type="text"  placeholder="ชื่อ" required>
                        <div class="invalid-feedback">
                            Please input  name project (TH)
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="editMainProjectNameEnId" class="text-right font-weight-bold col-sm-3 col-form-label">Name Project:</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="editMainProjectNameEnId" name="name_en" value="" type="text"  placeholder="Name" required>
                        <div class="invalid-feedback">
                            Please input  name project (EN)
                        </div>
                    </div>
                </div>

            </div>

            <div class="modal-footer">
                <input id="modalEditMainProjectIdInput" type="text" name="mainProjectId" value="" hidden>
                <input type="text" name="fn" value="editMainProject" hidden>
                <button type="submit" class="btn btn-warning">บันทึก</button>
            </div>
        </form>
    </div>
</div>
<script>

    (function() {
        'use strict';
        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var formEditMainProject = document.getElementsByClassName('editMainProject-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(formEditMainProject, function(form) {
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

    function showModalMainProjectEdit(id,year,name,name_en) {
        $('#modalEditMainProjectIdInput').val(id);
        $('#editMainProjectYearId').val(year);
        $('#editMainProjectNameId').val(name);
        $('#editMainProjectNameEnId').val(name_en);

        $('#modalEditMainProject').modal();
    }


</script>

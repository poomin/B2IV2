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

<div id="modalAddSchool" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myModalAddSchool">
    <div class="modal-dialog" role="document">
        <form class="modal-content school-validation" method="post" novalidate>
            <div class="modal-header alert-success">
                <h4 class="modal-title font-weight-bold" id="myModalAddSchool"> เพิ่มโรงเรียน </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body m-1">

                <div class="form-group row">
                    <label for="addName" class="text-right font-weight-bold col-sm-3 col-form-label">โรงเรียน:</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="addName" name="name" value=""  type="text" placeholder="โรงเรียน" required>
                        <div class="invalid-feedback">
                            Please input school name!
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="addAddress" class="text-right font-weight-bold col-sm-3 col-form-label">ที่อยู่:</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="addAddress" name="address" value="" type="text"  placeholder="ที่อยู่,ซอย,ถนน" required>
                        <div class="invalid-feedback">
                            Please input address! <small>(not data input '-')</small>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="addSubdistrict" class="text-right font-weight-bold col-sm-3 col-form-label">ตำบล:</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="addSubdistrict" name="subdistrict" value="" type="text" placeholder="ตำบล" required>
                        <div class="invalid-feedback">
                            Please input sub district! <small>(not data input '-')</small>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="addDistrict" class="text-right font-weight-bold col-sm-3 col-form-label">อำเภอ:</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="addDistrict" name="district" value="" type="text" placeholder="อำเภอ" required>
                        <div class="invalid-feedback">
                            Please input district! <small>(not data input '-')</small>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="addProvince" class="text-right font-weight-bold col-sm-3 col-form-label">จังหวัด:</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="addProvince" name="province" value="" type="text"  placeholder="จังหวัด" required>
                        <div class="invalid-feedback">
                            Please input province!
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="addCode" class="text-right font-weight-bold col-sm-3 col-form-label">รหัสไปรษณีย์:</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="addCode" name="code" value="" type="text"  placeholder="รหัสไปรษณีย์" required>
                        <div class="invalid-feedback">
                            Please input zip code!
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <input type="text" name="fn" value="insertSchool" hidden>
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
            var formSchool = document.getElementsByClassName('school-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(formSchool, function(form) {
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

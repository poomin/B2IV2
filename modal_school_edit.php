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

<div id="modalEditSchool" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myModalEditSchool">
    <div class="modal-dialog" role="document">
        <form class="modal-content school-edit" method="post" novalidate>
            <div class="modal-header alert-warning">
                <h4 class="modal-title font-weight-bold" id="myModalEditSchool"> แก้ไขโรงเรียน </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body m-1">

                <div class="form-group row">
                    <label for="editName" class="text-right font-weight-bold col-sm-3 col-form-label">โรงเรียน:</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="editName" name="name" value=""  type="text" placeholder="โรงเรียน" required>
                        <div class="invalid-feedback">
                            Please input school name!
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="editAddress" class="text-right font-weight-bold col-sm-3 col-form-label">ที่อยู่:</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="editAddress" name="address" value="" type="text"  placeholder="ที่อยู่,ซอย,ถนน" required>
                        <div class="invalid-feedback">
                            Please input address! <small>(not data input '-')</small>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="editSubdistrict" class="text-right font-weight-bold col-sm-3 col-form-label">ตำบล:</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="editSubdistrict" name="subdistrict" value="" type="text" placeholder="ตำบล" required>
                        <div class="invalid-feedback">
                            Please input sub district! <small>(not data input '-')</small>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="editDistrict" class="text-right font-weight-bold col-sm-3 col-form-label">อำเภอ:</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="editDistrict" name="district" value="" type="text" placeholder="อำเภอ" required>
                        <div class="invalid-feedback">
                            Please input district! <small>(not data input '-')</small>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="editProvince" class="text-right font-weight-bold col-sm-3 col-form-label">จังหวัด:</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="editProvince" name="province" value="" type="text"  placeholder="จังหวัด" required>
                        <div class="invalid-feedback">
                            Please input province!
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="editCode" class="text-right font-weight-bold col-sm-3 col-form-label">รหัสไปรษณีย์:</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="editCode" name="code" value="" type="text"  placeholder="รหัสไปรษณีย์" required>
                        <div class="invalid-feedback">
                            Please input zip code!
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <input id="modalEditSchoolIdInput" type="text" name="schoolId" value="" hidden>
                <input type="text" name="fn" value="updateSchool" hidden>
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
            var formSchool = document.getElementsByClassName('school-edit');
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

    function showModalSchoolEdit(id,name,address,sub,district,province,code) {
        $('#modalEditSchoolIdInput').val(id);
        $('#editName').val(name);
        $('#editAddress').val(address);
        $('#editSubdistrict').val(sub);
        $('#editDistrict').val(district);
        $('#editProvince').val(province);
        $('#editCode').val(code);

        $('#modalEditSchool').modal();
    }


</script>

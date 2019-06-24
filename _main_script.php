<?php
/**
 * Created by PhpStorm.
 * User: PF0T4E5G
 * Date: 28/3/2562
 * Time: 06:49 หลังเที่ยง
 */
?>

<script src="./jquery/jquery.min.js"></script>
<script src="./bootstrap/js/popper.js"></script>
<script src="./bootstrap/js/bootstrap.min.js"></script>
<script src="./bootstrap/js/bootstrap-select.js"></script>
<script src="./bootstrap/js/bootstrap-validate.js"></script>

<script src="./js/loader.js"></script>
<script>
    //tooltip
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });

    $('.inputNumberFormat').on('change',function () {
        var value = $(this).val();
        value = value.trim();
        value = value.replace(/,/g,'');
        if(!isNaN(value) && value!=''){
            var max = $(this).attr('fmax');
            var min = $(this).attr('fmin');

            max = fNum(max);
            min = fNum(min);
            if(max && (parseFloat(max) < parseFloat(value))){
                $(this).val(max);
            }else if(min && parseFloat(min) > parseFloat(value) ){
                $(this).val(min);
            }

        }else{
            $(this).val('');
            $(this).focus();
        }
    });
    function fNum(number) {
        if(number==undefined){
            return false;
        }else{
            number = number.trim();
            number = number.replace(/,/g,'');
            if(!isNaN(number) && number!=''){
                return number;
            }else{
                return false;
            }
        }

    }

</script>

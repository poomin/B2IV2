<?php
/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 4/2/2019
 * Time: 11:31 AM
 */
if(isset($_SESSION['action_status'])):
    $alert_status  = $_SESSION['action_status'];
    $alert_message = $_SESSION['action_message'];

    if($alert_status=='error'){
        $alert_class = 'alert-danger';
    }elseif ($alert_status=='warning'){
        $alert_class = 'alert-warning';
    }elseif ($alert_status=='success'){
        $alert_class = 'alert-success';
    }else{
        //info
        $alert_class = 'alert-info';
    }

    unset($_SESSION['action_status']);
    unset($_SESSION['action_message']);

?>

    <div class="alert <?php echo $alert_class; ?> alert-dismissible fade show m-5" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="alert-heading"> <?php echo ucfirst($alert_status); ?> </h4>
        <hr>
        <p class="mb-0"> <?php echo $alert_message; ?> </p>
    </div>

<?php endif; ?>

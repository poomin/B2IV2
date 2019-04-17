<?php
/**
 * Created by PhpStorm.
 * User: PF0T4E5G
 * Date: 28/3/2562
 * Time: 07:02 หลังเที่ยง
 */
require_once __DIR__.'/_session.php';
require_once __DIR__.'/_session_login.php';

$MENU_LEFT = 'user';

require_once __DIR__.'/controller/userController.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once __DIR__.'/_main_css.php';?>

    <?php require_once __DIR__.'/_datatable_css.php';?>
</head>
<body>

<!-- loader -->
<div id="ajax-page-loader" class="show fullscreen">
    <div class="circular">
        <img src="./images/ajax-loader.gif">
    </div>
</div>


<div class="page-full container-fluid">

    <!-- top menu -->
    <?php require_once __DIR__.'/_main_menutop.php';?>

    <div class="pb-5 mb-5" style="margin-top: -80px;">

        <div class="row">

            <!-- left menu -->
            <div class="col-3 p-5">
                <?php require_once __DIR__.'/_main_menuleft_login.php';?>
            </div>

            <!-- page body -->
            <div class="col-9 p-5 bg-white">

                <div class="p-0">
                    <h2 class="h-c"><i class="fa fa-users icon-zoom"></i> จัดการสมาชิก</h2>
                    <hr class="style1">
                </div>

                <!-- alert status -->
                <div class="p-1">
                    <?php require_once __DIR__.'/_alert.php';?>
                </div>

                <div>
                    <table class="this-table table table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Username</th>
                            <th>Name Surname</th>
                            <th>School</th>
                            <th>Region</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($USERS as $key=>$item): ?>
                        <tr>
                            <td> <?php echo ($key+1); ?> </td>
                            <td> <?php echo $item['username']; ?> </td>
                            <td> <?php echo $item['name_title'].' '.$item['name'].' '.$item['surname']; ?> </td>
                            <td> <?php echo $item['schoolname']; ?> </td>
                            <td> <?php echo $item['schoolregion']; ?> </td>
                            <td>
                                <?php
                                if($item['role']=='admin'){
                                    echo "Admin";
                                }elseif($item['role']=='company'){
                                    echo "บริษัท / มหาวิทยาลัย";
                                }elseif($item['role']=='board'){
                                    echo "กรรมการ";
                                }elseif($item['role']=='teacher'){
                                    echo "ครู / อาจารย์";
                                }elseif($item['role']=='student'){
                                    echo "นักเรียน / นักศึกษา";
                                }
                                ?>
                            </td>
                            <td>
                                <a class="btn btn-info btn-sm" href="./luser-view.php?uid=<?php echo $item['id'];?>" data-toggle="tooltip" title="View user">
                                    <i class="fa fa-eye"></i>
                                </a>

                                <?php if (isset($LOGIN_USER_ROLE) && $LOGIN_USER_ROLE=='admin'): ?>

                                <a class="btn btn-warning btn-sm" href="/luser-edit.php?uid=<?php echo $item['id'];?>" data-toggle="tooltip" title="Edit user">
                                    <i class="fa fa-edit"></i>
                                </a>

                                <?php
                                    $item_id = $item['id'];
                                    $item_text = '<strong>คุณ '.$item['name'].' '.$item['surname'].'</strong>'.' ( '.$item['role'].' )';
                                ?>
                                <button class="btn btn-danger btn-sm" type="button" data-toggle="tooltip" title="Delete user"
                                onclick="showModalDelete('<?php echo $item_id;?>','<?php echo $item_text;?>');">
                                    <i class="fa fa-remove"></i>
                                </button>
                                <?php endif; ?>

                            </td>
                        </tr>
                        <?php endforeach;?>
                        </tbody>
                    </table>
                </div>

            </div>

        </div>

    </div>

</div>

<footer class="footer">
    <?php require_once __DIR__.'/_main_footer.php';?>
</footer>

<!-- modal -->
<?php require_once __DIR__.'/modal_delete.php';?>


<!-- main script -->
<?php require_once __DIR__.'/_main_script.php';?>

<?php require_once __DIR__.'/_datatable_script.php';?>


<script>
    $(document).ready(function() {
        $('.this-table').DataTable();
    } );
</script>

</body>
</html>
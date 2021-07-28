<?php 
require_once 'config/ini.php';
require_once 'config/security.php';
require_once 'config/auth.php';


if($_SESSION['auth_user']['branch'] != 1){
    header('Location:please_login');
}


if(!empty($_GET['i'])){
    $id = $defender->encrypt('decrypt', $_GET['i']);
}

if($_POST && (!empty($id) || (empty($id) && !empty($_POST['password'])))){

    if(empty($id) && !empty($_POST['username'])){
        $username_validate = sql_read('select username from merchant where username=? limit 1', 's', $_POST['username']);
    }

    if(!empty($username_validate['username'])){

        $_SESSION['session_msg'] = '<div class="alert alert-danger">
        <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close" 
        style="position:relative; top:-2px;">×</a>
        Username not available, please use other username.</div>';

    }else{
        
        if(!empty($id))                     $data['id'] = $id;
        $data['company'] = $_SESSION['auth_user']['company'];
        if(!empty($_POST['branch']))        $data['branch'] = $defender->encrypt('decrypt', $_POST['branch']);
        $data['status'] = $_POST['status'];
        if(!empty($_POST['username']))      $data['username'] = $_POST['username'];
        if(!empty($_POST['password']))      $data['password'] = hash('md5',$_POST['password']);
        
        sql_save('merchant', $data);

        $_SESSION['session_msg'] = '<div class="alert alert-success">
        <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close" style="position:relative; top:-2px;">×</a>Save successfully.</div>';
    }
}

if(!empty($id)){
    $staff = sql_read('select m.company, m.branch, m.username, m.status
    from merchant as m     
    where m.id=? limit 1', 'i', $id);
}
/*, b.type, b.region_id, b.branch_name, b.contact_person,  b.mobile_number, b.address, b.branch_location, b.branch_location_coordinate
JOIN branch AS b ON b.id = m.branch 
*/


?>


<script src="js/jquery-3.4.1.js"></script>


<link rel="stylesheet" href="<?php echo ROOT?>css/bootstrap-4.3.1.css" type="text/css">
<link rel="stylesheet" href="<?php echo ROOT?>css/pink-shadow.css" type="text/css">
<!--<link rel="stylesheet" href="<?php echo ROOT?>css/animate.css" type="text/css">-->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;700&display=swap" rel="stylesheet">

<style>
.password-eyedrop {
    position: relative;
    width:0;
    height:0;
    float: right;
    top: 10px;
    right: 26px;
    cursor: pointer;
}
</style>

<?php include_once 'head.php';?>

<html lang="en">
<body class="container-fluid p-0" style="background:#F5F5F5;">

    <?php include 'header.php'?>

    <div class="row">
        <div class="col-12 col-md-10 offset-md-1">

            <div class="row p-4">

                <?php include 'back.php';?>

                <div class="row" style="width:100%;">

                    <!--
                    <div class="col-12 col-md-5 pt-1 pb-5">

                        <?php if(!empty($id)){?>
                        <div class="row">
                            <div class="col-12 pt-4">
                                <h4 style="color:#CCC;">BRANCH</h4>
                                <?php echo $_SESSION['auth_user']['branch_name']?>
                            </div>                        
                        </div>
                        <?php }?>

                        <div class="row">
                            <div class="col-12 pt-4">
                                <h4 style="color:#CCC;">ADDRESS</h4>
                                <?php echo $_SESSION['auth_user']['address']?>
                            </div>                        
                        </div>
                        <div class="row">
                            <div class="col-12 pt-4">
                                <h4 style="color:#CCC;">LOCATION</h4>
                                <?php echo $_SESSION['auth_user']['branch_location']?>
                            </div>
                        </div>                            
                    </div>-->


                    <div class="col-12 col-md-5 offset-md-4 pt-1 pb-5">
                        
                        <h1><?php if(!empty($id)) echo 'Edit'; else echo 'Create';?> Account</h1>

                        <form action="" method="post" enctype="multipart/form-data">

                        <?php if($_SESSION['auth_user']['type'] == 'Headquarter'){?>

                        <?php /*
                        <div class="row">
                            <div class="col-12">
                                <?php $regions = sql_read('SELECT * FROM region ORDER BY region ASC', 'i', 1);?>
                                Region
                                <select name="region" class="form-group" required>
                                    <option value="">Select Region</option>
                                    <?php foreach((array)$regions as $region){?>
                                        <option value="<?php echo $defender->encrypt('encrypt',$region['id'])?>" <?php if($staff['region_id'] == $region['id']) echo 'selected'; ?>><?php echo $region['region']?></option>
                                    <?php }?>
                                    <?php echo $staff['region_id'];?>
                                </select>
                            </div>
                        </div>*/?>

                        <div class="row">
                            <div class="col-12">
                                <?php 
                                $branches = sql_read('SELECT * FROM branch where company_id = ? ORDER BY branch_name ASC', 'i', $_SESSION['auth_user']['company']);?>
                                Branch
                                <select name="branch" class="form-group" required>
                                    <option value="">Select Branch</option>
                                    <?php foreach((array)$branches as $branch){?>
                                        <option value="<?php echo $defender->encrypt('encrypt',$branch['id'])?>" <?php if($staff['branch'] == $branch['id']) echo 'selected'; ?>><?php echo $branch['branch_name']?></option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>
                        <?php }?>

                        <div class="row">
                            <div class="col-12">
                                Username
                                <input type="text" name="username" value="<?php echo $staff['username']?>" class="form-group" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                Password
                                <input type="password" name="password" value="" class="form-group password" autocomplete="off" <?php if(empty($id)) echo 'required';?> pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}">
                                <div class="password-eyedrop">
                                    <img src="<?php echo ROOT?>cms/images/remove_red_eye-black-18dp.svg" alt="" onclick="switch_password('<?php echo $field?>')">
                                </div>
                                <div class="text-muted" style="position:relative; top:-12px;">
                                    Leave empty if not changing password<br>
                                    Must contain number, uppercase, one lowercase & minimum 6 characters.
                                </div>
                                

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                Status
                                <select name="status" class="form-group" required>
                                    <option value="">Select Status</option>
                                        <option value="1" <?php if($staff['status'] == '1') echo 'selected'; ?>>Activated</option>
                                        <option value="0" <?php if($staff['status'] == '0') echo 'selected'; ?>>Suspend</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 pt-4">
                                <button type="submit" name="submit" value="apply" class="btn btn-block p-3 btn-default">
                                    <i class="fas fa-user pr-2"></i>
                                    <span class="center-word">SAVE ACCOUNT</span>
                                </button>

                            </div>
                        </div>
                        
                        </form>


                    </div>
                    
                </div>
                
            </div>
        
        </div>
    </div>
   
    <div class="row">
        <div class="col-12">            
            <?php include 'footer.php';?>
        </div>
    </div>



</body>
</html>

<script>
$(document).ready(function(){
    $('.password').val('');
});
function switch_password(){
    
    var curr_type = $('.password').attr('type');    
    if(curr_type == 'password'){
        $('.password').attr('type', 'text');
    }else{
        $('.password').attr('type', 'password');
    }
}

</script>

<script src="js/functions.jquery.js"></script>
<?php include_once 'config/session_msg.php';?>
            
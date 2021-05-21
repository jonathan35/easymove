<?php 
require_once 'config/ini.php';
require_once 'config/security.php';
require_once 'config/auth.php';
?>

<script src="js/jquery-3.4.1.js"></script>


<link rel="stylesheet" href="<?php echo ROOT?>css/bootstrap-4.3.1.css" type="text/css">
<link rel="stylesheet" href="<?php echo ROOT?>css/pink-shadow.css" type="text/css">
<!--<link rel="stylesheet" href="<?php echo ROOT?>css/animate.css" type="text/css">-->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;700&display=swap" rel="stylesheet">


<?php include_once 'head.php';?>

<html lang="en">
<body class="container-fluid p-0" style="background:#F5F5F5;">

    <?php include 'header.php'?>    
    <div class="row">
        <div class="col-12 col-md-10 offset-md-1">

            <div class="row p-4">

                <?php include ROOT.'back.php';?>

                <div class="row">
                    <div class="col-12 pb-5" style="min-height:60vh;">
                        <div class="row">
                            <div class="col-12"><h1>Accounts</h1></div>
                        </div>
                        <table class="table">
                            
                            <?php                             
                            $company_id = $_SESSION['auth_user']['company'];
                            $branch_id = $_SESSION['auth_user']['branch'];
                            $branch_type = $_SESSION['auth_user']['type'];

                            $params = 1;
                            $param_vals = array();
                            $branch_query = '';
                            $param_vals[] = $_SESSION['auth_user']['company'];


                            if($branch_type == 'Branch'){//Headquarter
                                $branch_query = ' and branch=? ';
                                $params++;
                                $param_vals[] = $_SESSION['auth_user']['branch'];
                            }

                            $staffs = sql_read("
                                select 
                                m.id, m.company, m.branch, m.status, m.username, c.company_name, b.branch_name, b.contact_person,  b.mobile_number, b.address, b.branch_location, b.branch_location_coordinate
                                
                                from merchant as m 
                                inner JOIN company AS c ON c.id = m.company 
                                inner JOIN branch AS b ON b.id = m.branch
                                
                                where company=? $branch_query
                                ", str_repeat('i', $params), $param_vals);

                            //echo str_repeat('i', $params);
                            //debug($param_vals);
                            //debug($staffs);
                            ?>
                            <tr>
                                <th>No.</th>
                                <th>Username</th>
                                <th>Branch</th>
                                <th>Address</th>
                                <th>Status</th>
                                <th>Edit</th>
                            </tr>
                            <?php
                            $itemCount=1;
                            $maxPerPage=10;

                            foreach((array)$staffs as $staff){?>
                            <tr class="page page<?php echo $itemCount?>" style=" <?php if($itemCount>$maxPerPage){?> display:none;<?php }?>">
                                <td><?php echo $itemCount?></td>
                                <td><?php echo $staff['username']?></td>
                                <td><?php echo $staff['branch_name']?></td>
                                <td>
                                    <?php echo $staff['address']?><br>
                                    <?php echo $staff['branch_location']?>
                                    <?php //echo $staff['branch_location_coordinate']?>
                                </td>
                                <td><?php if($staff['status'] == 1) echo 'Activated'; elseif($staff['status'] == 0) echo 'Suspended'; else echo 'Pending';?></td>
                                <td><a href="<?php echo ROOT?>staff/<?php echo $defender->encrypt('encrypt', $staff['id'])?>">Edit</a></td>
                            </tr>
                    


                        <?php 
                        $itemCount++;
                        }?>
                            
                        </table>
                        <?php include 'paging.php'?>


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


<script src="js/functions.jquery.js"></script>
<?php include_once 'config/session_msg.php';?>
            
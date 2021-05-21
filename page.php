<?php 
include_once 'head.php';

if($_GET['t']){
    $title = $str_convert->to_query($_GET['t']);
    $ffpage = sql_read("select * from pages where status = ? and title like ? limit 1", 'is', array(1, '%'.$title.'%'));
}
?>



<html lang="en">
<body class="container-fluid p-0">
    
    <?php include 'header.php'?>

    <div class="row">
        <div class="col-10 offset-1 mt-4 mt-md-0" style="padding-top:50px; padding-bottom:90px;">
            <div class="row">
                <div class="col-12 p-0">
                    <h1 class="pb-3"><?php echo $ffpage['title'];?></h1>
                    <?php
                    $ffpage['content'] = str_replace(array('../../', '<img'), array(ROOT, '<img class="img-fluid"'), $ffpage['content']);                
                    echo $ffpage['content'];?>
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
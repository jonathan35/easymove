<?php 
include_once 'head.php';

$news = sql_read("select * from news where status = ? order by position asc, id desc", 'i', 1);

?>

<html lang="en">



<body class="container-fluid p-0">
    
    <?php include 'header.php'?>

    <div class="row" style="padding-top:50px; background:#fafafa;">
        <div class="col-12 col-md-10 offset-md-1">

            <h1 class="text-center">Announcement</h1>
            <div class="row">
                <div class="col-12 p-4">
                    <div class="row">          
                        <div class="col-12">
                            <?php 
                                
                            $itemCount=1;
                            $maxPerPage=5;
                            
                            foreach((array)$news as $new){?>
                                <div class="row pt-5 page page<?php echo $itemCount?>" style="<?php if($itemCount>$maxPerPage){?> display:none;<?php }?>">
                                    <div class="col-12 col-md-5">
                                        <img src="<?php echo ROOT.$new['photo']?>" class="img-fluid">
                                    </div>
                                    <div class="col-12 col-md-7">
                                        <div class="row">
                                            <div class="col-12"><h2><?php echo $new['title']?></h2></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6 pb-4" style="color:#BBB;">
                                                Date:
                                                <?php echo date('M d, Y', strtotime($new['news_date']))?>
                                            </div>
                                            <div class="col-6 pb-4 text-right">
                                                <?php echo $new['news_attachment']?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12"><?php echo $new['news_content']?></div>
                                        </div>
                                        
                                    </div>
                                </div>
                            <?php 
                            $itemCount++;
                            }?>
                            <div class="row">
                                <div class="col-12 pt-5">
                                <?php include 'paging.php'?>
                                </div>                        
                            </div>
                        </div>
                    
                        
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

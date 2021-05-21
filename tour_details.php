<?php 
require_once 'config/ini.php';
require_once 'config/security.php';
require_once 'config/auth.php';
include_once 'head.php';

//include_once 'head.php';
//include_once 'cart_function.php';

       
if(!empty($_GET['p'])){
    $tour_name = $str_convert->to_query($_GET['p']);
    $tour = sql_read('select * from tour where status=1 and name like ? limit 1', 's', $tour_name);
    $_SESSION['tour'] = $tour['id'];
    //debug($tour);

    if(!empty($tour['tour_type'])){
        $type = sql_read('select * from tour_type where status=1 and id=? limit 1', 'i', $tour['tour_type']);
    }
    if(!empty($tour['category'])){
        $category = sql_read('select * from category where status=1 and id=? limit 1', 'i', $tour['category']);
    }
    if(!empty($tour['location'])){
        $location = sql_read('select * from location where status=1 and id=? limit 1', 'i', $tour['location']);
    }
    
}

?>
<html lang="en">

<body class="container-fluid p-0 wave" style="background-position: 0 200px;">

    <?php include 'header.php'?>

    <div class="row">
        <div class="col-10 offset-1 pb-5 pt-5">
            <div class="row">

                <div class="col-12 p-0">

                    <div class="row" style="border-bottom:1px solid #CCC;">
                        <div class="col-12">
                            
                            <div class="row mb-3">
                                <div class="col-12 col-md-8">
                                    <?php if(file_exists($tour['photo'])){?>
                                        <img src="<?php echo ROOT.$tour['photo']?>" width="100%">
                                    <?php }else{?>
                                        <img src="<?php echo ROOT.'images/SD-default-image.png'?>" class="img-fluid">
                                    <?php }?>

                                    <div class="row">
                                        <div class="col-12 text-black p-3" style="font-size:30px; line-height:1.2;">
                                            <?php echo $tour['name'];?>
                                        </div>
                                        <?php if(!empty($locations[$tour['location']])){?>
                                        <div class="col-12 col-md-6 pt-2">
                                            <i class="fa fa-map-marker ico-cus2"></i>
                                            <b>Location: </b>
                                            <?php echo $locations[$tour['location']];?>
                                        </div>
                                        <?php }?>

                                        <?php if(!empty($tour['duration'])){?>
                                        <div class="col-12 col-md-6 pt-2">
                                            <i class="fa fa-hourglass-start ico-cus2"></i>
                                            <b>Duration: </b>
                                            <?php echo $tour['duration']?>
                                        </div>
                                        <?php }?>

                                        <?php if(!empty($tour['departure'])){?>
                                        <div class="col-12 col-md-6 pt-2">
                                            <i class="fa fa-bell ico-cus2"></i>
                                            <b>Departure: </b>
                                            <?php echo $tour['departure']?>
                                        </div>
                                        <?php }?>

                                        <?php if(!empty($tour_type[$tour['tour_type']])){?>
                                        <div class="col-12 col-md-6">
                                            <i class="fa fa-flag ico-cus2"></i>
                                            <b>Tour Type: </b>
                                            <?php echo $tour_type[$tour['tour_type']]?>
                                        </div>
                                        <?php }?>

                                    </div>

                                </div>


                                <div class="col-12 col-md-4 pl-md-5 pt-4 pt-md-0">
                                    


                                    <div class="row">
                                        <div class="col-md-12">
                                            <?php if($tour['price']>0){?>
                                                <div id="book-calendar" class="calendar-area" style="height:320px;">
                                                    <?php include 'book.php';?>
                                                </div>
                                                <div class="row calendar-area">
                                                    <div class="col-12 ">
                                                        <div class="row">
                                                            <div class="col-12 pt-2 show_date text-booked">
                                                                Select date to begin tour
                                                            </div>
                                                        </div>
                                                        <br>

                                                        <form action="<?php echo ROOT?>cart" method="post" class="form-group">
                                                            <input type="hidden" name="date" id="date" value="">
                                                            <input type="hidden" name="tour" value="<?php echo $defender->encrypt('encrypt', $tour['id'])?>">
                                                            <input class="d-inline pr-1 form-control" type="number" name="qty" required value="<?php echo $tour['min_travellers']?>" min="<?php echo $tour['min_travellers']?>" max="<?php echo $tour['stock']?>" style="width:80px">
                                                            x Pax <span class="text-booked" style="position:relative; top:2px;">(<?php echo 'RM'.number_format($tour['price'],2,'.',',') ?>)</span>

                                                            <div class="row">
                                                                <div class="col-12 pt-4">
                                                                    <input type="submit" id="add_to_cart" class="form-control btn btn-lg btn-success" value="Add to Cart" disabled>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            <?php }else{?>
                                                <div class="enquiry"><!--collapse-->
                                                    <?php include 'message.php';?>
                                                </div>
                                            <?php }?>
                                        </div>
                                    </div>

                                     

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row pt-5">
                    
                        <div class="col-12">
                            <?php 
                            $tour['description'] = str_replace(array('../../', '<img'), array(ROOT, '<img class="img-fluid"'), $tour['description']);                
                            echo $tour['description'];                            
                            ?>
                            <?php //echo $tour['popular']?>
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

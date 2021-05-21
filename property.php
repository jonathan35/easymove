<?php 
require_once 'config/ini.php';
require_once 'config/security.php';
include_once 'head.php';

?>

<html lang="en">


<div class="cat-trigger d-sm-none" onclick="$('.category-panel').toggleClass('category-active');"><i class="fa fa-search" aria-hidden="true"></i></div>


<body class="container-fluid p-0">
    <div class="my-container">

        <?php include 'header.php';?>
        <div style="height:66px;">
            <div class="page_title">
                tour
            </div>
        </div>

        <div class="row"><div class="col-12"><br></div></div>
        
        <?php 
        $categories = sql_read("select * from category where status =?", 's', 1);
        $properties = sql_read("select * from tour where status =?", 's', 1);

        foreach((array)$categories as $cat){
            $en_cat[$cat['id']] = $defender->encrypt('encrypt', $cat['id']);
            $cat_count[$cat['id']] = $defender->encrypt('encrypt', $cat['id']);
        }
        ?>

        <div class="row wave_rec">

            <div class="col-12 col-md-9 p-4 pl-2 pr-md-5"><!-- pl-md-5-->
                <div class="row">

                <?php        
                               
                $itemCount=1;
                $maxPerPage=20;

                foreach((array)$properties as $tour){?>

                    <div class="col-12 col-sm-4 col-md-3 pb-4 ani_card fil-cat fil-<?php echo $en_cat[$tour['category']];?> page page<?php echo $itemCount?>" style=" <?php if($itemCount>$maxPerPage){?> display:none;<?php }?>">
                        <div class="card form-rounded tour-item">
                            <div class="card-body p-2">
                                <div class="row">
                                    <div class="col-12 mb-2">
                                    <div class="bg-cover tour-thum" style="height:calc(100vh / 5);background-image:url('<?php echo ROOT.$tour['photo'];?>')"></div>
                                    </div>
                                    <div class="col-12 text-left" style="height:80px;">
                                        <div class="truancate">
                                            <?php echo $tour['name']; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 mt-2 mb-1 text-center">
                                        <a href="tour_details/<?php echo $str_convert->to_url($tour['name']);?>" style="text-decoration:none;">
                                            <button type="button" class="btn btn-block view_more">VIEW DETAILS</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php }?>
                </div>
                
                <?php include 'paging.php';?>
            </div>

            <div class="col-12 col-md-3 pt-3 category-panel">
                <div class="pro-cat" onclick="filter_tour('.fil-cat')">All Properties</div>
                <?php 
                foreach((array)$categories as $cat){?>
                    <div class="pro-cat" onclick="filter_tour('.fil-<?php echo $en_cat[$cat['id']]?>')">
                        <?php echo $cat['category'];?>
                    </div>

                <?php }?>
                <script>
                function filter_tour(cat){
                    $('.fil-cat').hide();
                    $(cat).fadeIn();
                }
                </script>
            </div>
        </div>

    </div>


    <div class="row">
        <div class="col-12">
            <div class="row"><div class="col-12"><br><br><br><br><br></div></div>
            <? include 'footer.php';?>        
        </div>
    </div>                
            

</body>

</html>

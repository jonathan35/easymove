<?php 

$news = sql_read("select * from news where status=? order by position asc, id desc", 'i', 1);

//include 'path.php';


?>


<div class="row pt-4">
    <div class="col-md pt-5">
        <h1 class="dash-left pb-2 pl-3">ANNOUNCEMENT</h1>    
    </div>
</div>


<div class="row pb-3">
    <?php 
    foreach((array)$news as $new){
    ?>
    <div class="col-12 col-md-4 pl-4 pr-4 pb-4">
        <?php /*<a href="#<?php echo ROOT?>new_details/<?php echo $str_convert->to_url($new['title'])?>" style="color:#555;">*/?>
        <div class="row" style=" background:white; border:1px solid #DDD;">
            <div class="col-12">

                <div class="row">
                    <div class="col-12 p-0" style="overflow:hidden;">
          
                        <div class="d-none d-md-block bg-cover bg-pic-<?php echo $c?> zoom-in" style="cursor:pointer; height:calc(100vh / 2.4); background-color:#CCC; background-image:url('<?php echo ROOT.$new['photo']?>'); " data-toggle="modal" data-target="#enlargeModal" onclick="$('.indicator-<?php echo $c?>').click();"></div>

                        <div class="d-md-none bg-cover bg-pic-<?php echo $c?>" style="height:calc(100vw / 2); background-color:#CCC;background-image:url('<?php echo ROOT.$new['photo']?>'); "></div>
                        <img class="img-fluid" src="<?php echo ROOT.$new['photo']?>" onload="cover_contain(this, '<?php echo $c?>')" style="display:none;">
                        <script>/*
                        function cover_contain(t, e){
                            var h = $(t).height();
                            var w = $(t).width();
                            if(h>w){
                                $('.bg-pic-'+e).removeClass('bg-cover');
                                $('.bg-pic-'+e).addClass('bg-contain');
                            }
                        }*/
                        </script>
                    </div>

                    <div class="col-12 p-2" style="font-size:14px; background:var(--main-dark); ">
                        <div class="row">
                            <div class="col-12 mb-1 text-center" style="color:white; font-size:20px; line-height:1.2; height:48px; overflow:hidden;">
                                <?php echo $new['title']?>
                            </div>
                        </div>
                    </div>
                </div>
          
            </div>
        </div>
        <?php /*</a>*/?>
    </div>
    <?php 
    $c++;
    }?>
</div>
<div class="row pb-4">
    <div class="col-12 text-center">
        <a href="<?php echo ROOT?>news"><div class="line-btn">MORE NEWS</div></a>
    </div>
</div>
<br><br><br>

<style>

.line-btn {
    cursor:pointer;
    border-radius:30px; border: 3px solid var(--main-light); padding:8px 40px; width:280px; text-align:center; font-size:22px; color:var(--main-light); margin:0 auto;
    transition: color .8s, background-color .8s;
}

.line-btn:hover {
    background-color:var(--main-light);
    color:white;

}
</style>


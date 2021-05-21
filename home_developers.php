<? 
$devs = sql_read("select * from developer where status=?" , 'i', 1);

$n = $c = 0;
$developers = array();
foreach((array)$devs as $dev){
	if($n%6==0){
		$c++;
	}
	$developers[$c][$n] = $dev;
	$n++;
}

?>


<div class="row">
  <?php foreach((array)$devs as $dev){?>
  <div class="col-12 d-md-none">
    <div class="col-12" style="height:40vh; background-position: center; background-repeat: no-repeat; background-size: contain;  background-image:url('<?php echo $dev['developer_photo']?>')"></div>
  </div>
  <?php }?>
</div>

<div class="row">

    <div class="col-12 d-none d-md-block" style="font-size:14px;">
      <div class="bd-example" data-example-id="">
          <div id="carouselBlock" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner" role="listbox" style="padding:40px; height:140px;">                 
            <? 
            $o = 0;
            foreach((array)$developers as $developer){?>
              <div class="carousel-item <? if($o==0){?>active<? }?>">
            
                <div class="row">
                    <? foreach((array)$developer as $n){?>
                    <div class="col-12 col-md-2" style="background-position: center; background-repeat: no-repeat; background-size: contain; height: 60px; background-image:url('<?php echo $n['developer_photo']?>')">
                    
                    </div>	
                    <? }?>
                </div>
                     
              </div>
  <? 
          $o++;
          }?>
              
            </div>


            <?php if($c>1){?>
            <a class="carousel-control-prev noedit" href="#carouselBlock" role="button" data-slide="prev" style="width:60px; ">
              <i class="fa fa-chevron-left" aria-hidden="true" style="color:rgba(0,0,0,.5); font-size:20px;"></i>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next noedit" href="#carouselBlock" role="button" data-slide="next" style="width:60px; ">
            <i class="fa fa-chevron-right" aria-hidden="true" style="color:rgba(0,0,0,.5); font-size:20px;"></i>
              <span class="sr-only">Next</span>
            </a>
            <?php }?>
          </div>
      </div>
    </div>
</div>



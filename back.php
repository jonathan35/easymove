<div class="row">
    <div class="col-12 pt-4 pb-4">
        <div class="row back-link">
            <?php 
            $previous = $_SERVER['HTTP_REFERER'];
            $current = HTTP.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

            if($previous == $current){
                $back = ROOT.'home';
            }else{
                $back =$previous;
            }        
            ?>
            <a href="<?php echo $back?>">
                <div class="col-12" style="color:#333;">
                    <i class="fas fa-arrow-left"></i> Back
                </div>
            </a>
        </div>
    </div>
</div>
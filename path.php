<?php 
if(!isset($tours)){
    echo '<div class="row"><div class="col-12"><div class="row"><div class="col-12 p-2">No tour found</div></div></div></div>';
}else{?>
    <div class="row">
        <div class="col-12 p-2">
            <div style="font-size:26px; color:#555;">            
            <?php 
            if(!empty($selected_location['location'])){
                echo $selected_location['location'];
            }

            if(!empty($selected_category['category'])){
                echo '<div class="d-inline" style="padding-left:10px; padding-right:10px;">></div>';
                echo $selected_category['category'];
            }
            ?>
            </div>
            <div style="color:gray;">
                <?php echo count($tours);?> tours found
            </div>
        </div>
    </div>
<?php 
}?>
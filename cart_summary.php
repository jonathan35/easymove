<?php 
include_once 'head.php';
include_once 'cart_function.php';

$count_item = 0 + count((array)$items);
$item_total = item_total();

?>

<style>

.summary-item-count-outter {
    display:inline-block;
    position:relative; top:-15px; right:-2px; width:0; height:0;
}
.summary-item-count-inner {
    color:white;
    width:24px; height:24px; padding-top:2px; text-align:center; background:var(--main-dark); border-radius:50%; box-shadow:0 7px 11px rgba(222, 126, 0, .6); font-size:13px;
}
@media (max-width: 800px) {
    .summary-item-count-outter {
        position:relative; top:2px; right:20px; width:0; height:0; float:right;
    }
}
.nav-shop-cart-icon, .nav-shop-cart-icon:hover, .nav-shop-cart-icon:active, .nav-shop-cart-icon:focus, .nav-shop-cart-icon:visited {
 color:var(--main-dark);
}


</style>
<a class="nav-link nav-shop-cart-icon pl-0" href="<?php echo ROOT.'cart'?>">
    <i class="d-inline fas fa-shopping-cart nav-icon"></i> 
    
    RM <?php echo $item_total;?>
    <span id="cart_summary">
        <div class="summary-item-count-outter">
            <div class="summary-item-count-inner" >
            <?php echo $count_item?>
            </div>
        </div>
    </span>
    
</a>

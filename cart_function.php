<?php


//-------------- Remove from Cart -------------------
if($_POST['remove'] == 'Remove'){

    $id = $defender->encrypt('decrypt', $_POST['tour']);
    sql_exec("delete from items where id=?", 'i', $id);

    $_SESSION['session_msg'] = '<div class="alert alert-success">
    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close" style="position:relative; top:-2px;">×</a>
    Item remove successfully.</div>';
}

//-------------- Add to Cart -------------------
if(!empty($_POST['tour']) && !empty($_POST['qty']) && !empty($_POST['date'])){

    $_SESSION['session_msg'] = '<div class="alert alert-danger">
    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close" 
    style="position:relative; top:-2px;">×</a>
    Failed to add to cart, please try again.</div>';

    $id = $defender->encrypt('decrypt', $_POST['tour']);    
    $tour = sql_read('select * from tour where id=? limit 1', 'i', $id);

    if(!empty($tour['id'])){

        $data['session'] = session_id();
        $data['tour_id'] = $tour['id'];
        $data['name'] = $tour['name']; 
        $data['photo'] = $tour['photo'];
        $data['date'] = $_POST['date'];
        $data['quantity'] = $_POST['qty'];
        $data['unit_price'] = $tour['price']; 
        $data['total_price'] = $_POST['qty'] * $tour['price'];
    
        sql_save('items', $data);

        $_SESSION['session_msg'] = '<div class="alert alert-success">
        <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close" style="position:relative; top:-2px;">×</a>
        Added to cart.</div>';

    }

}

//-------------- Read Cart items-------------------
$items = sql_read('select * from items where session=? order by id asc', 's', session_id());



//-------------- Cart function-------------------
if(!function_exists('item_total')){

    function item_total($total = 0){
        
        global $items;        

        if(@count($items)){
            foreach((array)$items as $i){
                if($i['sarawakian_total_price']>0){
                    $total += $i['sarawakian_total_price'];
                }else{
                    $total += $i['total_price'];
                }
                
                //$total += 11;
            }
        }
        return number_format($total,2,'.',',');
    }
}


?>

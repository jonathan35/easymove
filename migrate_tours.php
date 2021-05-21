<?php 
require_once 'config/ini.php';
require_once 'config/security.php';
include_once 'head.php';



/*
$tours = sql_read('select * from tour');



foreach((array)$tours as $tour){
    $data['id'] = $tour['id'];

    if($tour['location'] == 1){
        $oldtable = 'sarawak';
    }elseif($tour['location'] == 2){
        $oldtable = 'sabah';
    }elseif($tour['location'] == 3){
        $oldtable = 'brunei';
    }elseif($tour['location'] == 4){
        $oldtable = 'package';
    }

    $old_tour = sql_read("select * from $oldtable where duration=? and departure=? and price=? and image1=? and description=? limit 1", 'sssss', array($tour['duration'], $tour['departure'], $tour['price'], $tour['photo'], $tour['full_description']));
    echo '<table style="border:1px solid red;" border="1">';
    echo '<tr>';
        echo '<td>';
        echo $tour['brief_description'];
        echo '</td>';
        echo '<td>-->';
        echo '</td>';
        echo '<td>';
        echo $old_tour['brief'];
        echo '</td>';
    echo '</tr>';
    echo '</table>';
    echo '<br>';echo '<br>';echo '<br>';

    //$data['brief_description'] = $asdsadsad;

}*/


/*
$new_sar_cats = sql_read('select * from category where location=1');

foreach((array)$new_sar_cats as $new_sar_cat){
    $new_cat1[$new_sar_cat['category']] = $new_sar_cat['id'];
}
debug($new_cat1);
$sar_cats = sql_read('select * from sarawak_category');
foreach((array)$sar_cats as $sar_cat){
    $sarawak_cats[$sar_cat['cat_id']] = $sar_cat['cat_name'];
}
debug($sarawak_cats);

$tours = sql_read('select * from tour where location=1');
foreach((array)$tours as $tour){

    if(!empty($tour['id'])){

        $data['id'] = $tour['id'];
        $data['category'] = $new_cat1[$sarawak_cats[$tour['category']]];

        echo '<br>'.$tour['category'].'--->'.$data['category'];

        sql_save('tour', $data);
        
    }
}



$new_sab_cats = sql_read('select * from category where location=2');

foreach((array)$new_sab_cats as $new_sab_cat){
    $new_cat1[$new_sab_cat['category']] = $new_sab_cat['id'];
}
debug($new_cat1);
$sab_cats = sql_read('select * from sabah_category');
foreach((array)$sab_cats as $sab_cat){
    $sabah_cats[$sab_cat['cat_id']] = $sab_cat['cat_name'];
}
debug($sabah_cats);

$tours = sql_read('select * from tour where location=2');
foreach((array)$tours as $tour){

    if(!empty($tour['id'])){

        $data['id'] = $tour['id'];
        $data['category'] = $new_cat1[$sabah_cats[$tour['category']]];

        echo '<br>'.$tour['category'].'--->'.$data['category'];

        sql_save('tour', $data);
        
    }
}





$new_bru_cats = sql_read('select * from category where location=3');

foreach((array)$new_bru_cats as $new_bru_cat){
    $new_cat1[$new_bru_cat['category']] = $new_bru_cat['id'];
}
debug($new_cat1);
$bru_cats = sql_read('select * from brunei_category');
foreach((array)$bru_cats as $bru_cat){
    $brunei_cats[$bru_cat['cat_id']] = $bru_cat['cat_name'];
}
debug($brunei_cats);

$tours = sql_read('select * from tour where location=3');
foreach((array)$tours as $tour){

    if(!empty($tour['id'])){

        $data['id'] = $tour['id'];
        $data['category'] = $new_cat1[$brunei_cats[$tour['category']]];

        echo '<br>'.$tour['category'].'--->'.$data['category'];

        sql_save('tour', $data);
        
    }
}




$new_pac_cats = sql_read('select * from category where location=4');

foreach((array)$new_pac_cats as $new_pac_cat){
    $new_cat1[$new_pac_cat['category']] = $new_pac_cat['id'];
}
debug($new_cat1);
$pac_cats = sql_read('select * from package_category');
foreach((array)$pac_cats as $pac_cat){
    $package_cats[$pac_cat['cat_id']] = $pac_cat['cat_name'];
}
debug($package_cats);

$tours = sql_read('select * from tour where location=4');
foreach((array)$tours as $tour){

    if(!empty($tour['id'])){

        $data['id'] = $tour['id'];
        $data['category'] = $new_cat1[$package_cats[$tour['category']]];

        echo '<br>'.$tour['category'].'--->'.$data['category'];

        sql_save('tour', $data);
        
    }
}
*/

/*
$sar_cats = sql_read('select * from sarawak_category');
foreach((array)$sar_cats as $a){
    if(!empty($a['cat_id'])){
        $data['location'] = 1;
        $data['category'] = $a['cat_name'];
        $data['status'] = $a['status'];
        sql_save('category', $data);
        echo '<br>';
    }
}

$sab_cats = sql_read('select * from sabah_category');
foreach((array)$sab_cats as $a){
    if(!empty($a['cat_id'])){
        $data['location'] = 2;
        $data['category'] = $a['cat_name'];
        $data['status'] = $a['status'];
        sql_save('category', $data);
        echo '<br>';
    }
}

$bru_cats = sql_read('select * from brunei_category');
foreach((array)$bru_cats as $a){
    if(!empty($a['cat_id'])){
        $data['location'] = 3;
        $data['category'] = $a['cat_name'];
        $data['status'] = $a['status'];
        sql_save('category', $data);
        echo '<br>';
    }
}

$pac_cats = sql_read('select * from package_category');
foreach((array)$pac_cats as $a){
    if(!empty($a['cat_id'])){
        $data['location'] = 4;
        $data['category'] = $a['cat_name'];
        $data['status'] = $a['status'];
        sql_save('category', $data);
        echo '<br>';
    }
}
*/

/*

$sarawaks = sql_read('select * from sarawak');


foreach((array)$sarawaks as $a){

    if(!empty($a['id'])){

        $data['location'] = 1;
        $data['category'] = $a['cat_id'];

        $data['photo'] = $a['image1'];
        $data['name'] = $a['code'].' '.$a['package_name'];

        $data['price'] = $a['price'];
        $data['duration'] = $a['duration'];
        $data['departure'] = $a['departure'];
        $data['brief_description'] = $a['brief'];
        $data['full_description'] = $a['description'];
        $data['status'] = $a['status'];

        sql_save('tour', $data);
        echo '<br>';
    }
}


$sabahs = sql_read('select * from sabah');

foreach((array)$sabahs as $a){

    if(!empty($a['id'])){

        $data['location'] = 2;
        $data['category'] = $a['cat_id'];

        $data['photo'] = $a['image1'];
        $data['name'] = $a['code'].' '.$a['package_name'];

        $data['price'] = $a['price'];
        $data['duration'] = $a['duration'];
        $data['departure'] = $a['departure'];
        $data['brief_description'] = $a['brief'];
        $data['full_description'] = $a['description'];
        $data['status'] = $a['status'];

        sql_save('tour', $data);
        echo '<br>';
    }
}



$bruneis = sql_read('select * from brunei');

foreach((array)$bruneis as $a){

    if(!empty($a['id'])){

        $data['location'] = 3;
        $data['category'] = $a['cat_id'];

        $data['photo'] = $a['image1'];
        $data['name'] = $a['code'].' '.$a['package_name'];

        $data['price'] = $a['price'];
        $data['duration'] = $a['duration'];
        $data['departure'] = $a['departure'];
        $data['brief_description'] = $a['brief'];
        $data['full_description'] = $a['description'];
        $data['status'] = $a['status'];

        sql_save('tour', $data);
        echo '<br>';
    }
}

$packages = sql_read('select * from package');

foreach((array)$packages as $a){

    if(!empty($a['id'])){

        $data['location'] = 4;
        $data['category'] = $a['cat_id'];

        $data['photo'] = $a['image1'];
        $data['name'] = $a['code'].' '.$a['package_name'];

        $data['price'] = $a['price'];
        $data['duration'] = $a['duration'];
        $data['departure'] = $a['departure'];
        $data['brief_description'] = $a['brief'];
        $data['full_description'] = $a['description'];
        $data['status'] = $a['status'];

        sql_save('tour', $data);
        echo '<br>';
    }
}
*/

?>
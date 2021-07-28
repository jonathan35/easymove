<?php 
require_once '../../config/ini.php'; 

$read_id = base64_decode($_GET['id']);
$read_table = $_GET['table'];
$read_fields = json_decode(base64_decode($_GET['fields']), true);


$the_reads = sql_read("select * from $read_table where id=? limit 1", 'i', $read_id);
unset($the_reads['id']);
unset($the_reads['modified']);


$data['id'] = $read_id;
$data['status'] = 'Read';

sql_save($read_table, $data);

?>


<link href="<?php echo ROOT?>cms/css/bootstrap.4.5.0.css" rel="stylesheet">
<link href="<?php echo ROOT?>cms/css/cms.css" rel="stylesheet">


<div class="row">
    <div class="col p-4">
        <?php 

        $rs = sql_read('select id, region from region order by region asc');
        foreach($rs as $r){
            $regions[$r['id']] = $r['region'];
        }
        $zs = sql_read('select id, zone from zone order by zone asc');
        foreach($zs as $z){
            $zones[$z['id']] = $z['zone'];
        }
        

        foreach((array)$the_reads as $l => $v){?>
            <div class="row p-1">
                <div class="col-2 text-capitalize text-muted">
                    <?php echo str_replace('_',' ',$l);?>
                </div>
                <div class="col-10">
                    <?php if($l == 'region') echo $regions[$v]; elseif($l == 'zone') echo $zones[$v]; else echo $v;?>
                </div>
            </div>
        <?php }?>


    </div>
</div>


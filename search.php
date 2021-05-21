<div class="row homebanner">
    <div class="col-10 offset-1 col-md-6 offset-md-3 text-center" style="background:rgba(0,0,0,.7); padding:15px 5px; border-radius:8px;">
        <h1 class="d-none d-md-block text-white">Parcel Tracking</h1>
        <h3 class="d-md-none text-white">Parcel Tracking</h3>
        <div class="p-1 text-white">            
            <div class="d-none d-md-block text-white">
                Enter your order number to see what is the status now.
            </div>
            <div class="d-md-none text-white" style="font-size:10px">
                Enter your order number to see what is the status now.
            </div>
        </div>
        <form action="<?php echo ROOT?>track" method="post" class="form-group p-0 mb-0" id="search_from">
            <div class="ic-search">
                <i class="fa fa-search"></i>
            </div>
            
            <input type="text" class="form-control h-search" name="keyword" placeholder="Order number" id="keyword" autocomplete="off"><input type="submit" class="h-search-submit" value="CHECK">

        </form>


    </div>
</div>
<script>
$("#keyword").on('keyup dblclick', function(){
    
    var keyw = $(this).val();

    if( keyw != ''){
        $('#auto_list').fadeIn();
    }
    $( ".auto_suggest_item" ).each(function( index ) {
        var auto_suggest_item = $(this).text();
        if(auto_suggest_item.toLowerCase().includes(keyw.toLowerCase()) === true){
            $(this).fadeIn();
        }else{
            $(this).fadeOut();
        }
    });
});

$(".auto_suggest_item").on('click', function(){
    var str = $(this).text();
    $('#keyword').val(str);
    $('#keyword').focus(); 
    $('#auto_list').fadeOut();

});

$(function() {
    $("body").click(function(e) {
        if (e.target.id == "auto_list" || $(e.target).parents("#auto_list").length || e.target.id == "keyword" ) {
            //alert("Inside div");
        } else {
            $('#auto_list').fadeOut();
        }
    });
})

</script>

<style>
#auto_list {
    /**/display:none;
    position:absolute;
    top:62px;	
    z-index:4;
    background: rgba(255,255,255,.9);;
    border:1px solid #CCC;
    box-shadow:2px 2px 4px rgba(0,0,0,.4);
    overflow-y:scroll;
    overflow-x:hidden;
    max-height:80vh;
}
#auto_list > div {
    padding:4px 10px;
    cursor:pointer;
}
#auto_list > div:hover {
    background: #EFEFEF;
}
.h-search::placeholder {
    color:#999;
}
</style>

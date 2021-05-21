<style>
.parent {
    overflow: hidden;
    position: relative;
    width: 100%;
}
.child-right {
    background:transparent;
    height: 100%;
    width: 100%;
    position: absolute;
    right: 0;
    top: 0;
    transition:background .5s;    
}
.child-right:hover {
    background:rgba(0,0,0,0.8);
}
.sec-title {
    color:white; padding:30px; text-align:center; padding-top:180px;
}
</style>

<div class="row">
    <div class="col-4 parent bg-cover" style="cursor:pointer; height:calc(100vh / 1.5); background-color:#999; background-image:url('<?php echo ROOT?>images/unnamed.jpg');">
        <div class="child-right sec-title">
            <h1>Turnkey (EPCIC) for Offshore Marginal Field Development</h1>
        </div>       
    </div>
    <div class="col-4 parent bg-cover" style="cursor:pointer; height:calc(100vh / 1.5); background-color:#999; background-image:url('https://www.sarawakenergy.com/assets/images/landing/thermal-energy.jpg');">
        <div class="child-right sec-title">
            <h1>Two Semi Submersible Oil Rig Near Shore </h1>
        </div>       
    </div>
    <div class="col-4 parent bg-cover" style="cursor:pointer; height:calc(100vh / 1.5); background-color:#999; background-image:url('<?php echo ROOT?>photo/603358e5d365d.jpg');">
        <div class="child-right sec-title">
            <h1>Fabrication of Offshore Modules </h1>
        </div>       
    </div>
        
</div>

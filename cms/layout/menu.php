<div class="leftmenu-contain">  

  <h4 class="icon-gear">Order</h4>
  <div class="nav lnav" link="../order/orders">Order 
    
    <?php 
    
    if($_SESSION['group_id'] == 2){
      $new_order = sql_count('select id from orders where status=? and region = ? ', 'ss', array('Ordered', $_SESSION['region']));
    }else{
      $new_order = sql_count('select id from orders where status=?', 's', 'Ordered');
    }

    
    
    if($new_order>0){?>
    <div class="circle_num ml-1" label="New order ">
      <?php echo $new_order?>
    </div>
    <?php }?>
  </div>
  <!--<div class="nav lnav" link="../tour/message?tab=New">Enquiry</div>
  -->

  <h4 class="icon-gear">Merchant</h4>
  <div class="nav lnav" link="../content/message_contact?tab=New">Application
    <?php $message_contact = sql_count('select id from message_contact where status=?', 's', 'New');
    
    if($message_contact>0){?>
    <div class="circle_num ml-1" label="Driver waiting for approval ">
      <?php echo $message_contact?>
    </div>
    <?php }?>

  </div>
  <div class="nav lnav" link="../account/company">Company</div>
  <div class="nav lnav" link="../account/branch">Branch</div>
  <div class="nav lnav" link="../account/merchant">Staff Account</div>
  <div class="nav lnav" link="../account/trip">Trip Topup
    <?php $low_trip = sql_count('select id from trip where trip_balance < ? and trip_balance != ? and trip_balance is not null', 'ii', array(5, 0));
    
    if($low_trip>0){?>
    <div class="circle_num ml-1" label="Low stock trip count, low stock means trip balance less than 5 trip ">
      <?php echo $low_trip?>
    </div>
    <?php }?>
  </div>

  <h4 class="icon-gear">Driver</h4>
  <div class="nav lnav" link="../account/driver">Drivers
    
    <?php $pending_driver = sql_count('select id from driver where status=?', 'i', 2);
    
    if($pending_driver>0){?>
    <div class="circle_num ml-1" label="Driver waiting for approval ">
      <?php echo $pending_driver?>
    </div>
    <?php }?>
    
  </div>
  
  <div class="nav lnav" link="../account/merit">Merit Ad-Hoc/Withdraw</div>

  <?php if($_SESSION['group_id'] == 1){?>
  <div class="nav lnav" link="../account/merit_setup">Merit Rules</div>
  <div class="nav lnav" link="../order/basic_commission">Commission Rules</div>
  <div class="nav lnav" link="../order/bonus">Bonus Rules</div>
  <div class="nav lnav" link="../account/vehicle_type">Vehicle Type</div>
   
  <h4 class="icon-gear">Report</h4>
  <div class="nav lnav" link="../account/sales_by_zone">Sales by Zone/Merchant</div>
  <div class="nav lnav" link="../account/driver_by_region">Driver by Region</div>
  <div class="nav lnav" link="../account/peak_time">Peak Time Report</div>

  <h4 class="icon-gear">Administrator</h4>
  
  <div class="nav lnav" link="../account/login">Admin Account</div>  
  <!--<div class="nav lnav" link="../order/email_notification">Email Notification</div>-->
  
  <h4 class="icon-gear">Geographical</h4>
  <div class="nav lnav" link="../geographical/region">Region</div>
  <div class="nav lnav" link="../geographical/zone">Zone</div>
  <!--<div class="nav lnav" link="../setup/area">Area</div>-->

  <h4 class="icon-gear">Website</h4>
  <div class="nav lnav" link="../content/banner">Home Banner</div>
  <!--<div class="nav lnav" link="../content/content?id=MQ==&no_list=true">Contact Us</div>  -->
  <div class="nav lnav" link="../content/pages">Free-formated Pages</div>
  <div class="nav lnav" link="../content/news">Announcement</div>
  <?php }?>



  <style>

.icon-gear {
  background-image: url('../images/gear-16.png');
  background-repeat: no-repeat;
  background-position: 10px center;
  padding-left: 30px !important;
  border-bottom:1px solid rgba(255,255,255,.3);
}

  </style>

  <!--
    <h4 class="icon-gear">Tour</h4>
    <div class="nav lnav" link="../tour/tour">Tour</div>
    <div class="nav lnav" link="../tour/location">Location</div>
    <div class="nav lnav" link="../tour/category">Category</div>
  -->
  

  <!-- 
  <h4 class="icon-gear">Payment setup</h4>   
  <?php $choosen_gateway = sql_read('select * from payment_gateway where id=1 limit 1');?>
  <div class="nav lnav" link="../setup/payment_gateway?id=MQ==">Change Gateway 
  <?php if($choosen_gateway['para1']=='eghl') echo '(eGHL)'; elseif($choosen_gateway['para1']=='paypal') echo '(PayPal)';?>
  </div>
  <div class="nav lnav" link="../setup/eghl_setup?id=Mg==">eGHL <?php if($choosen_gateway['para1']=='eghl') echo '(In Use)';?></div>
  <div class="nav lnav" link="../setup/paypal_setup?id=Mw==">PayPal <?php if($choosen_gateway['para1']=='paypal') echo '(In Use)';?></div>-->


  
  <!--
  <h4 class="icon-gear">Home</h4>

  <div class="nav lnav" link="../content/developer">Developer</div>
  <div class="nav lnav" link="../content/home_block">Why Choose Us?</div>
  <div class="nav lnav" link="../content/banner_dashboard?id=Mg==">Banner (Account Dashboard)</div>-->

  <?php /*

<div class="nav lnav" link="../tour/tour_type">Type</div>


  
  <?php $home_content = sql_read('select * from content where id = 2 limit 1');?>
  <div class="nav lnav" link="../content/content?id=Mg==&no_list=true"><?php echo $home_content['title']?></div>
  

  <h4 class="icon-gear">Product & Order</h4>
  
  <?php if($_SESSION['group_id'] == '1'){?>
    <div class="nav lnav" link="../product/import_product">Import Product</div>
    <!--<div class="nav lnav" link="../product/add_product">Create Product</div>-->
  <?php }?>
  <div class="nav lnav" link="../product/list_product">Product</div>
  <div class="nav lnav" link="../product/uom">Product UOM & Price</div>
  <div class="nav lnav" link="../order/orders">Order</div>


  <h4 class="icon-gear">Product Pre-data</h4>
  <div class="nav lnav" link="../product/category">Category</div>  
  <div class="nav lnav" link="../product/sub_category">Sub Category</div>
  <div class="nav lnav" link="../product/brand">Brand</div>  
  




  <h4 class="icon-gear">Locality & Delivery</h4>
  
  <div class="nav lnav" link="../setup/delivery_tier">Delivery Tier</div>
  <div class="nav lnav" link="../account/driver">Delivery Driver</div>


  <h4 class="icon-gear">Accounts</h4>
  <div class="nav lnav" link="../account/admins">Admin</div>
  <div class="nav lnav" link="../account/subscribers">Subscribers</div>
  





  <h4 class="icon-gear">Report</h4>

  <div class="nav lnav" link="../order/time_span_standard?id=MQ==">Time Span Standard Setup</div>
  <div class="nav lnav" link="../report/performance_index">Performance Index</div>
  <div class="nav lnav" link="../report/mtd">Month to Date</div>
  <div class="nav lnav" link="../report/monthly_sales">Monthly Sales</div>

  <div class="nav lnav" link="../account/site_log">Admin's Log</div>
  <div class="nav lnav" link="../account/member_visits">Member's Log</div>


  <div class="nav lnav" link="../report/delivered_declined">Orders Delivered/Declined</div>
*/?>
  

  <script>
  $('.nav').click(function(e){
    var link = $(this).attr('link');
    window.location = link;
  })
  
  document.addEventListener('DOMContentLoaded', function(){
    //var tl = '';
    //var p = '<?php //echo $pag?>';

    var p1 = $(location).attr('href').split('/cms/')[1];
    var p2 = p1.split('?')[0];
    p2 = p2.replace('//', '/');
    
  
    $('.lnav').each(function(){
      tl = $(this).attr('link').replace('../','');      

      if(tl == p1 || tl == p2){
        $(this).addClass('nav-active');
      }
    })

  })
  </script>

  <div id="session-page"></div>

  



<!--
  <h4 class="icon-gear">Font-Page</h4>
  banner_url
  url_page
  seo
    

  <h4 class="icon-gear">Database</h4>
  database
  manageAccount
  subscriber
  
  <h4 class="icon-gear">Project</h4>
  projects
  packages
  project_details
  project_photos
  project_pdfs
  causes_of_delay
  contractual_issues
  chart

  <h4 class="icon-gear">Parliament & DUN</h4>
  parliaments.php
  duns  
  par_dun_display
  mpduns
  mpdun_projects
  mpdun_display
  
  <h4 class="icon-gear">Dynamic Content</h4>  
  editLogo.php
  editSetup.php
  editHomeTitle.php'
  postBanner.php' || $page_name == 'editBanner.php
  homeContent.php' || $page_name == 'editHomeContent.php
  createVolunteer.php'|| $page_name == 'editVolunteer.php
  about_us.php'
  createContent.php || editContent.php
  pdfs.php
  statements.php

-->

</div>



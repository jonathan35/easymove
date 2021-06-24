<? 
require_once('Connections/pamconnection.php'); 
require_once('pro/str_convert.php');
require_once('pro/authentication.php');

$authentication->authenticate();

?>
<!DOCTYPE html>
<html lang="en" xml:lang="en">
<head>
<? include 'prefix.php';?>
</head>
<body>
<div class="center">
	<? include("header.php");?>
    <div class="container">
        <div class="row">
			<? include("filter.php");?>
            <div class="section section-home">
                <div class="col-12 nopadding">
					<? include("banner.php");?>
                </div>
                <div class="col-12" >
                    <div class="row">
                        <div class="col-12 mt-3">
                        	<h4>Featured product</h4>
							<? include("featured.php");?>
                    	</div>
                    </div>
                </div>
                
				
            </div>
           
		<? //include("footer.php");?>
		</div>
        
    </div>
</div>
<? include("suffix.php");?>
</body>
</html>

<?php
include("../vendor/autoload.php");
use Controller\mmshightech;
use Controller\mmshightech\usersPdo;
use Controller\mmshightech\productsPdo;
// include("../controller/mmshightech.php");
// // 
// include("../controller/mmshightech/usersPdo.php");
if(session_status() !== PHP_SESSION_ACTIVE){
    session_start();
}
if(isset($_SESSION['user_agent'],$_SESSION['var_agent'])){
    $mmshightech=new mmshightech();
    $user=new usersPdo($mmshightech);
    $productsPdo = new productsPdo($mmshightech);
    $cur_user_row = $mmshightech->userInfo($_SESSION['user_agent']);
    $userDirect=$cur_user_row['user_type'];
    if($cur_user_row['user_type']==$userDirect){
    	if(isset($_POST['request'])){
    		date_default_timezone_set('Africa/Johannesburg');
    		$getProductData = $productsPdo->getDataOnThisProduct($_POST['request']);
    		if(isset($getProducts['error'])){
    			echo $getProducts['error'];
    		}
    		else{
    			$img=$getProductData['product_thumbnail'];
		        ?>
		        <div style="padding:10px 10px;display: flex;height: 80vh;">
		        	<div style="padding:10px 10px;width:50%;">
		        		<div style="width:40%; margin-left: 25%;margin-top: 10%;">
		        			<img style="width: 100%;" src="../img/<?php echo $img;?>">
		        		</div>
		        		<label>Change this icon image</label>
		        		<input type="file" accept="image/*" style="width:40%;" name="">
		        	</div>
		        	<div style="padding:30px 30px;width: 50%;background: #dddddd;text-align: left;">
		        		<h3 style="font-weight: bolder; text-align: left;"><?php echo "product_title : ".$getProductData['product_title'];?></h3>
		        		<h3 style="font-weight: bolder; text-align: left;"><?php echo "product_description : ".$getProductData['product_description'];?></h3>
		        		<h3 style="font-weight: bolder; text-align: left;"><?php echo "product_weight : ".$getProductData['product_weight'];?></h3>
		        		<h3 style="font-weight: bolder; text-align: left;"><?php echo "product_origin_country : ".$getProductData['product_origin_country'];?></h3>
		        		<h3 style="font-weight: bolder; text-align: left;"><?php echo "variant_barcode : ".$getProductData['variant_barcode'];?></h3>
		        		<h3 style="font-weight: bolder; text-align: left;"><?php echo "price_usd : ".$getProductData['price_usd'];?></h3>
		        		<h3 style="font-weight: bolder; text-align: left;"><?php echo "available_quantiy : ".$getProductData['available_quantiy'];?></h3>



		        	</div>
		        </div>
		        <?php
    		}
    	}
    	else{
    		echo"UNKNOWN REQUEST!!.";
    	}
    }
	else{
        session_destroy();
        ?>
        <script>
            window.location=("../");
        </script>
        <?php
    }
}
else{
    session_destroy();
    ?>
    <script>
        window.location=("../");
    </script>

    <?php
}
?>
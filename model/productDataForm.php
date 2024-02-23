<?php
include("../vendor/autoload.php");
use Controller\mmshightech;
use Controller\mmshightech\usersPdo;
use Controller\mmshightech\productsPdo;
use Classes\constants\Constants;
if(session_status() !== PHP_SESSION_ACTIVE){
    session_start();
}
if(isset($_SESSION['user_agent'],$_SESSION['var_agent'])){
    $mmshightech=new mmshightech();
    $user=new usersPdo($mmshightech);
    $productsPdo = new productsPdo($mmshightech);
    $cur_user_row = $mmshightech->userInfo($_SESSION['user_agent']);
    $userDirect=$cur_user_row['user_type'];
    if($cur_user_row['user_type']==Constants::USER_TYPE_ADMIN){
    	if(isset($_POST['request'])){
    		date_default_timezone_set('Africa/Johannesburg');
    		$getProductData = $productsPdo->getDataOnThisProduct($_POST['request']);
    		$getCategory = $productsPdo->getCategory($getProductData['menu_catalogue_id']);
    		if(isset($getProducts['error'])){
    			echo $getProducts['error'];
    		}
    		else{
    			$img=$getProductData['product_thumbnail'];
    			$categoryDrop = '';
    			foreach($getCategory as $category){
    				$categoryDrop.="<option value='{$category['id']}'>{$category['menu']}</option>";
    			}
		        ?>
		        <style>
		        	.form-control{
		        		padding: 10px 10px;
		        		border-radius: 10px;
		        		border:1px solid #ddd;
		        		width: 100%;
		        	}
		        	.subControl{
		        		width:100%;
		        	}
		        	.switch {
					  position: relative;
					  display: inline-block;
					  width: 60px;
					  height: 34px;
					}

					.switch input { 
					  opacity: 0;
					  width: 0;
					  height: 0;
					}

					.sliderSlider {
					  position: absolute;
					  cursor: pointer;
					  top: 0;
					  left: 0;
					  right: 0;
					  bottom: 0;
					  background-color: #ccc;
					  -webkit-transition: .4s;
					  transition: .4s;
					}

					.sliderSlider:before {
					  position: absolute;
					  content: "";
					  height: 26px;
					  width: 26px;
					  left: 4px;
					  bottom: 4px;
					  background-color: white;
					  -webkit-transition: .4s;
					  transition: .4s;
					}

					input:checked + .sliderSlider {
					  background-color: #2196F3;
					}

					input:focus + .sliderSlider {
					  box-shadow: 0 0 1px #2196F3;
					}

					input:checked + .sliderSlider:before {
					  -webkit-transform: translateX(26px);
					  -ms-transform: translateX(26px);
					  transform: translateX(26px);
					}

					/* Rounded sliderSliders */
					.sliderSlider.round {
					  border-radius: 34px;
					}

					.sliderSlider.round:before {
					  border-radius: 50%;
					}

		        </style>
		        <div style="padding:10px 10px;display: flex;height: 80vh;">
		        	<div style="padding:10px 10px;width:50%;">
		        		<div style="width:50%; margin-left: 25%;margin-top: 10%;">
		        			<img style="width: 100%;" src="../img/<?php echo $img;?>">
		        		</div>
		        		<label>Change this icon image</label>
		        		<input type="file" accept="image/*" style="width:40%;" name="">
		        	</div>
		        	<div style="padding:30px 30px;width: 80%;text-align: left;">
		        		<!-- <h3 style="font-weight: bolder; text-align: left;"><?php //echo "product_title : ".$getProductData['product_title'];?></h3>
		        		<h3 style="font-weight: bolder; text-align: left;"><?php //echo "product_description : ".$getProductData['product_description'];?></h3>
		        		<h3 style="font-weight: bolder; text-align: left;"><?php //echo "product_weight : ".$getProductData['product_weight'];?></h3>
		        		<h3 style="font-weight: bolder; text-align: left;"><?php //echo "product_origin_country : ".$getProductData['product_origin_country'];?></h3>
		        		<h3 style="font-weight: bolder; text-align: left;"><?php //echo "variant_barcode : ".$getProductData['variant_barcode'];?></h3>
		        		<h3 style="font-weight: bolder; text-align: left;"><?php //echo "price_usd : ".$getProductData['price_usd'];?></h3>
		        		<h3 style="font-weight: bolder; text-align: left;"><?php //echo "available_quantiy : ".$getProductData['available_quantiy'];?></h3>
 -->
 						<div style="padding:2px 2px;width: 100%;display: flex;">
 							<div class="subControl"><label>Product Label</label><textarea class="form-control " type="text" placeholder="Label"><?php echo $getProductData['product_title'];?></textarea></div>
 							<div class="subControl"><label>Product Sub-Label</label><textarea class="form-control " type="text" placeholder="Sub Label"><?php echo $getProductData['product_subtitle'];?></textarea></div>
 							<div class="subControl"><label>Product Description</label><textarea class="form-control " type="text" placeholder="Description"><?php echo $getProductData['product_description'];?></textarea></div>
 						</div>
 						<div style="padding:2px 2px;width: 100%;display: flex;">
 							<div class="subControl"><label>Manufacture</label><input value="<?php echo $getProductData['manufacture'];?>" class="form-control " type="text" placeholder="Manufacture"></div>
 							<div class="subControl"><label>Brand</label><input value="<?php echo $getProductData['brand'];?>" class="form-control " type="text" placeholder="Brand"></div>
 							<div class="subControl"><label>Category</label>
 								<select class="form-control" >
 									<option value="<?php echo $getProductData['menu_catalogue_id']??null;?>"><?php echo $getProductData['category']??'NONE';?></option>
 									<?php echo $categoryDrop;?>
 								</select>
 							</div>
 							<div class="subControl"><label>Selling Unit</label><input value="<?php echo $getProductData['product_weight'];?>" class="form-control " type="text" placeholder="Selling Unit"></div>
 							<div class="subControl"><label>Content Quantity</label><input value="<?php echo $getProductData['available_quantiy'];?>" class="form-control " type="number" placeholder="Content Quantity"></div>
 						</div>
 						<div style="padding:2px 2px;width: 100%;display: flex;">
 							<div class="subControl"><label>Content UOM</label><select class="form-control">
 								<option  value="<?php echo $getProductData['uom']??null;?>"><?php echo $getProductData['uom']??'NONE';?></option>
 								<option value="UNIT">UNIT</option>
 								<option value="ML">ML</option>
 								<option value="KG">KG</option>
 								<option value="L">L</option>
 							</select></div>
 							<div class="subControl"><label>EAN CODE</label><input  value="<?php echo $getProductData['variant_barcode'];?>" class="form-control " type="number" placeholder="EAN CODE"></div>
 							<div class="subControl"><label>Alt EAN</label><input  value="<?php echo $getProductData['variant_barcode_alt'];?>" class="form-control " type="text" placeholder="ALT EAN"></div>
 							<div class="subControl"><label>ALT EAN2</label><input  value="<?php echo $getProductData['variant_barcode_alt2'];?>" class="form-control " type="number" placeholder="ALT EAN2"></div>
 							<div class="subControl"><label>EAN CODE SINGLE</label><input  value="<?php echo $getProductData['variant_barcode'];?>" class="form-control " type="number" placeholder="EAN CODE SINGLE"></div>
 						</div>
 						<div style="padding:2px 2px;width: 100%;display: flex;">
 							<div class="subControl"><label>is Promo</label>
 								<label class="switch">
								  <input type="checkbox" <?php if($getProductData['product_discountable']===Constants::SUCCESS_YES){echo 'checked';} ?>>
								  <span class="sliderSlider round"></span>
								</label>
 							</div>
 							<div class="subControl"><label>Start date</label><input value="<?php echo $getProductData['promo_start_date'];?>" class="form-control " type="date" placeholder="Start Date"></div>
 							<div class="subControl"><label>End Date</label><input value="<?php echo $getProductData['promo_end_date'];?>" class="form-control " type="date" placeholder="End Date"></div>
 							<div class="subControl"><label>is InStock</label>
 								<label class="switch">
								  <input type="checkbox" <?php if($getProductData['is_instock']===Constants::SUCCESS_YES){echo 'checked';} ?>>
								  <span class="sliderSlider round"></span>
								</label>
 							</div>
 							
 						</div>
 						<div style="padding:2px 2px;width: 100%;display: flex;">
 							<div class="subControl"><label>Product Price</label><input value="<?php echo  number_format($getProductData['price_usd'],2);?>" class="form-control " type="text" placeholder="Price"></div>
 							<div class="subControl"><label>Promo Price</label><input value="<?php echo number_format($getProductData['promo_price'],2);?>" class="form-control " type="text" placeholder="Promo Price"></div>
 							<div class="subControl"><label>% Discount</label><input value="<?php echo  number_format($getProductData['promo_percentage'],2);?>" class="form-control " type="text" placeholder="% Discount"></div>
 							<div class="subControl"><label>Discount Amount</label><input value="<?php echo  number_format($getProductData['discount_amount'],2);?>" class="form-control " type="text" placeholder="Discount Amount"></div>
 							
 						</div>
 						<br>
 						<div style="padding:10px 10px;">
			        		<span style="cursor:pointer;padding: 10px 10px;border-radius: 10px; background: navy;color: white;">SAVE</span><span class="displayErrorMessage" hidden></span>
			        	</div>
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
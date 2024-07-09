<?php
include("../vendor/autoload.php");
use Controller\mmshightech;
use Classes\constants\Constants;
use Controller\mmshightech\productsPdo;
if(session_status() !== PHP_SESSION_ACTIVE){
    session_start();
}
if(isset($_SESSION['user_agent'],$_SESSION['var_agent'])){
    // require_once("../controller/mmshightech.php");
    $mmshightech=new mmshightech();
    $cur_user_row = $mmshightech->userInfo($_SESSION['user_agent']);
    $productsPdo = new productsPdo($mmshightech);
    $userDirect=$cur_user_row['user_type'];
    if($cur_user_row['user_type']==Constants::USER_TYPE_ADMIN){
        date_default_timezone_set('Africa/Johannesburg');
        $getCategory = $productsPdo->getCategory(0);
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
        <div class="body-tag" style="display: flex;">
            <div class="left-tag-set">
                <div class="left-top" style="padding: 10px 10px;width:100%;">
                    <label>Upload product data csv|xls|xlxs</label>
                    <input type="file" class="filesUpload" id="filesUpload" multiple>
                    <div style="padding: 10px 10px;width:100%;" class="displayResponse" hidden></div>
                </div>

            </div>
            <div class="right-tag-set" style="padding: 10px 10px;">
                <div style="padding:30px 30px;width: 80%;text-align: left;">
                        <div style="padding:2px 2px;width: 100%;display: flex;">
                            <div class="subControl"><label>Product Label</label>
                                <textarea class="form-control add_label" type="text" placeholder="Label"></textarea>
                            </div>
                            <div class="subControl"><label>Product Sub-Label</label>
                                <textarea class="form-control add_sub_label" type="text" placeholder="Sub Label"></textarea>
                            </div>
                            <div class="subControl"><label>Product Description</label>
                                <textarea type="text" class="form-control add_description" placeholder="Description"></textarea>
                            </div>
                        </div>
                        <div style="padding:2px 2px;width: 100%;display: flex;">
                            <div class="subControl"><label>Manufacture</label>
                                <input class="form-control add_manufacture" type="text" placeholder="Manufacture">
                            </div>
                            <div class="subControl"><label>Brand</label>
                                <input class="form-control add_brand" type="text" placeholder="Brand">
                            </div>
                            <div class="subControl"><label>Category</label>
                                <select class="form-control add_category" >
                                    <option value="">-- Select Category --</option>
                                    <?php echo $categoryDrop;?>
                                </select>
                            </div>
                            <div class="subControl"><label>Selling Unit</label>
                                <input class="form-control add_seling_unit" type="text" placeholder="Selling Unit">
                            </div>
                            <div class="subControl"><label>Content Quantity</label>
                                <input class="form-control add_qantity" type="number" placeholder="Content Quantity">
                            </div>
                        </div>
                        <div style="padding:2px 2px;width: 100%;display: flex;">
                            <div class="subControl"><label>Content UOM</label>
                                <select class="form-control add_content_uom">
                                    <option  value="">-- Select Selling UOM</option>
                                    <option value="UNIT">UNIT</option>
                                    <option value="ML">ML</option>
                                    <option value="KG">KG</option>
                                    <option value="L">L</option>
                                </select>
                            </div>
                            <div class="subControl"><label>EAN CODE</label>
                                <input class="form-control add_ean_code" type="number" placeholder="EAN CODE">
                            </div>
                            <div class="subControl"><label>Alt EAN</label>
                                <input class="form-control add_alt_ean" type="text" placeholder="ALT EAN">
                            </div>
                            <div class="subControl"><label>ALT EAN2</label>
                                <input class="form-control add_alt_ean2" type="number" placeholder="ALT EAN2">
                            </div>
                            <div class="subControl"><label>EAN CODE SINGLE</label>
                                <input class="form-control add_code_single" type="number" placeholder="EAN CODE SINGLE">
                            </div>
                        </div>
                        <div style="padding:2px 2px;width: 100%;display: flex;">
                            <div class="subControl"><label>is Promo</label>
                                <label class="switch">
                                  <input type="checkbox" class="promoToggle" id="addPromoToggle">
                                  <span class="sliderSlider round"></span>
                                </label>
                            </div>
                            <div class="subControl"><label>Start date</label>
                                <input class="form-control add_start_date" type="date" placeholder="Start Date">
                            </div>
                            <div class="subControl"><label>End Date</label>
                                <input class="form-control add_end_date" type="date" placeholder="End Date">
                            </div>
                            <div class="subControl"><label>is InStock</label>
                                <label class="switch">
                                  <input type="checkbox" class="instockToggle" id="addInstockToggle">
                                  <span class="sliderSlider round"></span>
                                </label>
                            </div>
                            
                        </div>
                        <div style="padding:2px 2px;width: 100%;display: flex;">
                            <div class="subControl"><label>Product Price</label>
                                <input class="form-control add_price" type="text" placeholder="Price">
                            </div>
                            <div class="subControl"><label>Promo Price</label>
                                <input class="form-control add_label_promo_price" type="text" placeholder="Promo Price">
                            </div>
                            <div class="subControl"><label>% Discount</label>
                                <input class="form-control add_percentage_discount" type="text" placeholder="% Discount">
                            </div>
                            <div class="subControl"><label>Discount Amount</label>
                                <input class="form-control add_discount_amount" type="text" placeholder="Discount Amount">
                            </div>
                            
                        </div>
                        <br>
                        <div style="padding:10px 10px;">
                            <span style="cursor:pointer;padding: 10px 10px;border-radius: 10px; background: navy;color: white;" onclick="addNewProductDetails()">SAVE</span><span class="displayErrorMessage" hidden></span>
                        </div>
                    </div>
            </div>
        </div>
        <?php
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
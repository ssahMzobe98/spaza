<?php

use controller\mmshightech;
use controller\mmshightech\spazaPdo;

if(session_status() !== PHP_SESSION_ACTIVE){
    session_start();
}
if(isset($_SESSION['user_agent'],$_SESSION['var_agent'])){
    require_once("../controller/mmshightech.php");
    require_once("../controller/mmshightech/spazaPdo.php");
    $mmshightech=new mmshightech();
    $spazaPdo=new spazaPdo($mmshightech);
    $cur_user_row = $mmshightech->userInfo($_SESSION['user_agent']);
    $userDirect=$cur_user_row['user_type'];
    if($cur_user_row['user_type']==$userDirect){
        date_default_timezone_set('Africa/Johannesburg');
        if(isset($_POST['request']) && $_POST['request']>0){
            $spazaID =$mmshightech->OMO($_POST['request']);
            $spazaDetails = $spazaPdo->getSpazaInformation($spazaID);


            if(empty($spazaDetails)){
                echo"<h5>SPAZA NOT FOUND</h5>";
            }
            else{

                if($spazaDetails['is_veryfied']==1){
                    ?>
                    <style>
                        .shippingDetails{
                            width:70%;
                            border: 2px solid #000000;
                            color:#000000;
                            border-radius: 10px 10px;
                            padding: 5px 5px;
                        }
                        .paymentDetails{
                            width:70%;
                            border:2px solid #000000;
                            color: #000000;
                            border-radius: 10px 10px;
                            padding: 5px 5px;
                        }
                        .divSpaz{
                            width:100%;
                            border:2px solid #000000;
                            border-radius: 10px;

                        }
                        .divSpaz select{
                            width:100%;
                            border:none;
                            color: #000000;

                        }


                     </style>
                    <style>
                        .row {
                            display: -ms-flexbox; /* IE10 */
                            display: flex;
                            -ms-flex-wrap: wrap; /* IE10 */
                            flex-wrap: wrap;
                            margin: 0 -16px;
                        }

                        .col-25 {
                            -ms-flex: 25%; /* IE10 */
                            flex: 25%;
                        }

                        .col-50 {
                            -ms-flex: 50%; /* IE10 */
                            flex: 50%;
                        }

                        .col-75 {
                            -ms-flex: 75%; /* IE10 */
                            flex: 75%;
                        }

                        .col-25,
                        .col-50,
                        .col-75 {
                            padding: 0 16px;
                        }

                        .container {
                            background-color: #f2f2f2;
                            padding: 5px 20px 15px 20px;
                            border: 1px solid lightgrey;
                            border-radius: 3px;
                        }

                        input[type=text] {
                            width: 100%;
                            margin-bottom: 20px;
                            padding: 12px;
                            border: 1px solid #ccc;
                            border-radius: 3px;
                        }

                        label {
                            margin-bottom: 10px;
                            display: block;
                        }

                        .icon-container {
                            margin-bottom: 20px;
                            padding: 7px 0;
                            font-size: 24px;
                        }

                        .btn- {
                            background-color: #04AA6D;
                            color: white;
                            padding: 12px;
                            margin: 10px 0;
                            border: none;
                            width: 100%;
                            border-radius: 3px;
                            cursor: pointer;
                            font-size: 17px;
                        }

                        .btn-:hover {
                            background-color: #45a049;
                        }

                        a {
                            color: #2196F3;
                        }

                        hr {
                            border: 1px solid lightgrey;
                        }

                        span.price {
                            float: right;
                            color: grey;
                        }

                        /* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other (also change the direction - make the "cart" column go on top) */
                        @media (max-width: 800px) {
                            .row {
                                flex-direction: column-reverse;
                            }
                            .col-25 {
                                margin-bottom: 20px;
                            }
                        }
                    </style>
                    <h2 style="text-align: center;">SPAZA DETAILS</h2>
                    <div style="width: 100%;display: flex;">
                        <div style="width: 50%;">
                            <div class="shippingDetails">
                                <div class="shippingDetailsReal">

                                    <div class="spazaAddressDetails"></div>

                                </div>
                            </div>
                        </div>
                        <div style="width: 30%;">
                            <div class="row">
                                <div class="col-25">
                                    <div class="container">
                                            <div class="row">
                                                <div class="col-25">
                                                    <h3>Payment</h3>

                                                    <?php
                                                    $checkoutBtn = 'hidden';
                                                    //echo "<pre>";print_r($spazaDetails['card_details']);echo"</pre>";
                                                    if(empty($spazaDetails['card_details']['card_number'])||
                                                        empty($spazaDetails['card_details']['card_expiry_date'])||
                                                        empty($spazaDetails['card_details']['card_name'])||
                                                        empty($spazaDetails['card_details']['card_cvv'])
                                                    ){
                                                        $checkoutBtn = "onclick='saveCardDetails({$spazaDetails['spaza_owner_id']},{$spazaID})' value='Save Card Details'";
                                                    ?>
                                                    <div class="icon-container">
                                                        <i class="fa fa-cc-visa" style="color:navy;"></i>
                                                        <i class="fa fa-cc-amex" style="color:blue;"></i>
                                                        <i class="fa fa-cc-mastercard" style="color:red;"></i>
                                                        <i class="fa fa-cc-discover" style="color:orange;"></i>
                                                    </div>
                                                    <label for="cname">Name on Card</label>
                                                    <input type="text" id="cname" name="cardname" placeholder="John More Doe">
                                                    <label for="ccnum">Credit card number</label>
                                                    <input type="text" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444">
                                                    <label for="expmonth">Exp Month</label>
                                                    <input type="text" id="expmonth" name="expmonth" placeholder="September">
                                                    <div class="row">
                                                        <div class="col-50">
                                                            <label for="expyear">Exp Year</label>
                                                            <input type="text" id="expyear" name="expyear" placeholder="2018">
                                                        </div>
                                                        <div class="col-50">
                                                            <label for="cvv">CVV</label>
                                                            <input type="text" id="cvv" name="cvv" placeholder="352">
                                                        </div>
                                                    </div>
                                                    <?php
                                                    }
                                                    else{
                                                        $checkoutBtn = "onclick='processPayment({$spazaDetails['spaza_owner_id']})' value='Continue to checkout'";
                                                        ?>
                                                        <div class="payment-info">
                                                            <h2>Card Payment Information</h2>
                                                            <div class="payment-details">
                                                                <p><strong>Cardholder Name:</strong> <?php echo $spazaDetails['card_details']['card_name'];?></p>
                                                                <p><strong>Card Number:</strong> **** **** **** <?php echo substr($spazaDetails['card_details']['card_expiry_date'], -4);?></p>
                                                                <p><strong>Expiration Date:</strong> <?php echo $spazaDetails['card_details']['card_expiry_date'];?></p>
                                                            </div>
                                                        </div>
                                                        <h6 style="cursor:pointer;color:red;" onclick="removeCardDetails(<?php echo $spazaDetails['spaza_owner_id'];?>,<?php echo $spazaID;?>)">Update Card details</h6>
                                                        <div hidden class="errorDisplay"></div>
                                                        <?php
                                                    }
                                                    ?>

                                                </div>

                                            </div>
                                            <input type="submit" <?php echo $checkoutBtn;?>  class="btn-">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script>
                        loadAfterQuery('.spazaAddressDetails','../model/spazaDisplay.php?spazaId=<?php echo $spazaID;?>');

                    </script>
                    <?php
                }
                else{
                    unset($spazaDetails['is_veryfied'],$spazaDetails['time_verified'],$spazaDetails['verified_by']);
                    $isPopulated=true;
                    foreach ($spazaDetails as $detail){
                        if(empty($detail)){
                            $isPopulated=false;
                            break;
                        }
                    }
                    if(!$isPopulated){
                        ?>
                        <style>
                            .unverifiedData{
                                width: 100%;
                                padding: 10px 10px;
                                display: flex;
                            }
                            .leftDisplay,.rightDisplay{
                                width:50%;
                                padding: 10px 10px;
                            }
                            .rightDisplay .launchData{
                                width:100%;
                                border:1px solid #dddddd;
                                border-radius:10px;
                                padding: 10px 10px;
                            }
                            .leftDisplay .defaultControlledData{
                                width: 100%;
                                border-radius: 10px;
                                border:1px solid #dddddd;
                                padding: 10px 10px;

                            }
                            .RunFault{
                                width:100%;
                                padding: 10px 10px;

                            }
                            .visaDetails{
                                width:100%;
                                padding: 10px 10px;
                                background: green;
                                color:white;
                                text-align: center;
                                cursor: pointer;
                                border-radius: 10px;
                                box-shadow: 0 1px 1px rgba(0, 0, 0, 0.5);
                            }
                            .CountryOfOriginAddress{
                                width:100%;
                                padding: 10px 10px;
                                background: purple;
                                color:white;
                                text-align: center;
                                cursor: pointer;
                                border-radius: 10px;
                                box-shadow: 0 1px 1px rgba(0, 0, 0, 0.5);
                            }
                            .spazaLocalAddress{
                                width:100%;
                                padding: 10px 10px;
                                background: rebeccapurple;
                                color:white;
                                text-align: center;
                                cursor: pointer;
                                border-radius: 10px;
                                box-shadow: 0 1px 1px rgba(0, 0, 0, 0.5);
                            }
                            .visaLegalDocuments{
                                width:100%;
                                padding: 10px 10px;
                                background: red;
                                color:white;
                                text-align: center;
                                cursor: pointer;
                                border-radius: 10px;
                                box-shadow: 0 1px 1px rgba(0, 0, 0, 0.5);
                            }
                        </style>
                        <center>
                            <h3 style="width: 100%;text-align: center;">SPAZA IS NOT VERIFIED</h3>
                        </center>
                        <div class="unverifiedData">
                            <div class="leftDisplay">
                                <div class="defaultControlledData">
                                    <h5 style="width:100%;text-align: center;" onclick="ShowMissingDataForm('a',<?php echo $spazaID;?>)">Missing DATA</h5>
                                    <div class="RunFault">
                                        <div class="visaDetails" onclick="ShowMissingDataForm('b',<?php echo $spazaID;?>)">VISA DETAILS</div>
                                    </div>
                                    <div class="RunFault">
                                        <div class="CountryOfOriginAddress" onclick="ShowMissingDataForm('c',<?php echo $spazaID;?>)">COUNTRY OF ORIGIN ADDRESS</div>
                                    </div>
                                    <div class="RunFault">
                                        <div class="spazaLocalAddress" onclick="ShowMissingDataForm('d',<?php echo $spazaID;?>)">SPAZA LOCAL ADDRESS</div>
                                    </div>
                                    <div class="RunFault">
                                        <div class="visaLegalDocuments" onclick="ShowMissingDataForm('e',<?php echo $spazaID;?>)">VISA & LEGAL DOCUMENTS</div>
                                    </div>

                                </div>
                            </div>
                            <div class="rightDisplay">
                                <div class="launchData"></div>
                            </div>
                        </div>

                        <?php
                    }
                    else{
                        echo"<h5 style='text-align: center;color: #000000;font-size: larger;font-weight:bolder;'>Awaiting for verification.</h5>";
                    }
                }
            }
        }
        else{
            echo"UNKNOWN REQUEST!!";
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
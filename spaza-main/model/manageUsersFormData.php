<?php
include("../vendor/autoload.php");
use Controller\mmshightech;
use Classes\constants\Constants;
use Classes\factory\PDOFactoryOOPClass;
if(session_status() !== PHP_SESSION_ACTIVE){
    session_start();
}
if(isset($_SESSION['user_agent'],$_SESSION['var_agent'])){
    // require_once("../controller/mmshightech.php");
    $mmshightech=new mmshightech();
    $cur_user_row = $mmshightech->userInfo($_SESSION['user_agent']);
    $userDirect=$cur_user_row['user_type'];
    $usersPdo = PDOFactoryOOPClass::make(Constants::USER,[$mmshightech]);
    $spazaPdo = PDOFactoryOOPClass::make(Constants::SPAZA,[$mmshightech]);
    if($cur_user_row['user_type']==Constants::USER_TYPE_ADMIN && isset($_POST['request'])){
        $userInfo = $usersPdo->getUserDetailsForUser($mmshightech->OMO($_POST['request']));
        $spazaInfo = $spazaPdo->getSpazaInfoForThisUser($mmshightech->OMO($_POST['request']));
        $date = explode('-', $userInfo['card_expiry_date']);
        date_default_timezone_set('Africa/Johannesburg');
        ?>
        <div class="fullBody-tech">
            <div class="modal-header">
                <h4 class="modal-title" style="text-align: center;<?php if($cur_user_row['background']==1){echo'color:black;';}else{echo'color:white;';} ?>">User Details</h4>
            </div>
            <div class="headerTech" style="display:flex;width: 100%;">
                <div style="padding:10px 10px;width: 30%;">
                    <h4 style="width: 100%;text-align: center;">USER DETAILS</h4>
                    <div style="width:100%;padding:5px 5px;border:2px solid #ddd;border-radius: 10px;">
                        <h5 style="width:100%;font-weight:bolder;color: #000;text-align: center;">
                            Personal Details
                        </h5>
                        <div style="width:100%;border: 1px solid #ddd;padding: 6px 6px;border-radius: 10px;">
                            <table>
                                <tr>
                                    <th>Name</th>
                                    <th>: <?php echo $userInfo['name'].' '.$userInfo['surname'];?></th>
                                </tr>
                                <tr>
                                    <th>Gender</th>
                                    <th>: <?php echo $userInfo['gender'];?></th>
                                </tr>
                                <tr>
                                    <th>DOB</th>
                                    <th>: <?php echo $userInfo['dob'];?></th>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <th>: <?php echo $userInfo['usermail'];?></th>
                                </tr>
                                <tr>
                                    <th>Phone</th>
                                    <th>: <?php echo $userInfo['phone_number'];?></th>
                                </tr>
                                <tr>
                                    <th>Nationality</th>
                                    <th>: <?php echo $userInfo['nationality'];?></th>
                                </tr>
                                <tr>
                                    <th>SA ID/Passport</th>
                                    <th>: <?php echo $userInfo['passport_id_no'];?></th>
                                </tr>
                                
                                <tr>
                                    <th>SA Address</th>
                                    <th>: <?php echo $userInfo['sa_residing_address'];?></th>
                                </tr>
                                <tr>
                                    <th>Foreign Address</th>
                                    <th>: <?php echo $userInfo['country_of_origin_address'];?></th>
                                </tr>
                                <tr>
                                    <th>Registered on</th>
                                    <th>: <?php echo $userInfo['time_added'];?></th>
                                </tr>
                            </table>
                        </div>
                        <br>
                        <h5 style="width:100%;font-weight:bolder;color: #000;text-align: center;">
                            Card Details
                        </h5>
                        <div style="width:100%;border: 1px solid #ddd;padding: 6px 6px;border-radius: 10px;">
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
                            <div class="icon-container">
                                <i class="fa fa-cc-visa" style="color:navy;"></i>
                                <i class="fa fa-cc-amex" style="color:blue;"></i>
                                <i class="fa fa-cc-mastercard" style="color:red;"></i>
                                <i class="fa fa-cc-discover" style="color:orange;"></i>
                            </div>
                            <label for="cname">Name on Card : <?php echo $userInfo['card_name']??'';?></label>
                            
                            <label for="ccnum">Credit card number: <?php echo $userInfo['card_number']??'';?></label>
                            <!-- <input type="text" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444"> -->
                            <div class="row" style="display:flex;">
                                <div class="col-50">
                                    <label for="expmonth">Exp Year: <?php echo $date[0]??'';?></label>
                                    <!-- <input style="padding:10px 10px;" class="form-control" type="number" id="expmonth" name="expmonth" placeholder="10" max="12" min="1"> -->
                                </div>
                                <div class="col-50">
                                    <label for="expDay">Exp Month: <?php echo $date[1]??'';?></label>
                                    <!-- <input style="padding:10px 10px;" class="form-control" type="day" id="expDay" name="expDay" placeholder="31" max="31" min="1"> -->
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-50">
                                    <label for="expyear">Card Type: <?php echo $userInfo['card_type']??'';?></label>
                                    <!-- <input type="text" id="expyear" name="expyear" placeholder="2018"> -->
                                </div>
                                <div class="col-50">
                                    <label for="cvv">CVV : <?php echo $userInfo['card_cvv']??'';?></label>
                                    <!-- <input type="text" id="cvv" name="cvv" placeholder="352"> -->
                                </div>
                            </div>
                            <br>
                        </div>

                    </div>
                </div>
                <div style="padding:10px 10px;width:70%;">
                    <h4 style="width: 100%;text-align: center;">SPAZA DETAILS</h4>
                    <div style="width:100%;padding:5px 5px;border:2px solid #ddd;border-radius: 10px;">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Sales Rep Name</th>
                                <th>Spaza</th>
                                <th>Nationality</th>
                                <th>Email Address</th>
                                <th>Phone</th>
                                <th>Delivery Address</th>
                                <th>Active Orders</th>
                                <th>Pending Orders</th>
                                <th>Delivered Orders</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($spazaInfo as $spazaDetails){
                                if(!empty($spazaDetails)){
                                    ?>
                                    <tr  class="removeSpaza'<?php echo $spazaDetails['spaza_id'];?>'">
                                        <td onclick="getSpazaInfo('<?php echo $spazaDetails['spaza_id'];?>')" style="color:#000000;cursor: pointer;"><?php echo $spazaDetails['rep_name'];?></td>
                                        <td onclick="getSpazaInfo('<?php echo $spazaDetails['spaza_id'];?>')" style="color:#000000;cursor: pointer;"><?php echo $spazaDetails['spaza_name'];?></td>
                                        <td style="color:#000000;"><?php echo $spazaDetails['nationality'];?></td>
                                        <td style="color:#000000;"><?php echo $spazaDetails['delivery_address'];?></td>
                                        <td style="color:#000000;"><?php echo $spazaDetails['email'];?></td>
                                        <td style="color:#000000;"><?php echo $spazaDetails['phone'];?></td>
                                        <td style="color:#000000;"><span class="badge badge-primary text-white text-center"><?php echo $spazaDetails['active_orders'];?></span></td>
                                        <td style="color:#000000;"><span class="badge badge-warning text-white text-center"><?php echo $spazaDetails['pending_orders'];?></span></td>
                                        <td style="color:#000000;"><span class="badge badge-success text-white text-center"><?php echo $spazaDetails['delivered_orders'];?></span></td>
                                        
                                    </tr>

                                    <?php
                                }
                            }
                            ?>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th><div class='button'>
                                        <a onclick="loadAfterQuery('.dynamicalLoad1','./model/loadMasomaneSchools.php?start=1&limit=10');">prev</a>
                                    </div>
                                </th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th style="font-size:9px;">Displaying 3 to 30 of 500</th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th><div class='button'>
                                        <a onclick="loadAfterQuery('.dynamicalLoad1','./model/loadMasomaneSchools.php?start=10&limit=10');">next</a>
                                    </div>
                                </th>
                            </tr>
                            </tfoot>
                        </table>
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
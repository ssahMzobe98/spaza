<?php

namespace classes\payment_integration;

use Controller\mmshightech;
use Controller\mmshightech\usersPdo;
class paymentPdo{
	private mmshightech $mmshightech;
    private usersPdo $usersPdo;
    public function __construct(mmshightech $mmshightech){
        $this->mmshightech=$mmshightech;
        $this->usersPdo = new usersPdo($mmshightech);
    }
	public function paymentGateway(?int $clientId=0,?float $amount=0.00):array{
        $user_details = $this->usersPdo->getUserDetailsForUser($clientId);
		$passPhrase = 'msiziMzobe98';
        $amount_net=$amount-4.60;
        $data = array(
            'merchant_id' => '18152361',
            'merchant_key' => '2ammma77nrah4',
            'return_url' => 'https://netchatsa.com/?apply',
            'cancel_url' => 'https://netchatsa.com/cancel.php',
            'notify_url' => 'https://netchatsa.com/notify.php',
            'name_first'=>$user_details['name'],
            'name_last'=>$user_details['surname'],
            'email_address'=>$user_details['usermail'],
            'm_payment_id' => $user_details['passport_id'],
            'amount' => number_format( sprintf( '%.2f', $amount ), 2, '.', '' ),
            'item_name' => 'ISPAZA PRODUCTS PURCHASE'

        );
            // Generate signature (see Custom Integration -> Step 2)
        $data["signature"] = $this->generateSignature($data, $passPhrase);
        $pfParamString = $this->dataToString($data);
        //echo 'Param : '.$pfParamString;

        $identifier = $this->generatePaymentIdentifier($pfParamString);
        $data['pf_payment_id'] = '';
        $data['item_description'] = 'THIS PAYMENT IS MADE ONLY FOR TERTIARY APPLICATION. IT IS NOT AN APPLICATION FEE. IT IS AN ADMINISTRATION FEE.';
        $data['amount_gross'] = number_format( sprintf( '%.2f', $amount ), 2, '.', '' );
        $data['amount_fee'] = 2.48;
        $data['amount_net'] = $amount_net;
        $data['payment_status'] = 'PAID';
        if($identifier!==null){
               ?>
               <script>
                  window.payfast_do_onsite_payment({"uuid":"<?php echo $identifier;?>"}, function (result){
                      if(result){
                        //   window.location=("./?_=apply&Processing=true");
                        const client_id="<?php echo $clientId;?>";
                        const amountToPay="<?php echo $amount;?>";
                        const pfData ='<?php echo json_encode($data);?>';
                        const pfParamString = '<?php echo $pfParamString;?>';
                        $(".sudoCodeoSitePayment").removeAttr("hidden");
                        $.ajax({
                    		url:'./model/success.php',
                    		type:'post',
                    		data:{client_id:client_id,amountToPay:amountToPay,pfData:pfData,pfParamString:pfParamString},
                    		success:function(e){
                    		    console.log(e);
                    		    if(e.length<=2){
                    		        $(".sudoCodeoSitePayment").attr("style","width:100%;padding:10px 10px;color:#45f3ff;background:green;border:2px solid white;text-align:center;font-size:14px;");
                    		        $(".sudoCodeoSitePayment").html("Payment Successfull, Processing Request...");
                    		        loader("apply");
                    		    }
                    		    else{
                    		        $(".sudoCodeoSitePayment").attr("style","width:100%;padding:10px 10px;color:#45f3ff;background:red;border:2px solid white;text-align:center;font-size:14px;");
                    		        $(".sudoCodeoSitePayment").html(e);
                    		    }

                    		}
                        });
                      }
                      else{
                          //window.location=("./?_=apply&failedProcessing=true");
                          $(".sudoCodeoSitePayment").attr("style","width:100%;padding:10px 10px;color:#45f3ff;background:red;border:2px solid white;text-align:center;font-size:14px;");
                    	  $(".sudoCodeoSitePayment").html("Payment Cancelled ");

                      }
                  });
                </script>
                   <?php
       }
       else{
           echo'<div style="width:100%;padding:10px 10px;color:#45f3ff;background:red;border:2px solid white;text-align:center;font-size:14px;">
            Could not Identify your payment request {'.$identifier.'}
        </div>';
       }
       return [];
	}
}

?>

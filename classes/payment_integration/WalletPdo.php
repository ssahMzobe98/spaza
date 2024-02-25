<?php
namespace Classes\payment_integration;
use Classes\constants\Constants;
use Controller\mmshightech;
use Controller\mmshightech\productsPdo;
use Classes\factory\PDOFactoryOOPClass;
use Classes\payment_integration\InvoicePdo;
class WalletPdo
{
	private mmshightech $mmshightech;
	private productsPdo $products;
	private processorNewPdo $processorNewPdo;
    private InvoicePdo $invoicePdo;
    public function __construct(mmshightech|null $mmshightech,null|productsPdo $product){
        $this->mmshightech=$mmshightech;
        $this->products=$product;
        $this->invoicePdo= PDOFactoryOOPClass::make(Constants::INVOICE,[$mmshightech,$product]);
    }
    public function actionToWallet(?int $invoice=null,?int $invoiceOrder_orderNo=null,int|string|null|float $vat=null,int|string|null|float $deliveryFee=null,int|string|null|float $invoiceTotal=null,int|string|null|float $orderTotal=null,int|float|string|null $refundTotal=null,int|string|float|null $invoicedBy=null,string $action2wallet='WALLET_PAYMENT',?int $user_id=null):array{
        if(!$this->invoicePdo->isOrderInvoiced($invoiceOrder_orderNo)){
            return ['response'=>'F','data'=>'Order -'.$invoiceOrder_orderNo.' is NOT invoiced!.'];
        }
        $response=$this->setWalletHistory($invoice,$invoiceOrder_orderNo,$vat,$deliveryFee,$invoiceTotal,$orderTotal,$refundTotal,$invoicedBy,$action2wallet,$user_id);
        if($response['response']==='F'){
            return ['response'=>'F','data'=>'failed to set wallet due to '.json_encode($response['data'])];
        }
        return $this->setWallet($user_id,$refundTotal);

    }
    private function setWalletHistory(?int $invoice=null,?int $invoiceOrder_orderNo=null,int|string|null|float $vat=null,int|string|null|float $deliveryFee=null,int|string|null|float $invoiceTotal=null,int|string|null|float $orderTotal=null,int|float|string|null $refundTotal=null,int|string|float|null $invoicedBy=null,string $action2wallet='WALLET_PAYMENT',?int $user_id=null):array{
        $sql="INSERT into wallet_history(invoice_id,order_id,user_id,vat,delivery_fee,invoice_total,order_total,refund_total,invoice_by,action_2_wallet,time_added)values(?,?,?,?,?,?,?,?,?,?,NOW())";
        $params=[$invoice,$invoiceOrder_orderNo,$user_id,$vat,$deliveryFee,$invoiceTotal,$orderTotal,$refundTotal,$invoicedBy,$action2wallet];
        $response = $this->mmshightech->postDataSafely($sql,'ssssssssss',$params);
        if(is_numeric($response)){
            return ['response'=>"S",'data'=>$response];
        }
        return ['response'=>'F','data'=>$response];

    }
    public function getWalletTotal(?int $user_id=null):array{
        $sql="SELECT wallet_amount from wallet where user_id=?";
        return $this->mmshightech->getAllDataSafely($sql,'s',[$user_id])[0]??[];
        
    }
    private function setWallet(?int $user_id=null,int|string|null|float $refundTotal=null):array{
        $amount_total = $this->getWalletTotal($user_id)??[];
        $amount_total=(empty($amount_total['wallet_amount'])?0:$amount_total['wallet_amount'])+$refundTotal;
        // echo $amount_total." + ".$refundTotal;
        $sql="UPDATE wallet set wallet_amount=? where user_id=?";
        $response = $this->mmshightech->postDataSafely($sql,'ss',[$amount_total,$user_id]);
        if(is_numeric($response)){
            return ['response'=>"S",'data'=>$response];
        }
        return ['response'=>'F','data'=>$response];

    }
    public function refundToWallet(?int $order_id=null,string $totalAmount=null,?int $user_id=null,?string $payment_status=''):array{
        $response=$this->setWalletHistory(null,$order_id,null,null,null,$totalAmount,$totalAmount,null,'WALLET_REFUND',$user_id);
        if($response['response']==='F'){
            return ['response'=>'F','data'=>'failed to set wallet due to '.json_encode($response['data'])];
        }
        return $this->setWallet($user_id,$totalAmount);
    }
    public function getMyWalletInfo(?int $user_id=null):array{
        $sql="SELECT wallet_amount from wallet where user_id=? and status='A'";
        $results = $this->mmshightech->getAllDataSafely($sql,'s',[$user_id])[0]??[];
        if(empty($results)){
            return [];
        }
        $results['wallet_history']=$this->getmyWalletHistory($user_id);
        return $results;
    }
    public function getmyWalletHistory(?int $user_id=null):array{
        $sql="SELECT invoice_id ,order_id,invoice_total,order_total,refund_total,action_2_wallet,date(time_added) as date_added,time(time_added) as time_added from wallet_history where user_id=? order by id Desc";
        return $this->mmshightech->getAllDataSafely($sql,'s',[$user_id])??[];
    }
    public function createWallet(?int $user_id=null):array{
        $sql="INSERT into wallet(user_id,wallet_amount,added_on,status)values(?,0,NOW(),'A')";
        $response = $this->mmshightech->postDataSafely($sql,'s',[$user_id]);
        if(is_numeric($response)){
            return ['response'=>'S','data'=>$response];
        }
        return ['response'=>'F','data'=>$response];
    }
}
?>
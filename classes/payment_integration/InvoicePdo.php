<?php
namespace Classes\payment_integration;
use Classes\constants\Constants;
use Controller\mmshightech;
use Controller\mmshightech\productsPdo;
class InvoicePdo
{
	private mmshightech $mmshightech;
	private productsPdo $products;
	private processorNewPdo $processorNewPdo;
    public function __construct(mmshightech|null $mmshightech,null|productsPdo $product){
        $this->mmshightech=$mmshightech;
        $this->products=$product;
    }
    public function finaliseInvoice(?int $invoiceOrder_orderNo=null,string|null|float $vat=null,string|null|float $deliveryFee=null,string|null|float $invoiceTotal = null,string|null|float $orderTotal=null,string|null|float $refundTotal=null,?int $invoicedBy=null):array{
    	if($this->isOrderInvoiced($invoiceOrder_orderNo)){
    		return ['response'=>'F','data'=>'Order -'.$invoiceOrder_orderNo.' is already invoiced!.'];
    	}
    	return $this->invoiceOrder($invoiceOrder_orderNo,$vat,$deliveryFee,$invoiceTotal,$orderTotal,$refundTotal,$invoicedBy);
    }
    private function invoiceOrder(?int $invoiceOrder_orderNo=null,string|null|float $vat=null,string|null|float $deliveryFee=null,string|null|float $invoiceTotal = null,string|null|float $orderTotal=null,string|null|float $refundTotal=null,?int $invoicedBy=null):array{
    	$sql="insert into invoices(order_id,vat,delivery_fee,invoice_total,order_total,refund_total,time_invoiced,invoiced_by)values(?,?,?,?,?,?,NOW(),?)";
    	$response = $this->mmshightech->postDataSafely($sql,'sssssss',[$invoiceOrder_orderNo,$vat,$deliveryFee,$invoiceTotal,$orderTotal,$refundTotal,$invoicedBy]);
    	if(is_numeric($response)){
    		return ['response'=>'S','data'=>$response];
    	}
    	return ['response'=>'F','data'=>$response];
    }
    public function isOrderInvoiced(?int $orderId=null):bool{
    	$sql="select order_id from invoices where order_id=? limit 1";
    	return ($this->mmshightech->numRows($sql,'s',[$orderId])===0)?false:true;

    }
}
?>
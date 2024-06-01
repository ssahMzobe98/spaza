<?php
namespace Classes\payment_integration;
use Classes\constants\Constants;
use Controller\mmshightech;
use Controller\mmshightech\productsPdo;
use Classes\response\Response;
class InvoicePdo
{
	private mmshightech $mmshightech;
	private productsPdo $products;
	private processorNewPdo $processorNewPdo;
    private $Response;
    public function __construct(mmshightech|null $mmshightech,null|productsPdo $product){
        $this->mmshightech=$mmshightech;
        $this->products=$product;
        $this->Response = new Response();
    }
    public function finaliseInvoice(?int $invoiceOrder_orderNo=null,string|null|float $vat=null,string|null|float $deliveryFee=null,string|null|float $invoiceTotal = null,string|null|float $orderTotal=null,string|null|float $refundTotal=null,?int $invoicedBy=null):Response{
    	if($this->isOrderInvoiced($invoiceOrder_orderNo)){
            $this->Response->responseStatus = "F";
            $this->Response->responseMessage = 'Order -'.$invoiceOrder_orderNo.' is already invoiced!.';
            return $this->Response;
    	}
    	return $this->invoiceOrder($invoiceOrder_orderNo,$vat,$deliveryFee,$invoiceTotal,$orderTotal,$refundTotal,$invoicedBy);
    }
    private function invoiceOrder(?int $invoiceOrder_orderNo=null,string|null|float $vat=null,string|null|float $deliveryFee=null,string|null|float $invoiceTotal = null,string|null|float $orderTotal=null,string|null|float $refundTotal=null,?int $invoicedBy=null):Response{
    	$sql="INSERT into invoices(order_id,vat,delivery_fee,invoice_total,order_total,refund_total,time_invoiced,invoiced_by)values(?,?,?,?,?,?,NOW(),?)";
    	return $this->mmshightech->postDataSafely($sql,'sssssss',[$invoiceOrder_orderNo,$vat,$deliveryFee,$invoiceTotal,$orderTotal,$refundTotal,$invoicedBy]);
    }
    public function isOrderInvoiced(?int $orderId=null):bool{
    	$sql="SELECT order_id from invoices where order_id=? limit 1";
    	return ($this->mmshightech->numRows($sql,'s',[$orderId])===0)?false:true;

    }
    // public function getSpazaProductInvoicing(?int $spaza_id=null):Response{
    //     $sql='SELECT id from spaza_product_invoicing where spaza_product_id=? and status=?';
    //     return $this->mmshightech->getAllDataSafely($sql,'ss',[$spaza_id,Constants::PENDING])??[];
    // }
    public function updateInvoicedProducts(?int $spaza_id=null,?int $spaza_invoice_id=null):Response{
        $sql="UPDATE spaza_product_invoicing set status=?,time_invoiced=NOW(),invoice_id=? where spaza_id=? and status=?";
        $this->Response=$this->mmshightech->postDataSafely($sql,'ssss',[Constants::INVOICED,$spaza_invoice_id,$spaza_id,Constants::PENDING]);
        if($this->Response->responseStatus===Constants::SUCCESS_STATUS){
            $this->Response->responseMessage=$spaza_invoice_id;
        }
        return $this->Response;
    }
    public function actionProductsTOInvoice(?int $invoicing_spaza_id=null,string|null|float $invoicing_spaza_amount=null,string|null|float $invoicingSpazaInputAmount=null,?int $spazaUserId=null):Response{
        $total_change = $invoicingSpazaInputAmount-$invoicing_spaza_amount;
        $params = [$invoicing_spaza_id,$invoicing_spaza_amount,$invoicingSpazaInputAmount,$total_change,$spazaUserId];
        $sql="INSERT into spaza_invoices(spaza_id,total_amount,total_payment,total_change,date_invoice,spaza_device_user)values(?,?,?,?,NOW(),?)";
        $this->Response=$this->mmshightech->postDataSafely($sql,'sssss',$params);
        if($this->Response->responseStatus===Constants::FAILED_STATUS){
            return $this->Response;
        }
        $productUIdsAndQuantities = $this->products->getProductUIDsToBeInvoicedBySpaza($invoicing_spaza_id);
        foreach ($productUIdsAndQuantities as $productUIdData) {
            if($productUIdData['total_quantity_available']<$productUIdData['quantity']){
                return $this->response->failureSetter()->messagerSetter("Purchase Quantity ({$productUIdData['quantity']}) is greater than available quantity ({$productUIdData['total_quantity_available']}) for product -> {$productUIdData['spaza_product_id']}");
            }
        }
        $this->Response=$this->updateInvoicedProducts($invoicing_spaza_id,$this->Response->responseMessage);
        if($this->Response->responseStatus === Constants::FAILED_STATUS){
            return $this->Response;
        }
        $message = $this->Response->responseMessage;
        $this->Response = $this->products->removeProductFromShelf($productUIdsAndQuantities);
        if($this->Response->responseStatus===Constants::SUCCESS_STATUS){
            $this->Response->responseMessage=$message;
        }
        return $this->Response;
    }
    public function getInvoiceFinalReport(?int $invoiceId=null):array{
        $sql="SELECT * from spaza_invoices where id=?";
        return $this->mmshightech->getAllDataSafely($sql,'s',[$invoiceId])[0]??[];
    }
}
?>
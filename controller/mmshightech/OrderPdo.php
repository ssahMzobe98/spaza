<?php
namespace Controller\mmshightech;
use Controller\mmshightech;
use Controller\mmshightech\productPdo;
use Controller\mmshightech\processorNewPdo;
use Classes\factory\PDOFactoryOOPClass;
use Classes\constants\Constants;
use Classes\payment_integration\InvoicePdo;
use Classes\payment_integration\WalletPdo;
use Classes\response\Response;
class OrderPdo{
	private mmshightech $mmshightech;
	private productsPdo $products;
	private processorNewPdo $processorNewPdo;
    private WalletPdo $walletPdo;
    private InvoicePdo $invoice;
    private $Response;
     // RESPONSE_SUCCESS
    // RESPONSE_FAILED 
    public function __construct(mmshightech $mmshightech){
        $this->mmshightech=$mmshightech;
        $this->products = new productsPdo($mmshightech);
        $this->processorNewPdo = new processorNewPdo($mmshightech);
        $this->invoicePdo=PDOFactoryOOPClass::make(Constants::INVOICE,[$mmshightech,$this->products]);
        $this->walletPdo=PDOFactoryOOPClass::make(Constants::WALLET,[$mmshightech,$this->products]);
        $this->Response = new Response();
    }
    public function validateOrder(?string $order_total_amount,?string $order_total_Vat,?string $order_subTotal_amount,?string $order_deliveryFee,?int $user_id):Response{
    	if(!isset($user_id)){
    	   $this->Response->responseStatus = "F";
           $this->Response->responseMessage = 'fail to validate order, User ID not found';
           return $this->Response ;
    	}
    	$userHasOrder=$this->isUserHasActiveOrder($user_id);
    	if(isset($userHasOrder['order_id'])){
            $this->Response->responseStatus=Constants::RESPONSE_FAILED;
            $this->Response->responseMessage= "You still have an active order-{$userHasOrder['order_id']}";
            return $this->Response;
    	}
    	$getProducts=$this->products->getCartProducts($user_id);
    	$deliveryFee = 20.50;
        $subTotal = 0;
        $tax = 0.15;
        foreach ($getProducts as $product){
        	$price = $product['price_usd']*$product['quantity'];
        	if($product['product_discountable']==='Y'){
        		$price = (isset($product['promo_price'])?$product['promo_price']:$price);
        	}
            $subTotal += $price;
        }
        $vat = $subTotal*$tax;
        $total = $vat+$subTotal+$deliveryFee;
       
        // if(($total!=$order_total_amount)||($order_total_Vat!=$vat)||($subTotal!=$order_subTotal_amount)){
        // 	return ['response'=>'F','data'=>'Card miss match card payment -'.$r];
        // }
        return $this->createOrder($getProducts,$vat,$total,$subTotal,$deliveryFee,$user_id);
    }
    public function isUserHasActiveOrder(?int $user_id):array{
    	$sql="SELECT id as order_id from orders where user_id=? and process_status in (1,2,3,4,5,6,8,9,10,11,12)";
    	return $this->mmshightech->getAllDataSafely($sql,'s',[$user_id])[0]??[];
    }
    public function isActiveOrder(?int $order_id):bool{
    	$sql="SELECT id as order_id from orders where id=? and process_status in (1,2,3,4,5,6,8,9,10,11,12)";
    	$response=$this->mmshightech->getAllDataSafely($sql,'s',[$order_id])[0]??[];
    	return (empty($response)?false:($response['order_id']==$order_id))?true:false;
    }
    protected function createOrder(array|int|string|null $getProducts=null,?string $vat,?string $total,?string $subTotal,?string $deliveryFee,?string $user_id):Response{
    	if(!isset($user_id)){
    		$this->Response->responseStatus=Constants::RESPONSE_FAILED;
            $this->Response->responseMessage= 'fail to create order, User ID not found';
            return $this->Response;
    	}
    	$this->Response=$this->createNewOrder($getProducts,$vat,$total,$subTotal,$deliveryFee,$user_id);
    	if($this->Response->responseStatus!=='S'){
    		return $this->Response;
    	}
    	//createNewOrder['data'] is an order number
    	return $this->createNewOrderDetails($getProducts,$this->Response->responseMessage);
    }
    protected function createNewOrder(string|int|array|null $getProducts=null,?string $vat,?string $total,?string $subTotal,?string $deliveryFee,?string $user_id):Response{
    	$sql="INSERT into orders(user_id,created_datetime,process_status,total,sub_total,vat,delivery_fee,order_json)values(?,NOW(),1,?,?,?,?,?)";
    	$params = [$user_id,$total,$subTotal,$vat,$deliveryFee,json_encode($getProducts)];
    	return $this->mmshightech->postDataSafely($sql,'ssssss',$params);
    	
    }
    protected function createNewOrderDetails(array|int|string|null $getProducts=null,?int $orderNo):Response{
    	if(!isset($orderNo)){
            $this->Response->responseStatus=Constants::RESPONSE_FAILED;
            $this->Response->responseMessage= 'Order placement process failed to retrieve order ID';
            return $this->Response;
    	}
    	$sql="INSERT into order_details(order_id,product_id,label,product_unit_size,price,quantity,is_instock,comments,is_promo,promo_price,time_added)values(?,?,?,?,?,?,?,?,?,?,NOW())";
    	$response=[];
    	foreach($getProducts as $product){
    		$params=[$orderNo,$product['id'],$product['product_description'],$product['product_weight'],$product['price_usd'],$product['quantity'],$product['is_instock'],'No Comment',$product['product_discountable'],$product['promo_price']];
    		$this->Response = $this->mmshightech->postDataSafely($sql,'ssssssssss',$params);
    		if($this->Response->responseStatus===Constants::RESPONSE_FAILED){
    			return $this->Response;
    		}
    	}
    	if($this->Response->responseStatus===Constants::RESPONSE_FAILED){
            return $this->Response;
        }
		return $this->processorNewPdo->emptyCart($product['user_id']);
    }
    public function getOrderTotal(?int $order_id){
    	if(!isset($order_id)){
    		return ['response'=>'F','data'=>'Order placement process failed to retrieve order ID'];
    	}
    	$sql="SELECT total from orders where id=?";
    	return $this->mmshightech->getAllDataSafely($sql,'s',[$order_id])[0]??[];
    }
    public function getAllactiveOrder(int $min=0,int $limit=10):array{
    	$sql="SELECT 
    		s.status as order_status,
    		o.id as order_id,
    		o.user_id,
    		o.spaza_id,
    		o.is_invoiced,
    		o.total,
    		u.name,
    		u.surname,
    		sd.spaza_name,
    		o.payment_status,
    		sd.rep_name,
    		date(o.created_datetime) as created_date,
    		time(o.created_datetime) as created_time,
    		sd.rep_surname,
    		sd.phone_number,
    		sd.email_address,
    		sd.spaza_address,
    		o.driver_id
    	from orders as o
    		left join statuses as s on s.id=o.process_status
    		left join users as u on u.id=o.user_id
    		left join spaza_details as sd on sd.id=o.spaza_id
    	where o.process_status in (2,3,4,5,6,8,9,10,11,12) limit ?,?";
    	return $this->mmshightech->getAllDataSafely($sql,'ss',[$min,$limit])??[];
    }
    public function searchOrderWithId(?int $searchOrderNumber=0):array{
    	$sql="SELECT 
    		s.status as order_status,
    		o.id as order_id,
    		o.user_id,
    		o.spaza_id,
    		o.is_invoiced,
    		o.total,
    		u.name,
    		u.surname,
    		sd.spaza_name,
    		o.payment_status,
    		sd.rep_name,
    		date(o.created_datetime) as created_date,
    		time(o.created_datetime) as created_time,
    		sd.rep_surname,
    		sd.phone_number,
    		sd.email_address,
    		sd.spaza_address,
    		o.driver_id
    	from orders as o
    		left join statuses as s on s.id=o.process_status
    		left join users as u on u.id=o.user_id
    		left join spaza_details as sd on sd.id=o.spaza_id
    	where o.id like ?";
    	return $this->mmshightech->getAllDataSafely($sql,'s',['%'.$searchOrderNumber.'%'])??[];
    }
    public function getAllactiveCount():int{
    	$sql="SELECT id from orders where process_status in (1,2,3,4,5,6,8,9,10,11,12,13,14,15)";
    	return $this->mmshightech->numRows($sql,'',[])??0;
    }
    public function getAllStatusCount(int $id1=0,int $id2=0):int{
    	$sql="select id from orders where process_status in (?,?)";
    	return $this->mmshightech->numRows($sql,'ss',[$id1,$id2])??0;
    }
    public function getHistoryOrdersOfThisUserCount(int $user_id=0):int{
        $sql="select id from orders where user_id = ?";
        return $this->mmshightech->numRows($sql,'s',[$user_id])??0;
    }
    public function getHistoryOrdersOfThisUserSearch(int $user_id=null,int $search=null):array{
        $sql="SELECT 
            s.status as order_status,
            o.id as order_id,
            o.user_id,
            o.spaza_id,
            o.is_invoiced,
            o.total,
            u.name,
            u.surname,
            sd.spaza_name,
            o.payment_status,
            sd.rep_name,
            date(o.created_datetime) as created_date,
            time(o.created_datetime) as created_time,
            sd.rep_surname,
            sd.phone_number,
            sd.email_address,
            sd.spaza_address,
            o.driver_id
        from orders as o
            left join statuses as s on s.id=o.process_status
            left join users as u on u.id=o.user_id
            left join spaza_details as sd on sd.id=o.spaza_id
        where o.user_id =? and o.id like ? order by o.id desc ";
        return $this->mmshightech->getAllDataSafely($sql,'ss',[$user_id,"%".$search."%"])??[];
    }
    public function getHistoryOrdersOfThisUser(int $user_id=0,int $min=0,int $limit=10):array{
        $sql="SELECT 
            s.status as order_status,
            o.id as order_id,
            o.user_id,
            o.spaza_id,
            o.is_invoiced,
            o.total,
            u.name,
            u.surname,
            sd.spaza_name,
            o.payment_status,
            sd.rep_name,
            date(o.created_datetime) as created_date,
            time(o.created_datetime) as created_time,
            sd.rep_surname,
            sd.phone_number,
            sd.email_address,
            sd.spaza_address,
            o.driver_id
        from orders as o
            left join statuses as s on s.id=o.process_status
            left join users as u on u.id=o.user_id
            left join spaza_details as sd on sd.id=o.spaza_id
        where o.user_id =? order by o.id desc limit ?,?";
        return $this->mmshightech->getAllDataSafely($sql,'sss',[$user_id,$min,$limit])??[];
    }
	public function getAllStatusOrder(int $id1=0,int $id2,$min,$limit):array{
		$sql="SELECT 
    		s.status as order_status,
    		o.id as order_id,
    		o.user_id,
    		o.spaza_id,
    		o.is_invoiced,
    		o.total,
    		u.name,
    		u.surname,
    		sd.spaza_name,
    		o.payment_status,
    		sd.rep_name,
    		date(o.created_datetime) as created_date,
    		time(o.created_datetime) as created_time,
    		sd.rep_surname,
    		sd.phone_number,
    		sd.email_address,
    		sd.spaza_address,
    		o.driver_id
    	from orders as o
    		left join statuses as s on s.id=o.process_status
    		left join users as u on u.id=o.user_id
    		left join spaza_details as sd on sd.id=o.spaza_id
    	where o.process_status in ($id1,$id2) limit ?,?";
    	return $this->mmshightech->getAllDataSafely($sql,'ss',[$min,$limit])??[];
	}
    public function getMyOrderDetailsByUser(?int $userId=null):array{
        if(empty($userId)){
            return ['response'=>'F','data'=>'Cannot process undefined request.'];
        }
        $sql="SELECT id as order_id from orders where user_id=? order by id desc limit 1
        ";
        $order_id=$this->mmshightech->getAllDataSafely($sql,'s',[$userId])[0]??[];
        if(empty($order_id['order_id'])){
            return [];
        }
        else{
            return $this->orderSummary($order_id['order_id']);
        }

    }
	public function orderSummary(int $order_id=0):array{
		$sql="SELECT 
                o.user_id,
                od.order_id,
                od.product_id,
                od.label,
                (CASE WHEN od.is_promo='Y' THEN od.promo_price ELSE od.price END) AS price,
                od.quantity,
                o.total,
                od.is_instock,
                od.is_picked,
                o.payment_status,
                o.total AS order_total,
                o.process_status as order_status,
                s.status as process_status,
                (CASE WHEN o.payment_status='NOT PAID' THEN 'N' ELSE 'Y' END) AS is_paid,
                (CASE WHEN o.accepted_datetime IS NULL THEN 'N' ELSE 'Y' END) AS is_accepted,
                o.is_invoiced,
                od.comments,
                od.status
            FROM 
                order_details AS od
            LEFT JOIN 
                orders AS o ON o.id = od.order_id 
            left join statuses as s on s.id=o.process_status
            WHERE 
                od.order_id = ? AND od.status = 'A'
		";
		return $this->mmshightech->getAllDataSafely($sql,'s',[$order_id])??[];
	}
    public function acceptOrder(?int $acceptOrderId=null,?int $adminUserId=null):Response{
        $sql="UPDATE orders set process_status=3, accepted_datetime=NOW(),processed_by=? where id=?";
        return $this->mmshightech->postDataSafely($sql,'ss',[$adminUserId,$acceptOrderId]);
        
    }
	public function removeProductFromOrder(int $removeThisProductFromOrder_order_id=0,int $removeThisProductFromOrder_product_id=0,int $removed_by):Response{
		$sql="UPDATE order_details set status='D', removed_by=? where order_id=? and product_id=?";
		return $this->mmshightech->postDataSafely($sql,'sss',[$removed_by,$removeThisProductFromOrder_order_id,$removeThisProductFromOrder_product_id]);
	}

	public function pickProduct(int $order_id=0,int $product_id=0):Response{
        if($this->products->productPicked($order_id,$product_id)){
            $sql="UPDATE order_details set is_picked='N', time_picked=NOW() where order_id=? and product_id=?";
            return $this->mmshightech->postDataSafely($sql,'ss',[$order_id,$product_id]);
        }
		$sql="UPDATE order_details set is_picked='Y', time_picked=NOW() where order_id=? and product_id=?";
		return $this->mmshightech->postDataSafely($sql,'ss',[$order_id,$product_id]);
	}
	public function invoiceOrder(?int $invoiceOrder_orderNo=0,$invoicedBy):Response{
        if(!isset($invoiceOrder_orderNo)){
            $this->Response->responseStatus=Constants::RESPONSE_FAILED;
            $this->Response->responseMessage= 'Order Invoicing process failed to retrieve order ID';
            return $this->Response;
        }
    	$orderSummary=$this->orderSummary($invoiceOrder_orderNo);
    	$orderInvoiceTotal=0;
        $user_id=$orderSummary[0]['user_id'];
        $orderTotal=$orderSummary[0]['order_total'];
        foreach($orderSummary as $summary){
            $total_price = $summary['price']*$summary['quantity'];
            $orderInvoiceTotal+=$total_price;
            if($summary['is_picked']==="N"){
                $this->Response->responseStatus=Constants::RESPONSE_FAILED;
                $this->Response->responseMessage= $summary['product_id']." is not PICKED. please pick the the item or remove it from list.";
                return $this->Response;
            } 
        }
        $vat=$orderInvoiceTotal*0.15;
        $deliveryFee = 20.50;
        $invoiceTotal=$orderInvoiceTotal+$vat+$deliveryFee;
        $refundTotal = $orderTotal-$invoiceTotal;
        $this->Response = $this->invoicePdo->finaliseInvoice($invoiceOrder_orderNo,$vat,$deliveryFee,$invoiceTotal,$orderTotal,$refundTotal,$invoicedBy);
        if($this->Response->responseStatus==="F"){
        	return $this->Response; 
        }
        $invoiceId=$this->Response->responseMessage;
        if($refundTotal>0 ){
            $this->Response= $this->walletPdo->actionToWallet($response['data'],$invoiceOrder_orderNo,$vat,$deliveryFee,$invoiceTotal,$orderTotal,$refundTotal,$invoicedBy,'WALLET_REFUND',$user_id); 
        }
        if($this->Response->responseStatus==="F"){
            return $this->Response; 
        }
        $this->Response = $this->updateOrderProcessStatus(4,$invoiceOrder_orderNo);
        if($this->Response->responseStatus==="F"){
            return $this->Response; 
        }
        return $this->updateInvoiceIdOnOrder($invoiceId,$invoiceOrder_orderNo);
    }
    public function updateInvoiceIdOnOrder(?int $invoiceId=null,?int $invoiceOrder_orderNo=null):Response{
        $sql="UPDATE orders set invoice_datetime=NOW(),is_invoiced='Y',invoice_id=? where id=?";
        return $this->mmshightech->postDataSafely($sql,'ss',[$invoiceId,$invoiceOrder_orderNo]);
    }
    public function updateOrderProcessStatus(?int $status=null,?int $order_id=null):Response{
        $sql="UPDATE orders set process_status=? where id=?";
        return $this->mmshightech->postDataSafely($sql,'ss',[$status,$order_id]);
        if(!is_numeric($response)){
            return ['response'=>'F','data'=>$response];
        }
        return ['response'=>'S','data'=>'Success'];
    }
    public function getOrderInfo(?int $order_id=null):array{
        $sql="SELECT * from orders where id=?";
        return $this->mmshightech->getAllDataSafely($sql,'s',[$order_id])[0]??[];
    }
    public function refundToWallet(?int $order_id=null):Response{
        $orderDetails = $this->getOrderInfo($order_id);
        if($orderDetails['payment_status']!=='PAID'){
            // return ['response'=>'S','data'=>'Order cancelled.'];
            $this->Response->responseStatus=Constants::RESPONSE_SUCCESS;
            $this->Response->responseMessage=" Order cancelled.";
             return $this->Response;
        }
        
        return $walletPdo->refundToWallet($order_id,$orderDetails['total'],$orderDetails['user_id']);
    }
}

?>
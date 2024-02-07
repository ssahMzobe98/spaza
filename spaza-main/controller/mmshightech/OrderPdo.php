<?php
namespace Controller\mmshightech;
use Controller\mmshightech;
use Controller\mmshightech\productPdo;
use Controller\mmshightech\processorNewPdo;
class OrderPdo{
	private mmshightech $mmshightech;
	private productsPdo $products;
	private processorNewPdo $processorNewPdo;
    public function __construct(mmshightech $mmshightech){
        $this->mmshightech=$mmshightech;
        $this->products = new productsPdo($mmshightech);
        $this->processorNewPdo = new processorNewPdo($mmshightech);
    }
    public function validateOrder(?string $order_total_amount,?string $order_total_Vat,?string $order_subTotal_amount,?string $order_deliveryFee,?int $user_id):array{
    	if(!isset($user_id)){
    		return ['response'=>"F",'data'=>'fail to validate order, User ID not found'];
    	}
    	$userHasOrder=$this->isUserHasActiveOrder($user_id);
    	if(isset($userHasOrder['order_id'])){
    		return ['response'=>"F",'data'=>"You still have an active order-{$userHasOrder['order_id']}."];
    	}
    	$getProducts=$this->products->getCartProducts($user_id);
    	$deliveryFee = 20.50;
        $subTotal = 0;
        $tax = 0.15;
        foreach ($getProducts as $product){
        	$price = $product['price_usd']*$product['quantity'];
        	if($product['product_discountable']==='Y'){
        		$price = (isset($product['promo_price'])?$product['promo_price']:$product['price_usd'])*$product['quantity'];
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
    	$sql="select id as order_id from orders where user_id=? and process_status in (1,2,3,4,5,6,8,9,10,11,12)";
    	return $this->mmshightech->getAllDataSafely($sql,'s',[$user_id])[0]??[];
    }
    public function isActiveOrder(?int $order_id):bool{
    	$sql="select id as order_id from orders where id=? and process_status in (1,2,3,4,5,6,8,9,10,11,12)";
    	$response=$this->mmshightech->getAllDataSafely($sql,'s',[$order_id])[0]??[];
    	return (empty($response)?false:($response['order_id']==$order_id))?true:false;
    }
    protected function createOrder(array|int|string|null $getProducts=null,?string $vat,?string $total,?string $subTotal,?string $deliveryFee,?string $user_id):array{
    	if(!isset($user_id)){
    		return ['response'=>"F",'data'=>'fail to create order, User ID not found'];
    	}
    	$createNewOrder=$this->createNewOrder($getProducts,$vat,$total,$subTotal,$deliveryFee,$user_id);
    	if($createNewOrder['response']!=='S'){
    		return $createNewOrder;
    	}
    	//createNewOrder['data'] is an order number
    	return $this->createNewOrderDetails($getProducts,$createNewOrder['data']);
    }
    protected function createNewOrder(string|int|array|null $getProducts=null,?string $vat,?string $total,?string $subTotal,?string $deliveryFee,?string $user_id):array{
    	$sql="insert into orders(user_id,created_datetime,process_status,total,sub_total,vat,delivery_fee,order_json)values(?,NOW(),1,?,?,?,?,?)";
    	$params = [$user_id,$vat,$total,$subTotal,$deliveryFee,json_encode($getProducts)];
    	$response = $this->mmshightech->postDataSafely($sql,'ssssss',$params);
    	if(is_numeric($response)){
            return ['response'=>"S",'data'=>$response];
        }
        else{
            return ['response'=>"F",'data'=>$response];
        }
    }
    protected function createNewOrderDetails(array|int|string|null $getProducts=null,?int $orderNo):array{
    	if(!isset($orderNo)){
    		return ['response'=>'F','data'=>'Order placement process failed to retrieve order ID'];
    	}
    	$sql="insert into order_details(order_id,product_id,label,product_unit_size,price,quantity,is_instock,comments,is_promo,promo_price,time_added)values(?,?,?,?,?,?,?,?,?,?,NOW())";
    	$response=[];
    	foreach($getProducts as $product){
    		$params=[$orderNo,$product['id'],$product['product_description'],$product['product_weight'],$product['price_usd'],$product['quantity'],$product['is_instock'],'No Comment',$product['product_discountable'],$product['promo_price']];
    		$response = $this->mmshightech->postDataSafely($sql,'ssssssssss',$params);
    		if(!is_numeric($response)){
    			return ['response'=>'F','data'=>$response];
    		}
    	}
    	if(!is_numeric($response)){
			return ['response'=>'F','data'=>$response];
		}
		$this->processorNewPdo->emptyCart($product['user_id']);
		return ['response'=>'S','data'=>$orderNo]; 
    }
    public function getOrderTotal(?int $order_id){
    	if(!isset($order_id)){
    		return ['response'=>'F','data'=>'Order placement process failed to retrieve order ID'];
    	}
    	$sql="select total from orders where id=?";
    	return $this->mmshightech->getAllDataSafely($sql,'s',[$order_id])[0]??[];
    }
    public function getAllactiveOrder(int $min=0,int $limit=10):array{
    	$sql="select 
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
    	$sql="select 
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
    	$sql="select id from orders where process_status in (1,2,3,4,5,6,8,9,10,11,12,13,14,15)";
    	return $this->mmshightech->numRows($sql,'',[])??0;
    }
    public function getAllStatusCount(int $id1=0,int $id2=0):int{
    	$sql="select id from orders where process_status in (?,?)";
    	return $this->mmshightech->numRows($sql,'ss',[$id1,$id2])??0;
    }
	public function getAllStatusOrder(int $id1=0,int $id2,$min,$limit):array{
		$sql="select 
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
	public function orderSummary(int $order_id=0):array{
		$sql="select 
				od.order_id,
				od.product_id,
	    		od.label,
	    		(if(od.is_promo='Y',od.promo_price,od.price)) as price,
	    		od.quantity,
	    		od.is_instock,
	    		od.is_picked,
	    		od.comments
	    	from order_details as od
	    	where od.order_id=? and od.status='A'
		";
		return $this->mmshightech->getAllDataSafely($sql,'s',[$order_id])??[];
	}
	public function removeProductFromOrder(int $removeThisProductFromOrder_order_id=0,int $removeThisProductFromOrder_product_id=0,int $removed_by):array{
		$sql="update order_details set status='D', removed_by=? where order_id=? and product_id=?";
		$response = $this->mmshightech->postDataSafely($sql,'sss',[$removed_by,$removeThisProductFromOrder_order_id,$removeThisProductFromOrder_product_id]);
		if(!is_numeric($response)){
			return ['response'=>'F','data'=>$response];
		}
		return ['response'=>'S','data'=>'Success'];

	}
	public function pickProduct(int $markDownPicker_order_id=0,int $markDownPicker_product_id=0):array{
		$sql="update order_details set is_picked='Y', time_picked=NOW() where order_id=? and product_id=?";
		$response = $this->mmshightech->postDataSafely($sql,'ss',[$markDownPicker_order_id,$markDownPicker_product_id]);
		if(!is_numeric($response)){
			return ['response'=>'F','data'=>$response];
		}
		return ['response'=>'S','data'=>'Success'];
	}
}

?>
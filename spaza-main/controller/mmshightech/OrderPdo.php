<?php
namespace Conntroller\mmshightech;
class OrderPdo{
	private mmshightech $mmshightech;
	private productsPdo $products;
    public function __construct(mmshightech $mmshightech){
        $this->mmshightech=$mmshightech;
        $this->products = new productsPdo($mmshightech);
    }
    public function validateOrder(?string $order_total_amount,?string $order_total_Vat,?string $order_subTotal_amount,?string $order_deliveryFee,?int $user_id):array{
    	if(!isset($user_id)){
    		return ['response'=>"F",'data'=>'fail to validate order, User ID not found'];
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
        if(($total!==$order_total_amount)||($order_total_Vat!==$vat)||($subTotal!==$order_subTotal_amount)){
        	return ['response'=>'F','data'=>'Card miss match card payment'];
        }
        return $this->createOrder($getProducts,$vat,$total,$subTotal,$deliveryFee,$user_id);
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
    	$sql="insert into order_details(order_id,product_id,label,product_unit_size,price,quantity,is_out_of_stock,comments,is_promo,promo_price,time_added)values(?,?,?,?,?,?,?,?,?,?,NOW())";
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
		return ['response'=>'S','data'=>$orderNo]; 
    }
}
?>
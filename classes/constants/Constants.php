<?php
namespace Classes\constants;
class Constants{
	public const USER_TYPE_ADMIN = 'ADMIN';
	public const USER_TYPE_APP = 'APP';
	public const INVOICE='InvoicePdo';
	public const WALLET='WalletPdo';
	public const SPAZA='spazaPdo';
	public const ORDER ='OrderPdo'; 
	public const USER = 'usersPdo';
	public const PRODUCT='productsPdo';
	public const SUPPLIER = 'SuppliersDao';
	public const MMSHIGHTECH = 'mmshightech';
	public const PAYMENT_STATUS_PAID = 'PAID';
	public const ORDER_PROSESS_STATUS_WFP = 'WAITING FOR PAYMENT';
	public const PROCESS_STATUS_FAILED = 'ORDER FAILED';
	public const PROCESS_STATUS_DELIVERED = 'ORDER DELIVERD';
	public const SUCCESS_YES ='Y';
	public const STATUS_ACTIVE ='A';
	public const SUCCESS_NO = 'N';
	public const RESPONSE_ERROR = 'E';
	public const RESPONSE_SUCCESS='S';
	public const RESPONSE_FAILED='F';
	public const CONNECTION_STATUS_NOT_CONNECTED = "Not Connected";
    public const SUCCESS_STATUS = "S";
    public const FAILED_STATUS = "F";
    public const SUCCESS_MESSAGE = "Success";
    public const IS_INSTOCK_TABLE_COL='product_discountable';
	public const IS_PRODUCT_DISCOUNTABLE_TABLE_COL='is_instock';
	public const ORDER_RECEIVED = 'ORDER RECEIVED';
	public const ADD='add';
	public const PENDING = 'PENDING';
	public const INVOICED = 'INVOICED';
}
?> 
<?php

namespace controller\mmshightech;

use Controller\mmshightech;

class spazaPdo
{
    private mmshightech $mmshightech;
    public function __construct(mmshightech $mmshightech){
        $this->mmshightech=$mmshightech;
    }
    public function getSpazaInformation(?int $spazaId):array
    {
        $sql = "SELECT * from spaza_details where id=?";
        $row=$this->mmshightech->getAllDataSafely($sql,'s',[$spazaId])[0]??[];
        $sql="SELECT u.card_number,
                    u.card_expiry_date,
                    u.card_name,
                    u.card_type,
                    u.card_cvv,
                    u.card_token
             from users as u where u.id=?";
        $row['card_details']=$this->mmshightech->getAllDataSafely($sql,'s',[$row['spaza_owner_id']])[0]??[];
        return $row??[];
    }
    public function spazaDetailsForThisOrder(?int $orderId=null):array{
        if(empty($orderId)){
            return ['response'=>'F','data'=>'Please provide order no.'];
        }
        $sql='SELECT spaza_id from orders where id=?';
        $row=$this->mmshightech->getAllDataSafely($sql,'s',[$orderId])[0]??[];
        if(empty($row['spaza_id'])){
            return ['response'=>'F','data'=>'cannot process request with NO spaza ID'];
        }
        $spaza_id = $row['spaza_id']??null;
        // print_r($spaza_id);
        return $this->getSpazaInformationForOrderProcessing($spaza_id);
    }
    public function getSpazaInfoForThisUser(int $userId=null):array{
        $sql = "SELECT id as spaza_id from spaza_details where spaza_owner_id=?";
        $data = $this->mmshightech->getAllDataSafely($sql,'s',[$userId])??[];
        if(empty($data)){
            return [];
        }
        $dataToReturn=[];
        foreach($data as $da){
            $dataToReturn[]=$this->getSpazaInformationForOrderProcessing($da['spaza_id']);
        }
        return $dataToReturn;
    }
    public function getSpazaInformationForOrderProcessing(?int $spazaId=null):array{
        $sql = "SELECT 
                    sd.id as spaza_id, 
                    sd.spaza_name as spaza_name,
                    concat(sd.rep_name,' ',sd.rep_surname) as rep_name,
                    sd.spaza_owner_id as owner_id,  
                    concat(u.name,' ',u.surname) as owner_name,
                    u.usermail as owner_email,
                    u.phone_number as owner_phone,
                    (select count(id) from orders where process_status in (2,3,4,5,6,7,8,9,10,11,12) and spaza_id=sd.id) as active_orders,
                    (select count(id) from orders where process_status =1 and spaza_id=sd.id) as pending_orders,          
                    (select count(id) from orders where process_status = 13 and spaza_id=sd.id) as delivered_orders,
                    sd.status as spaza_status,
                    sd.id_passport_number as rep_passp_id,
                    sd.country_of_origin as nationality,
                    sd.email_address as email,
                    sd.phone_number as phone,
                    sd.spaza_address as delivery_address,
                    
                    sd.gender as gender
                from spaza_details as sd 
                    left join users as u on u.id=sd.spaza_owner_id
                where sd.status='A' and sd.id=? order by sd.spaza_name asc
               ";
        return $this->mmshightech->getAllDataSafely($sql,'s',[$spazaId])[0]??[];
    }
    public function getSpazaInfoAll():array
    {
        $sql = "SELECT 
                    sd.id as spaza_id, 
                    sd.spaza_name as spaza_name,
                    concat(sd.rep_name,' ',sd.rep_surname) as rep_name,
                    sd.spaza_owner_id as owner_id,  
                    concat(u.name,' ',u.surname) as owner_name,
                    u.usermail as owner_email,
                    u.phone_number as owner_phone,
                    (select count(id) from orders where process_status in (2,3,4,5,6,7,8,9,10,11,12) and spaza_id=sd.id) as active_orders,
                    (select count(id) from orders where process_status = 1 and spaza_id=sd.id) as pending_orders,          
                    (select count(id) from orders where process_status = 13 and spaza_id=sd.id) as delivered_orders,
                    sd.id_passport_number as rep_passp_id,
                    sd.country_of_origin as nationality,
                    sd.email_address as email,
                    sd.status as spaza_status,
                    sd.phone_number as phone,
                    sd.spaza_address as delivery_address
                from spaza_details as sd 
                    left join users as u on u.id=sd.spaza_owner_id
                where sd.status='A' order by sd.spaza_name asc
               ";
        return $this->mmshightech->getAllDataSafely($sql)??[];
    }
    public function getSpazaInfoSearchAll(string $search=''):array
    {
        $sql = "SELECT 
                    sd.id as spaza_id, 
                    sd.spaza_name as spaza_name,
                    concat(sd.rep_name,' ',sd.rep_surname) as rep_name,
                    sd.spaza_owner_id as owner_id,  
                    concat(u.name,' ',u.surname) as owner_name,
                    u.usermail as owner_email,
                    u.phone_number as owner_phone,
                    (select count(id) from orders where process_status  in (2,3,4,5,6,7,8,9,10,11,12) and spaza_id=sd.id) as active_orders,
                    (select count(id) from orders where process_status =1 and spaza_id=sd.id) as pending_orders,          
                    (select count(id) from orders where process_status = 13 and spaza_id=sd.id) as delivered_orders,
                    sd.status as spaza_status,
                    sd.id_passport_number as rep_passp_id,
                    sd.country_of_origin as nationality,
                    sd.email_address as email,
                    sd.phone_number as phone,
                    sd.spaza_address as delivery_address
                from spaza_details as sd 
                    left join users as u on u.id=sd.spaza_owner_id
                where sd.status='A' and (sd.spaza_name like ? or u.name like ? or u.surname like ?) order by sd.spaza_name asc
               ";
        return $this->mmshightech->getAllDataSafely($sql,'sss',['%'.$search.'%','%'.$search.'%','%'.$search.'%'])??[];
    }

    public function getOtherSpazas(?int $spaza_owner_id):array
    {
        $sql = "SELECT spaza_name, id as spaza_id from spaza_details where spaza_owner_id=? and status='A'";
        return $this->mmshightech->getAllDataSafely($sql,'s',[$spaza_owner_id])??[];

    }
    public function getSpazaByOrderId(?int $orderId=null):string{
        $sql="SELECT if(o.spaza_id=0,u.current_spaza,o.spaza_id) as current_spaza
              from users as u 
              left join orders as o on o.id=?
              where u.id = o.user_id";
        $response = $this->mmshightech->getAllDataSafely($sql,'s',[$orderId])[0]??[];
        return intval($response['current_spaza']??0);
    }
    public function get_A_Details(?int $spazaID):array
    {
        $sql = "SELECT  permit_number, 
                        visa_number,
                        origin_address,
                        spaza_address,
                        passport_id_copy,
                        proof_of_origin_address,
                        proof_of_residental_adress,
                        copy_of_permit,
                        proof_of_spaza_address,
                        rep_facial_img,
                        is_veryfied 
                from spaza_details where id = ? and status='A'";
        return $this->mmshightech->getAllDataSafely($sql,'s',[$spazaID])[0]??[];
    }
    public function getSpazaPaymentDetails(?int $orderId=null):array{
        if(!isset($orderId)){
            return [];
        }
        $sql = "SELECT  u.id as owner_id,
                        u.card_number,
                        u.card_cvv,
                        u.card_token,
                        u.card_expiry_date,
                        u.card_type,
                        u.card_name,
                        u.name,
                        u.surname,
                        u.usermail as email, 
                        u.phone_number as phone ,
                        u.dob,
                        u.gender,
                        u.nationality,
                        u.sa_residing_address
                from users as u 
                    left join orders as o on o.id=?
                where u.id=o.user_id and status='A'";
        return $this->mmshightech->getAllDataSafely($sql,'s',[$orderId])[0]??[];
    }
}
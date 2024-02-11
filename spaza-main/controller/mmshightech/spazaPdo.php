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
    public function getSpazaInformationForOrderProcessing(?int $spazaId=null):array{
        $sql = "SELECT 
                    sd.id as spaza_id, 
                    sd.spaza_name as spaza_name,
                    concat(sd.rep_name,' ',sd.rep_surname) as rep_name,
                    sd.spaza_owner_id as owner_id,  
                    concat(u.name,' ',u.surname) as owner_name,
                    u.usermail as owner_email,
                    u.phone_number as owner_phone,
                    (select count(id) from orders where process_status <12) as active_orders,
                    (select count(id) from orders where process_status =16) as pending_orders,          
                    (select count(id) from orders where process_status = 13) as delivered_orders,
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
                    (select count(id) from orders where process_status <12) as active_orders,
                    (select count(id) from orders where process_status =16) as pending_orders,          
                    (select count(id) from orders where process_status = 13) as delivered_orders,
                    sd.status as spaza_status,
                    sd.id_passport_number as rep_passp_id,
                    sd.country_of_origin as nationality,
                    sd.email_address as email,
                    sd.phone_number as phone,
                    sd.spaza_address as delivery_address
                from spaza_details as sd 
                    left join users as u on u.id=sd.spaza_owner_id
                where sd.status='A' order by sd.spaza_name asc
               ";
        return $this->mmshightech->getAllDataSafely($sql)??[];
    }

    public function getOtherSpazas(?int $spaza_owner_id):array
    {
        $sql = "SELECT spaza_name, id as spaza_id from spaza_details where spaza_owner_id=? and status='A'";
        return $this->mmshightech->getAllDataSafely($sql,'s',[$spaza_owner_id])??[];

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
    public function getSpazaPaymentDetails(?int $spazaId):array{
        $sql = "SELECT  id as owner_id,card_number,card_cvv,card_token,card_expiry_date,card_type,card_name,name,surname,usermail as email, phone_number as phone ,dob,gender,nationality,sa_residing_address
                from users where current_spaza = ? and status='A'";
        return $this->mmshightech->getAllDataSafely($sql,'s',[$spazaId])[0]??[];
    }
}
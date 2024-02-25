<?php

namespace Controller;
use Classes\response\Response;
class mmshightech
{
    public $connection;
    public function __construct()
    {
        $this->dbConn();
    }
    public function dbConn(){
        $user='u405316555_ispaza';
        $pass='iSpaza2024';
        $dbnam='u405316555_ispaza';
        // $user='root';
        // $pass='';
        // $dbnam='spaza';
        $this->connection=mysqli_connect('localhost',$user,$pass,$dbnam)or die("Connection was not established!!");
    }
    public function getAllDataSafely($query, $paramType="", $paramArray=[]):array{
        // global $conn;
        $stmt = $this->connection->prepare($query);

        if(!empty($paramType) && !empty($paramArray)) {
            $this->bindQueryParams($stmt, $paramType, $paramArray);
        }

        $stmt->execute();
        $result = $stmt->get_result();
        $resultset=array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                array_push($resultset,$row);
            }
        }
        return $resultset;


    }
    public function isUserExists(string $userEmailAddressNewUser=""):bool{
        $sql="select usermail from users where usermail=?";
        $result = $this->getAllDataSafely($sql,'s',[$userEmailAddressNewUser])[0]??[];
        return isset($result['usermail']);

    }
    public function postDataSafely($query, $paramType, $paramArray):array|int{
        $stmt = $this->connection->prepare($query);
        $this->bindQueryParams($stmt, $paramType, $paramArray);
        $stmt->execute();
        if($stmt->errno==0){
            return $stmt->insert_id;
        }
        return ['error'=>$stmt->error,'Error_list'=>$stmt->error_list];
    }
    public function newPostDataSafely($query, $paramType, $paramArray):Response{
        $response = new Response();
        $stmt = $this->connection->prepare($query);
        $this->bindQueryParams($stmt, $paramType, $paramArray);
        $stmt->execute();
        $response->failureSetter()->messagerSetter("Failed to process due to : ".$stmt->error)->messagerArraySetter(['error'=>$stmt->error,'Error_list'=>$stmt->error_list]);
        if($stmt->errno==0){
            $response = new Response();
            $response->successSetter()->messagerSetter($stmt->insert_id)->setObjectReturn();
        }
        return $response;
    }
    public function execute($query, $paramType="", $paramArray=array()){
        $stmt = $this->connection->prepare($query);

        if(!empty($paramType) && !empty($paramArray)) {
            $this->bindQueryParams($stmt, $paramType="", $paramArray=array());
        }
        $stmt->execute();
    }

    public function bindQueryParams($stmt, $paramType, $paramArray=array()){
        $paramValueReference[] = & $paramType;
        for ($i = 0; $i < count($paramArray); $i ++) {
            $paramValueReference[] = & $paramArray[$i];
        }
        call_user_func_array(array(
            $stmt,
            'bind_param'
        ), $paramValueReference);
    }
    public function numRows($query, $paramType="", $paramArray=array()):int{
        // global $conn;
        $stmt = $this->connection->prepare($query);

        if(!empty($paramType) && !empty($paramArray)) {
            $this->bindQueryParams($stmt, $paramType, $paramArray);
        }

        $stmt->execute();
        $stmt->store_result();
        $recordCount = $stmt->num_rows;
        return $recordCount;
    }
    public function DBClose(){
        mysqli_close($this->connection);
    }

    protected function cleanData(string $mess){
        $mess = str_replace('<', "?", $mess);
        $mess = str_replace('>', "?", $mess);
        $mess = str_replace("\\r\\n", "<br>", $mess);
        $mess = str_replace("\\n\\r", "<br>", $mess);
        $mess = str_replace("\\r", "<br>", $mess);
        $mess = str_replace("\\n", "<br>", $mess);
        $mess = str_replace("\r\n", "<br>", $mess);
        $mess = str_replace("\n\r", "<br>", $mess);
        $mess = str_replace("\r", "<br>", $mess);
        $mess = str_replace("\n", "<br>", $mess);
        $mess = str_replace("\\", " ", $mess);
        $mess = str_replace("'", "`", $mess);
        $mess = str_replace('"', "``", $mess);
        return $mess;
    }
    public function OMO(string $string){
        return $this->cleanData(
            mysqli_escape_string(
                $this->connection,$string
            )
        );
    }
    public function cleanAll(array $data =[]){
        if(empty($data)){
            return array();
        }
        $cleanData = [];
        foreach ($data as $da){
            $cleanData[] = $this->cleanData(
                mysqli_escape_string(
                    $this->connection,$da));
        }
        return  $cleanData;
    }
    public function login(string $email=null,string $pass=null):array{
        $pass = $this->lockPassWord($pass);
        //echo $pass." | ".$email;
        $response = $this->Verification($email,$pass);
        if($response==1){
            return ['response'=>'S','data'=>'Success'];
        }
        return ['response'=>'F','data'=>'Email|Password incorrect'];
    }
    public function login2App(string $email=null, string $pass=null,string $app="APP"){
        $pass = $this->lockPassWord($pass);
        $response = $this->VerificationApp($email,$pass,$app);
        if($response==1){
            return ['response'=>'S','data'=>'Success'];
        }
        return ['response'=>'F','data'=>'Email|Password incorrect'];
    }
    private function Verification($email,$pass):int{
        //echo"here";
        $sql = "select usermail,security from users where usermail=? and security=?";
        return $this->numRows($sql,"ss",[$email,$pass])??0;
    }
    private function VerificationApp($email,$pass,$app):int{
        $sql = "select usermail,security from users where usermail=? and security=? and user_type=?";
        return $this->numRows($sql,"sss",[$email,$pass,$app])??0;
    }
    public function lockPassWord(string $pass):string{
        return $this->ibhubesiLesilisa(
            md5(
                $this->ibhubesiLesilisa(
                    md5(
                        $this->ibhubesiLesilisa($pass)
                    )
                )
            )
        );
    }
    public function verifyClientMenuStore(array $cleanData=[]):array{
        if(empty($cleanData)){
            return ['response'=>"F",'data'=>"Failed to process empty dataset."];
        }
        $verifiedData = [];
        foreach ($cleanData as $data){
            if(empty($data)){
                $verifiedData=['response'=>"F",'data'=>"Failed to process empty dataset. You have an undefined var dataset"];
                break;
            }
            else{
                $verifiedData[]=$this->$data;
            }
        }
    }
    private function ibhubesiLesilisa($pwd){
        $strArr=array("L","9","D","!","a","K","1","b","Y","$","R","c","@","F","d","S","3","e","5","-","A","f","g","6","V","h","G","i","W","j","k","l","T","%","m","8","B","n","E","+","o","X","p","C","*","q","r","Q","s","M","+","t","N","2","u","H","v","4","U","w","I","7","&","x","O","y","J","z","=","P");
        $intArr=array('!','1','B','$','9','T','%','3','^','5','*','2','6','Y','(','7','+','8','G','-','4','E');
        //print sizeof($strArr)."   ";
        $fihliwe=$this->shayIqanda($this->wamaHalahle($pwd),$strArr);
        return $fihliwe;
    }
    private function shayIqanda($iqanda,$arr){
        $bhozo=str_split($iqanda);
        $khala="";
        foreach ($bhozo as $value) {
            $inamba=ord($value);
            //print $value;
            //print $inamba."-";
            $currPos=$this->position($this->hash1($inamba));
            $khala.=$arr[$currPos];
            //echo "<pre>";print $arr[$currPos];echo"<prev";
        }
        return $khala;
    }
    private function hash1($inamba){
        $hi=(($inamba^3)*((8%$inamba)/0.5))/30;
        //print $hi."  ";
        return $hi;
    }
    private function position($pos){
        ///print_r($strArr);
        if($pos>69){
            $pos/=3;
            return $pos;

        }
        else{
            return $pos;
        }
    }
    public function userInfo(string $agent=null):array{
        return $this->getAllDataSafely("select*from users where usermail=?","s",[$agent])[0]??[];
    }
    public function updateDomeBackground(int $dome=0,int $id=0):array{
        $sql = "update users set background=? where id=?";
        $response = $this->postDataSafely($sql,'ss',[$dome,$id]);
        if(is_numeric($response)&&$response==$id){
            return ['response'=>"S",'data'=>"Success"];
        }
        else{
            return ['response'=>"F",'data'=>$response];
        }
    }
    private function wamaHalahle($pwd){
        $umphumela=str_split($pwd);
        $ubhozo="fr%";$ucikicane="fRg";$isithupha="3g@";
        $k=0;
        $uzwane="";
        foreach ($umphumela as $value) {
            if($k<sizeof($umphumela)){
                if((sizeof($umphumela)%2)==0){
                    if(($k)==2){
                        $uzwane=$uzwane.$ubhozo;
                        //print $uzwane."";
                    }
                    else if(($k)==6){
                        $uzwane=$uzwane.$ucikicane;
                    }
                    else if(($k)==9){
                        $uzwane=$uzwane.$isithupha;
                    }
                    else{
                        $uzwane=$uzwane.$value;
                    }
                }
                else{
                    if(($k)==3){
                        $uzwane=$uzwane.$ubhozo;
                        //print $uzwane."";
                    }
                    else if(($k)==7){
                        $uzwane=$uzwane.$ucikicane;
                    }
                    else if(($k)==10){
                        $uzwane=$uzwane.$isithupha;
                    }
                    else{
                        $uzwane=$uzwane.$value;
                    }
                }
            }
            else{
                break;
            }
            $k+=1;
        }
        return $uzwane;
    }
    public function sendEmail(?string $message,?string $reciever,?string $sender,?string $subject):bool{
        $from=$sender;
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

        // Create email headers
        $headers .= 'From: '.$from."\r\n".
            'Reply-To: '.$from."\r\n" .
            'X-Mailer: PHP/' . phpversion();

        // Compose a simple HTML email message
        $mess = '<html><body> <div style="background-color:#212121;color:#45f3ff;">';
        $mess .= '<div style="display:flex;">';
        $mess .='<div style="width:40px;height:40px;margin-left:5%;border-radius:100%;padding:1px 1px;background:#45f3ff;"><img style="width:100%;height:100%;border-radius:100%;" src="https://netchatsa.com/img/aa.jpg"></div>';
        // $mess .='<div><h3 style="color:#080;font-size:18px;">Netchatsa Mailer Alert</h3></div>';
        $mess .='</div>';
        $mess .= '<h3 style="color:#f40;">Dear Customer</h3>'.$message;
        $mess .="<a href='https://play.google.com/store/apps/details?id=com.mmshightech.netchatsa'><span class='badge badge-primary text-center text-white'>Download APP</span></a>";
        $mess .= '<div style="padding:10px;border:1px solid #45f3ff;font-style:italic;font-size:12px;color:red;">ispaza mailer is a communication system developed by mms high tech. If this mail does not belong to you please ignore it. Do not reply to this email as it is controlled by RoboTech.<p><small>copyright 2023-to-date all right reserved</small></p></div></div></body></html>';
        return mail($reciever, $subject, $mess, $headers);

    }
}

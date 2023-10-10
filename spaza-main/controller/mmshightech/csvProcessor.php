<?php
class csvProcessor{
    public function processCSV(string $pathFile=null):array{
        $bom = "\xef\xbb\xbf";
        $fp = fopen($pathFile, 'r');
        if (fgets($fp, 4) !== $bom) {
            rewind($fp);
        }
        $lines =[];
        while(!feof($fp) && ($line = fgetcsv($fp)) !== false) {
            $lines[] = $line;
        }
        $rto=$this->processCSVLines($lines);
        return $rto??[];
    }
    private function processCSVLines(array $lines=[]){
        if(empty($lines)){
            return [];
        }
        $index=0;
        $table = [];
        foreach ($lines as $line){
            if($index==0){
                foreach ($line as $l){
                    $table[] = strtolower(implode("_",explode(" ",$l)));
                }
                $table[]="time_added";
                $table[]="query_by";
                $index++;
            }
            else{
                break;
            }
        }
        $table = implode(',',$table);
        unset($lines[0]);
        $splitedData=$lines;// $this->splitedData($lines);

        return ['header'=>$table,'data'=>$splitedData];
    }
    public function splitedData($lines):array{
        $split = [];
        foreach ($lines as $line){
            $split[] = explode(",",$line[0]);
//            print_r($line);echo"<br>";
        }
        return $split;
    }
}
?>

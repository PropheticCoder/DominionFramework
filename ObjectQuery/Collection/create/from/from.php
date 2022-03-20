<?php
namespace libraries\ObjectQuery\Collection\Create;

use libraries\BasicSQL\QUERY;
use \libraries\ObjectQuery\DataObject;

class from{
    private $modelName;
    public function __construct(string $modelName){
        $this->modelName=$modelName;
    }
    
    public function table(){
        $ObjectArray=[];
        
        $Fetch=QUERY::SELECT($this->modelName);
        if(count($Fetch)>0){
            foreach($Fetch as $row){
                $TempObject=DataObject::Create($this->modelName);
                $TempObject=DataObject::Fill($row,$TempObject);
                array_push($ObjectArray,$TempObject);
            }
        }
        return $ObjectArray;
    }

    public function where(array $clauses) : array{
        $ObjectArray = [];
        $Fetch = QUERY::SELECT($this->modelName, $clauses);
        if (count($Fetch) > 0) {
            foreach ($Fetch as $row) {
                $TempObject = DataObject::Create($this->modelName);
                $TempObject = DataObject::Fill($row, $TempObject);
                array_push($ObjectArray,$TempObject);
            }
        }
        return $ObjectArray;
    }
}
?>
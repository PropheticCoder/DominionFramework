<?php
namespace libraries\ObjectQuery\Object\Create;

use libraries\BasicSQL\QUERY;
use libraries\ObjectQuery\Object\create;
use libraries\ObjectQuery\Object\fill;

class from extends QUERY{
    private $modelName;
    private $tableName;
    public function __construct(string $modelName){
        $this->modelName=$modelName;
    }
    
    public function table(array $clauses){
        $Create = new  create($this->modelName);
        $Object = $Create->New($this->modelName);
        $this->tableName=$Object->table;
        $FetchedInput = QUERY::SELECT($this->tableName,$clauses);
        if(count($FetchedInput)>0) {
            $Fill = new fill($FetchedInput[0],$Object);
            $Object=$Fill->in();
        }
        return $Object;
    }
}
?>
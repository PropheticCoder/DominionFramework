<?php
namespace libraries\ObjectQuery\Object;
use libraries\ObjectQuery\Object\Create\from;

class create{
    private $modelName;
    public function __construct(string $modelName){
        $this->modelName=$modelName;
    }
    
    public function New() : object{
        $object='\App\Models';
        $object .="\\".$this->modelName."Model";
        return new $object;
    }

    public function From():object{
        return new from($this->modelName);
    }

    public function Collection(){
    }
}
?>
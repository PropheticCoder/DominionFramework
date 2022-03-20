<?php
namespace libraries\ObjectQuery\Object;

use libraries\BasicSQL\QUERY;

class destroy{
    private $Object;
    public function __construct(object $Object){
        $this->Object=$Object;
    }

    public function fromDatabase(){
        return $sql=QUERY::DELETE($this->Object->table,['id'=>$this->Object->id]);
    }

    public function fromMemory(){
        unset($this->Object);
    }
}
?>
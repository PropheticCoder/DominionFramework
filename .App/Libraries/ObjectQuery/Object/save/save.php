<?php
namespace libraries\ObjectQuery\Object;

use Exception;
use libraries\BasicSQL\QUERY;

class save extends QUERY{
    public function __construct(object $Object){
        $propertyValues=[];
        foreach($Object->columns as $column => $columnDataType){
            if ($Object->$column != null) $propertyValues[$column] = $Object->$column;
        }
        if(count($propertyValues)>0) {
            QUERY::UPSERT($Object->table, $propertyValues,['id'=>$Object->id]);
            $TABLE = QUERY::SELECT($Object->table);
            $Object->id = $TABLE[count($TABLE) - 1]['id'];
        }
        return $Object->id;
    }
}
?>
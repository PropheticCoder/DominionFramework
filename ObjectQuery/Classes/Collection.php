<?php
/**
 * Never used,and not guaranteed to work
 */
namespace libraries\ObjectQuery;
use libraries\ObjectQuery\Collection\create;

class Collection{
    public static function Create(){
        return new create;
    }

    public static function Destroy(array $Collection){
        foreach($Collection as $Object){
            DataObject::Destroy($Object);
            unset($Collection);
        }
    }
}
?>
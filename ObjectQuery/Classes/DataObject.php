<?php
namespace libraries\ObjectQuery;
/**
 * Object Capabilities
 * @copyright NMaphiri
 * @author NMaphiri
 * @version 1
 */
use libraries\ObjectQuery\Interfaces\ObjectInterface;
use libraries\ObjectQuery\Object\create;
use libraries\ObjectQuery\Object\fill;
use libraries\ObjectQuery\Object\save;
use libraries\ObjectQuery\Object\destroy;

class DataObject implements ObjectInterface{
    public static function Create(string $modelName):object{
        return new create($modelName);
    }
    
    public static function Fill (array $input,object $Object):object{
        if($Object==null) throw new \Exception('Cannot fill an object not created!');
        return new fill($input,$Object);
    }
    
    public static function Save(object $Object) {
        if ($Object == null) throw new \Exception('Cannot save an object not created!');
        return new save($Object);
    }
    
    public static function Destroy(object $Object){
        if ($Object == null) throw new \Exception('Cannot destroy an object not created!');
        return new destroy($Object);
    }
}
?>
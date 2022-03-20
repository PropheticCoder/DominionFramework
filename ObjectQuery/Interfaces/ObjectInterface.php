<?php

namespace libraries\ObjectQuery\Interfaces;
/**
 * In Here We Have Object Capabilities
 * @author PropheticCoder 
 * @copyright PropheticCoder 
 * @version 1.1
 */

interface ObjectInterface{
    public static function Create(string $modelName);
    public static function Fill(array $input,object $Object);
    public static function Save(object $Object);
    public static function Destroy(object $Object);
}
?>
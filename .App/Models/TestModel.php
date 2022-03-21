<?php
namespace App\Models;

class TestModel{
    /**
     * Table/Model name
     */
    public $name="test";

    /**
     * Array Of Model input
    */
    public $columns=[
        'id'=>'int',
        'uniqueCode'=>'string',
        'type'=>'int',
        'provider'=>'int'
    ];
    
    //Table/Model Columns
    public $id;
    public $uniqueCode;
    public $type;
    public $provider;
}
?>
<?php
namespace libraries\ObjectQuery\Collection;

use libraries\ObjectQuery\Collection\Create\from;

class create{
    public function from(string $modelName){
        return new from($modelName);
    }
}
?>
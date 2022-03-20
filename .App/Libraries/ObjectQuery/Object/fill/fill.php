<?php
namespace libraries\ObjectQuery\Object;
class fill{
    private $Object;
    private $input;
    public function __construct(array $input, object $Object){
        $this->Object = $Object;
        $this->input=$input;
    }

    public function in() : object{
        foreach ($this->Object->columns as $column => $columnDataType) {
            foreach ($this->input as $inputName => $inputData) {
                if ($column == $inputName) {
                    $this->Object->$column = $inputData;
                }
            }
        }
        return $this->Object;
    }
}
?>
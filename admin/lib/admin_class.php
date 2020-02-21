<?php
class DataObject {
    
    public $col;
    public $count;

    public function __construct($col, $count) {
        $this->col = $col;
        $this->count = $count;
    }
    
}

?>
<?php
class TagihanListrikRepository{
    private $data = [
        ["nama"=>"budi","kwh"=>1200],
        ["nama"=>"sinta","kwh"=>800],
        ["nama"=>"rani","kwh"=>1500]
    ];

    public function getAll(){
        return $this->data;
    }
}
?>
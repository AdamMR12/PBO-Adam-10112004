<?php
class employee{
    private $first_name;
    private $last_name;
    private $age;

    public function __construct($first_name, $last_name, $age) {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->age = $age;
    }

    public function getfirstname(){
        return $this->first_name;
    }

    public function getlastname(){
        return $this->last_name;
    }

    public function getage(){
        return $this->age;
    }
}
?>
<?php
$emplo = new employee('bob ','smith ',30);

echo $emplo->getfirstname();
echo $emplo->getlastname();
echo $emplo->getage()."<br>";

$emplo2 = new employee('john ','smith ',34);

echo $emplo2->getfirstname();
echo $emplo2->getlastname();
echo $emplo2->getage();
?>
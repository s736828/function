<?php
// 物件導向設計(Object-Oriented Programming, OOP)封裝、繼承、多型
// protected受保護的跟private差在，protected可以被繼承的使用
class Animal
{
    private $age = 10;
    protected $name;
    protected $hair = "紅色";

    function __construct($name)
    {
        $this->name = $name;
    }
    public function getName()
    {
        return $this->name;
    }
    public function setName($name)
    {
        return $this->name = $name;
    }

    public function age()
    {
        return $this->age;
        // return $this->run();
    }
    protected function run()
    {
        return "跑跑跑";
    }

    private function speed()
    {
        return "跑速1000";
    }
}
// 在外部產生新的物件
$animal = new Animal('小亮');
echo "<br>";
echo $animal->getName();
$animal->setName("小莉");
echo $animal->getName();
// echo $animal->age;
// echo $animal->hair;
echo $animal->age();
echo "<br>";


class Cat1 extends Animal
{
    private $age;
    function __construct($name, $age)
    {
        $this->name = $name;
        $this->age = $age;
        echo "$name";
        echo "$age";
    }
    
    function caturn()
    {
        return $this->run();
    }

    function run()
    {
        return "走走走";
    }
}
// 前面沒加修飾詞表示預設是public
$cat = new Cat1('小花',20);
echo "<br>";
echo $cat->age();
echo $cat->caturn();
echo $cat->run();

echo "<br>";
echo $cat->getName();

echo $cat->setName("小庭");
echo $cat->getName();

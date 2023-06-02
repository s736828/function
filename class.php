<?php
// 物件導向設計(Object-Oriented Programming, OOP)封裝、繼承、多型

class Animal
{
    private $age = 10;
    protected $name = "大雄";
    protected $hair = "紅色";

    function __construct()
    {
        echo "建立物件";
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
$animal = new Animal;
echo "<br>";
echo $animal->getName();
$animal->setName("小莉");
echo $animal->getName();
// echo $animal->age;
// echo $animal->hair;
echo $animal->age();
echo "<br>";
// echo $animal->speed();

class Cat extends Animal
{
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

$cat = new Cat;
echo "<br>";
echo $cat->age();
echo $cat->caturn();
echo $cat->run();





// 封裝特性
// class Salary
// {                //將資料和方法都放置進類內部，不可見
//     private static $count = 0;
//     private $money = 0;

//     public function getMoney()
//     {            //對類內的資料進行操作
//         return $this->money;
//     }
// }

// //類外部
// $s = new Salary();
// $s->getMoney();				//外部只能存取類中公有的方法，具體實現不可見

<?php
/*
針對類別進行抽象的宣告
包含成員，方法
成員只能是常數成員
方法不需要實作
類別可以實作多個介面
*/
interface Animals
{   
    const type = "animal"; //必需是常數
    public function sound();
    public function run();
}

class Dog implements Animals
{
    public function name()
    {
        return "小黑";
    }
    public function sound()
    {
        return "汪汪汪";
    }
    public function run()
    {
        return "跑跑";
    }
}

$ani = new Dog;
echo $ani->name();
echo $ani->sound();
echo $ani->run();

?>

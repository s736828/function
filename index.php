<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>自訂函式</title>
</head>

<body>
    <?php
    $name = "jerry";

    // $sum=sum(15,21,10,20,30,40);
    // echo $sum;

    echo sum(15, 21, 10, 20, 30, 40).'<br>';
    echo g().'<br>';
    echo circle(10);
    ?>
</body>

</html>

<?php
// function sum($a,$b,$c,$d,$e,$f){
//     // return $a+$b;
//     $sum=$a+$b*$c+$d-$e+$f;
//     return $sum;
// }

// 有時我們不確定參數的個數，或是不同的參數組合時會有不同的結果，這時可以用不定參數的方式來宣告函式
function sum(...$arg)
{
    print_r($arg);
    $totals = 0;
    foreach ($arg as $total) {
        $totals = $totals + $total;
        echo "$total<br>";
    }
    return $totals;
}
function g(){
    //要取用function外的全域變數時使用global關鍵字
    global $name;
    echo "1234" . $name;
}

function circle($r, $p=3.141596)
{
    return $r * $r * $p;
}
?>
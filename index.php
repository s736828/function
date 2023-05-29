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
    echo circle(10,6.18);
    ?>
</body>

</html>

<?php
// function sum($a,$b,$c,$d,$e,$f){
//     // return $a+$b;
//     $sum=$a+$b*$c+$d-$e+$f;
//     return $sum;
// }

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
    global $name;
    echo "1234" . $name;
}

function circle($r, $p=3.141596){
    return $r * $r * $p;
}
?>
<?php
// echo "<pre>";
// print_r(all('members'));
// echo "</pre>";
// all()-給定資料表名後，會回傳整個資料表的資料
function all($table)
{
    $dsn = "mysql:host=localhost;charset=utf8;dbname=vote";
    $pdo = new PDO($dsn, 'root', '');

    $sql = "select * from $table";
    $rows = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
}

// echo "<pre>";
// print_r(find('topics',9));
// echo "</pre>";
// find()-會回傳資料表指定id的資料
function find($table, $id)
{
    $dsn = "mysql:host=localhost;charset=utf8;dbname=vote";
    $pdo = new PDO($dsn, 'root', '');

    $sql = "select * from `$table` where `id`= '$id' ";
    $rows = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    return $rows;
}

// echo "<pre>";
// print_r(update('topics',['subject'=>'颱風天?','login'=>1,'close_time'=>'2023-06-30 12:00:00'],7));
// echo "</pre>";
// echo "<br>";
// 一次更新一筆
function update($table, $cols, $id)
{
    $dsn = "mysql:host=localhost;charset=utf8;dbname=vote";
    $pdo = new PDO($dsn, 'root', '');
    $tmp = '';
    foreach ($cols as $key => $value) {
        $tmp .= "`$key`='$value',";
    }
    // echo $tmp;
    // 刪除前後的多餘逗號,
    $tmp = trim($tmp, ',');
    $sql = "update `$table` set $tmp where `id`='$id'";
    echo $sql;
    $result = $pdo->exec($sql);
    return $result;
}

// 用陣列裝字串
// update1('options',
// ['description'=>'test用','total'=>10],
// ['subject_id'=>6,'total'=>1]);
function update1($table, $cols, $def)
{
    $dsn = "mysql:host=localhost;charset=utf8;dbname=vote";
    $pdo = new PDO($dsn, 'root', '');
    foreach ($cols as $key => $value) {
        $tmp[] = "`$key`='$value'";
    }
    // echo "<pre>";
    // print_r($tmp);
    // echo "</pre>";
    foreach ($def as $key => $value) {
        $con[] = "`$key`='$value'";
    }
    $sql = "update `$table` set  " . join(',', $tmp) . " where " . join(" && ", $con);
    echo $sql;
    $result = $pdo->exec($sql);
    return $result;
}


// update2('options',['id'=>8,'description'=>'50萬','total'=>200]);
function update2($table, $cols)
{
    $dsn = "mysql:host=localhost;charset=utf8;dbname=vote";
    $pdo = new PDO($dsn, 'root', '');
    foreach ($cols as $key => $value) {
        // 把不是'id'的資料隔開，串接到陣列裡，就可以少掉$id的變數
        if ($key != 'id') {
            $tmp[] = "`$key`='$value'";
        }
    }
    // echo "<pre>";
    // print_r($tmp);
    // echo "</pre>";      
    $sql = "update `$table` set  " . join(',', $tmp) . " where `id`='{$cols['id']}'";
    echo $sql;
    // $result=$pdo->exec($sql);       
    // return $result;
}


// $data=['description'=>'70',
//         'subject_id'=>'9',
//         'total'=>10,];
// insert('options',$data);
// insert('options',['description'=>'test用','total'=>8]);
function insert($table, $cols)
{
    $dsn = "mysql:host=localhost;charset=utf8;dbname=vote";
    $pdo = new PDO($dsn, 'root', '');
    $col = array_keys($cols);
    echo "<pre>";
    print_r($col);
    echo "</pre>";
    $sql = "insert into $table (`" . join("`,`", $col) . "`)values('" . join("','", $cols) . "')";
    echo $sql;
    $result = $pdo->exec($sql);
    return $result;
}

// del('options',8);

// del('options',['subject_id'=>8,'total'=>2]);

del('options', '37');
function del($table, $arg)
{
    $dsn = "mysql:host=localhost;charset=utf8;dbname=vote";
    $pdo = new PDO($dsn, 'root', '');
    $sql = "delete from `$table` where ";
    if (is_array($arg)) {
        foreach ($arg as $key => $value) {
            $tmp[] = "`$key`='$value'";
        }
        $sql .= join(" && ", $tmp);
    } else {
        $sql .= " `id` = '$arg' ";
    }
    echo $sql;
    return $pdo->exec($sql);
}

// echo "<pre>";
// print_r(find1('options',27));
// echo "</pre>";
// echo "<pre>";
// print_r(find1('options',['subject_id'=>7,'description'=>'4567']));
// echo "</pre>";

function find1($table, $arg)
{
    $dsn = "mysql:host=localhost;charset=utf8;dbname=vote";
    $pdo = new PDO($dsn, 'root', '');

    $sql = "select * from `$table` where ";
    // ↓判斷使用者要的需求是陣列形態，或是數值型態來做分類執行
    if (is_array($arg)) {
        foreach ($arg as $key => $value) {
            $tmp[] = "`$key`='$value'";
        }
        $sql .= join(" && ", $tmp);
    } else {
        $sql .= " `id` = '$arg' ";
    }
    echo $sql;
    $row = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    return $row;
}

function save($table, $cols)
{
    // 接到有id的資料就修改，沒id就新增
    if (isset($cols['id'])) {
        update2($table, $cols);
    } else {
        insert($table, $cols);
    }
}

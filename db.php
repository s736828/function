<?php
function pdo()
{
    $dsn = "mysql:host=localhost;charset=utf8;dbname=vote";
    $pdo = new PDO($dsn, 'root', '');
    return $pdo;
}


echo math('options','max','id');
echo "<br>";
echo math('options','min','id');
echo "<br>";
echo math('options','sum','total',['subject_id'=>7]);
// 計數用函式 $math給sql函式，$col為給欄位，...$arg給條件
function math($table,$math,$col,...$arg){
    $pdo = pdo();

    $sql = "select $math(`$col`) from $table ";

    if (!empty($arg)) {
        if (is_array($arg[0])) {
            foreach ($arg[0] as $key => $value) {
                $tmp[] = "`$key`='$value'";
            }
            $sql = $sql ." where ". join(" && ", $tmp);
        } else {
            $sql = $sql ." where ". $arg[0];

        }
    }
    if (isset($arg[1])) {
        $sql = $sql ." where ". $arg[1];
    }
    $rows = $pdo->query($sql)->fetchColumn();
    return $rows;
}

echo _count('topics');
// 計數用的函數
function _count($table, ...$arg){
    $pdo = pdo();
    $sql = "select count(*) from $table ";
    if (!empty($arg)) {
        if (is_array($arg[0])) {
            foreach ($arg[0] as $key => $value) {
                $tmp[] = "`$key`='$value'";
            }
            $sql = $sql ." where ". join(" && ", $tmp);
        } else {
            $sql = $sql ." where ". $arg[0];
        }
    }
    if (isset($arg[1])) {
        $sql = $sql ." where ". $arg[1];
    }
    $rows = $pdo->query($sql)->fetchColumn();
    return $rows;
}
/* 
 * all($table) => 全部資料表的內容
 * 例:select * from `topics` => all('topics')
 * ---------------------------------------------------------------
 * all($table,$array) => 以and為基礎的符合條件資料
 * 例: select * from `topics` where `type`='1' && `login`=1; => all('topics',['type'=>1,'login'=>1]) ;
 * ---------------------------------------------------------------
 * all($table,$sql) => 以sql字串為條件的資料
 * 例: select * from `topics` where open_time <= '2023/06/02' order by `id` desc
 * all(`topcis`,"where open_time <= '2023/06/02' order by `id` desc")
 * ---------------------------------------------------------------
 * all($table,$array,$sql) => 符合複雜條件的資料
 * 例: select * from `topics` where `type`=1 && `login`=1  order by `id` desc
 * all(`topcis`,['type'=>1,,'login'=>1], " order by `id` desc")
 */
// dd(all('options'));
// isset() - 判斷變數是否已被宣告，或已宣告，但值不為null
// empty() - 判斷變數的值是否為空的，0也會被判斷為空，未宣告也會被判斷為空
// ...$arg 不定參數
function all($table, ...$arg){
    $pdo = pdo();
    $sql = "select * from $table ";
    if (!empty($arg)) {
        if (is_array($arg[0])) {
            foreach ($arg[0] as $key => $value) {
                $tmp[] = "`$key`='$value'";
            }
            $sql = $sql ." where ". join(" && ", $tmp);
        } else {
            $sql = $sql ." where ". $arg[0];
        }
    }
    if (isset($arg[1])) {
        $sql = $sql ." where ". $arg[1];
    }
    // echo $sql;
    $rows = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
}


function find($table, $arg)
{
    $pdo = pdo();
    $sql = "select * from `$table` where ";
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

// update2('options',['id'=>8,'description'=>'50萬','total'=>200]);
function update($table, $cols)
{
    $pdo = pdo();
    foreach ($cols as $key => $value) {
        // 把不是'id'的資料隔開，串接到陣列裡，就可以少掉$id的變數
        if ($key != 'id') {
            $tmp[] = "`$key`='$value'";
        }
    }
    // dd($tmp);
    $sql = "update `$table` set  " . join(',', $tmp) . " where `id`='{$cols['id']}'";
    // echo $sql;
    $result = $pdo->exec($sql);
    return $result;
}



// $data=['description'=>'70',
//         'subject_id'=>'9',
//         'total'=>10,];
// insert('options',$data);
// insert('options',['description'=>'test用','total'=>8]);
function insert($table, $cols)
{
    $pdo = pdo();
    // 需要欄位名稱，所以用array_keys($cols)取索引值key
    $col = array_keys($cols);   
    // dd($col);
    $sql = "insert into $table (`" . join("`,`", $col) . "`)values('" . join("','", $cols) . "')";
    echo $sql;
    $result = $pdo->exec($sql);
    return $result;
}

// del('options',['subject_id'=>8,'total'=>2]);
// del('options', '37');
function del($table, $arg){
    $pdo = pdo();
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


function save($table, $cols)
{
    // 接到有id的資料嗎?
    if (isset($cols['id'])) {
        update($table, $cols);
    } else {
        insert($table, $cols);
    }
}


//執行select 較複雜的語法
function q($sql)
{
    $pdo = pdo();
    return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}
// 用來傾印陣列的內容 direct_dump
function dd($array)
{
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}

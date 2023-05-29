<?php
// echo "<pre>";
// print_r(all('members'));
// echo "</pre>";

// echo "<pre>";
// print_r(find('topics',9));
// echo "</pre>";

// echo "<pre>";
// print_r(update('topics',['subject'=>'颱風天?','open_time'=>'2023-05-30 12:00:00'],7));
// echo "</pre>";

update1('options',
['description'=>'50萬','total'=>50],
['subject_id'=>2,'total'=>17]);


// del('options','36');


// all()-給定資料表名後，會回傳整個資料表的資料
function all($table){
    $dsn = "mysql:host=localhost;charset=utf8;dbname=vote";
    $pdo = new PDO($dsn, 'root', '');

    $sql = "select * from $table";
    $rows = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
}
// find()-會回傳資料表指定id的資料
function find($table,$id)
{
    $dsn = "mysql:host=localhost;charset=utf8;dbname=vote";
    $pdo = new PDO($dsn, 'root', '');

    $sql = "select * from `$table` where `id`= '$id' ";
    $rows = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    return $rows;
}

// 一次更新一筆
function update($table,$cols,$id){
    $dsn = "mysql:host=localhost;charset=utf8;dbname=vote";
    $pdo = new PDO($dsn, 'root', '');
    $tmp='';
    foreach($cols as $key=>$value){
        $tmp.="`$key`='$value',";
        // echo $tmp;
    }
    // 刪除前後的多餘逗號,
    $tmp=trim($tmp,',');

    $sql="update `$table` set $tmp where `id`='$id'";
    // echo $sql;
    $result= $pdo->exec($sql);

    return $result;
}


function update1($table,$cols,$def){
    $dsn="mysql:host=localhost;charset=utf8;dbname=vote";
    $pdo=new PDO($dsn,'root','');        
    //['subject'=>'今天天氣很好吧?',
    // 'open_time'=>'2023-05-29',
    // 'close_time'=>'2023-06-05',
    //]        
    foreach($cols as $key => $value){
        $tmp[]= "`$key`='$value'";
    }        
    // echo "<pre>";
    // print_r($tmp);
    // echo "</pre>";
    //`subject`='今天天氣很好吧?',`open_time`='2023-05-29',`close_time`='2023-06-05'
    foreach($def as $key => $value){
        $con[]= "`$key`='$value'";
    }        

    $sql="update `$table` set  ".join(',',$tmp)." where ".join(" && ",$con);
        echo $sql;
    $result=$pdo->exec($sql);        
    return $result;
}

echo "<br>";
$data=['description'=>'10',
        'subject_id'=>'9',
        'total'=>3,];

// insert('options',$data);
function insert($table,$cols){
    $dsn="mysql:host=localhost;charset=utf8;dbname=vote";
    $pdo=new PDO($dsn,'root','');
    $col=array_keys($cols);

    $sql="insert into $table (`".join("`,`",$col)."`)values('".join("','",$cols)."')";
    echo $sql;

    $result=$pdo->exec($sql);
    return $result;
}


function del($table,$id){
    $dsn="mysql:host=localhost;charset=utf8;dbname=vote";
    $pdo=new PDO($dsn,'root','');
    $sql="delete from `$table` where `id`='$id'";
    return $pdo->exec($sql);
}


echo "<pre>";
print_r(find1('topics',9));
echo "</pre>";
echo "<pre>";
print_r(find1('topics',9));
echo "</pre>";
function find1($table,$arg)
{
    $dsn = "mysql:host=localhost;charset=utf8;dbname=vote";
    $pdo = new PDO($dsn, 'root', '');

    $sql = "select * from `$table` where ";
    if(is_array($arg)){
        foreach($arg as $key=>$value){
            $tmp[]="`$key`='$value'";
        }
        $sql.=join(" && ",$tmp);
    }else{
        $sql.=" `id` = '$arg' ";
    }

    echo $sql;
    
    $row = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    return $row;
}

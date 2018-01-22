<?php

    require('../mysql_data.php');
    $db_link = new PDO("mysql:dbname=$db_data[db];host=$db_data[host];charset=utf8" , $db_data["user"] , $db_data["password"],
        array( PDO::ATTR_PERSISTENT => true )
    );
    //main
    $data = [];
    
    //テーブル取得
    $stmt = $db_link->query('SHOW TABLES');


    while($tables = $stmt->fetch(PDO::FETCH_ASSOC) ){
        //配列にテーブル名を追加していく
        $data[] = $tables["Tables_in_testdb"];
    }
    echo json_encode($data);
    exit;
?>

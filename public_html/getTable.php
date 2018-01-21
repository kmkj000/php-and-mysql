<?php

    require('../mysql_data.php');
    $db_link = new PDO("mysql:dbname=testdb;host=localhost;charset=utf8" , $db_data["user"] , $db_data["password"],
        array( PDO::ATTR_PERSISTENT => true )
    );
    //main
    $data = [];
    
    //テーブル取得
    $stmt = $db_link->query('SHOW TABLES');


    while($tables = $stmt->fetch(PDO::FETCH_ASSOC) ){
        $data[] = $tables["Tables_in_testdb"];
    }
    echo json_encode($data);
    exit;
?>

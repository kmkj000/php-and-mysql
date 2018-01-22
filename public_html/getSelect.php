<?php

    require('../mysql_data.php');
    $db_link = new PDO("mysql:dbname=$db_data[db];host=$db_data[host];charset=utf8" , $db_data["user"] , $db_data["password"],
        array( PDO::ATTR_PERSISTENT => true )
    );

    //main
    //POSTからテーブル名を受け取る
    var_dump($_POST);
    if(isset($_POST['tableName'])){
        $tableName = $_POST['tableName'];
    }
    var_dump($tableName);

    $data = [];
    
    //テーブルからデータ取得
    $stmt = $db_link->query("SELCT * FROM $tableName");

    var_dump($stmt);
    while($tables = $stmt->fetch(PDO::FETCH_ASSOC) ){
       // $data[] = $tables["Tables_in_testdb"];
    }
    echo json_encode($data);
    exit;
?>

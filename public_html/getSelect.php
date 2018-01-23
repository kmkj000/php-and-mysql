<?php

    require('../mysql_data.php');
    $db_link = new PDO("mysql:dbname=$db_data[db];host=$db_data[host];charset=utf8" , $db_data["user"] , $db_data["password"],
        array( PDO::ATTR_PERSISTENT => true )
    );

    //main
    //POSTからテーブル名を受け取る
    if(isset($_POST['tableName'])){
        $tableName = $_POST['tableName'];
    }

    $data = [];
    
    // テーブルからテーブル構造を取得
    $stmt = $db_link->query("SHOW COLUMNS FROM $tableName");
    if($stmt) {
        while($tableStruct = $stmt->fetch(PDO::FETCH_ASSOC) ){
            $data['tableStructs'][] =$tableStruct["Field"];
        }
    }
    
    //テーブルからデータ取得
    $stmt = $db_link->query("SELCT * FROM $tableName");
    if($stmt) {
        while($tableData = $stmt->fetch(PDO::FETCH_ASSOC) ){
            $data['tableData'][] = $tableData;
        }
    }
    echo json_encode($data);
    exit;
?>

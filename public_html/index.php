<html ng-app>
<head>
    <title>PHP TEST</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
</head>
<body>

<?php
    require('../mysql_data.php');

    try{
        $db_link = $pdo = new PDO("mysql:dbname=testdb;host=localhost;charset=utf8" , $db_data["user"] , $db_data["password"],
            array( PDO::ATTR_PERSISTENT => true ) 
        );

    }catch (PDOException $e) {
        exit('データベース接続失敗。'.$e->getMessage());
    }
    $stmt = $db_link->query('SHOW TABLES');

    // mysql接続成功メッセ
    print('<h3 style="text-align:center;"><i class="fa fa-handshake-o" aria-hidden="true"></i>mysql接続に成功しました。</h3>');
    
    // テーブル表示
    print '<table style="margin:10 auto 0;" border="1"><tr>';
        
    while($tables = $stmt->fetch(PDO::FETCH_ASSOC) ){
        print '<td>'.$tables["Tables_in_testdb"].'</td>';
    }
    print '</tr></table>';





    $db_link = null;
    if (!$db_link){
        print('<h3 style="text-align:center;"><i class="fa fa-hand-rock-o" aria-hidden="true"></i>切断に成功しました。</h3>');
    }
?>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.6/angular.min.js"></script>
</body>
</html>
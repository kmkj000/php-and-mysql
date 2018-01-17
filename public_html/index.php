<html ng-app="App">
<head>
    <title>TableView</title>
    <meta charset="utf-8">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
</head>
<body ng-controller="MainBody">

    <div class="container">
<?php
    require('../mysql_data.php');

    try{
        $db_link = $pdo = new PDO("mysql:dbname=testdb;host=localhost;charset=utf8" , $db_data["user"] , $db_data["password"],
            array( PDO::ATTR_PERSISTENT => true )
        );

    }catch (PDOException $e) {
        exit('データベース接続失敗。'.$e->getMessage());
    }
    // mysql接続成功メッセ
    print('<h3 style="text-align:center;"><i class="fa fa-handshake-o" aria-hidden="true"></i>mysql接続に成功しました。</h3>');
    
    $stmt = $db_link->query('SHOW TABLES');
    if($stmt) {
?>
        <div ng-controller="TableView">
            <!-- 読み込み中エリア -->
            <div ng-show="loading">
                <i class="fa fa-refresh fa-spin fa-2x fa-fw"></i>
            </div>
            <!-- loop -->
            <!-- テーブル表示 -->
            <table class="table table-bordered table-hover" style="margin:10 auto 0;">
                <tr class="success"><th>テーブル一覧</th></tr>
                <tr ng-repeat="table in tables">
                    <td>{{table.data}}</td>
                </tr>
            </table>
            
        </div>
<?php
    }else {
        print '<div class="alert alert-danger" role="alert">データベースにテーブルが存在しません</div>';
    }
?>
    </div>
    <script>
        var app = angular.module('App',[]);
        
        app.controller('TableView',function($scope,$http){
        
            //読み込み中を表示
            $scope.loading = true;
        
            //データ取得
            $http.get("./getTable.php")
            .success(function(response){
        
                //データ取得
                $scope.tables = response.data;
        
                //読み込み中非表示
                $scope.loading = false;
            });
        
        });
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.6/angular.min.js"></script>
</body>
</html>
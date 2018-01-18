<html ng-app="myApp">
<head>
    <title>TableView</title>
    <meta charset="utf-8">
    
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
</head>
<body>

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
    
?>
        <div  ng-controller="tableView">
            <!-- loop -->
            <!-- テーブル表示 -->
            <table ng-show="tableExists" ng-init="tableExists=true" class="table table-bordered table-hover" style="margin:10 auto 0;">
                <tr class="success"><th>テーブル一覧<i ng-show="loading" class="fa fa-refresh fa-spin fa-2x fa-fw"></i></th></tr>
                <tr ng-repeat="table in tables">
                    <td ng-cloak>{{table}}</td>
                </tr>
            </table>

            <div ng-hide="tableExists" class="alert alert-danger" role="alert">データベースにテーブルが存在しません</div>
        </div>

    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.6/angular.min.js"></script>
    <script>
        angular.module('myApp',[])
            .controller('tableView',function($scope , $http){
                // テーブルを表示
                $scope.tableExists = true;
                //読み込み中を表示
                $scope.loading = true;

                //データ取得
                $http.get("./getTable.php")
                .success(function(response){
                    console.log(response);
            
                    //データ取得
                    $scope.tables = response;
                    if($scope.tables.length == 0){
                        $scope.tableExists = false;
                    }
                    //読み込み中非表示
                    $scope.loading = false;
                    
                })
                .error(function() {
                    //読み込み中非表示
                    $scope.loading = false;
                    $scope.tableExists = false;
                });
                
                
            
        });
    </script>
</body>
</html>
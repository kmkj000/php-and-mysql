<html ng-app="myApp">
<head>
    <title>TableView</title>
    <meta charset="utf-8">

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
</head>
<body>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.6/angular.min.js"></script>

    <div class="container">
<?php
require('../mysql_data.php');

try{
    $db_link = new PDO("mysql:dbname=$db_data[db];host=$db_data[host];charset=utf8" , $db_data["user"] , $db_data["password"],
        array( PDO::ATTR_PERSISTENT => true )
    );

}catch (PDOException $e) {
    exit('データベース接続失敗。'.$e->getMessage());
}
// mysql接続成功メッセ
print('<h3 style="text-align:center;"><i class="fa fa-handshake-o" aria-hidden="true"></i>mysql接続に成功しました。</h3>');

?>
        <div  ng-controller="TableView">
            <!-- loop -->
            <!-- テーブル表示 -->
            <table ng-show="tableExists" ng-init="tableExists=true" class="table table-bordered table-hover" style="margin:10 auto 0;">
                <tr class="success"><th>テーブル一覧<i ng-show="loading" class="fa fa-refresh fa-spin fa-2x fa-fw" /></th></tr>
                <tr ng-repeat="table in tables">
                    <td ng-cloak><a style="cursor: pointer;" ng-click='clickFunction(table)'>{{table}}</a></td>
                </tr>
            </table>

            <div ng-cloak ng-hide="tableExists" class="alert alert-danger" role="alert">データベースにテーブルが存在しません</div>
        </div>

        <div style="padding-top:30px;"  ng-controller="SelectView" ng-show="tableClick" ng-init="tableClick=false">
            <table ng-cloak ng-show="dataExists" ng-init="dataExists=true" class="table table-bordered" style="margin:auto;">
                <tr class="success"><th>テーブルデータ一覧<i ng-show="loading" class="fa fa-refresh fa-spin fa-2x fa-fw" /></th></tr>
                <tr ng-repeat="selectData in selectDatas">
                    <td ng-cloak>{{selectData}}</td>
                </tr>
            </table>
            <div ng-cloak ng-hide="dataExists" class="alert alert-danger" role="alert">{{tableName}}テーブルにデータが存在しません</div>
        </div>

    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="./angularApp.js"></script>
</body>
</html>

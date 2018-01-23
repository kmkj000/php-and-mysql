let app = angular.module('myApp',[]);

//factoryを作成($scopeを保持する用)
app.factory('SharedScopes', function($rootScope) {
    // Scopeを保持するための変数
    var sharedScopes = {};

    return {
        setScope: function(key, value){ 
            //key-value方式で$scopeを入れる
            sharedScopes[key] = value;
        },
        getScope: function(key) {
            //$scopeを返す
            return sharedScopes[key];
        }
    };
});

//$httpでPOST使って送るときのヘッダ情報自動
app.config(function ($httpProvider) {
    $httpProvider.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded; charset=UTF-8';
    $httpProvider.defaults.transformRequest = function(data){
        if (data === undefined) {
            return data;
        }
        return $.param(data);
    }
});

//$scope,$http,SharedScopesをDI
app.controller('TableView',function($scope , $http , SharedScopes){
    //factoryに$scopeを入れる
    SharedScopes.setScope('TableView' , $scope);

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
            //テーブルが一つも取得できなかった場合
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

//$scope,$http,SharedScopesをDI
app.controller('SelectView',function($scope , $http , SharedScopes){
    SharedScopes.setScope('SelectView' , $scope);

    // テーブル名をクリックした時の動作
    SharedScopes.getScope('TableView').clickFunction = function(val) {         
        $scope.tableClick = true;
        //読み込み中アイコン表示
        $scope.loading = true;
        // POSTメソッドでテーブル内データを取る
        $http({
            method: 'POST',
            url: './getSelect.php',
            data: { tableName: val }
        })
        //成功時の処理
        .success(function(response){
            $scope.selectDatas = response.selectDatas;
            //データが一つもなかった場合
            if($scope.selectDatas == null || $scope.selectDatas.length == 0) {
                $scope.dataExists=false;
                $scope.tableName = val;
            }
            //読み込み中非表示
            $scope.loading = false;
        })
        // 失敗時の処理
        .error(function(response){
            //読み込み中非表示 
            $scope.loading = false;
            $scope.tableName = val;
            $scope.dataExists = false;
        });
    }

});

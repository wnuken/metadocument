
var MetaDocument = angular.module('MetaDocument', []);

MetaDocument.controller('HomeController', function($scope, $http) {
	$http.get('./files/user1-home.json').success(function (data) {
        $scope.home = data;
    });
	
	$( "div#info_ofertantes" ).fadeIn( "slow", function() {
		// Animation complete
	});
	
   /* $scope.Save=function(){
        $scope.nombres.push({nombre:$scope.newName.nombre,valor:$scope.newName.valor,id:$scope.newName.id});
        imagesString = JSON.stringify($scope.nombres);
        // $scope.localStorage.setItem('gifWallet', imagesString);
    } */
});
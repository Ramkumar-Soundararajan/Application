var app = angular.module('etiApp', ['datatables']);

app.controller('etiController', function($scope, $http){
 $http.get('fetch.php').success(function(data, status, headers, config){
  $scope.customers = data;
 });
});
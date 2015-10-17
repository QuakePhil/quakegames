angular.module('app', [])

  .factory("ping", function($timeout, $http) {

      // Pings a URL or IP using HTTP GET request
      var ping = function(URL, callback) {

          var responseTime = 0;
          var start = (new Date()).getTime();

          $http.get('http://' + URL + '?rnd=' + (new Date().getTime()))
              .success(function() {
                  responseTime = (new Date().getTime()) - start;
                  callback(Math.round(responseTime / 10) / 100);
              })
              .error(function() {
                  callback(responseTime);
              })
      };

      return {
          ping: ping
      };
  })
  
  .controller('pingctrl', ['$scope', 'ping', function($scope, ping) {
      
      $scope.pingtgt = '93.81.254.63';
      
      $scope.doping = function() {
          ping.ping($scope.pingtgt, function(pingtime) {
              // this shit doesn't work, nor does Image()
              console.log('Ping ' + $scope.pingtgt + ': ' + pingtime);
          });
      }
      
  }]);
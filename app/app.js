var app = angular.module('myApp', ['angularUtils.directives.dirPagination', 'ui.mask']);
 
 app.filter('strLimit', ['$filter', function($filter) {
   return function(input, limit) {
     if (! input) return;
     if (input.length <= limit) {
          return input;
      }
    
      return $filter('limitTo')(input, limit) + ' [...]';
   };
}]);

 app.filter('unique', function() {

  // Take in the collection and which field
  //   should be unique
  // We assume an array of objects here
  // NOTE: We are skipping any object which
  //   contains a duplicated value for that
  //   particular key.  Make sure this is what
  //   you want!
  return function (arr, targetField) {

    var values = [],
        i, 
        unique,
        l = arr.length, 
        results = [],
        obj;

    // Iterate over all objects in the array
    // and collect all unique values
    for( i = 0; i < arr.length; i++ ) {

      obj = arr[i];

      // check for uniqueness
      unique = true;
      for( v = 0; v < values.length; v++ ){
        if( obj[targetField] == values[v] ){
          unique = false;
        }
      }

      // If this is indeed unique, add its
      //   value to our values and push
      //   it onto the returned array
      if( unique ){
        values.push( obj[targetField] );
        results.push( obj );
      }

    }
    return results;
  };
});
app.controller('mainCtrl', function($scope, $http) {
 
 
/*This starts the problem functions*/
$scope.showCreateFormProblem = function(){
 
    // clear form
    $scope.clearFormProblem();
 
    // change modal title
    $('#modal-problem-title').text("Create New Problem");
 
    // hide update problem button
    $('#btn-update-problem').hide();
 
    // show create problem button
    $('#btn-create-problem').show();
 
}

$scope.clearFormProblem = function(){
    $scope.name = "";
   
}

// create new problem
$scope.createProblem = function(){
 
    $http({
        method: 'POST',
        data: {
               'name_problem':$scope.name
              
        },
        url: 'api/problem/create.php'
    }).then(function successCallback(response) {
 
        // tell the user new problem was created
        Materialize.toast(response.data, 4000);
 
        // close modal
        $('#modal-problem-form').modal('close');
 
        // clear modal content
        $scope.clearFormProblem();
 
        // refresh the list
       
        $scope.moreCity();
        $scope.moreProblem();
        $scope.totalStartup();
    });
}

// retrieve record to fill out the form
$scope.readOneProblem = function(id){
 
    // change modal title
    $('#modal-problem-title').text("Edit Problem");
 
    // show udpate problem button
    $('#btn-update-problem').show();
 
    // show create problem button
    $('#btn-create-problem').hide();
 
    // post id of problem to be edited
    $http({
        method: 'POST',
        data: { 'id' : id },
        url: 'api/problem/read_one.php'
    }).then(function successCallback(response) {
 
        // put the values in form
        $scope.id = response.data[0]["id"];
        $scope.name = response.data[0]["name"];
       
 
        // show modal
        $('#modal-problem-form').modal('open');
    })
    .error(function(data, status, headers, config){
        Materialize.toast('Unable to retrieve record.', 4000);
    });
}


$scope.getAllProblem = function(){
    $http({
        method: 'GET',
        url: 'api/problem/read.php'
    }).then(function successCallback(response) {
        $scope.names = response.data.records;
    });
}


// update problem record / save changes
$scope.updateProblems = function(){
    $http({
        method: 'POST',
        data: {
              'id':$scope.id,
              'name_problem':$scope.name
        },
        url: 'api/problem/update.php'
    }).then(function successCallback(response) {
 
        // tell the user problem record was updated
        Materialize.toast(response.data, 4000);
 
        // close modal
        $('#modal-problem-form').modal('close');
 
        // clear modal content
        $scope.clearFormProblem();
 
        // refresh the problem list
        
                $scope.moreCity();
        $scope.moreProblem();
        $scope.totalStartup();
    });
}


// delete problem
$scope.deleteProblem = function(id){
 
    // ask the user if he is sure to delete the record
    if(confirm("Are you sure?")){
 
        $http({
            method: 'POST',
            data: { 'id' : id },
            url: 'api/problem/delete.php'
        }).then(function successCallback(response) {
 
            // tell the user problem was deleted
            Materialize.toast(response.data, 4000);
 
            // refresh the list
             $scope.moreCity();
        $scope.moreProblem();
        $scope.totalStartup();
        });
    }
}

$scope.showDetailsStartup = function(){
      $('#modal-startup-title-detail').text("Startup Details");
    
}


/*This starts the Startup functions*/


$scope.showCreateFormStartup = function(){
 
    // clear form
    $scope.clearFormStartup();
 
    // change modal title
    $('#modal-startup-title').text("Create New Startup");
 
    // hide update startup button
    $('#btn-update-startup').hide();
 
    // show create startup button
    $('#btn-create-startup').show();

        $scope.getAllStartup();

        $scope.moreCity();
        $scope.moreProblem();
        $scope.totalStartup();
        
      

  
}

// clear variable / form values
$scope.clearFormStartup = function(){
    $scope.name = "";
    $scope.pitch = "";
    $scope.city = "";
    $scope.state = "";
    $scope.problem = "1";
    $scope.info = "";
    $scope.name_founder = "";
    $scope.url_founder = "";
    $scope.date_born="";
    $scope.date_fail="";
    $scope.investiment="";

}

// create new startup
$scope.createStartup = function(){
 
    $http({
        method: 'POST',
        data: {
               'name_startup':$scope.name, 
               'pitch':$scope.pitch, 
               'city':$scope.city, 
               'state':$scope.state, 
               'id_problem':$scope.problem,
               'more_info':$scope.info,
               'name_founder':$scope.name_founder,
               'url_founder':$scope.url_founder,
               'date_born':$scope.date_born,
               'date_fail':$scope.date_fail,
               'investiment': $scope.investiment
        },
        url: 'api/startup/create.php'
    }).then(function successCallback(response) {
 
        // tell the user new startup was created
        Materialize.toast(response.data, 4000);
 
        // close modal
        $('#modal-startup-form').modal('close');
 
        // clear modal content
        $scope.clearFormStartup();
 
        // refresh the list
        $scope.getAllStartup();

        $scope.moreCity();
        $scope.moreProblem();
        $scope.totalStartup();
    });
}

// retrieve record to fill out the form
$scope.readOneStartup = function(id){
 
    // change modal title
    $('#modal-startup-title-detail').text("Startup details");
 
    // show udpate problem button
   // $('#btn-update-startup').show();
 
    // show create prodproblemuct button
   //$('#btn-create-startup').hide();
 
    // post id of problem to be edited
    $http({
        method: 'POST',
        data: { 'id' : id },
        url: 'api/startup/read-one.php'
    }).then(function successCallback(response) {
 
        // put the values in form
        $scope.id = response.data[0]["id"];
        $scope.name = response.data[0]["name"];
        $scope.pitch = response.data[0]["pitch"];
        $scope.city = response.data[0]["city"];
        $scope.state = response.data[0]["state"];
        $scope.info = response.data[0]["info"];
        $scope.name_founder = response.data[0]["name_founder"];
        $scope.url_founder = response.data[0]["url_founder"];
        $scope.date_born = response.data[0]["date_born"];
        $scope.date_fail = response.data[0]["date_fail"];
        $scope.id_problem = response.data[0]["id_problem"];
        $scope.name_problem = response.data[0]["name_problem"];
        $scope.investiment = response.data[0]["investiment"];
        $scope.date_include = response.data[0]["date_include"];

        // show modal
        $('#modal-startup-detail').modal('open');
    })
    .error(function(data, status, headers, config){
        Materialize.toast('Unable to retrieve record.', 4000);
    });
}

$scope.getAllStartup = function(){
    $http({
        method: 'GET',
        url: 'api/startup/read.php'
    }).then(function successCallback(response) {
        $scope.names = response.data.records;
    });
}

// update startup record / save changes
$scope.updateStartup = function(){
    $http({
        method: 'POST',
        data: {
               'id':$scope.id,
               'name_startup':$scope.name, 
               'pitch':$scope.pitch, 
               'city':$scope.city, 
               'state':$scope.state, 
               'id_problem':$scope.problem,
               'more_info':$scope.info,
               'name_founder':$scope.name_founder,
               'url_founder':$scope.url_founder,
               'date_born':$scope.date_born,
               'date_fail':$scope.date_fail,
               'investiment': $scope.investiment
        },
        url: 'api/startup/update.php'
    }).then(function successCallback(response) {
 
        // tell the user startup record was updated
        Materialize.toast(response.data, 4000);
 
        // close modal
        $('#modal-startup-form').modal('close');
 
        // clear modal content
        $scope.clearFormStartup();
 
        // refresh the startup list
        $scope.getAllStartup();
         $scope.moreCity();
        $scope.moreProblem();
        $scope.totalStartup();
    });
}

// delete startup
$scope.deleteStartup = function(id){
 
    // ask the user if he is sure to delete the record
    if(confirm("Are you sure?")){
 
        $http({
            method: 'POST',
            data: { 'id' : id },
            url: 'api/startup/delete.php'
        }).then(function successCallback(response) {
 
            // tell the user problem was deleted
            Materialize.toast(response.data, 4000);
 
            // refresh the list
                    $scope.moreCity();
        $scope.moreProblem();
        $scope.totalStartup();
            $scope.getAllStartup();
        });
    }
}

$scope.totalStartup = function(id){
 
    
   $http({
        method: 'GET',
        url: 'api/startup/total-startup.php'
    }).then(function successCallback(response) {
        $scope.num_rows = response.data[0]["num_rows"];
    });
}
  
$scope.moreProblem = function(id){
 
    
   $http({
        method: 'GET',
        url: 'api/startup/more-problem.php'
    }).then(function successCallback(response) {
        $scope.more_problem = response.data[0]["name_problem"];
    });
}

$scope.moreCity = function(id){
 
    
   $http({
        method: 'GET',
        url: 'api/startup/more-city.php'
    }).then(function successCallback(response) {
        $scope.more_city = response.data[0]["city"];
    });
}



});
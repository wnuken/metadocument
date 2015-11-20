

var $tableUser = $('table#tableUser');

var adminUserApp = angular.module('adminUserApp',[]);

adminUserApp.controller('adminUserController', ['$scope', function($scope) {

$scope.formVisivility = false;
$scope.newUser = {};
var params = {
	url: 'lista-usuarios',
};

	$.ajax({
		type: "POST",
		url: params.url,
		dataType: 'json',
		async: false,
		cache: true,
		success: function(response) {
			$scope.AdminUsers = response.AdminUsers;
			$scope.formVisivility = true;
        },
        error: function(e) {
        	var message = "Rayos parece que no puedo validar los datos";
        	console.log(e);
        }
    });

    $scope.Save = function(){


    	console.log($scope.newUser.name);
    	/*var user = $scope.newUser.user;
		var pass1 = $scope.newUser.name;
		var pass2 = $('#pass2', $createUserForm).val();
		var name = $('#name', $createUserForm).val();
		var email = $('#email', $createUserForm).val();
		var folder_id = $('#folder_id', $createUserForm).val();

    	if(user == '' || pass1 == '' || pass2 == '' || name == '' || email == '' || folder_id == ''){
		console.log('no se valida');
		$createUserMessages.html("<div class='alert alert-danger alert-dismissible' role='alert'>" +
			"<button type='button' class='close' data-dismiss='alert' aria-label='Close'>" +
				"<span aria-hidden='true'>&times;</span></button><strong>Por vafor llene los campos vacíos </strong></div>");
		return false;
		
	};*/



    	$scope.AdminUsers.push({
		Name:$scope.newUser.name, User: $scope.newUser.user
		});
    };


   
}]);








var $createUser = $('div#createUser');
var $createUserForm = $('form#createUserForm', $createUser);
var $createUserFormButton = $('button#createUserFormButton', $createUser);
var $createUserMessages = $('div#createUserMessages', $createUser);

$.fn.registerUser = function(params){
	var $that = $(this);
	var data = $that.serialize();
	$.ajax({
		type: "POST",
		url: params.url,
		dataType: 'html',
		data: data,
		async: true,
		success: function(response) {
        	$createUserMessages.html("<div class='alert alert-success alert-dismissible' role='alert'>" +
			"<button type='button' class='close' data-dismiss='alert' aria-label='Close'>" +
				"<span aria-hidden='true'>&times;</span></button><strong>Se guardo el usuario correctamente </strong></div>");
        	$that[0].reset();
        },
        error: function() {
        	var message = "Rayos parece que no puedo validar los datos";
        	console.log(message);
        }
    });
};

$createUserFormButton.on('click', function(){
	var params = {
		url: 'register-user-internal'
	};

	var user = $('#user', $createUserForm).val();
	var pass1 = $('#pass1', $createUserForm).val();
	var pass2 = $('#pass2', $createUserForm).val();
	var name = $('#name', $createUserForm).val();
	var email = $('#email', $createUserForm).val();
	var folder_id = $('#folder_id', $createUserForm).val();

	console.log(pass1);
	console.log(pass2);

	if(user == '' || pass1 == '' || pass2 == '' || name == '' || email == '' || folder_id == ''){
		console.log('no se valida');
		$createUserMessages.html("<div class='alert alert-danger alert-dismissible' role='alert'>" +
			"<button type='button' class='close' data-dismiss='alert' aria-label='Close'>" +
				"<span aria-hidden='true'>&times;</span></button><strong>Por vafor llene los campos vacíos </strong></div>");
		return false;
		
	};

	if(pass1 != pass2){
		$createUserMessages.html("<div class='alert alert-danger alert-dismissible' role='alert'>" +
			"<button type='button' class='close' data-dismiss='alert' aria-label='Close'>" +
				"<span aria-hidden='true'>&times;</span></button><strong>Las contraseñas no coinciden </strong></div>");
		return false;

	};

	var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
 
    //Se utiliza la funcion test() nativa de JavaScript
    if (!regex.test(email.trim())) {
        $createUserMessages.html("<div class='alert alert-danger alert-dismissible' role='alert'>" +
			"<button type='button' class='close' data-dismiss='alert' aria-label='Close'>" +
				"<span aria-hidden='true'>&times;</span></button><strong>El correo no es valido </strong></div>");
		return false;
    }


	// console.log('se valida');


	$createUserForm.registerUser(params);

});



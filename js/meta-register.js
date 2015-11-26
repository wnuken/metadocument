
var $createUser = $('div#createUser');
var $createUserForm = $('form#createUserForm', $createUser);
var $createUserMessages = $('div#createUserMessages', $createUser);

var adminUserApp = angular.module('adminUserApp',[]);

adminUserApp.directive("passwordVerify", function() {
	return {
		require: "ngModel",
		scope: {
			passwordVerify: '='
		},
		link: function(scope, element, attrs, ctrl) {
			scope.$watch(function() {
				var combined;

				if (scope.passwordVerify || ctrl.$viewValue) {
					combined = scope.passwordVerify + '_' + ctrl.$viewValue; 
				}                    
				return combined;
			}, function(value) {
				if (value) {
					ctrl.$parsers.unshift(function(viewValue) {
						var origin = scope.passwordVerify;
						if (origin !== viewValue) {
							ctrl.$setValidity("passwordVerify", false);
							return undefined;
						} else {
							ctrl.$setValidity("passwordVerify", true);
							return viewValue;
						}
					});
				}
			});
		}
	};
});

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

		var $inputRol = $('input[name=rol]', $createUser);
		$scope.newUser.rol_id = $inputRol.val();
		var paramSave = {
			url: 'register-user-internal'
		};

		$.ajax({
			type: "POST",
			url: paramSave.url,
			dataType: 'json',
			data: $scope.newUser,
			async: false,
			success: function(response) {

				$scope.AdminUsers.push({
					Id: response.id,
					Name:$scope.newUser.name, 
					User: $scope.newUser.user,
					Email: $scope.newUser.email,
					FolderRoot: $scope.newUser.folder_id
				});

				$createUserMessages.html("<div class='alert alert-success alert-dismissible' role='alert'>" +
					"<button type='button' class='close' data-dismiss='alert' aria-label='Close'>" +
					"<span aria-hidden='true'>&times;</span></button>Se guardo el usuario <strong>" + response.id + "</strong> correctamente </div>");
				$createUserForm[0].reset();
			},
			error: function() {
				var message = "Rayos parece que no puedo validar los datos";
				console.log(message);
			}
		});


	};



}]);

$inputRol.on('click', function(){
	console.log('hola');
});
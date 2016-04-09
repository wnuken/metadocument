
var $createUser = $('div#createUser');
var $updateUser = $('div#updateUser');
var $deleteUser = $('div#deleteUser');
var $createUserForm = $('form#createUserForm', $createUser);
var $updateUserForm = $('form#updateUserForm', $updateUser);
var $deleteUserForm = $('form#deleteUserForm', $deleteUser);
var $createUserMessages = $('div#createUserMessages', $createUser);
var $updateUserMessages = $('div#updateUserMessages', $updateUser);
var $deleteUserMessages = $('div#deleteUserMessages', $updateUser);

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
	$scope.updateUser = {};
	$scope.deleteUser = {};
	$scope.urls = {
		'insert' : 'user-insert',
		'update' : 'user-update',
		'delete' : 'user-delete',
		'list' : 'user-list'
	};
	var params = {
		url: 'lista-usuarios',
	};
	var userindex = 0;

	$.ajax({
		type: "POST",
		url: $scope.urls.list,
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

		$.ajax({
			type: "POST",
			url: $scope.urls.insert,
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

	$scope.Update = function(){

		$.ajax({
			type: "POST",
			url: $scope.urls.update,
			dataType: 'json',
			data: $scope.updateUser,
			async: false,
			success: function(response) {

				$scope.AdminUsers.splice(userindex, 1);


				$scope.AdminUsers.push({
					Id: response.id,
					Name:$scope.updateUser.name, 
					User: $scope.updateUser.user,
					Email: $scope.updateUser.email,
					FolderRoot: $scope.updateUser.folder_id
				});

				$updateUserMessages.html("<div class='alert alert-success alert-dismissible' role='alert'>" +
					"<button type='button' class='close' data-dismiss='alert' aria-label='Close'>" +
					"<span aria-hidden='true'>&times;</span></button>Se actualizo el usuario <strong>" + response.id + "</strong> correctamente </div>");
				$deleteUserForm[0].reset();
			},
			error: function() {
				var message = "Rayos parece que no puedo validar los datos";
				console.log(message);
			}
		});
	};

	$scope.Delete = function(){

		$.ajax({
			type: "POST",
			url: $scope.urls.delete,
			dataType: 'json',
			data: $scope.deleteUser,
			async: false,
			success: function(response) {

				$scope.AdminUsers.splice(userindex, 1);

				$deleteUserMessages.html("<div class='alert alert-success alert-dismissible' role='alert'>" +
					"<button type='button' class='close' data-dismiss='alert' aria-label='Close'>" +
					"<span aria-hidden='true'>&times;</span></button>Se Elimino el usuario <strong>" + response.id + "</strong> correctamente </div>");
				$updateUserForm[0].reset();
			},
			error: function() {
				var message = "Rayos parece que no puedo validar los datos";
				console.log(message);
			}
		});
		console.log($scope.deleteUser);
	};

	$('#showEditUser').on('show.bs.modal', function (event) {
		var $that = $(this);
		var button = $(event.relatedTarget);
		var $inputRol = $('input[name=rol]', $updateUser);
		userindex = button.data('userindex');
		$updateUserMessages.html('');

		$scope.updateUser = {
			'id' : button.data('userid'),
			'user': button.data('userlogin'),
			'name' : button.data('username'),
			'email' : button.data('useremail'),
			'folder_id' : button.data('userfolder'),
			'rol_id' : $inputRol.val()
		};

		$('input#id', $that).val($scope.updateUser.id);
		$('input#user', $that).val($scope.updateUser.user);
		$('input#pass1', $that).val('');
		$('input#pass2', $that).val('');
		$('input#name', $that).val($scope.updateUser.name);
		$('input#email', $that).val($scope.updateUser.email);
		$('input#folder_id', $that).val($scope.updateUser.folder_id);
	});

	$('input[name=rol]', $updateUser).on('change', function(){
		var $that = $(this);
		$scope.updateUser.rol_id = $that.val();
	});

	$('input[name=rol]', $createUser).on('change', function(){
		var $that = $(this);
		$scope.newUser.rol_id = $that.val();
	});

	

	$('#showDeleteUser').on('show.bs.modal', function (event) {
		var $that = $(this);
		var button = $(event.relatedTarget);
		userindex = button.data('userindex');
		$deleteUserMessages.html("");
		$scope.deleteUser.id = button.data('userid');
		$('input#id', $that).val($scope.deleteUser.id);
		$('span#userName').html(button.data('username'));
	});

}]);


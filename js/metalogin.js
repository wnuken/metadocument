/**
* Querido yo en el futuro. Por favor, perdóname. No puedo siquiera empezar a expresar cuando lo siento.
*
* author: Brian Sanabria
* @params
*
**/

var $loginForm = $('form#loginForm');
var $chagephrase = $('form#chagephrase');
var $changeForm = $('div#changeform');
var $chageLogin = $('div#chageLogin');

$.fn.postUrl = function(params){
	var $that = $(this);
	var url = "/";
	$.post(params, { url: url }, function(data) {
		$that.html(data);
	});
};

$('input.product_change', $chageLogin).on('change', function(){
	var $that = $(this);
	var value = $that.val();
	var url = './views/form-login-' + value + '.php';
	$changeForm.postUrl(url);	
});

$.fn.GValidate = function(params){
	var $that = $(this);
	var data = $that.serialize();
	console.log(data);
	$.ajax({
		type: "POST",
		url: params.url,
		dataType: 'json',
		data: data,
		async: true,
		success: function(response) {
        	// $('#progress').css({'display':'none'});
            // console.log(response);
            window.location=response.url;
        },
        error: function() {
        	var message = "Rayos parece que no puedo validar los datos";
        	console.log(message);
        }
    });
};

$loginForm.submit(function(e){
	e.preventDefault();
	var params = {};
	$('#progress').css({'display':'block'});
	params.url = ('input#redirecturi', $loginForm).val();
	$loginForm.GValidate(params);
});
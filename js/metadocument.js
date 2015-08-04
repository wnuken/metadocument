var messageError = [
'Los valores no coinciden, intente de nuevo',
'Error al validar',
'Se debe ingresar un valor'
];


var $loginform = $('form#loginform');
var $chagephrase = $('form#chagephrase');
var $changeform = $('div#changeform');
var $chagelogin = $('div#chagelogin');
var $seahfrom = $('form#drivesearh');
var $generalFolder = $('div#generalfolder')
var $propertiesForm = $('form#propertiesForm');
var $multielemt = $('div.multielemt');
var documentId = '';

$.fn.postUrl = function(params){
    var $that = $(this);
    var url = "/";
    $.post(params, { url: url }, function(data) {
        $that.html(data);
	});
};

$.fn.GValidate = function(params){
    var $that = $(this);
    var data = $that.serialize();
    $.ajax({
        type: "POST",
        url: params.url,
        dataType: 'json',
        data: data,
        async: true,
        success: function(response) {
            console.log(response);
            window.location=response.url;
		},
        error: function() {
            var message = "Rayos parece que no puedo validar los datos";
            console.log(message);
		}
	});
};

$.fn.GSearh = function(params){
    var $that = $(this);
    var data = $that.serialize();
    $.ajax({
        type: "POST",
        url: params.url,
        dataType: 'html',
        data: data,
        async: true,
        success: function(response) {
            $('#progress').css({'display':'none'});
            $('div#generalsearhresult').fadeOut("slow", function(){
                $thet = $(this);
                $thet.html('');
                $thet.html(response).fadeIn();
			});
            // window.location=response.url;
		},
        error: function() {
            var message = "Rayos parece que no puedo validar los datos";
            console.log(message);
		}
	});
};

$.fn.ChangePhrase = function(params){
	var $that = $(this);
	var data = $that.serialize();
	$.ajax({
        type: "POST",
        url: params.url,
        dataType: 'json',
        data: data,
        async: true,
        success: function(response) {
            console.log(response);
			if(response.validate == false){
				$('p#messageError').css({"display":"block"}).html(messageError[1]);
			}
		},
        error: function() {
            var message = "Rayos parece que no puedo validar los datos";
            console.log(message);
		}
	});
}

$('input.product_change', $chagelogin).on('change', function(){
    var $that = $(this);
    var value = $that.val();
    var url = './views/form-login-' + value + '.php';
    $changeform.postUrl(url);
	
});

$loginform.submit(function(e){
    e.preventDefault();
    var params = {
        'url' : $('input#redirecturi',$loginform).val()
        /*   'user' : $('input#username',$loginform).val(),
			'type' : $('input#logintype',$loginform).val(),
			'pass' : $('input#password',$loginform).val() */
		};
		
		// if(params.type == 'google'){
		
		$loginform.GValidate(params);
		
		// }else{    }
		
});

$chagephrase.submit(function(e){
	e.preventDefault();
	var $that = $(this);
    var params = {
        'url' : $that.attr('id')
	}
	
	var newPhrase = $('input#newphrse', $that).val();
	var newPhrase1 = $('input#newphrse1', $that).val();
	if(newPhrase == newPhrase1){
		$that.ChangePhrase(params);	
		$('input#newphrse1', $that).closest('div').removeClass('has-error');
		$('p#messageError').css({"display":"none"}).html();
		}else{
		$('input#newphrse1', $that).closest('div').addClass('has-error');
		$('p#messageError').css({"display":"block"}).html(messageError[0]);
	}
	
});


$seahfrom.submit(function(e){
	e.preventDefault();
	var $that = $(this);
	var valueSearh = $('input#query', $that).val();
	var params = {
		url : 'searh'
	};
	if(valueSearh != ''){
		$('#progress').css({'display':'block'});
		$that.GSearh(params);	
	}else{
		console.log(messageError[2]);
	}
	
});

$('a', $generalFolder).on('click', function(e){
	e.preventDefault();
	var $that = $(this);
	var data = {
		"path" : $that.attr('data-g-id'),
		"url" : "searh"
	};
	
	if(data.path != ''){
		$('#progress').css({'display':'block'});
		$.ajax({
		type: "POST",
		url: data.url,
		dataType: 'html',
		data: data,
		async: true,
		success: function(response) {
			$('#progress').css({'display':'none'});
			$('div#generalsearhresult').fadeOut("slow", function(){
				$thet = $(this);
				$thet.html('');
				$thet.html(response).fadeIn();
			});
		},
		error: function() {
			var message = "Rayos parece que no puedo validar los datos";
			console.log(message);
		}
	});
	}
	
	
});

$('button.buttonProperies').on('click', function(){
	var $that = $(this);
	documentId = $that.attr('data-document-id');
});

$('#myModal').on('shown.bs.modal', function () {
    $('input#fileId', $propertiesForm).val(documentId);
   //$('input#fileId', $propertiesForm).attr('value':documentId);
});

$('div.toelement', $multielemt).on('click', function(){
	console.log('hola');
	var $that = $(this);
	$that.fadeOut('slow', function(){
		$thatSib = $that.siblings('div');
		$thatSib.fadeIn('slow');
	});
});
















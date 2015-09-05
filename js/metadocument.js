var $loginform = $('form#loginform');
var $chagephrase = $('form#chagephrase');
var $changeform = $('div#changeform');
var $chagelogin = $('div#chagelogin');
var $seahfrom = $('form#drivesearh');
var $generalFolder = $('div#generalfolder')
var $metaDAtaForm = $('form#metaDAtaForm');
var $multielemt = $('div.multielemt');
var $uploadFileForm = $('form#uploadFileForm');
var $registerform = $('form#register');
var documentId = '';
var descriptionText = '';

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

$.fn.setPropeties = function(params){
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
		},
		error: function() {
			var message = "Rayos parece que no puedo validar los datos";
			console.log(message);
		}
	});
};


$.fn.uploadFile = function(params){
	var $that = $(this);

	var data = new FormData($that[0]);

	$.ajax({
		type: "POST",
		url: params.url,
		dataType: 'json',
		data: data,
		cache: false,
		contentType: false,
		processData: false,
		success: function(response) {
			console.log(response);
		},
		error: function() {
			var message = "Rayos parece que no puedo validar los datos";
			console.log(message);
		}
	});
};


$('input.product_change', $chagelogin).on('change', function(){
	var $that = $(this);
	var value = $that.val();
	var url = './views/form-login-' + value + '.php';
	$changeform.postUrl(url);
	
});

$loginform.submit(function(e){
	e.preventDefault();
	$('#progress').css({'display':'block'});
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

function pagesearh(that){
//$('a#nextpage').on('click', function(e){
	$('#progress').css({'display':'block'});
	var $that = $(that);
	var data = {
		"pageToken" : $that.attr('data-g-id'),
		"parents" : $that.attr('data-g-parents')
	}
	//console.log(data);
	var params = {
		url : 'searhpage'
	};
	/* e.preventDefault();
	var $that = $(that);
	var valueSearh = $('input#query', $that).val();
	var params = {
		url : 'searhpage'
	};
	var data = {
		"pageToken" : $that.attr('data-g-id')
	}
	*/
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

/*function datasearhGD(idPath, element){
//$('a', $generalFolder).on('click', function(e){
	element.preventDefault;
	var $that = $(element);
	var data = {
		"path" : idPath,
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
};*/

function loadigPage(){
	$('#progress').css({'display':'block'});
};


$registerform.submit(function(e){
	e.preventDefault();
	var $that = $(this);
	var params = {
		url : 'register-user'
	};
	var data = $that.serialize();

	$('#progress').css({'display':'block'});

	$.ajax({
		type: "POST",
		url: params.url,
		dataType: 'html',
		data: data,
		async: true,
		success: function(response) {
			// $('#progress').css({'display':'none'});
			window.location='/';
			/*$('div#registerResult').fadeOut("slow", function(){
				$thet = $(this);
				$thet.html('');
				$thet.html(response).fadeIn();
			});*/
		},
		error: function() {
			var message = "Rayos parece que no puedo validar los datos";
			console.log(message);
		}
	});



	
});


$('button.buttonProperies').on('click', function(){
	var $that = $(this);
	documentId = $that.attr('data-document-id');
	descriptionText = $('#data-description', $that).text();
});


$('div.toelement', $multielemt).on('click', function(){
	console.log('hola');
	var $that = $(this);
	$that.fadeOut('slow', function(){
		$thatSib = $that.siblings('div');
		$thatSib.fadeIn('slow');
	});
});


$('button#save', $uploadFileForm).on('click', function(e){
	e.preventDefault();
	var params = {
		"url" : "uploadfile"
	}
	console.log(params);
	$uploadFileForm.uploadFile(params);
});

$('.btn-file').on('change', function() {
	var input = $(this),
	numFiles = input.get(0).files ? input.get(0).files.length : 1,
	label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        // input.trigger('fileselect', [numFiles, label]);
        console.log(numFiles);
        console.log(label);
    });

/* Begin Again - Aprobado */

/* Errors*/

VALIDATE_ERROR_MG = 'Rayos parece que no puedo validar los datos';
SAVE_FOLDER_MG = 'Parece que no se pudo crear la carpeta';
SAVE_META_DATA_MG = 'No se logro incluir los metadatos';
var errorMessages = {
	'validate_error': VALIDATE_ERROR_MG,
	'save_folder_error':SAVE_FOLDER_MG,
	'meta_data_error': SAVE_META_DATA_MG
}

/* Variables */

var $modalAddFolder = $('div#modalAddFolder');


var $createFormModal = $('div#createFormModal');
var $createFormBody = $('div#createFormBody', $createFormModal);
var $createForm = $('form#createForm', $createFormBody);

var $metaDataModal = $('div#metaDataModal');
var $metaDataBody = $('div#metaDataBody', $metaDataModal);
var $metaDataForm = $('form#metaDataForm', $metaDataBody);
var idDocument = '';

/* PageSearh */
var documentHeight = $(document).height();

$(window).scroll(function(){
	documentHeight = $(document).height();
	if($(window).scrollTop() + $(window).height() == documentHeight) {
		var data = {
			"pageToken" : $('div#addFolder').attr('data-token'),
			"parents" : $('div#addFolder').attr('data-parent')
		}

		if(data.pageToken !== undefined && data.pageToken != ''){
			$('#progress-mini').css({'display':'block'});
			var $listDocument = $('div#list-document');
			var params = {
				url : 'searhpage'
			};

			$.ajax({
				type: "POST",
				url: params.url,
				dataType: 'json',
				data: data,
				async: true,
				success: function(response) {
					$('#progress-mini').css({'display':'none'});
					$('div#addFolder').attr('data-token', response.pageToken);
					$(response.html).appendTo($listDocument);
					documentHeight = $(document).height();
				},
				error: function() {
					$('#progress-mini').css({'display':'none'});
					var message = errorMessages.validate_error;
					console.log(message);
				}
			});
		}
	}
});

/* AddFolder */
$('#addFolderBt', $modalAddFolder).on('click', function(){
	var $thisForm = $('form#addfolderForm', $modalAddFolder);
	
	var params = {
		'url': 'new-folder'
	};

	var data = {
		'title': $('input#title', $thisForm).val(),
		'parentId': $("div#addFolder").attr("data-parent")
	}

	if(data.title != ''){
		$.ajax({
			type: "POST",
			url: params.url,
			dataType: 'json',
			data: data,
			async: true,
			success: function(response) {
				var AddFoldermessageSuccess = '<div class="alert alert-success alert-dismissible" role="alert">' +
				'<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
				'<span aria-hidden="true">&times;</span></button><strong>Se creó la carpeta:</strong> '+ response.title + '</div>';
				$(AddFoldermessageSuccess).appendTo($('div#addFolderError'));
			},
			error: function() {
				var messageError = '<div class="alert alert-warning alert-dismissible" role="alert">' +
				'<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
				'<span aria-hidden="true">&times;</span></button><strong>Alerta!</strong> '+ errorMessages.save_folder_error + ' </div>';
				$(messageError).appendTo($('div#addFolderError'));
			}
		});
	}else{
		var messageError = '<div class="alert alert-danger alert-dismissible" role="alert">' +
		'<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
		'<span aria-hidden="true">&times;</span></button><strong>Error!</strong> La carpeta debe tener un nombre</div>';
		$(messageError).appendTo($('div#addFolderError'));
	}



});

$createFormModal.on('shown.bs.modal', function () {

	var idFolder = $('div#addFolder').attr('data-parent');
	$('input#id', $createForm).val(idFolder);

	var params = {
			url: "get-metadata-fields",
			data: {
				id : idFolder
			}
		};
	$.ajax({
        type: "POST",
        url: params.url,
        dataType: 'json',
        data: params.data,
        async: true,
        success: function(response) {
            $(response.message).appendTo($('div#createFormMessages', $createFormBody));
        },
        error: function() {
            
        }
    });



	
});

$createFormModal.on('hidden.bs.modal', function () {
	$('div#createFormMessages', $createFormBody).html('');
});


$('button#add', $createForm).on('click', function(){
	$that = $(this);
	$that.button('loading');
	var valuesForm = $createForm.serialize();

	var params = {
		url: "create-form",
		data: valuesForm
	};

	$.ajax({
		type: "POST",
		url: params.url,
		dataType: 'json',
		data: params.data,
		async: true,
		success: function(response) {
			$that.button('reset');
          	$(response.message).appendTo($('div#createFormMessages', $createFormBody));
      	},
      	error: function() {
      		$that.button('reset');
      		var messageError = '<div class="alert alert-warning alert-dismissible" role="alert">' +
      		'<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
      		'<span aria-hidden="true">&times;</span></button><strong>Alerta!</strong> '+ errorMessages.validate_error + ' </div>';
      		$(messageError).appendTo($('div#createFormMessages', $createFormBody));
      	}
  	});
});

function removeMataDataField(element){
	var $that = $(element);

	var params = {
			url: "remove-metadata-field",
			data: {
				metaid : $that.attr('data-position-id'),
				id : $('div#addFolder').attr('data-parent'),
			}
		};

	$.ajax({
        type: "POST",
        url: params.url,
        dataType: 'json',
        data: params.data,
        async: true,
        success: function(response) {
          	$(response.message).appendTo($('div#createFormMessages', $createFormBody));
        },
        error: function() {
            
        }
    });

};

function loadDocumentId(id){
	idDocument = id;
};

$metaDataModal.on('shown.bs.modal', function () {
	var params = {
			url: "get-metadata-form",
			data: {
				id : $('div#addFolder').attr('data-parent'),
				elementId : idDocument
			}
		};
	$.ajax({
        type: "POST",
        url: params.url,
        dataType: 'json',
        data: params.data,
        async: true,
        success: function(response) {
            $(response.message).appendTo($metaDataForm);
        },
        error: function() {
            
        }
    });
});

$metaDataModal.on('hide.bs.modal', function () {
	$metaDataForm.html('');
	$('div#metaDataMessages', $metaDataBody).html('');
});

$('button#savedata', $metaDataModal).on('click', function(){
	$that = $(this);
	$that.button('loading');
	$metaDataForm = $('form#metaDataForm');

	var valuesForm = $metaDataForm.serialize();
		
		var params = {
			url: "save-metada",
			data: valuesForm
		};
		
		$('div#metaDataMessages', $metaDataModal).html('');

		$.ajax({
        type: "POST",
        url: params.url,
        dataType: 'json',
        data: params.data,
        async: true,
        success: function(response) {
        	$that.button('reset');
            $(response.message).appendTo($('div#metaDataMessages', $metaDataModal));
        },
        error: function() {
            $that.button('reset');
        }
    });

	console.log(valuesForm);
});

/*var $metaDataModal = $('div#metaDataModal');
var $metaDataBody = $'div#metaDataBody', $metaDataModal);
var $metaDataForm = $('form#metaDataForm', $metaDataBody);*/



/* Fin aprobado */




/*


$('button#save', $metaDataModal).on('click',function(){
	var dataform = $metaDataForm.serialize();
	//var CKedit = CKEDITOR.instances.editor1.getData();
	console.log(CKedit);

	var data = {
		'description': $('input#description', $metaDataForm).val(),
		'text': 'CKedit',
		'fileId': $('input#fileId', $metaDataForm).val()
	};

	console.log(data);

	var params = {
		url : 'metadata-save'
	};
	$('#progress').css({'display':'block'});

	$.ajax({
		type: "POST",
		url: params.url,
		dataType: 'json',
		data: data,
		async: true,
		success: function(response) {
			$('#progress').css({'display':'none'});
			var AddFoldermessageSuccess = '<div class="alert alert-success alert-dismissible" role="alert">' +
			'<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
			'<span aria-hidden="true">&times;</span></button><strong>Se guardaron los metadatos correctamente</strong></div>';
			$(AddFoldermessageSuccess).appendTo($('div#MetaDataError'));
		},
		error: function() {
			var AddFoldermessageError = '<div class="alert alert-warning alert-dismissible" role="alert">' +
			'<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
			'<span aria-hidden="true">&times;</span></button><strong>Alerta!</strong> '+ errorMessages.meta_data_error + ' </div>';
			$(AddFoldermessageError).appendTo($('div#MetaDataError'));
		}
	});

});*/






/*$('button#save', $metaDAtaForm).on('click', function(e){
	e.preventDefault();
	var params = {
		"url" : "setpropeties"
	}
	console.log(params);
	$metaDAtaForm.setPropeties(params);
});*/
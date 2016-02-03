var $loginform = $('form#loginform');
var $chagephrase = $('form#chagephrase');
var $changeform = $('div#changeform');
var $chagelogin = $('div#chagelogin');
var $seahfrom = $('form#drivesearh');
var $generalFolder = $('div#generalfolder')
var $metaDAtaForm = $('form#metaDAtaForm');
var $multielemt = $('div.multielemt');
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
	$seahfrom.addClass('hidden');
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
/*$('#addFolderBt', $modalAddFolder).on('click', function(){
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
});*/

/*$createFormModal.on('show.bs.modal', function () {

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
});*/


/*$('button#add', $createForm).on('click', function(){
	$that = $(this);
	$that.button('loading');
	var valuesForm = $createForm.serialize();
	var nameField = $('input#name', $createForm).val();

	var params = {
		url: "create-form",
		data: valuesForm
	};

	if(nameField != ''){
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
      		'<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
      		'<span aria-hidden="true">&times;</span></button><strong>Alerta!</strong> '+ errorMessages.validate_error + ' </div>';
      		$(messageError).appendTo($('div#createFormMessages', $createFormBody));
      	}
  	});
	}else{
		$that.button('reset');
		var messageError = '<div class="alert alert-warning alert-dismissible" role="alert">' +
      		'<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
      		'<span aria-hidden="true">&times;</span></button><strong>Debes darle un nombre al MetaDato!</strong></div>';
      		$(messageError).appendTo($('div#createFormMessages', $createFormBody));
	}
});*/


function loadDocumentId(id){
	idDocument = id;
};

/*$metaDataModal.on('show.bs.modal', function () {
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
});*/


function loadFormDataModal(){
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
            //$(response.message).appendTo($metaDataForm);
            $metaDataForm.html(response.message);
        },
        error: function() {
            
        }
    });
}

/*$metaDataModal.on('hide.bs.modal', function () {
	$metaDataForm.html('');
	$('div#metaDataMessages', $metaDataBody).html('');
});*/

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
            console.log(response);
        },
        error: function() {
            $that.button('reset');
        }
    });

	console.log(valuesForm);
});

function fieldMetadata(element){
	var $that = $(element);
	var $parentInput = $that.parent().parent().parent();
	$parentInput.remove();
	//console.log($parentInput);
};

var $modalDetailFile = $("div#modalDetailFile");
function loadinfoDocument(element){
	var $that = $(element);
	var dateCreateFile = $that.attr('data-create-file');
	var dateUpdateFile = $that.attr('data-update-file');
	var dateDescriptionFile = $that.attr('data-description-file');
	$('div#DetailFileBody', $modalDetailFile).html(dateCreateFile);
	$('div#DetailFileBody', $modalDetailFile).append(dateUpdateFile);
	$('div#DetailFileBody', $modalDetailFile).append(dateDescriptionFile);
	$modalDetailFile.modal('show');

};

$modalAvanceSearh = $('div#modalAvanceSearh');
$AvanceSearhMessages = $('div#AvanceSearhMessages', $modalAvanceSearh);
$AvanceSearhForm = $('form#AvanceSearhForm', $modalAvanceSearh);

/*function AvanceSearhgetForm() {
	var params = {
		url: "get-metadata-form",
		data: {
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
			$('div#AvanceSearhDates',$AvanceSearhForm).html(response.message);
			if(response.ismetadata !== true){
				 $('div#text_button', $AvanceSearhForm).css('display','none');
			}
			//$(response.message).appendTo($('div#AvanceSearhDates',$AvanceSearhForm));
		},
		error: function() {

		}
	});
};*/

//$formVariables = $('form#formVariables');
//$AvanceSearhForm = $('form#AvanceSearhForm');

/*function loadinput(idElement){
	$('div.input-group', $AvanceSearhForm).css('display', 'none');
	$('div#' + idElement + '-group').css('display', '');
	if(idElement == 'all'){
   		$('input#uses', $AvanceSearhForm).attr('value', '0');
	}else{
		$('input#uses', $AvanceSearhForm).attr('value', '1');
   	}
};

function loadinputkey(idElement){

}

function getvalues(element){

	var $that = $(element).parent().parent();
	var inputDate = '';
	var attrId = '';
	var nameDate = '';
	var nameNumber = '';
	var inputNumber = '';
	var divAppend = '';
	$('input', $that).each(function(index){

		$thet = $(this);

		if(index == 0){
			attrId = $thet.attr('id');
		}
		var attrType = $thet.attr('type');
		var attrPlaceholder = $thet.attr('placeholder');
		var inputVal = $thet.val();

		if(index == 0 && attrType == 'text' && inputVal != ''){
			divAppend = '<div class="alert alert-info alert-dismissible fade in meta-text" role="alert" data-meta-filter="' + attrPlaceholder + ' ' + inputVal + '">' +
			'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>' +
			'<strong>' + attrPlaceholder + ': </strong>' + inputVal +
			'</div>';
	    }

	    if(index == 0 && attrType == 'date' && inputVal != ''){
		  	inputDate = inputVal;
		  	nameDate = $thet.attr('name');
	  	}

		if(index == 1 && attrType == 'date' && inputVal != '' && inputDate != ''){
			inputDate = inputDate + '/' + inputVal;
		}

		if(index == 0 && attrType == 'number' && inputVal != ''){
		  	inputNumber = inputVal;
		  	nameNumber = $thet.attr('name');
	  	}

		if(index == 1 && attrType == 'number' && inputVal != '' && inputNumber != ''){
			inputNumber = inputNumber + '/' + inputVal;
		}


	});

	if(inputDate != ''){
		divAppend = '<div class="alert alert-info alert-dismissible fade in meta-text" role="alert" data-meta-id="'+attrId+'" data-meta-date="' + inputDate + '">' +
		'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>' +
		'<strong>'+ nameDate +': </strong>' + inputDate +
		'</div>';
	}

	if(inputNumber != ''){
		divAppend = '<div class="alert alert-info alert-dismissible fade in meta-text" role="alert" data-meta-id="'+attrId+'" data-meta-number="' + inputNumber + '">' +
		'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>' +
		'<strong>'+ nameNumber +': </strong>' + inputNumber +
		'</div>';
	}
	
	$('div#text_button', $AvanceSearhForm).append(divAppend);
	$('input', $that).val('');
	$that.css('display', 'none');

};*/

/*$('#AvanceSearhButton', $modalAvanceSearh).on('click', function(){
	//$('#progress').css({'display':'block'});
	var valueSearh = [];
	var valueSearhDate = [];
	var valueSearhNumber = [];
	$that = $(this);
	$that.button('loading');
	

	$('div#text_button div.meta-text' , $AvanceSearhForm).each(function(index){
		var $that = $(this);
		var metaFilter = $that.attr('data-meta-filter');
		var metaFilterDate = $that.attr('data-meta-date');
		var metaFilterNumber = $that.attr('data-meta-number');
		var metaFilterId = $that.attr('data-meta-id');
		if(typeof metaFilter != 'undefined'){
			valueSearh.push(metaFilter);	
		}

		if(typeof metaFilterDate != 'undefined'){
			valueSearhDate.push({'id':metaFilterId,'date':metaFilterDate});
		}
		
		if(typeof metaFilterNumber != 'undefined'){
			valueSearhNumber.push({'id':metaFilterId,'number':metaFilterNumber});
		}
		
	});

	var params = {
		url: "advanced-search",
		parent: $('input#parent', $AvanceSearhForm).val(),
		title: $('input#title', $AvanceSearhForm).val(),
		content: $('input#content', $AvanceSearhForm).val(),
		metaData: valueSearh,
		metaDataDate: valueSearhDate,
		metaDataNumber: valueSearhNumber
	};

	//$that.button('reset');

	console.log(params);
	$.ajax({
		type: "POST",
		url: params.url,
		dataType: 'json',
		data: params,
		async: true,
		success: function(response) {
			//$('#progress').css({'display':'none'});
			$modalAvanceSearh.modal('hide');
			$that.button('reset');
			$('div#addFolder').attr('data-token', response.pageToken);
			$('div#generalsearhresult').fadeOut("slow", function(){
				var $thet = $(this);
				$thet.html('');
				$thet.html(response.html).fadeIn();
			});
		},
		error: function() {
			$('#progress').css({'display':'none'});
		}
	});
});*/

function searchFormVisible(){
	$seahfrom.removeClass('hidden');
};

var $modalUploadFiles = $('div#modalUploadFiles');
var $uploadFileForm = $('form#uploadFileForm');
var $UploadFilesButton = $('button#UploadFilesButton', $modalUploadFiles);
var $UploadFilesMessages = $('div#UploadFilesMessages', $modalUploadFiles);


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
			if(response.filterDate == ''){
				var divAppend = '<div class="alert alert-info alert-dismissible fade in meta-text" role="alert">' +
					'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>' +
					'<strong>Ocurrio un error al subir el archivo, intenta nuevamente</strong></div>';
				$UploadFilesMessages.append(divAppend);
				$UploadFilesButton.button('reset');
			}else{
				$UploadFilesButton.button('reset');
				$modalUploadFiles.modal('hide');
				$('div#addFolder').attr('data-token', response.pageToken);
				$('div#generalsearhresult').fadeOut("slow", function(){
					var $thet = $(this);
					$thet.html('');
					$thet.html(response.html).fadeIn();
				});
			}
		},
		error: function() {
			var message = "Rayos parece que no puedo validar los datos";
			console.log(message);
		}
	});
};

$UploadFilesButton.on('click', function(e){
	$that = $(this);
	e.preventDefault();
	$that.button('loading');
	var params = {
		"url" : "uploadfile"
	}
	console.log(params);
	$uploadFileForm.uploadFile(params);
});

$(document).ready(function(){
 
	$('.ir-arriba').click(function(){
		$('body, html').animate({
			scrollTop: '0px'
		}, 300);
	});
 
	$(window).scroll(function(){
		if( $(this).scrollTop() > 0 ){
			$('.ir-arriba').slideDown(300);
		} else {
			$('.ir-arriba').slideUp(300);
		}
	});
 
});

var $leftNewFolder = $('div#leftNewFolder');
var $leftNewFolderBody = $('div#leftNewFolderBody', $leftNewFolder);
var $leftNewFolderForm = $('form#leftNewFolderForm', $leftNewFolderBody);
var $leftNewFolderMessages = $('div#leftNewFolderMessages', $leftNewFolder);
var $leftNewFolderButton = $('button#leftNewFolderButton', $leftNewFolder);

var $leftCreateMeta = $('div#leftCreateMeta');
var $leftCreateMetaBody = $('div#leftCreateMetaBody', $leftCreateMeta);
var $leftCreateMetaForm = $('form#leftCreateMetaForm', $leftCreateMetaBody);
var $leftCreateMetaMessages = $('div#leftCreateMetaMessages', $leftCreateMeta);
var $leftCreateMetaButton = $('button#leftCreateMetaButton', $leftCreateMeta);

var $leftAvanceSearh = $('div#leftAvanceSearh');
var $leftAvanceSearhBody = $('div#leftAvanceSearhBody', $leftAvanceSearh);
var $leftAvanceSearhForm = $('form#leftAvanceSearhForm', $leftAvanceSearhBody);
var $leftAvanceSearhMessages = $('div#leftAvanceSearhMessages', $leftAvanceSearh);
var $leftAvanceSearhButton = $('button#leftAvanceSearhButton', $leftAvanceSearh);



$.fn.getMetaDataFields = function(){
	var idFolder = $('div#addFolder').attr('data-parent');
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
        		$leftCreateMetaMessages.html(response.message);
        },
        error: function() {
            
        }
    });
};


var scrollTopElem = 53;
$(window).scroll(function(){
		scrollTopElem = $(this).scrollTop();
		scrollTopElem = scrollTopElem + 53;
});

$('button[data-meta-toggle=left]').on('click', function(){
	var $that = $(this);
	var targetId = $that.attr('data-target');

	// $('div.left-menu').addClass('hidden-element');
	if(targetId == '#leftCreateMeta'){
		$().getMetaDataFields();
	}

	$('div.left-menu').animate({
		left: '-250px'}, 
		300, 
		function(){
			$('div.left-menu').addClass('hidden-element');
			$('div' + targetId).removeClass('hidden-element');
			$('div' + targetId).css('top', scrollTopElem + 'px');
			$('div' + targetId).animate({left: '0px'});
		});

});

$('button[data-meta-close=left]').on('click', function(){
	var $that = $(this);
	var $parentLeft = $that.parent().parent();
	$parentLeft.animate({
		left: '-250px'}, 
		600, 
		function(){
			$parentLeft.addClass('hidden-element');
		});
});

$('div.left-menu-back').on('click', function(){
	var $that = $(this);
	var $parentLeft = $that.parent();
	$parentLeft.animate({
		left: '-250px'}, 
		600, 
		function(){
			$parentLeft.addClass('hidden-element');
		});
});

$leftNewFolderButton.on('click', function(){
	$leftNewFolderButton.button('loading');
	var params = {
		'url': 'new-folder'
	};

	var data = {
		'title': $('input#title', $leftNewFolderForm).val(),
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
				$leftNewFolderButton.button('reset');
				var AddFoldermessageSuccess = '<div class="alert alert-success alert-dismissible" role="alert">' +
				'<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
				'<span aria-hidden="true">&times;</span></button><strong>Se creó la carpeta:</strong> '+ response.title + '</div>';
				$(AddFoldermessageSuccess).appendTo($leftNewFolderMessages);
			},
			error: function() {
				$leftNewFolderButton.button('reset');
				var messageError = '<div class="alert alert-warning alert-dismissible" role="alert">' +
				'<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
				'<span aria-hidden="true">&times;</span></button><strong>Alerta!</strong> '+ errorMessages.save_folder_error + ' </div>';
				$(messageError).appendTo($leftNewFolderMessages);
			}
		});
	}else{
		$leftNewFolderButton.button('reset');
		var messageError = '<div class="alert alert-danger alert-dismissible" role="alert">' +
		'<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
		'<span aria-hidden="true">&times;</span></button><strong>Error!</strong> La carpeta debe tener un nombre</div>';
		$(messageError).appendTo($leftNewFolderMessages);
	}
});


$leftCreateMetaButton.on('click', function(){
	$that = $(this);
	$that.button('loading');
	var valuesForm = $leftCreateMetaForm.serialize();
	var nameField = $('input#name', $leftCreateMetaForm).val();

	var params = {
		url: "create-form",
		data: valuesForm
	};

	console.log(valuesForm);

	if(nameField != ''){
	$.ajax({
		type: "POST",
		url: params.url,
		dataType: 'json',
		data: params.data,
		async: true,
		success: function(response) {
			$that.button('reset');
          	$(response.message).prependTo($leftCreateMetaMessages);
      	},
      	error: function() {
      		$that.button('reset');
      		var messageError = '<div class="alert alert-warning alert-dismissible" role="alert">' +
      		'<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
      		'<span aria-hidden="true">&times;</span></button><strong>Alerta!</strong> '+ errorMessages.validate_error + ' </div>';
      		$(messageError).prependTo($leftCreateMetaMessages);
      	}
  	});
	}else{
		$that.button('reset');
		var messageError = '<div class="alert alert-warning alert-dismissible" role="alert">' +
      		'<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
      		'<span aria-hidden="true">&times;</span></button><strong>Debes darle un nombre al MetaDato!</strong></div>';
      		$(messageError).prependTo($leftCreateMetaMessages);
	}
});

function editMataDataField(element){
	var $that = $(element);
	var $parentInput = $that.parent().parent().parent();
	var $parentElement = $that.parent().parent();

	var params = {
			url: "edit-metadata-field",
			data: {
				metaid : $('input', $parentElement).attr('id'),
				id : $('div#addFolder').attr('data-parent'),
				name : $('input', $parentElement).val()
			}
		};

	$.ajax({
        type: "POST",
        url: params.url,
        dataType: 'json',
        data: params.data,
        async: true,
        success: function(response) {
          	$(response.message).appendTo($leftCreateMetaMessages);
        },
        error: function() {
            
        }
    });
};

function removeMataDataField(element){
	var $that = $(element);
	var $parentInput = $that.parent().parent().parent();
	var $parentElement = $that.parent().parent();
	$parentInput.remove();

	var params = {
			url: "remove-metadata-field",
			data: {
				metaid : $('input', $parentElement).attr('id'),
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
          	$(response.message).appendTo($leftCreateMetaMessages);
        },
        error: function() {
            
        }
    });

};

function AvanceSearhgetForm() {
	var params = {
		url: "get-metadata-form",
		data: {
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
			$('div#AvanceSearhDates',$leftAvanceSearhForm).html(response.message);
			if(response.ismetadata !== true){
				 $('div#text_button', $leftAvanceSearhForm).css('display','none');
			}
			//$(response.message).appendTo($('div#AvanceSearhDates',$AvanceSearhForm));
		},
		error: function() {

		}
	});
};

function loadinput(idElement){
	$('div.input-group', $leftAvanceSearhForm).css('display', 'none');
	$('div#' + idElement + '-group').css('display', '');
	if(idElement == 'all'){
   		$('input#uses', $leftAvanceSearhForm).attr('value', '0');
	}else{
		$('input#uses', $leftAvanceSearhForm).attr('value', '1');
   	}
};

function loadinputkey(idElement){

}

function getvalues(element, metod){

	if(metod == 1){
		var $that = $(element).parent().parent();
	}else{
		var $that = $(element).parent();
	}
	
	var inputDate = '';
	var attrId = '';
	var nameDate = '';
	var nameNumber = '';
	var inputNumber = '';
	var divAppend = '';
	$('input', $that).each(function(index){

		$thet = $(this);

		if(index == 0){
			attrId = $thet.attr('id');
		}
		var attrType = $thet.attr('type');
		var attrPlaceholder = $thet.attr('placeholder');
		var inputVal = $thet.val();

		if(index == 0 && attrType == 'text' && inputVal != ''){
			divAppend = '<div class="alert alert-info alert-dismissible fade in meta-text" role="alert" data-meta-filter="' + attrPlaceholder + ' ' + inputVal + '">' +
			'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>' +
			'<strong>' + attrPlaceholder + ': </strong>' + inputVal +
			'</div>';
	    }

	    if(index == 0 && attrType == 'date' && inputVal != ''){
		  	inputDate = inputVal;
		  	nameDate = $thet.attr('name');
	  	}

		if(index == 1 && attrType == 'date' && inputVal != '' && inputDate != ''){
			inputDate = inputDate + '/' + inputVal;
		}

		if(index == 0 && attrType == 'number' && inputVal != ''){
		  	inputNumber = inputVal;
		  	nameNumber = $thet.attr('name');
	  	}

		if(index == 1 && attrType == 'number' && inputVal != '' && inputNumber != ''){
			inputNumber = inputNumber + '/' + inputVal;
		}


	});

	if(inputDate != ''){
		divAppend = '<div class="alert alert-info alert-dismissible fade in meta-text" role="alert" data-meta-id="'+attrId+'" data-meta-date="' + inputDate + '">' +
		'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>' +
		'<strong>'+ nameDate +': </strong>' + inputDate +
		'</div>';
	}

	if(inputNumber != ''){
		divAppend = '<div class="alert alert-info alert-dismissible fade in meta-text" role="alert" data-meta-id="'+attrId+'" data-meta-number="' + inputNumber + '">' +
		'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>' +
		'<strong>'+ nameNumber +': </strong>' + inputNumber +
		'</div>';
	}
	
	$('div#text_button', $leftAvanceSearhForm).append(divAppend);
	$('input', $that).val('');
	// $that.css('display', 'none');

};

function pressEnter(element, e){
	// console.log(e);
	if (e.keyCode == 13) {
        getvalues(element, e);
        return false;
    }
};


$leftAvanceSearhButton.on('click', function(){
	var valueSearh = [];
	var valueSearhDate = [];
	var valueSearhNumber = [];
	$that = $(this);
	$that.button('loading');

	$('div#text_button div.meta-text' , $leftAvanceSearhForm).each(function(index){
		var $that = $(this);
		var metaFilter = $that.attr('data-meta-filter');
		var metaFilterDate = $that.attr('data-meta-date');
		var metaFilterNumber = $that.attr('data-meta-number');
		var metaFilterId = $that.attr('data-meta-id');
		if(typeof metaFilter != 'undefined'){
			valueSearh.push(metaFilter);	
		}

		if(typeof metaFilterDate != 'undefined'){
			valueSearhDate.push({'id':metaFilterId,'date':metaFilterDate});
		}
		
		if(typeof metaFilterNumber != 'undefined'){
			valueSearhNumber.push({'id':metaFilterId,'number':metaFilterNumber});
		}
		
	});

	var params = {
		url: "advanced-search",
		parent: $('input#parent', $leftAvanceSearhForm).val(),
		title: $('input#title', $leftAvanceSearhForm).val(),
		content: $('input#content', $leftAvanceSearhForm).val(),
		metaData: valueSearh,
		metaDataDate: valueSearhDate,
		metaDataNumber: valueSearhNumber
	};

	$.ajax({
		type: "POST",
		url: params.url,
		dataType: 'json',
		data: params,
		async: true,
		success: function(response) {
			$that.button('reset');
			$('div#addFolder').attr('data-token', response.pageToken);

			$('div.left-menu').animate({
				left: '-250px'}, 
				300, 
				function(){
					$('div.left-menu').addClass('hidden-element');
			});

			$('div#generalsearhresult').fadeOut("slow", function(){
				var $thet = $(this);
				$thet.html('');
				$thet.html(response.html).fadeIn();
			});
		},
		error: function() {
			$that.button('reset');
		}
	});
});

$ReportDocument = $('button#ReportDocument');

$ReportDocument.on('click', function(){

	var params = {
		url: "report-document"
	};

	$.ajax({
		type: "POST",
		url: params.url,
		dataType: 'json',
		data: params,
		async: true,
		success: function(response) {
			$('span', $ReportDocument).html('Archivos');
			// window.location = response.url;
			$('div#generalsearhresult').fadeOut("slow", function(){
				var $thet = $(this);
				$thet.html('');
				$thet.html('<a class="btn btn-danger" href="' + response.url + '" role="button">Descargar</a>');
				$thet.append(response.html).fadeIn();
			});

		},
		error: function() {
			
		}
	});

});

function descargarArchivo(contenidoEnBlob, nombreArchivo) {
  //creamos un FileReader para leer el Blob
  var reader = new FileReader();
  //Definimos la función que manejará el archivo
  //una vez haya terminado de leerlo
  reader.onload = function (event) {
    //Usaremos un link para iniciar la descarga 
    var save = document.createElement('a');
    save.href = event.target.result;
    save.target = '_blank';
    //Truco: así le damos el nombre al archivo 
    save.download = nombreArchivo || 'archivo.dat';
    var clicEvent = new MouseEvent('click', {
      'view': window,
      'bubbles': true,
      'cancelable': true
    });
    //Simulamos un clic del usuario
    //no es necesario agregar el link al DOM.
    save.dispatchEvent(clicEvent);
    //Y liberamos recursos...
    (window.URL || window.webkitURL).revokeObjectURL(save.href);
  };
  //Leemos el blob y esperamos a que dispare el evento "load"
  reader.readAsDataURL(contenidoEnBlob);
  console.log('hola');
};
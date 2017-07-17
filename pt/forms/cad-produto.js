$(function(){
	$("#cad-produto-form").validate();
});

$("#cad-produto-form").submit(function(e){
	e.preventDefault();
	var formData = new FormData(this);
    console.log(formData);
	$.ajax({
        url: 'http://localhost/sysne/api/rest.php',
        type: 'POST',
        data: formData,
        success: function (data) {
            alert(data);
        },
        cache: false,
        contentType: false,
        processData: false,
        xhr: function() {  // Custom XMLHttpRequest
            var myXhr = $.ajaxSettings.xhr();
            if (myXhr.upload) { // Avalia se tem suporte a propriedade upload
                myXhr.upload.addEventListener('progress', function () {
                    /* faz alguma coisa durante o progresso do upload */
                }, false);
            }
        	return myXhr;
        }
    });
});
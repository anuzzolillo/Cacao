var form = document.getElementsByName("Article")[0];
var method = form.attributes[1].value;
var action = form.attributes[0].value;
var markdown = document.querySelector("#markdown");
var textarea = document.querySelector("#html");
	
function keywordPress() {
	textarea.value=markdown.innerHTML;

}

var fn_publish = function(status) {

	var dataString = $("form").serialize();

	$.ajax({
		type: method,
		url: action,
		data: dataString + "&status=" + status,
		success: function(html) {
			console.log(html)
			if (html == 1) {
				console.log("Articulo Creado Correctamente");
				$("form input[type=text], form textarea").val("");
				$(".preview").html("");
				window.location = urlWeb;
			}
		}
	});

}
var fn_UpdateAticle = function() {

	var dataString = $("form").serialize();

	$.ajax({
		type: method,
		url: action,
		data: dataString,
		success: function(html) {
			console.log(html)
			if (html == 1) {
				console.log("Articulo actualizado correctamente");
				window.location = urlWeb;
			}
		}
	});

}

var fn_UpdateAboutPage = function() {

	var dataString = $("form").serialize();

	$.ajax({
		type: method,
		url: action,
		data: dataString,
		success: function(html) {
			console.log(html)
			if (html == 1) {
				console.log("Pagina actualziada correctamente");
				$(".notification-success").fadeIn();
			} else {
				$(".notification-danger").fadeIn();
			}
			setTimeout(function() {
				$(".notification").fadeOut();
			}, 4000);
		}
	});

}

window.onkeydown = keywordPress;
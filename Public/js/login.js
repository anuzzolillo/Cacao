var form = document.getElementsByName("Login")[0];
var method = form.attributes[1].value;
var action = form.attributes[0].value;

var fn_login = function() {

	var dataString = $("form").serialize();

	$.ajax({
		type: method,
		url: action,
		data: dataString,
		success: function(html) {
			if(html > 0) {
				console.log("Sesión Iniciada exitosamente");
				location.reload(true);
			} else if (html == 0) {
				console.log("Contraseña/Usuario no coincide");
				$(".notification").removeClass("notification-warning").addClass("notification-danger");
				$(".notification p").html("Contraseña/Usuario no coincide");
				$(".notification").fadeIn();
			} else if (html < 0) {
				console.log("El usuario no existe");
				$(".notification").removeClass("notification-danger").addClass("notification-warning");
				$(".notification p").html("El usuario no existe");
				$(".notification").fadeIn();
			}
			setTimeout(function() {
				$(".notification").fadeOut();
			}, 4000);
		}
	});

}
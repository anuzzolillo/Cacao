var form = document.getElementsByName("settings")[0];
var alert = $(".notification");
var alertSuccess = $(".notification-success");
var alertDanger = $(".notification-danger");
var action = form.attributes[0].value;
var method = form.attributes[1].value;

var settings_update = function() {
	var dataString = $("form").serialize();

	$.ajax({
		type: method,
		url: action,
		data: dataString,
		success: function(html) {
			if(html>0) {
				alertSuccess.fadeIn();
			} else {
				alertDanger.fadeOut();
			}
			setTimeout(function() {
				alert.fadeOut();
			}, 4000);
		}
	});
}
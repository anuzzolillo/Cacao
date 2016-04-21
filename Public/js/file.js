var open_manager = function() {
	$(".fade").fadeIn();
}
var close_manager = function() {
	$(".fade").fadeOut();
}
$("form").submit(function(e) {
	e.preventDefault();
	var form = $(this);
	var dataString = new FormData(document.getElementById("ajax"));
	var method = form.attr("method");
	var action = form.attr("action");
	var alert = $(".notification");
	var alertSuccess = $(".notification-success");
	var alertDanger = $(".notification-danger");
	dataString.append("dato","valor");
	console.log(dataString);
	$.ajax({
		url: action,
		type: method,
		dataType: "html",
		data: dataString,
		cache: false,
		contentType: false,
		processData: false
	})
	.done(function(html){
		if(html == 1) {
			alertSuccess.fadeIn();
		} else {
			alertDanger.fadeIn();
		}
		$("form input").val("");
		$(".fade").fadeOut();
		window.location.reload();
		setTimeout(function() {
			alert.fadeOut();
		}, 4000);
	});
});
var remove_file = function(id) {
	var method = $(".btn-danger").data("method");
	var action = $(".btn-danger").data("action");
	var dataString = "id=" + id;

	$.ajax({
		type: method,
		url: action,
		data: dataString,
		success: function(html) {
			window.location.reload();
		}
	});
}
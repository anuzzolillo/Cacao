var _elem = $(".switch > .on, .switch > .off");
var status = $("#status").val();

_elem.on("click", function() {
	_elem.removeClass("active");
	$(this).addClass("active");
	
	h = $(this).data("status");
	$("#status").val(h);
});
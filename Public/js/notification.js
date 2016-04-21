var button = $(".notification .close");

button.on("click", function() {
	$(this).parent().parent().fadeOut();
});
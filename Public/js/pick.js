var fn_pick = function(element, item) {
	$(".post-list > ul >li").removeClass("active");
	$(element).addClass("active");

	$("#content").load(urlWeb + "/index.php?id=" + item + " #content");
	console.log(item);
}

var fn_delete = function(item) {
	$.ajax({
		type: 'POST',
		url: urlWeb + '/System/Actions/Articles/delete.php',
		data: 'id=' + item,
		success: function(html) {
			if(html == 1) {
				window.location = urlWeb;
			}
		}
	})
}

var fn_visibility = function(item) {
	$.ajax({
		type: 'POST',
		url: urlWeb + '/System/Actions/Articles/visibility.php',
		data: 'id=' + item,
		success: function(html) {
			if(html == 1) {
				window.location = urlWeb;
			}
		}
	})
}
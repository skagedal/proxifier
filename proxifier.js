$(document).ready(function() {
    $("#create").click(function() {
	$("#info").show();
	var text = $("#proxy").val();
	var link = bookmarklet.replace("PROXY", text);
	$("#bookmarklets").append(
	    '<p class="marg"><a class="bookmarklet" href="' + link + 
		'">Add proxy ' + text + '</a></p>');
    });
    $("#info").hide();
});
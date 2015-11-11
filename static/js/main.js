$(document).ready(function(){
	$('.navbar-toggle').click(function(){
		$('#navbar').toggleClass('nav-toggle');
	});
	$('#notify').click(function(event) {
		event.preventDefault();
		$('#notify-box').toggleClass('hidden');
	});

	if(boss.isMobile()){
		$('#navbar').addClass('nav-toggle');
	}
});

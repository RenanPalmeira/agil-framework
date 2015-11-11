$(document).ready(function(){
	$(".navbar-toggle").click(function(){
		$("#nav_toggle").toggleClass("nav-toggle");
	});

	$(window).scroll(function() {
		var ypos = $(window).scrollTop();

		if (ypos >= 10){
			$('#navbar').css({"background": "#ffffff", "box-shadow": "0 -4px 0px 4px #edeff0,0 2px 4px 0 rgba(0,0,0,0.2)"});
			$('#nav_toggle').css({"color":"#54ACD2"});
			$('#logo').attr( "src","../static/img/logo/falcon_blue.png")
					  .css({"borderRadius" : "50%", 
						"border" : "2px solid #ffffff",
						"borderRadius" : "50%",
					  });;

			$('.icon-bar').each(function(i, el){
				$(el).css({"background": "#54ACD2"});
			});

			$('.link').each(function(i, el){
				$(el).css({"color": "#3BAFDA", "borderColor": "#3BAFDA"});
			});
		}
		else{
			$('#navbar').css({"background":"transparent", "box-shadow": "none"});
			$('#nav_toggle').css({"color": "#ffffff"});
			$('#logo').attr( "src","../static/img/logo/falcon.png")
					  .css({"border":"none",
					  		"transition": "1s all"
					  });

			$('.icon-bar').each(function(i, el){
				$(el).css({"background": "#ffffff"});
			});

			$('.link').each(function(i, el){
				$(el).css({"color": "#ffffff", "borderColor": "#ffffff"});
			});
		}
	});
});
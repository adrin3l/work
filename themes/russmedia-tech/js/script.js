$(window).load(function(){
	  $('.flexslider').flexslider({
	    animation: "fade",
	    directionNav: false,
	    animationLoop: true,
	    slideshow: true,
	    itemWidth: 1170,
	    itemMargin: 0,
	    animationSpeed: 600,
	    minItems: 1,
	    slideshowSpeed: 8000,
	    maxItems: 1,
	    start: function(slider){
	      $('body').removeClass('loading');
	    }
	  });
	  $('.teamslider').flexslider({
	    animation: "slide",
	    animationLoop: false,
	    slideshow: false,
	    itemWidth: 148,
	    touch: false,
	    controlNav: false,
	    itemMargin: 0,
	    animationSpeed: 600,
	    minItems: 2,
	    maxItems: 8,
	    start: function(slider){
	      $('body').removeClass('loading');
	    }
	  });
	  $('#mobile-switch').click(function(){
	  	$('#mobile-menu > ul').slideToggle("fast");
	  });
	  $('#mobile-menu > ul > li > a').click(function(event){
	  	if($(this).siblings('ul').length > 0)
	  	{
	  		$(this).parent().css('background-color','#333333');
	  		event.preventDefault();
	  		$(this).siblings('ul').slideToggle("fast");
	  	}
	  });
	  function toggleLang(){
	  	$('#lang-menu > ul').slideToggle("fast");
	  	$('#lang-menu').toggleClass('active');
	  }
	    $('#lang-switch').click(function(){
	    	toggleLang();
		    $('html').bind('click',function(event){
		    	var tg = event.target;
		    	if($(event.target).parent().parent().parent().attr("id") != 'lang-menu')
		    	{
			    	$('#lang-menu').removeClass('active');
			    	$('#lang-menu > ul').slideUp("fast");
			    	$('html').unbind('click');
		    	}
		    });
	    });
	    var imgH;
	    // Get element holding the video (embed or object)
		var player;

		//Create a simple function and check if player exists
		function play() {
		    if(player) {
		    	alert("playing");
		        player.playVideo();
		    }
		}
	    $('#open-video').click(function(event) {
	    	event.preventDefault();
	    	player = document.getElementById("companyVideo");
	    	imgH = $('#open-video').parent().innerHeight();
	    	$('#incentive').css('min-height',imgH);
	    	$('#open-video').fadeOut('fast', function(){
		    	$('#video').slideDown('slow', function(){
		    		$('#video > iframe').attr('src','http://www.youtube.com/embed/GLQDPH0ulCg?wmode=transparent&autoplay=1&autohide=1&modestbranding=1');
		    	});	    	
		    });
	    });
	    $('#close-video').click(function() {
	    	$('#video > iframe').attr('src','');
	    	$('#video').slideUp('slow', function(){
	    		$('#open-video').fadeIn('slow', function(){
	    			$('#incentive').css('min-height','0px');
	    		});
	    	});
	    });
	});


$(document).ready(function() {
	$(".dropdown dt a").click(function() {
		$(".dropdown dd ul").slideToggle('fast');
		$('#lang-menu').toggleClass('active');
	});
	$(".dropdown dd ul li a").click(function() {
		$(".dropdown dd ul").hide();
	});
	function getSelectedValue(id) {
		return $("#" + id).find("dt a span.value").html();
	}
	$(document).bind('click', function(e) {
		var $clicked = $(e.target);
		if (! $clicked.parents().hasClass("dropdown"))
		{
			$(".dropdown dd ul").slideUp('fast', function (){
				$('#lang-menu').removeClass('active');
			});
		}
	});

	$(".team-thumbs").click(function(event){
		var top = $(window).scrollTop();
		event.preventDefault();
		if(!$(this).hasClass('active'))
		{
			$(".team-tabs").css('display','none');
			$(".team-thumbs").removeClass('active');
			$(this).addClass('active');
			$(".team-tabs[data-tabs='"+$(this).attr("data-tabs")+"']").fadeIn('slow');
		}
		$(window).scrollTop( top );
	});
	$("#arrow-menu").children().click(function(){
		if(!$(this).hasClass('active'))
		{
			$(".arrow-tabs").css('display','none');
			$(this).addClass("active");
			$(this).siblings().removeClass("active");
			$(".arrow-tabs[data-tabs='"+$(this).children(":first").attr("data-tabs")+"']").fadeIn('slow');
		}
	});
}); 
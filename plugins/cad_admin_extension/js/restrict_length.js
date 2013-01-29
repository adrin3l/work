jQuery.fn.stripTags = function() { return this.replaceWith( this.html().replace(/<\/?[^>]+>/gi, '') ); };

var $jq = jQuery.noConflict();
$jq (document).ready(function(){
	
	var post_tl = $jq('#post_tl').val();
	var post_dl = $jq('#post_dl').val();
	var page_tl = $jq('#page_tl').val();
	var page_dl = $jq('#page_dl').val(); 


	if(post_tl || page_tl){
		$jq ("#title").keyup (function (e) {
			//console.log($jq ("#title").val().length);
		    if($jq ("#title").val().length > post_tl || $jq ("#title").val().length > page_tl){

		    	if(post_tl){
		    		title_length = post_tl;
		    	}

		    	
		    	if(page_tl){
		    		title_length = page_tl;
		    	}

		    	console.log($jq("#title_error").val());

		    	$jq ("#title").css('background-color', '#FFEBE8');
		    	$jq ("#title").css('border-color', '#CC0000');
		    	$jq ("#publish").attr('disabled','disabled');
		    	if($jq("#title_error").val() != ''){
		    		$jq ('<p class="description" style="color:red;" id="title_error" >Maximum field length is :'+ title_length+'</p>').insertAfter('#title');
		    	}
		    	else{
					$jq("#title_error").show();
		    	}
		    
		    	
		    }else{

		    	$jq ("#title").css('background-color', '#FFFFFF');
		    	$jq ("#title").css('border-color', '#DFDFDF');
		    	$jq ("#publish").removeAttr('disabled');
		    	$jq ("#title_error").hide();
		    }
		
		    
		});
	}

	if(post_dl || page_dl){
		$jq ("#excerpt").keyup (function (e) {
			//console.log($jq ("#excerpt").val().length);
		    if($jq ("#excerpt").val().length > post_dl || $jq ("#excerpt").val().length > page_dl){

		    	if(post_dl){
		    		excerpt_length = post_dl;
		    	}

		    	
		    	if(page_dl){
		    		excerpt_length = page_dl;
		    	}

		    	console.log($jq("#excerpt_error").val());

		    	$jq ("#excerpt").css('background-color', '#FFEBE8');
		    	$jq ("#excerpt").css('border-color', '#CC0000');
		    	$jq ("#publish").attr('disabled','disabled');
		    	if($jq("#excerpt_error").val() != ''){
		    		$jq ('<p class="description" style="color:red;" id="excerpt_error" >Maximum field length is :'+ excerpt_length+'</p>').insertAfter('#excerpt');
		    	}
		    	else{
					$jq("#excerpt_error").show();
		    	}
		    
		    	
		    }else{

		    	$jq ("#excerpt").css('background-color', '#FFFFFF');
		    	$jq ("#excerpt").css('border-color', '#DFDFDF');
		    	$jq ("#publish").removeAttr('disabled');
		    	$jq ("#excerpt_error").hide();
		    }
		
		    
		});
	}
});
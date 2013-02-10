jQuery( document ).ready( function($) {

	$('#Add_related_link').click(function(){

		var title		=	$("#related_title").val();
		var link		=	$("#related_link").val();
			if( title.length ==0 || link.length ==0 ){
				$("#related_error").html('Complete all fields.');
			}
			else{
				$("#related_error").html("");
				var total_links	=	$("#total_links").val();
				$('#link_list').append("<p style='clear:both;' id='link-"+total_links+"'><span><a class='ntdelbutton' onclick='delete_related_link("+total_links+")'>X</a></span> <span>"+title+"</span><span>:"+link+"</span><input type='hidden' name='links["+total_links+"][title]' value='"+title+"'/> <input type='hidden' name='links["+total_links+"][link]' value='"+link+"'/></p>");
// 		alert('here');
				total_links=parseInt(total_links)+1;
				$("#total_links").val(total_links);
				var title=$("#related_title").val('');
				var link=$("#related_link").val('');
			}
	});

});

function delete_related_link(link_nr){

	jQuery('#link-'+link_nr).remove();
}			
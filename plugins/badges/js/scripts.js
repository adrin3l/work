var $jqb = jQuery.noConflict();
$jqb (document).ready(function(){


		$jqb('[badge-id]').click(function(){
			//alert (badgeid);
			var badgeid = $jqb(this).attr('badge-id');
			//alert (badgeid);
			$jqb('#popup_text-'+badgeid).toggle('slow');
			return false;
		});

		$jqb("#badges").change(function(){
			
			var badgeid = $jqb(this).val();

			$jqb(".badges_box").hide();		
			$jqb("#badge-"+badgeid).show();
		});

// 		$jqb('[copy]').click(function(){

// 			var badgeid = $jqb(this).attr('copy');
// alert(badgeid);
// 		});

// 		$jqb('[copycode]').click(function(){

// 			var badgeid = $jqb(this).attr('copycode');

// 		});
// alert(badgeid);

 	 
		
		// $jqb("#copy-"+BadgeID).zclip({
		// 	path: templateDir + '/js/ZeroClipboard.swf',
		// 	copy:$jqb('#copy_code-'+BadgeID).val(),
		// 	afterCopy:function(){
		// 		$jqb('#copy_code-'+BadgeID).select();	
		// 		return false;
		// 	},
		// });

		//  $jqb('#copy_code-'+BadgeID).zclip({
		// 	path: templateDir + '/js/ZeroClipboard.swf',
		// 	copy:$jqb('#copy_code-'+BadgeID).val(),
		// 	afterCopy:function(){
		// 		$jqb('#copy_code-'+BadgeID).select();
		// 		return false;	
		// 	},
		// });

	});



var $jqb = jQuery.noConflict();
$jqb (document).ready(function(){


		$jqb('#activate_popup').click(function(){

			$jqb('#popup_text').toggle('slow');
			return false;
		});


		 $jqb('#copy').zclip({
			path: templateDir + '/js/ZeroClipboard.swf',
			copy:$jqb('#copy_code').val(),
			afterCopy:function(){
				$jqb('#copy_code').select();	
				return false;
			},
		});

		 $jqb('#copy_code').zclip({
			path: templateDir + '/js/ZeroClipboard.swf',
			copy:$jqb('#copy_code').val(),
			afterCopy:function(){
				$jqb('#copy_code').select();
				return false;	
			},
		});

	});



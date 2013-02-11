var $ns = jQuery.noConflict();	
		$ns (document).ready(function(){
			
			var show_year = $ns('#show_year').attr('show_year');

			if(show_year){

			$ns('.display_news').hide();
				$ns("#display_news_"+show_year).show();

			}
			// alert(show_year);
			$ns('.archive_years').click( function() {

				var year = $ns(this).attr('year');

				$ns('#list_'+year).toggle('slow');

				return false;
			});

		});
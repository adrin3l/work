<?php

// This file is part of the Carrington JAM Theme for WordPress
// http://carringtontheme.com
//
// Copyright (c) 2008-2010 Crowd Favorite, Ltd. All rights reserved.
// http://crowdfavorite.com
//
// Released under the GPL license
// http://www.opensource.org/licenses/gpl-license.php
//
// **********************************************************************
// This program is distributed in the hope that it will be useful, but
// WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. 
// **********************************************************************

if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
if (CFCT_DEBUG) { cfct_banner(__FILE__); }

wp_footer();
$template_url = get_bloginfo('template_url');

if (CFCT_DEBUG) {
?>

<div style="border: 1px solid #ccc; background: #ffc; padding: 20px;">The <code>CFCT_DEBUG</code> setting is currently enabled, which shows the filepath of each included template file. To hide the file paths, edit this setting in the <?php echo CFCT_PATH; ?>functions.php file.</div>

<?php
}

?>
	<div id="footer">
		<p id="comanda">Comanda</p>
		<div id="coloane">
			<?php $link_categories = get_terms('link_category');

				foreach($link_categories as $link_category){

					?>
					<div  class= "col">
						<ul>
						<?php
							$args = array('category'=>$link_category->term_id,
								 'category_before'  => '',
								 'category_after'   => '',
								 'title_li'         => '',
							    
							    'categorize' 		=>0
								);
							wp_list_bookmarks($args);

						?>
						</ul>
					</div>	


					
						<?php

				}
			?>
		
		<div id="logo-footer" class="col">
                        <img alt="logo din footer" src="<?php echo $template_url;?>/images/yumm-footer.png">
                        <p>Yumm.ro este un concept care trebuie sa umple acest spatiu indiferent de ce voi scrie aici.</p>
                        <p>Yumm.ro este un concept care trebuie sa umple acest spatiu indiferent de ce voi scrie aici.</p>
                        <p>Yumm.ro este un concept care trebuie sa umple acest spatiu indiferent de ce voi scrie aici.</p>
                        <br>
                        <p id="copyright">Copyright (c)Yumm.ro 2013. <a href="#">Termeni si conditii.</a></p>
                    </div>

                    </div>
	</div>
</div>
</body>
</html>
<p>Custom Links:</p>
		<p>
			Title	<input type="text" id="related_title" name="related_title" size="30" />
		</p>
		<p>
			Link	<input type="text" id="related_link" name="related_link" size="30" />  
		</p>
		<input type="button" id="Add_related_link" value="Add link" />

		<p id="related_error">
	
		<div id="link_list" class="tagchecklist">
			<input type="hidden" name="total_links" id="total_links" value="<?php echo $total_links?>" />
			<?php 
 				if(!empty($related_links))
					foreach ($related_links as $key=>$link){
				?>
					<p  style='clear:both;'  id="link-<?php echo $key;?>"> 
					<span><a class="ntdelbutton" onclick="delete_related_link(<?php echo $key;?>)">X</a></span>
					<?php echo '<span>'.$link['title'].'</span><span>:'.$link['link'].'</span>';?> 
					<input type="hidden" name="links[<?php echo $key;?>][title]" value="<?php echo $link['title']?>" />
					<input type="hidden" name="links[<?php echo $key;?>][link]" value="<?php echo $link['link']?>" />
					</p>
				<?php
					}
		?>
		</div>
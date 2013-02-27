<div id="search">
	<form method="get" id="searchform" action="<?php echo home_url(); ?>/">
		<p>
			<input type="text" value="<?php _e("Search here...", 'standardpack'); ?>" onfocus="if (this.value == '<?php _e("Search here...", 'standardpack'); ?>' ) { this.value = ''; }" onblur="if (this.value == '' ) { this.value = '<?php _e("Search here...", 'standardpack'); ?>'; }" name="s" id="searchbox" />
			<input type="submit" class="submitbutton" value="GO" />
		</p>
	</form>
</div>
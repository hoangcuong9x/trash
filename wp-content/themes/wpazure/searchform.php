<div class="widget_search w-100">
	<form role="search" class="search-form" action="<?php echo esc_url(home_url('/'));?>">
		<label class="sr-only"><?php esc_html_e("Search for","wpazure");?>:</label>
		<div class="search-input">
		   	<input type="search" name="s" value="" placeholder="<?php esc_attr_e("Search","wpazure");?>&hellip;">
		   	<input type="submit" value="<?php esc_attr_e( 'Search', 'wpazure' ); ?>">
	  	</div>
	</form>
</div>
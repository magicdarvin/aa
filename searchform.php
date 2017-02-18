<form method="get" id="searchform" action="<?php  echo home_url(); ?>/">
	<div id="search-text">
		<?php 
			$gdl_search_text = get_search_query();
			global $gdl_admin_translator;
			
			if( $gdl_admin_translator == 'enable' ) {
				$gdl_default_text = get_option(THEME_SHORT_NAME.'_search_text','Поиск');
			} else {
				$gdl_default_text = __('Поиск','gdl_front_end');
			}
			
			if( empty($gdl_search_text) ) {
				$gdl_search_text = $gdl_default_text;
			} 
		?>
		<input type="text" name="s" id="gdl-search-input" value="Поиск" data-default="Поиск" autocomplete="off" />
		<input type="submit" id="searchsubmit" value="" />
	</div>
	<br class="clear">
</form>

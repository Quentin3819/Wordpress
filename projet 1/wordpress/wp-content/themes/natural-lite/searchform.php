<?php
/**
 * The search form template for our theme.
 *
 * @package Natural Lite
 * @since Natural Lite 1.0
 */

?>

<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
	<label for="s" class="assistive-text"><?php esc_html_e( 'Search', 'natural-lite' ); ?></label>
	<input type="text" class="field" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" id="s" placeholder="<?php esc_attr_e( 'Search Here &hellip;', 'natural-lite' ); ?>" />
	<input type="submit" class="submit" name="submit" id="searchsubmit" value="<?php esc_attr_e( 'Go', 'natural-lite' ); ?>" />
</form>

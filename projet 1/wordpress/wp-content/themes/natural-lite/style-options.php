<?php
/**
 * This template controls the style options.
 *
 * @package Natural Lite
 * @since Natural Lite 1.0
 */

get_header(); ?>

<style type="text/css" media="screen">

	<?php
		$display_title = get_theme_mod( 'natural_lite_site_title', '1' );
		$display_tagline = get_theme_mod( 'header_text', '1' );
	?>

	.container .site-title {
		<?php
		if ( '1' != $display_title ) {
			echo
			'position: absolute;
			left: -9999px;
			margin: 0px;
			padding: 0px;';
		};
		?>
	}

	.container .site-description {
		<?php
		if ( '1' != $display_tagline ) {
			echo
			'position: absolute;
			left: -9999px;
			margin: 0px;
			padding: 0px;';
		};
		?>
	}

	.container .site-title a {
		color: #<?php echo esc_html( $header_text_color ); ?> ;
	}

	<?php if ( 'center' == get_theme_mod( 'title_align', 'center' ) ) { ?>
	.custom-logo-link, .site-title, .site-description, #navigation {
		text-align: center;
	}
	#custom-header .logo-title {
		text-align: center;
		margin: 0px auto 0px;
	}
	<?php } ?>

	<?php if ( 'right' == get_theme_mod( 'title_align', 'center' ) ) { ?>
	.custom-logo-link, .site-title, .site-description, #navigation {
		text-align: right;
	}
	#custom-header .header-img {
		text-align: right;
		justify-content: flex-end;
	}
	<?php } ?>

	<?php if ( 'left' == get_theme_mod( 'title_align', 'center' ) ) { ?>
	.custom-logo-link, .site-title, .site-description, #navigation {
		text-align: left;
	}
	#custom-header .header-img {
		text-align: left;
		justify-content: flex-start;
	}
	<?php } ?>

</style>

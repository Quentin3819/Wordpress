<?php
/**
Template Name: Full Width
 *
 * This template is used to display full-width pages.
 *
 * @package Natural Lite
 * @since Natural Lite 1.0
 */

get_header(); ?>

<!-- BEGIN .post class -->
<div <?php post_class(); ?> id="page-<?php the_ID(); ?>">

	<?php if ( has_post_thumbnail() ) { ?>
		<div class="feature-img banner shadow radius-full"><?php the_post_thumbnail( 'natural-lite-featured-large' ); ?></div>
	<?php } ?>

	<!-- BEGIN .row -->
	<div class="row">

		<!-- BEGIN .sixteen columns -->
		<div class="sixteen columns">

			<!-- BEGIN .post-area full -->
			<div class="post-area full">

				<?php get_template_part( 'loop', 'page' ); ?>

			<!-- END .post-area full -->
			</div>

		<!-- END .sixteen columns -->
		</div>

	<!-- END .row -->
	</div>

<!-- END .post class -->
</div>

<?php get_footer(); ?>

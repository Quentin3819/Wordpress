<?php
/**
 * This template displays the blog.
 *
 * @package Natural Lite
 * @since Natural Lite 1.0
 */

get_header(); ?>

<!-- BEGIN .post class -->
<div <?php post_class(); ?> id="page-<?php the_ID(); ?>">

	<!-- BEGIN .row -->
	<div class="row">

	<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>

		<!-- BEGIN .eleven columns -->
		<div class="eleven columns">

			<!-- BEGIN .post-area -->
			<div class="post-area">

				<?php get_template_part( 'loop', 'blog' ); ?>

			<!-- END .post-area -->
			</div>

		<!-- END .eleven columns -->
		</div>

		<!-- BEGIN .five columns -->
		<div class="five columns">

			<?php get_sidebar( 'blog' ); ?>

		<!-- END .five columns -->
		</div>

	<?php else : ?>

		<!-- BEGIN .sixteen columns -->
		<div class="sixteen columns">

			<!-- BEGIN .post-area full -->
			<div class="post-area full">

				<?php get_template_part( 'loop', 'blog' ); ?>

			<!-- END .post-area full -->
			</div>

		<!-- END .sixteen columns -->
		</div>

	<?php endif; ?>

	<!-- END .row -->
	</div>

<!-- END .post class -->
</div>

<?php get_footer(); ?>

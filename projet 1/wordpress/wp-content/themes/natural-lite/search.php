<?php
/**
 * The search template for our theme.
 *
 * This template is used to display search results.
 *
 * @package Natural Lite
 * @since Natural Lite 1.0
 */

get_header(); ?>

<!-- BEGIN .post class -->
<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<!-- BEGIN .row -->
	<div class="row">

		<?php if ( is_active_sidebar( 'sidebar-1' ) && is_active_sidebar( 'left-sidebar' ) ) : ?>

			<!-- BEGIN .three columns -->
			<div class="three columns">

				<?php get_sidebar( 'left' ); ?>

			<!-- END .three columns -->
			</div>

			<!-- BEGIN .eight columns -->
			<div class="eight columns">

				<!-- BEGIN .post-area -->
				<div class="post-area middle">

					<?php get_template_part( 'loop', 'archive' ); ?>

				<!-- END .post-area -->
				</div>

			<!-- END .eight columns -->
			</div>

			<!-- BEGIN .five columns -->
			<div class="five columns">

				<?php get_sidebar( 'blog' ); ?>

			<!-- END .five columns -->
			</div>

		<?php elseif ( is_active_sidebar( 'left-sidebar' ) ) : ?>

			<!-- BEGIN .three columns -->
			<div class="three columns">

				<?php get_sidebar( 'left' ); ?>

			<!-- END .three columns -->
			</div>

			<!-- BEGIN .thirteen columns -->
			<div class="thirteen columns">

				<!-- BEGIN .post-area -->
				<div class="post-area right">

					<?php get_template_part( 'loop', 'archive' ); ?>

				<!-- END .post-area -->
				</div>

			<!-- END .thirteen columns -->
			</div>

		<?php elseif ( is_active_sidebar( 'sidebar-1' ) ) : ?>

			<!-- BEGIN .eleven columns -->
			<div class="eleven columns">

				<!-- BEGIN .post-area -->
				<div class="post-area">

					<?php get_template_part( 'loop', 'archive' ); ?>

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

					<?php get_template_part( 'loop', 'archive' ); ?>

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

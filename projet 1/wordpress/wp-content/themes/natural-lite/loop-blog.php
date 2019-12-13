<?php
/**
 * This template displays the blog loop.
 *
 * @package Natural Lite
 * @since Natural Lite 1.0
 */

?>

<?php $wp_query = new WP_Query( array( 'cat' => get_theme_mod( 'natural_lite_category_blog', '0' ), 'paged' => $paged ) ); ?>
<?php if ( $wp_query->have_posts() ) : while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>

	<!-- BEGIN .blog-holder -->
	<div class="blog-holder">

		<!-- BEGIN .post class -->
		<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">

			<h2 class="headline"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

			<div class="post-author">
				<p class="align-left"><i class="fa fa-calendar"></i> &nbsp;<?php esc_html_e( 'Posted on', 'natural-lite' ); ?> <?php the_time( esc_html__( 'F j, Y', 'natural-lite' ) ); ?> <?php esc_html_e( 'by', 'natural-lite' ); ?> <?php esc_url( the_author_posts_link() ); ?></p>
				<p class="align-right"><i class="fa fa-comment"></i> &nbsp;<a href="<?php the_permalink(); ?>#comments"><?php comments_number( esc_html__( 'Leave a Comment', 'natural-lite' ), esc_html__( '1 Comment', 'natural-lite' ), '% Comments' ); ?></a></p>
			</div>

			<?php if ( has_post_thumbnail() ) { ?>
				<a class="feature-img" href="<?php the_permalink(); ?>" rel="bookmark" title="<?php echo esc_attr( sprintf( esc_html__( 'Permalink to %s', 'natural-lite' ), the_title_attribute( 'echo=0' ) ) ); ?>"><?php the_post_thumbnail( 'natural-lite-featured-large' ); ?></a>
			<?php } ?>

			<!-- BEGIN .article -->
			<div class="article">
				<?php the_content( esc_html__( 'Read More', 'natural-lite' ) ); ?>
			<!-- END .article -->
			</div>

		<!-- END .post class -->
		</div>

	<!-- END .blog-holder -->
	</div>

<?php endwhile; ?>

	<?php if ( $wp_query->max_num_pages > 1 ) { ?>
		<!-- BEGIN .pagination -->
		<div class="pagination">
			<?php echo natural_lite_get_pagination_links(); ?>
		<!-- END .pagination -->
		</div>
	<?php } ?>

<?php else : ?>

	<div class="error-404">
		<h1 class="headline"><?php esc_html_e( 'No Posts Found', 'natural-lite' ); ?></h1>
		<p><?php esc_html_e( "We're sorry, but no posts have been found. Create a post to be added to this section, and configure your theme options.", 'natural-lite' ); ?></p>
	</div>

<?php endif; ?>
<?php wp_reset_postdata(); ?>

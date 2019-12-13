<?php
/**
 * This template displays the archive loop.
 *
 * @package Natural Lite
 * @since Natural Lite 1.0
 */

?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<!-- BEGIN .post class -->
<div <?php post_class( 'archive-holder' ); ?> id="post-<?php the_ID(); ?>">

	<h2 class="headline small"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

	<div class="post-author">
		<p><i class="fa fa-calendar"></i> &nbsp;<?php esc_html_e( 'Posted on', 'natural-lite' ); ?> <?php the_time( esc_html__( 'F j, Y', 'natural-lite' ) ); ?> <?php esc_html_e( 'by', 'natural-lite' ); ?> <?php esc_url( the_author_posts_link() ); ?></p>
		<p><i class="fa fa-comment"></i> &nbsp;<a href="<?php the_permalink(); ?>#comments"><?php comments_number( esc_html__( 'Leave a Comment', 'natural-lite' ), esc_html__( '1 Comment', 'natural-lite' ), '% Comments' ); ?></a></p>
	</div>

	<?php if ( has_post_thumbnail() ) { ?>
		<a class="feature-img" href="<?php the_permalink(); ?>" rel="bookmark" title="<?php echo esc_attr( sprintf( esc_html__( 'Permalink to %s', 'natural-lite' ), the_title_attribute( 'echo=0' ) ) ); ?>"><?php the_post_thumbnail( 'natural-lite-featured-large' ); ?></a>
	<?php } ?>

	<?php the_excerpt(); ?>

	<!-- BEGIN .post-meta -->
	<div class="post-meta radius-full">

		<p><i class="fa fa-reorder"></i> &nbsp;<?php esc_html_e( 'Category:', 'natural-lite' ); ?> <?php the_category( ', ' ); ?> <?php $tag_list = get_the_tag_list( esc_html__( ', ', 'natural-lite' ) ); if ( ! empty( $tag_list ) ) { ?> &nbsp; &nbsp; <i class="fa fa-tags"></i> &nbsp;<?php esc_html_e( 'Tags:', 'natural-lite' ); ?> <?php the_tags( '' ); } ?></p>

	<!-- END .post-meta -->
	</div>

<!-- END .post class -->
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

<p><?php esc_html_e( 'Sorry, no posts matched your criteria.', 'natural-lite' ); ?></p>

<?php endif; ?>

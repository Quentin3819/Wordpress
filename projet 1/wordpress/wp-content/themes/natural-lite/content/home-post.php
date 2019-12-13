<?php
/**
 * This template is used to display the home post loop.
 *
 * @package Natural Lite
 * @since Natural Lite 1.0
 */

?>

<?php $cat = get_theme_mod( 'natural_lite_category_news', '0' ); ?>
<?php $description = category_description( $cat ); ?>

<?php if ( ! empty( $description ) ) { ?>
	<div class="cat-description text-center"><?php echo $description ?></div>
<?php } ?>

<?php if ( get_query_var( 'paged' ) ) { $paged = get_query_var( 'paged' );
} elseif ( get_query_var( 'page' ) ) { $paged = get_query_var( 'page' );
} else { $paged = 1; } ?>
<?php $query_args = array(
	'cat' => get_theme_mod( 'natural_lite_category_news', '0' ),
	'posts_per_page' => get_theme_mod( 'natural_lite_postnumber_news', '3' ),
	'paged' => $paged,
	); ?>
<?php $news = new WP_Query( $query_args ); ?>
<?php if ( $news->have_posts() ) : while ( $news->have_posts() ) : $news->the_post(); ?>
<?php if ( has_post_thumbnail() ) { $thumb = wp_get_attachment_image_src( get_post_thumbnail_id(), 'natural-lite-featured-medium' ); } ?>
<?php $video = natural_lite_first_embed_media(); ?>

<!-- BEGIN .information -->
<div class="information">

<?php if ( has_post_thumbnail() || ! empty( $video ) ) { ?>

	<!-- BEGIN .six columns -->
	<div class="six columns">

		<?php if ( has_post_thumbnail() ) { ?>
			<a class="feature-img background-cover" style="background-image: url(<?php echo $thumb[0]; ?>);" href="<?php the_permalink(); ?>" rel="bookmark" title="<?php echo esc_attr( sprintf( esc_html__( 'Permalink to %s', 'natural-lite' ), the_title_attribute( 'echo=0' ) ) ); ?>"></a>
		<?php } else { ?>
			<div class="feature-vid"><?php echo $video; ?></div>
		<?php } ?>

	<!-- END .six columns -->
	</div>

	<!-- BEGIN .twelve columns -->
	<div class="ten columns">

		<div class="holder">

		<!-- BEGIN .article -->
		<div class="article">

			<div class="post-author">
				<p class="align-left"><i class="fa fa-calendar"></i> &nbsp;<?php esc_html_e( 'Posted on', 'natural-lite' ); ?> <?php the_time( esc_html__( 'F j, Y', 'natural-lite' ) ); ?></p>
				<p class="align-right"><i class="fa fa-comment"></i> &nbsp;<a href="<?php the_permalink(); ?>#comments"><?php comments_number( esc_html__( 'Comment', 'natural-lite' ), esc_html__( '1 Comment', 'natural-lite' ), '% Comments' ); ?></a></p>
			</div>

			<h2 class="title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

			<div class="excerpt">
				<?php the_excerpt(); ?>
				<a class="button" href="<?php the_permalink(); ?>" rel="bookmark" title="<?php echo esc_attr( sprintf( esc_html__( 'Permalink to %s', 'natural-lite' ), the_title_attribute( 'echo=0' ) ) ); ?>">
					<span><?php esc_html_e( 'Learn More', 'natural-lite' ); ?></span>
				</a>
			</div>

		<!-- END .article -->
		</div>

		</div>

	<!-- END .twelve columns -->
	</div>

<?php } else { ?>

	<!-- BEGIN .sixteen columns -->
	<div class="sixteen columns">

		<!-- BEGIN .article -->
		<div class="article">

			<h2 class="title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

			<div class="excerpt">
				<?php the_excerpt(); ?>
			</div>

			<div class="post-author">
				<p class="align-left"><i class="fa fa-calendar"></i> &nbsp;<?php esc_html_e( 'Posted on', 'natural-lite' ); ?> <?php the_time( esc_html__( 'F j, Y', 'natural-lite' ) ); ?></p>
				<p class="align-right"><i class="fa fa-comment"></i> &nbsp;<a href="<?php the_permalink(); ?>#comments"><?php comments_number( esc_html__( 'Comment', 'natural-lite' ), esc_html__( '1 Comment', 'natural-lite' ), '% Comments' ); ?></a></p>
			</div>

		<!-- END .article -->
		</div>

	<!-- END .sixteen columns -->
	</div>

<?php } ?>

<!-- END .information -->
</div>

<?php endwhile; ?>

<?php if ( $news->max_num_pages > 1 ) { ?>
	<!-- BEGIN .pagination -->
	<div class="pagination">
		<?php
		$big = 999999999; // Need an unlikely integer.
		echo paginate_links( array(
			'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'format' => '?paged=%#%',
			'current' => max( 1, $paged ),
			'prev_text' => esc_html__( '&laquo;', 'natural-lite' ),
			'next_text' => esc_html__( '&raquo;', 'natural-lite' ),
			'total' => $news->max_num_pages,
			)
		);
		?>
	<!-- END .pagination -->
	</div>
<?php } ?>

<?php else : ?>

<!-- BEGIN .article -->
<div class="article">

	<h2 class="title"><?php esc_html_e( 'No Posts Found', 'natural-lite' ); ?></h2>
	<p><?php esc_html_e( "We're sorry, but no posts have been found. Create a post to be added to this section, and configure your theme options.", 'natural-lite' ); ?></p>

<!-- END .article -->
</div>

<?php endif; ?>
<?php wp_reset_postdata(); ?>

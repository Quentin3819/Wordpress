<?php
/**
 * This template displays the page loop.
 *
 * @package Natural Lite
 * @since Natural Lite 1.0
 */

?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<h1 class="headline"><?php the_title(); ?></h1>

<?php the_content( esc_html__( 'Read More', 'natural-lite' ) ); ?>

<?php wp_link_pages(array(
	'before' => '<p class="page-links"><span class="link-label">' . esc_html__( 'Pages:', 'natural-lite' ) . '</span>',
	'after' => '</p>',
	'link_before' => '<span>',
	'link_after' => '</span>',
	'next_or_number' => 'next_and_number',
	'nextpagelink' => esc_html__( 'Next', 'natural-lite' ),
	'previouspagelink' => esc_html__( 'Previous', 'natural-lite' ),
	'pagelink' => '%',
	'echo' => 1,
	)
); ?>

<div class="clear"></div>

<?php edit_post_link( esc_html__( '(Edit)', 'natural-lite' ), '', '' ); ?>

<?php endwhile; else : ?>

<p><?php esc_html_e( 'Sorry, no posts matched your criteria.', 'natural-lite' ); ?></p>

<?php endif; ?>

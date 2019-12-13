<?php
/**
 * This template displays the post loop.
 *
 * @package Natural Lite
 * @since Natural Lite 1.0
 */

?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<h1 class="headline"><?php the_title(); ?></h1>

<div class="post-author">
	<p class="align-left"><i class="fa fa-calendar"></i> &nbsp;<?php esc_html_e("Posted on", 'natural-lite'); ?> <?php the_time( esc_html__("F j, Y", 'natural-lite')); ?> <?php esc_html_e("by", 'natural-lite'); ?> <?php esc_url ( the_author_posts_link() ); ?></p>
	<p class="align-right"><i class="fa fa-comment"></i> &nbsp;<a class="scroll" href="<?php the_permalink(); ?>#comments"><?php comments_number( esc_html__("Leave a Comment", 'natural-lite'), esc_html__("1 Comment", 'natural-lite'), '% Comments'); ?></a></p>
</div>

<?php if ( has_post_thumbnail() ) { ?>
	<div class="feature-img"><?php the_post_thumbnail( 'featured-large' ); ?></div>
<?php } ?>

<!-- BEGIN .article -->
<div class="article">

<?php the_content(); ?>

<?php wp_link_pages(array(
	'before' => '<p class="page-links"><span class="link-label">' . esc_html__('Pages:', 'natural-lite') . '</span>',
	'after' => '</p>',
	'link_before' => '<span>',
	'link_after' => '</span>',
	'next_or_number' => 'next_and_number',
	'nextpagelink' => esc_html__('Next', 'natural-lite'),
	'previouspagelink' => esc_html__('Previous', 'natural-lite'),
	'pagelink' => '%',
	'echo' => 1 )
); ?>

<?php edit_post_link( esc_html__("(Edit)", 'natural-lite'), '', ''); ?>

<!-- BEGIN .post-meta -->
<div class="post-meta radius-full">
	<p><i class="fa fa-reorder"></i> &nbsp;<?php esc_html_e("Category:", 'natural-lite'); ?> <?php the_category(', '); ?> <?php $tag_list = get_the_tag_list( esc_html__( ", ", 'natural-lite' ) ); if ( ! empty( $tag_list ) ) { ?> &nbsp; &nbsp; <i class="fa fa-tags"></i> &nbsp;<?php esc_html_e("Tags:", 'natural-lite'); ?> <?php the_tags(''); } ?></p>
<!-- END .post-meta -->
</div>

<!-- BEGIN .post-navigation -->
<div class="post-navigation">
	<div class="previous-post"><?php previous_post_link('&larr; %link'); ?></div>
	<div class="next-post"><?php next_post_link('%link &rarr;'); ?></div>
<!-- END .post-navigation -->
</div>

<?php if ( comments_open() || '0' != get_comments_number() ) comments_template(); ?>

<div class="clear"></div>

<?php endwhile; else: ?>

<p><?php esc_html_e("Sorry, no posts matched your criteria.", 'natural-lite'); ?></p>

<?php endif; ?>

<!-- END .article -->
</div>

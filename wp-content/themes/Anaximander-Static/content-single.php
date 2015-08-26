<?php

/* Template used for displaying page content in single.php */

?>

<article id="post-<?php the_ID(); ?>" class="group post-container">
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>

		<div class="name-date">
			By <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" title="View all posts by <?php echo get_the_author(); ?>"><?php echo get_the_author(); ?></a> on <time class="entry-date" datetime="<?php echo get_the_date( 'c' ); ?>" pubdate><?php echo get_the_date('F j, Y'); ?></time>
		</div>	
		<?php get_template_part('index-meta'); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		
		<?php 
			// Insert featured image if there is one and the post format is set to 'Image'
			$the_format = get_post_format();
			if ( has_post_thumbnail() && ($the_format == 'image') ) { 
				echo '<figure class="single-thumb">';
				the_post_thumbnail('single-thumb');
				echo '</figure>';
			} 
		?>
		
	
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'anaximander' ), 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->

	<footer class="footer-meta">
		<?php
			/* translators: used between list items, there is a space after the comma */
			$tag_list = get_the_tag_list( '<li>', '</li><li>','</li>' );

			// But this blog has loads of categories so we should probably display them here
			if ( '' != $tag_list ) {
				echo '<ul class="footer-tags">';
				echo '<li class="highlight">Tags:</li> ' . $tag_list;
				edit_post_link( __( 'Edit', 'anaximander' ), '<li class="edit-link">', '</li>' );
				echo '</ul>';

			} 

		?>

		
	</footer><!-- .entry-meta -->
</article><!-- #post-<?php the_ID(); ?> -->

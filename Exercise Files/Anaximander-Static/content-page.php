<?php

/* Template used for displaying page content in page.php */

?>

<article id="post-<?php the_ID(); ?>" class="group post-container">
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
		
		
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'anaximander' ), 'after' => '</div>' ) ); ?>
		<?php edit_post_link( __( 'Edit', 'anaximander' ), '<span class="edit-link">', '</span>' ); ?>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->

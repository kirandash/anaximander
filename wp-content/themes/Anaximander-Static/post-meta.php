<?php

/* Template displaying post meta content. Displays date and time and post author */

?>

<time class="entry-date" datetime="<?php echo get_the_date( 'c' ); ?>" pubdate="pubdate">
	<a href="<?php get_permalink(); ?>" title="Permalink to post">
		<?php echo get_the_date( 'F j, Y \a\t g:i a' ); ?>
	</a>
</time>
<div class="entry-author">
	By <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" title="View all posts by <?php echo get_the_author(); ?>"><?php echo get_the_author(); ?></a>
</div>

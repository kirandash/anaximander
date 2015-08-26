<?php

/* Loop showing related posts in single post view. Can be replaced with Yet Another Related Posts Plugin (YARPP) */


	$backup = $post; //backup current object
	$current = $post->ID; //current page ID
	
	global $post;
	$thisCat = get_the_category();
	$currentCategory = $thisCat[0]->cat_ID;
	$myposts = get_posts('numberposts=3&order=DESC&orderby=ID&category=' . $currentCategory . '&exclude=' . $current);
	
	$check = count($myposts);
	
	if ($check > 1 ) { ?>
	<h1 id="recent">Related</h1>
	<div id="related" class="group">
		<ul class="group">
		<?php	
			foreach($myposts as $post) :
				setup_postdata($post);
		?>
			<li>
				<a href="<?php the_permalink() ?>" title="<?php the_title() ?>" rel="bookmark">
					<article>
						<h1 class="entry-title"><?php the_title() ?></h1>
						<div class="name-date"><?php the_time('F j, Y'); ?></div>
						<div class="theExcerpt"><?php the_excerpt(); ?></div>
					</article>
				</a>
			</li>
 
		<?php endforeach; ?>
		</ul>
<?php
	$post = $backup; //restore current object
	wp_reset_query();
?>

</div><!-- #related -->
<?php } ?>
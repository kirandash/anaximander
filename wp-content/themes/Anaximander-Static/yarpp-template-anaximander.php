<?php 

/*
Yet Another Related Posts Plugin (YARPP) template. Can be used in place of the default related posts function.
Author: mor10 (Morten Rand-Hendriksen)
*/

?>

<?php if ($related_query->have_posts()): ?>

	<h1 id="recent">Related</h1>
	<div id="related" class="group">
		<ul class="group">

			<?php while ($related_query->have_posts()) : $related_query->the_post(); ?>
				<li>
					<a href="<?php the_permalink() ?>" title="<?php the_title() ?>" rel="bookmark">
						<article>
							<h1 class="entry-title"><?php the_title() ?></h1>
							<div class="name-date"><?php the_time('F j, Y'); ?></div>
							<div class="theExcerpt"><?php the_excerpt(); ?></div>
						</article>
					</a>
				</li>	 
			<?php endwhile; ?>

		</ul>
	</div><!-- #related -->

<?php endif; ?>

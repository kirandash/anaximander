<?php

/* Template for displaying the 404 page when nothing is found. */

get_header(); ?>
				<header class="page-header">
						<h1 class="page-title">Hm. Looks like something went wrong&hellip;</h1>
				</header>
		<section id="content-container">
			<div id="content" role="main">

			<?php if ( have_posts() ) : ?>
				<section id="masonry-index" class="group">
				
					<?php /* Start the Loop */ ?>
					<?php while ( have_posts() ) : the_post(); ?>
	
						<?php get_template_part( 'content', 'search' ); ?>
	
					<?php endwhile; ?>
				</section>
			<?php else : ?>

				<article id="post-0" class="post no-results not-found">

					<div class="entry-content">
						<p>It seems we can’t find what you’re looking for. If you are looking for a specific post, try searching up in the right-hand corner. Otherwise take a look at our most recent posts below.</p>
					</div><!-- .entry-content -->
				</article><!-- #post-0 -->
				
				<h1 id="reply-title">
					Our most recent posts:
				</h1>
				<section id="masonry-index" class="group">
						<?php 
							$postQuery = new WP_Query(
								array(
									'posts_per_page' => 12
								)
							);
						?>
						
						<?php while ( $postQuery->have_posts() ) : $postQuery->the_post(); 
						
						
							get_template_part( 'content', get_post_format() );	
												
						endwhile; ?>
						
					<div class="paginationBox group">
					
						<?php kriesi_pagination($pages = '', $range = 3); ?>
	
					</div>
				</section>
			<?php endif; ?>

			<div class="paginationBox group">	
				<?php kriesi_pagination($pages = '', $range = 3); ?>
			</div>

			</div><!-- #content -->
		</section><!-- #content-container -->

<?php /* get_sidebar(); */ ?>
<?php get_footer(); ?>
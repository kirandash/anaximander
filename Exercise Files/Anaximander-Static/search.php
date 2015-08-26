<?php

/* Template for displaying Search Results pages. */

get_header(); ?>
				<header class="page-header">
					<?php if ( have_posts() ) { ?>
						<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'anaximander' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
					<?php } else { ?>
						<h1 class="page-title"><?php printf( __( 'Nothing found for %s', 'toolbox' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
					<?php } ?>
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
						<p>We don't seem to have any articles that match the word(s) you searched for. If you were unable to find what you were looking for try searching again with a different word or words.</p>
						<p>If you can't find what you are looking for take a look at the most recent blog posts below. Chances are you'll find something that may interest you there.</p>
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
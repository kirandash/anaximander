<?php

/* Template for displaying Author Archive pages. */

get_header(); ?>
				<header class="page-header">

					<?php if ( have_posts() ) : ?>

					<?php
						/* Queue the first post, that way we know
						 * what author we're dealing with (if that is the case).
						 *
						 * We reset this later so we can run the loop
						 * properly with a call to rewind_posts().
						 */
						the_post();
					?>

						<h1 class="page-title author">
						<?php printf( __( 'Author Archives: %s', 'twentyeleven' ), '<span class="vcard">' . get_the_author() . '</span>' ); ?></h1>

					<?php
						/* Since we called the_post() above, we need to
						 * rewind the loop back to the beginning that way
						 * we can run the loop properly, in full.
						 */
						rewind_posts();
						endif;
					?>			
					
				</header>
		<section id="content-container">
			<div id="content" class="group" role="main">

			<?php if ( have_posts() ) : ?>

				

				<?php /* Start the Loop */ ?>
				<!--<section id="masonry-index" class="group">-->
				<section id="regular-index" class="group">
					<div id="regular-content">
					
					<?php while ( have_posts() ) : the_post(); ?>
	
						<?php
							/* Include the Post-Format-specific template for the content.
							 * If you want to overload this in a child theme then include a file
							 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
							 */
							get_template_part( 'content', get_post_format() );
						?>

					<?php endwhile; ?>
					<div class="paginationBox group">	
						<?php kriesi_pagination($pages = '', $range = 3); ?>
					</div>
					
					</div><!-- #regular-content -->
				</section><!-- #regular-index -->

			<?php else : ?>

				<article id="post-0" class="post no-results not-found">
					<header class="entry-header">
						<h1 class="entry-title"><?php _e( 'Nothing Found', 'anaximander' ); ?></h1>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'anaximander' ); ?></p>
						<?php get_search_form(); ?>
					</div><!-- .entry-content -->
				</article><!-- #post-0 -->

			<?php endif; ?>

			
				<?php  get_sidebar();  ?>
			</div><!-- #content -->
			
		</section><!-- #content-container -->


<?php get_footer(); ?>
<?php

/* Template for displaying Category Archive pages. */

get_header(); ?>
				<header class="page-header">
					<h1 class="page-title"><?php
						printf( __( 'Category Archives: %s', 'anaximander' ), '<span>' . single_cat_title( '', false ) . '</span>' );
					?></h1>

					<?php
						$category_description = category_description();
						if ( ! empty( $category_description ) )
							echo apply_filters( 'category_archive_meta', '<div class="category-archive-meta">' . $category_description . '</div>' );
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
<?php

/* Template for displaying all single posts. */

get_header(); ?>

		<div id="content-container">
			<div id="content" class="group" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'single' ); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() )
						comments_template( '', true );
				?>

			<?php endwhile; // end of the loop. ?>
			</div><!-- #content -->
			<?php 
				// If you want to use Yet Another Related Post Plugin (YARPP):
				// 1. Uncomment related_posts();
				// 2. Comment get_template_part('related');
				// 3. In YARPP setup (WordPress Admin) assign yarpp-template-anaximander.php as the template file
				
				// related_posts();
				get_template_part('related'); 
			?>
		</div><!-- #content-container -->

<?php /* get_sidebar(); */ ?>
<?php get_footer(); ?>
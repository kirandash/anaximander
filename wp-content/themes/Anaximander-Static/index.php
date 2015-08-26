<?php

/* Front page (index / blog page) template */

get_header(); ?>

		<section id="content-container">
			<div id="content" role="main">
				
				<!-- Flexslider demo content -->

			

				<div class="flexslider">

					<ul class="slides">

						<li>

							<img src="http://farm7.staticflickr.com/6213/6256961398_a484813abe_b.jpg" />

							<p class="flex-caption">Caption goes here</p>

						</li>

						<li>

							<img src="http://farm7.staticflickr.com/6025/6012928351_d643e5a404_b.jpg" />

							<p class="flex-caption">Caption goes here</p>

						</li>

						<li>

							<img src="http://farm7.staticflickr.com/6126/6007110789_bd7faaaa79_b.jpg" />

							<p class="flex-caption">Caption goes here</p>

						</li>

						<li>

							<img src="http://farm6.staticflickr.com/5159/5874760659_de4c00d585_b.jpg" />

							<p class="flex-caption">Caption goes here</p>

						</li>

					</ul>

				</div>

				

				<!-- END Flexslider demo content -->
                
			<?php if ( have_posts() ) : ?>
				<section id="regular-index" class="group">
				<div id="regular-content">
				
				
				
				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php
						get_template_part( 'content', get_post_format() );
					?>

				<?php endwhile; ?>
				
				</div><!-- #regular-content -->
				<div class="paginationBox group">	
					<?php kriesi_pagination($pages = '', $range = 3); ?>
				</div>
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
			
			
				<?php get_sidebar();  ?>
			</div><!-- #content -->
		</section><!-- #content-container -->


<?php get_footer(); ?>
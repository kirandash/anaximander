<?php

/* Meta loop template. Displays comments link and list of post categories for each post */

?>

						<aside class="index-meta group">
							<ul>


									<li class="theComments">
										<?php comments_popup_link( ( 'Leave a comment'), ( '1 Comment'), ( '% Comments') ); ?>
									</li><!-- .theComments -->
								
								<?php
								
									$category_terms = wp_get_post_categories( $post->ID );
									if ( $category_terms ) {
										echo get_the_category_list(); 
									}
								?>
							</ul>		
							
						</aside><!-- .index-meta -->
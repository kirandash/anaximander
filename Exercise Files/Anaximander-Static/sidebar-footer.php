<?php 

/* Template showing the footer sidebar */ 

?>

	<?php if ( is_active_sidebar( 'footer-widgets' ) ) { ?>
		<div id="footer-sidebar" class="widget-area" role="complementary">
			<ul class="group">
				<?php dynamic_sidebar( 'footer-widgets' ); ?>
			</ul>
		</div><!-- #secondary .widget-area -->
	<?php } ?>
		

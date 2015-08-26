<?php

/* Template for displaying the footer. */

?>

	</div><!-- #main -->

	<footer id="colophon" role="contentinfo">

		<?php get_sidebar('footer'); ?>

		<div id="footer-content">
			<div id="site-generator">
				<?php do_action( 'anaximander_credits' ); ?>
				<p>
				<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'anaximander' ) ); ?>" title="<?php esc_attr_e( 'Semantic Personal Publishing Platform', 'anaximander' ); ?>" rel="generator"><?php printf( __( 'Proudly powered by %s', 'anaximander' ), 'WordPress' ); ?></a>
				<span class="sep"> | </span>
				<?php printf( __( 'Theme: %1$s by %2$s.', 'anaximander' ), 'anaximander', '<a href="http://pinkandyellow.com/" rel="nofollow">Pink &amp; Yellow Media</a>' ); ?>
				</p>
                <p><a href="#content">You have reached the bottom. Click here to get back on top.</a></p>

			</div>
		</div>
	</footer><!-- #colophon -->
</div><!-- #wrapper -->

<?php wp_footer(); ?>

</body>
</html>
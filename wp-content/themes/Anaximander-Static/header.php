<!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />

<!-- Check device width for responsive media queries -->

<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

<title><?php wp_title(''); ?></title>

<?php // Add definition for the 'rel' attribute in HTML4 browsers ?>	
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />

<?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>

<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<?php // Call HTML5 shim if the browser is older than IE9 ?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->


<?php 
	// GET THEME OPTIONS
	global $anaximander_options;
	$anaximander_settings = get_option( 'anaximander_options', $anaximander_options );
	$twitter_handle = $anaximander_settings['twitter_handle'];
	$facebook_page = $anaximander_settings['facebook_page'];
	$RSS_feed = $anaximander_settings['RSS_feed'];

?>

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="wrapper" class="hfeed">
<?php do_action( 'before' ); ?>


	<div id="pre-header" class="group">
		<ul id="social-links">
			<?php 
			if($twitter_handle) { ?>
				<li>
					<a href="http://www.twitter.com/<?php echo $twitter_handle; ?>" title="<?php echo $twitter_handle; ?> on Twitter" target="_blank">
						<i class="icon-twitter"></i>
						<span class="assistive-text"><?php echo $twitter_handle; ?> on Twitter</span>
					</a>
				</li>
			<?php }
			if($facebook_page) { ?>
				<li>
					<a href="http://facebook.com/<?php echo $facebook_page; ?>" title="Check out our Facebook page" target="_blank">
						<i class="icon-facebook"></i>
						<span class="assistive-text">Check out our Facebook page</span>
					</a>
				</li>
			<?php } ?>
			<li>
				<a href="<?php if ($RSS_feed) { echo esc_url($RSS_feed); } else { echo home_url('/feed'); } ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> RSS feed">
					<i class="icon-rss"></i>
					<span class="assistive-text"><?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> RSS feed</span>
				</a>
			</li>

		</ul>
		<aside id="header-search" class="group">
			<form method="get" id="searchform" action="<?php echo home_url(); ?>/">
				<div>
					<input type="text" size="put_a_size_here" name="s" id="s" value="Search..." onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;"/>
					<input type="image" src="<?php echo get_template_directory_uri(); ?>/images/header-search.png" id="searchsubmit" />
				</div>
			</form>
		</aside>
	</div><!-- #pre-header -->
	
	<header id="site-header" class="group" role="banner">

		<?php
			// Get header image:
			$header_image = get_header_image();
			// Get text colour (or lack thereof):
			$text_color = get_header_textcolor();
		?>

		<?php
		// Has the text been hidden?
		if ( 'blank' == $text_color ) { echo '<div id="header_image_margin">'; }
		else { echo '<div id="header_margin">'; } 
		?>
		<div class="header-container group">
			
			<hgroup id="header-title"  <?php /* if ( $header_image ) { echo 'class="header-image-true"'; } */ ?>>
				<h1 id="site-title"><a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<h2 id="site-description"><?php bloginfo( 'description' ); ?></h2>
			</hgroup>
			
			<?php 
			// MAIN MENU WHEN HEADER TEXT VISIBLE
			if ('blank' != $text_color) { ?>

					<nav id="access" class="group" role="navigation">
						<h1 class="assistive-text section-heading"><?php _e( 'Main menu', 'anaximander' ); ?></h1>
						<div class="skip-link screen-reader-text"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'anaximander' ); ?>"><?php _e( 'Skip to content', 'anaximander' ); ?></a></div>
						<?php 
							wp_nav_menu( array( 'theme_location' => 'header_menu', 'menu_class' => 'sf-menu' ) );
						?>
					</nav><!-- #access -->
				<?php
			} 
			?>
			
		</div><!-- .header-container -->
		</div><!-- #header_margin or #header_image_margin -->

		
		<?php
	// Check to see if there is a custom header image

	if ( $header_image) :
		echo '<div id="header_image">';
			// Compatibility with versions of WordPress prior to 3.4.
			if ( function_exists( 'get_custom_header' ) ) {
				// We need to figure out what the minimum width should be for our featured image.
				// This result would be the suggested width if the theme were to implement flexible widths.
				$header_image_width = get_theme_support( 'custom-header', 'width' );
			} else {
				$header_image_width = HEADER_IMAGE_WIDTH;
			}
			?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
				<?php
				// The header image
				// Compatibility with versions of WordPress prior to 3.4.
				if ( function_exists( 'get_custom_header' ) ) {
					$header_image_width  = get_custom_header()->width;
					$header_image_height = get_custom_header()->height;
				} else {
					$header_image_width  = HEADER_IMAGE_WIDTH;
					$header_image_height = HEADER_IMAGE_HEIGHT;
				}
				?>
				
				<img src="<?php header_image(); ?>" width="<?php echo $header_image_width; ?>" height="<?php echo $header_image_height; ?>" alt="" />
			</a>
		</div>
	<?php endif; // end check for removed header image ?>

			
	</header><!-- #site-header -->
	
	

	<?php 
		// MAIN MENU WHEN HEADER TEXT HIDDEN
		if ( 'blank' == $text_color ) { ?>

			<nav id="sub-access" class="group" role="navigation">
				<h1 class="assistive-text section-heading"><?php _e( 'Main menu', 'anaximander' ); ?></h1>
				<div class="skip-link screen-reader-text"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'anaximander' ); ?>"><?php _e( 'Skip to content', 'anaximander' ); ?></a></div>
				<?php 
					wp_nav_menu( array( 'theme_location' => 'header_menu', 'menu_class' => 'sf-menu' ) );
				?>
			</nav><!-- #access -->
		<?php
		}
	?>

	

	<div id="main" class="group">
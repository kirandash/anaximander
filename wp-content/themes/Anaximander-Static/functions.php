<?php


// Set the content width based on the theme's design and stylesheet.

if ( ! isset( $content_width ) )
	$content_width = 620; /* pixels */
	
// Get posttypes definitions (optional)
// include('posttypes.php');

if ( ! function_exists( 'anaximander_setup' ) ):

function anaximander_setup() {
//  Language support if necessary
	load_theme_textdomain( 'anaximander', get_template_directory() . '/languages' );

	$locale = get_locale();
	$locale_file = get_template_directory() . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );

//  Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

//  Get theme options
	require_once ( get_template_directory() . '/theme-options/theme-options.php' );

//  Custom menus
	register_nav_menus( array(
		'header_menu' => __( 'Header Menu', 'anaximander' )
	) );

//  Post Formats
	add_theme_support( 'post-formats', array( 'video', 'image' ) );
	
//	Checks is WP is at least a certain version (makes sure it has sufficient comparison decimals
function is_wp_version( $is_ver ) {
    $wp_ver = explode( '.', get_bloginfo( 'version' ) );
    $is_ver = explode( '.', $is_ver );
    for( $i=0; $i<=count( $is_ver ); $i++ )
        if( !isset( $wp_ver[$i] ) ) array_push( $wp_ver, 0 );
 
    foreach( $is_ver as $i => $is_val )
        if( $wp_ver[$i] < $is_val ) return false;
    return true;
}

//  Adds Custom Background support in admin panel

	$args = array(
		'default-color' => 'CCCCCC'
	);
	add_theme_support( 'custom-background', $args );


//  Adds Post Thumbnail feature in admin panels
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size(75, 75, true);
	add_image_size('index-thumb', 298, 9999);
	add_image_size('single-thumb', 620, 9999);
	add_image_size('feature-slider', 930, 400, true);
//  Add custom image sizes (optional):
//  add_image_size('size-name', height, width, true);
	
	
	
	
// Add support for custom headers.
	add_theme_support( 'custom-header', array(
		// The default header text color.
		'default-text-color' => 'fff',
		// The height and width of our custom header.
		'width' => apply_filters( 'anaximander_header_image_width', 1040 ),
		'height' => apply_filters( 'anaximander_header_image_height', 300 ),
		// Support flexible heights.
		'flex-height' => true,
		// Random image rotation by default.
		'random-default' => true,
		// Callback for styling the header.
		'wp-head-callback' => 'anaximander_header_style',
		// Callback for styling the header preview in the admin.
		'admin-head-callback' => 'anaximander_admin_header_style',
		// Callback used to display the header preview in the admin.
		'admin-preview-callback' => 'anaximander_admin_header_image',
	) );



}
endif; // anaximander_setup


if ( ! function_exists( 'anaximander_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * Based on code from Twenty Eleven
 */
function anaximander_header_style() {

	
	// CUSTOM THEME COLOUR
	global $anaximander_options;
	$anaximander_settings = get_option( 'anaximander_options', $anaximander_options );
	$theme_colour = $anaximander_settings['theme_colour'];
	
	if ($theme_colour) {
	?>	
		<style>
			#site-header,
			.index-meta li a:hover,
			.index-meta li.theComments a:hover,
			.more-link a:hover,
			.footer-tags li a:hover {
				background-color: <?php echo $theme_colour; ?>;
			}
		</style>
	<?php	
	}
	

	// CUSTOM TEXT COLOUR
	$text_color = get_header_textcolor();

	// If no custom options for text are set, let's bail.
	if ( $text_color == get_theme_support( 'custom-header', 'default-text-color' ) )
		return;
	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( 'blank' == $text_color ) :
	?>
		#site-title,
		#site-description {
			position: absolute !important;
			clip: rect(1px 1px 1px 1px); /* IE6, IE7 */
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text use that
		else :
	?>
		#site-title a,
		#site-description,
		#access a,
		#access li.current_page_item > a, 
		#access li.current_page_parent > a, 
		#access li.current-page-ancestor > a, 
		#access li.current-post-ancestor > a {
			color: #<?php echo $text_color; ?> !important;
		}
	<?php endif; ?>
	</style>
	<?php
	
}
endif; // anaximander_header_style

if ( ! function_exists( 'anaximander_admin_header_style' ) ) :
/* Custom styles the header preview in the Appearance > Header admin panel. */
function anaximander_admin_header_style() {
?>
	<?php 
	// CUSTOM THEME COLOUR
	global $anaximander_options;
	$anaximander_settings = get_option( 'anaximander_options', $anaximander_options );
	$theme_colour = $anaximander_settings['theme_colour'];
	
	if ($theme_colour) {
	?>	
		<style>
			#site-header,
			.index-meta li a:hover,
			.index-meta li.theComments a:hover,
			.more-link a:hover,
			.footer-tags li a:hover {
				background-color: <?php echo $theme_colour; ?>!important;
			}
		</style>
	<?php	
	}?>

	<style type="text/css">
		#site-header {
			background: #ff4800;
			position: relative;
			max-width: 1040px;
		}

		#header_margin {
			padding: 40px 50px;
		}

		#header_image img {
			display: block;
			width: 100%;
			height: auto;
		}
		
		#header_image_margin {
			display: none;
		}

		#site-title {
			font-size: 2.5em;
			font-weight: 700;
			margin: 0;
			font-family: 'Open Sans Condensed';
			text-transform: uppercase;
			z-index: 10;
		}

		#site-title a:link,
		#site-title a:visited,
		#site-title a:hover,
		#site-title a:focus {
			text-decoration: none;
			color: #fff;
		}

		#site-description {
			font-family: 'Open Sans', Arial, Helvetica, sans-serif;
			font-size: 1em;
			font-weight: normal;
			text-transform: uppercase;
			color: #fff;
			margin: 0.2em 0;
		}

		/* Conditional if header image is present */

		#header-title.header-image-true {
			width: 100%;
		}
		<?php
			// If the user has set a custom color for the text use that
			if ( get_header_textcolor() != get_theme_support( 'custom-header', 'default-text-color' ) ) :
		?>
			#site-title a,
			#site-description {
				color: #<?php echo get_header_textcolor(); ?>!important;
			}
		<?php endif; ?>
	</style>
<?php
}
endif; // anaximander_admin_header_style

if ( ! function_exists( 'anaximander_admin_header_image' ) ) :

/* Displays a preview of the header in the Appearance > Header admin panel. */
function anaximander_admin_header_image() { ?>
	
	
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

	
	
	
<?php }
endif; // anaximander_admin_header_image







add_action( 'after_setup_theme', 'anaximander_setup' );





// wp_nav_menu() fallback
function anaximander_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'anaximander_page_menu_args' );


// Add widgetized areas
function anaximander_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Front page widget 1', 'anaximander' ),
		'id' => 'front-widget-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
	register_sidebar( array(
		'name' => __( 'Front page widget 2', 'anaximander' ),
		'id' => 'front-widget-2',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
	register_sidebar( array(
		'name' => __( 'Front page widget 3', 'anaximander' ),
		'id' => 'front-widget-3',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );

	register_sidebar( array(
		'name' => __( 'Sidebar Widgets', 'anaximander' ),
		'id' => 'sidebar-1',
		'description' => __( 'Widgets displayed in the sidebar on category and archive pages. ', 'anaximander' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );

	
	register_sidebar( array(
		'name' => __( 'Footer Widgets', 'anaximander' ),
		'id' => 'footer-widgets',
		'description' => __( 'Widgets displayed in the footer. Each widget appears to the right of the previous one.', 'anaximander' ),
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => "</li>",
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
}
add_action( 'init', 'anaximander_widgets_init' );


if ( ! function_exists( 'anaximander_comment' ) ) :
// Comments and pingbacks - overrides comments.php
function anaximander_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'anaximander' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'anaximander' ), ' ' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment group">
			<footer class="comment-footer">
				<div class="left-content">
					<div class="the-avatar">
						<?php echo get_avatar( $comment, 50 ); ?>									
					</div>
					<div class="reply">
						<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
					</div><!-- .reply -->
				</div><!-- .left-content -->
				<div class="comment-meta commentmetadata">
					<div class="comment-author vcard">
						<?php printf( __( '%s', 'anaximander' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
					</div><!-- .comment-author .vcard -->
				
					<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
						<time pubdate datetime="<?php comment_time( 'c' ); ?>">
						<?php
							/* translators: 1: date, 2: time */
							printf( __( 'on %1$s at %2$s', 'anaximander' ), get_comment_date(), get_comment_time() ); ?>
						</time>
					</a>
					<?php edit_comment_link( __( '(Edit)', 'anaximander' ), ' ' );
					?>
					<?php if ( $comment->comment_approved == '0' ) : ?>
						<em><?php _e( 'Your comment is awaiting moderation.', 'anaximander' ); ?></em>
						<br />
					<?php endif; ?>

				</div><!-- .comment-meta .commentmetadata -->
			</footer>

			<div class="comment-content"><?php comment_text(); ?></div>

			
		</article><!-- #comment-## -->

	<?php
			break;
	endswitch;
}
endif; // ends check for anaximander_comment()


if ( ! function_exists( 'anaximander_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 * Create your own anaximander_posted_on to override in a child theme
 *
 * @since anaximander 1.2
 */
function anaximander_posted_on() {
	printf( __( '<span class="sep">Posted on </span><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a><span class="byline"> <span class="sep"> by </span> <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>', 'anaximander' ),
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'anaximander' ), get_the_author() ) ),
		esc_html( get_the_author() )
	);
}
endif;


//  Changes the contents of the excerpt more tag
function new_excerpt_more($more) {
	global $post;

	return ' &hellip;';
}
add_filter('excerpt_more', 'new_excerpt_more');



// Add custom pagination function
function kriesi_pagination($pages = '', $range = 2)
{  
     $showitems = ($range * 2)+1;  

     global $paged;
     if(empty($paged)) $paged = 1;

     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   

     if(1 != $pages)
     {
         echo '<ul class="pagination">';
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo '<li><a href="'.get_pagenum_link(1).'">&laquo;</a></li>';
         /*if($paged > 1 && $showitems < $pages) echo '<li><a href="'.get_pagenum_link($paged - 1).'">&lsaquo; Previous</a></li>';*/
         if($paged > 1 && $showitems < $pages) echo '<li>' . previous_posts_link('&laquo; Previous Entries') . '</li>';

         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                echo ($paged == $i)? '<li class="current">'.$i.'</li>':'<li><a href="'.get_pagenum_link($i).'" class="inactive" >'.$i.'</a></li>';
             }
         }

         /*if ($paged < $pages && $showitems < $pages) echo '<li><a href="'.get_pagenum_link($paged + 1).'">Next &rsaquo;</a></li>'; */
         if ($paged < $pages && $showitems < $pages) echo '<li>' . next_posts_link('Next &raquo;','') . '</li>';  
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo '<li><a href="'.get_pagenum_link($pages).'">&raquo;</a></li>';
         echo '</ul>';
     }
}

// END pagination



// Add Superfish functionality to header menu
// More info on Superfish can be found here: http://users.tpg.com.au/j_birch/plugins/superfish/
function anaximander_superfish() {
	if (!is_admin()) {

		wp_register_script( 'superfish',
		get_template_directory_uri() . '/js/superfish.js',
		 array('jquery') );    	
		 
    	wp_enqueue_script( 'superfish');
    	
    	add_action('wp_head', 'superfish_config');
    	
    	function superfish_config() { ?>
    		<script> 
 			    jQuery(document).ready(function() { 
 			       jQuery('ul.sf-menu').superfish();
 			       jQuery('.sf-menu ul').superfish();
 			   }); 
			</script>
    		<?php
	    }
	}
}

add_action('init', 'anaximander_superfish');





// Add FitVids to allow for responsive sizing of videos

function anaximander_fitvids() {

	if (!is_admin()) {



		wp_register_script( 'fitvids', get_template_directory_uri() . '/js/jquery.fitvids.js', array('jquery'), '1.0', true);    	

    	wp_enqueue_script( 'fitvids');

    	add_action('wp_head', 'add_fitthem');

    	

    	function add_fitthem() { ?>

	    	<script type="text/javascript">

		    	jQuery(document).ready(function() {

	    			jQuery('.video').fitVids();

	    		});

    		</script><?php

	    }



	}

}



add_action('init', 'anaximander_fitvids');





// Automatically append .video class to oembed content (not a perfect solution, but close)

function anaximander_embed_filter( $html, $data, $url ) {



	$return = '<div class="video">'.$html.'</div>';

	return $return;

}

add_filter('oembed_dataparse', 'anaximander_embed_filter', 90, 3 );


// FLEXSLIDER



function anaximander_flexslider() {

	if (!is_admin()) {



		// Enqueue FlexSlider JavaScript

		wp_register_script('jquery_flexslider', get_template_directory_uri(). '/js/jquery.flexslider.js', array('jquery') );

		wp_enqueue_script('jquery_flexslider');



		// Enqueue FlexSlider Stylesheet		

		wp_register_style( 'flexslider-style', get_template_directory_uri() . '/CSS/flexslider.css', 'all' );

		wp_enqueue_style( 'flexslider-style' );

		

		// FlexSlider custom settings		

		add_action('wp_footer', 'anaximander_flexslider_settings');

		

		function anaximander_flexslider_settings() { ?>			

			<script>

				jQuery(document).ready(function($){



					$('.flexslider').flexslider();

				});

			</script>

		<?php 

		}



	}

}



add_action('init', 'anaximander_flexslider');
/**
 * The End
 */
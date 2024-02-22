<?php // ADDED BY DAVID JANOSIK
include 'shortcodes.php';

add_action( 'wp_enqueue_scripts', 'my_add_stylesheet' );
function my_add_stylesheet() {
    wp_enqueue_style( 'extra-style', get_stylesheet_directory_uri() . '/css/custom.css?'.rand(111,9999), 'all' );
}

function my_theme_enqueue_styles() {

    $parent_style = 'Colleges-Theme-style'; // This is 'Colleges-Theme-style' for the Colleges-Theme.

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/static/css/style.min.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );


function themeslug_enqueue_script() { // This is for any 'Colleges-Theme' javascript files.
    //OLD WAY --  wp_enqueue_script( 'dropnav', get_template_directory_uri() . '/static/js/script.min.js', false );
	//wp_enqueue_script( 'dropnav', get_template_directory_uri() . '/static/js/script.min.js', array( 'jquery', 'tether' ), null, true );
    // here you can enqueue more js / css files 
}
add_action( 'wp_enqueue_scripts', 'themeslug_enqueue_script' );


/* REMOVE /FEED/ Link in all profile pages */
add_action( 'wp', 'remove_rss_feed_link_for_custom_post_type' );
function remove_rss_feed_link_for_custom_post_type() {
	$post_type = 'person';
	if ( is_singular( $post_type ) ) {
		remove_action('wp_head', 'feed_links_extra', 3 );
	}
}

// Remove Really Simple Discovery Link
remove_action('wp_head', 'rsd_link');


/* Change Excerpt length */
function custom_excerpt_length( $length ) {
	return 30;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

/* Get Last Updated Info */
function show_last_modified_date( $content ) {
$original_time = get_the_time('U');
$modified_time = get_the_modified_time('U');
if ($modified_time >= $original_time + 86400) {
$updated_time = get_the_modified_time('h:i a');
$updated_day = get_the_modified_time('F jS, Y');
$modified_content = '';
}
$modified_content = $content;
return $modified_content;
}
add_filter( 'the_content', 'show_last_modified_date' );


// CUSTOM SIDE BAR ADDONS
    // ADDING ONE FOR THE NEWS BLOG
function my_customblog_sidebar() {
    register_sidebar(
        array (
            'name' => __( 'Blog Post Sidebar' ),
            'id' => 'custom-side-bar',
            'description' => __( 'This is displayed on Blog Posts' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s widgetFix newsSearcher">',
			'after_widget' => '</div>',
			'before_title'  => '<h2 class="h5 heading-underline">',
			'after_title'   => '</h2>',
        )
    );
}
add_action( 'widgets_init', 'my_customblog_sidebar' );


// ADDING DIRECTORY SIDEBAR
function directory_sidebar() {
    register_sidebar(
        array (
            'name' => __( 'Directory' ),
            'id' => 'directory-sidebar',
            'description' => __( 'This is sidebar for the Directory' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s widgetFix">',
			'after_widget' => '</div>',
			'before_title'  => '<h2 class="h5 heading-underline">',
			'after_title'   => '</h2>',
        )
    );
}
add_action( 'widgets_init', 'directory_sidebar' );

// ADDING FACULTY RESEARCH SIDEBAR
function facresearch_sidebar() {
    register_sidebar(
        array (
            'name' => __( 'Faculty Research' ),
            'id' => 'facresearch-sidebar',
            'description' => __( 'This is sidebar for the Faculty Research' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s widgetFix">',
			'after_widget' => '</div>',
			'before_title'  => '<h2 class="h5 heading-underline">',
			'after_title'   => '</h2>',
        )
    );
}
add_action( 'widgets_init', 'facresearch_sidebar' );

// ADDING RESEARCH OPPORTUNITY SIDEBAR
function research_participation() {
    register_sidebar(
        array (
            'name' => __( 'Research Opportunities' ),
            'id' => 'research-participation',
            'description' => __( 'This is sidebar for the Research Opportunities' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s widgetFix">',
			'after_widget' => '</div>',
			'before_title'  => '<h2 class="h5 heading-underline">',
			'after_title'   => '</h2>',
        )
    );
}
add_action( 'widgets_init', 'research_participation' );

// ADDING EVENTS SIDEBAR
function events_sidbar() {
    register_sidebar(
        array (
            'name' => __( 'SLATE Events' ),
            'id' => 'events_sidebar',
            'description' => __( 'This is sidebar for the SLATE Events' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s widgetFix">',
			'after_widget' => '</div>',
			'before_title'  => '<h2 class="h5 heading-underline">',
			'after_title'   => '</h2>',
        )
    );
}
add_action( 'widgets_init', 'events_sidbar' );

// ADDING GRANTS SIDEBAR
function grants_sidebar() {
    register_sidebar(
        array (
            'name' => __( 'Grants' ),
            'id' => 'grants-sidebar',
            'description' => __( 'This is sidebar for the Grants Archive' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s widgetFix">',
			'after_widget' => '</div>',
			'before_title'  => '<h2 class="h5 heading-underline">',
			'after_title'   => '</h2>',
        )
    );
}
add_action( 'widgets_init', 'grants_sidebar' );

// ADDING FAQ SIDEBAR
function faq_sidebar() {
    register_sidebar(
        array (
            'name' => __( 'FAQs' ),
            'id' => 'faq-sidebar',
            'description' => __( 'This is sidebar for the FAQs' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s widgetFix">',
			'after_widget' => '</div>',
			'before_title'  => '<h2 class="h5 heading-underline">',
			'after_title'   => '</h2>',
        )
    );
}
add_action( 'widgets_init', 'faq_sidebar' );

// ADDING HEALTH TIPS SIDEBAR
function healthtips_sidebar() {
    register_sidebar(
        array (
            'name' => __( 'Health Tips' ),
            'id' => 'healthtips-sidebar',
            'description' => __( 'This is sidebar for Health Tips' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s widgetFix">',
			'after_widget' => '</div>',
			'before_title'  => '<h2 class="h5 heading-underline">',
			'after_title'   => '</h2>',
        )
    );
}
add_action( 'widgets_init', 'healthtips_sidebar' );

// CHANGE SORT ORDER OF GRANTS ARCHIVE
function sort_grants_archive_loop($query) { 
    if ($query->is_post_type_archive('grants') && $query->is_main_query()) {
    $query->set('order', 'DESC');
    $query->set('meta_key', 'grant_start_date');
	$query->set('meta_type', 'DATE');
    $query->set('orderby', 'meta_value');
    }
}
add_action('pre_get_posts', 'sort_grants_archive_loop');

// CHANGE SORT ORDER OF LABS ARCHIVE
add_filter( 'posts_orderby' , 'custom_cpt_order' );
function custom_cpt_order( $orderby ) {
	global $wpdb;
	// Check if the query is for an archive
	if ( is_archive() && get_query_var("post_type") == "lab" ) {
		// Query was for archive, then set order
		return "$wpdb->posts.post_title ASC";
	}
	return $orderby;
}

// Adding Custom Theme Settings To Better Control Global Aspects
if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Theme Settings',
		'menu_title'	=> 'Theme Settings',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Header Settings',
		'menu_title'	=> 'Header',
		'parent_slug'	=> 'theme-general-settings',
	));
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Social Media',
		'menu_title'	=> 'Social Media',
		'parent_slug'	=> 'theme-general-settings',
	));
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Footer Settings',
		'menu_title'	=> 'Footer',
		'parent_slug'	=> 'theme-general-settings',
	));
	
}
/* Add custom Facebook Social Share images for Yoast SEO for Archive pages
----------------------------------------------------------------------------------------*/
function fb_opengraph() {
    global $post;
	//insert all variables
	$socialUp_researchOpps = get_field('social_image_researchopps', 'option');
	$socialUp_pages = get_field('social_image_pages', 'option');
	//start singular page types
	//SINGLE RESEARCH OPPS
    if(is_singular( 'researchopp' )) {
        if(has_post_thumbnail($post->ID)) { /** do nothing */
        } else { ?>			
		<meta property="og:image" content="<?php echo $socialUp_researchOpps; ?>"/>
	<?php } } 
	//SINGLE REGULAR PAGE
	if(is_page()) {
        if(has_post_thumbnail($post->ID)) { /** do nothing */
        } else { ?>			
		<meta property="og:image" content="<?php echo $socialUp_pages; ?>"/>
	<?php } } 
//END REPEATER	
	else {
        return;
    }
//START ARCHIVES SECTION	
if(is_post_type_archive( 'researchopp' )) { ?>
<meta property="og:image" content="<?php echo $socialUp_researchOpps ?>"/>
<?php
        return;
    }
}
add_action('wp_head', 'fb_opengraph', 2);
/* END custom Facebook Social Share images for Yoast SEO for Archive pages
----------------------------------------------------------------------------------------*/
function wpbeginner_numeric_posts_nav() {
 
    if( is_singular() )
        return;
 
    global $wp_query;
 
    /** Stop execution if there's only 1 page */
    if( $wp_query->max_num_pages <= 1 )
        return;
 
    $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
    $max   = intval( $wp_query->max_num_pages );
 
    /** Add current page to the array */
    if ( $paged >= 1 )
        $links[] = $paged;
 
    /** Add the pages around the current page to the array */
    if ( $paged >= 3 ) {
        $links[] = $paged - 1;
        $links[] = $paged - 2;
    }
 
    if ( ( $paged + 2 ) <= $max ) {
        $links[] = $paged + 2;
        $links[] = $paged + 1;
    }
 
    echo '<div class="navigation"><ul>' . "\n";
 
    /** Previous Post Link */
    if ( get_previous_posts_link() )
        printf( '<li>%s</li>' . "\n", get_previous_posts_link() );
 
    /** Link to first page, plus ellipses if necessary */
    if ( ! in_array( 1, $links ) ) {
        $class = 1 == $paged ? ' class="active"' : '';
 
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );
 
        if ( ! in_array( 2, $links ) )
            echo '<li>…</li>';
    }
 
    /** Link to current page, plus 2 pages in either direction if necessary */
    sort( $links );
    foreach ( (array) $links as $link ) {
        $class = $paged == $link ? ' class="active"' : '';
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
    }
 
    /** Link to last page, plus ellipses if necessary */
    if ( ! in_array( $max, $links ) ) {
        if ( ! in_array( $max - 1, $links ) )
            echo '<li>…</li>' . "\n";
 
        $class = $paged == $max ? ' class="active"' : '';
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
    }
 
    /** Next Post Link */
    if ( get_next_posts_link() )
        printf( '<li>%s</li>' . "\n", get_next_posts_link() );
 
    echo '</ul></div>' . "\n";
 
}
function mychildtheme_person_post_type_args( $args ) {
	$args['rewrite'] = array( 'with_front' => false );
	return $args;
}
add_filter( 'ucf_people_post_type_args', 'mychildtheme_person_post_type_args', 10, 1 );


// TRYING TO FIGURE THIS OUT
function get_header_markup_dave() {
	$videos = $images = null;
	$obj = get_queried_object();

	if ( is_single() || is_page() ) {
		$videos = get_header_videos( $obj );
		$images = get_header_images( $obj );
	}

?>
<nav class="navbar navbar-toggleable-md navbar-inverse site-navbar" role="navigation">
	<div class="container">
		<?php if ( is_front_page() ): ?>
		<a href="<?php echo bloginfo( 'url' ); ?>/" class="text-decoration-none">
			<span class="navbar-brand mb-0">
				<?php echo get_sitename_formatted(); ?>
			</span>
		</a>
		<?php else: ?>
		<a href="<?php echo bloginfo( 'url' ); ?>/" class="navbar-brand">
			<?php echo get_sitename_formatted(); ?>
		</a>
		<?php endif; ?>
		<button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#header-menu" aria-controls="header-menu" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<?php
			wp_nav_menu( array(
				'theme_location'  => 'header-menu',
				'depth'           => 2,
				'container'       => 'div',
				'container_class' => 'collapse navbar-collapse',
				'container_id'    => 'header-menu',
				'menu_class'      => 'nav navbar-nav ml-md-auto',
				'fallback_cb'     => 'bs4Navwalker::fallback',
				'walker'          => new bs4Navwalker()
			) );
		?>
	</div>
</nav>
<?php 
if ( get_field( 'breadcrumb', 'option' ) == 1 ) { ?>
<div class="breadcrumbnav">
	<div class="container">
		<a href="/" title="UCF College of Health Professions and Sciences" class="yellow">College of Health Professions and Sciences</a><span class="hidemobile"> > <a href="<?php echo get_site_url(); ?>/" title="<?php bloginfo( 'name' ); ?> at the UCF College of Health Professions and Sciences"><?php bloginfo( 'name' ); ?></a>
       	<?php if ( !is_front_page() ) { ?>
         	> <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?> at the UCF <?php bloginfo( 'name' ); ?>"><?php the_title(); ?></a></span>
    	<?php } ?>
    </div>
</div>
<?php } ?>
<?php 
switch_to_blog(2);
$hero = get_field('top_alert', 'option');
?>
<style>
.topAlert a {
	color: <?php echo $hero['textcolor']; ?> !important;
	text-decoration:underline;
}
</style>
<?php
if ( $hero['activation'] == 1 ) { ?>
<div class="topAlert" style="background-color:<?php echo $hero['bgcolor']; ?>; color:<?php echo $hero['textcolor']; ?>;">
	<div class="container">
		<i class="<?php echo $hero['icon']; ?>"></i> <?php echo $hero['message']; ?>
    </div>
</div>
<?php } ?>
<?php restore_current_blog(); ?>
<?php 
	if ( $videos || $images ) {
		echo get_header_media_markup( $obj, $videos, $images );
	}
	else {  ?>
		<div class="container">
		<?php
		// Don't print multiple h1's on the page for person templates
		if ( is_singular( array( 'post', 'person' ) ) ):
		?>
		<?php
		// Don't print multiple h1's on the page for person templates
		if ( is_category() ):
		?>
		<?php else: ?>
		<h1 class="mt-3 mt-sm-4 mt-md-5 mb-3"><?php the_title(); ?></h1>
		<?php endif; ?>
	</div>
<?php }
}
?>
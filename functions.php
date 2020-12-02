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
            'before_widget' => '<div id="%1$s" class="widget %2$s widgetFix">',
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





?>
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

// CHANGE SORT ORDER OF GRANTS ARCHIVE
function sort_cars_archive_loop($query) { 
    if ($query->is_post_type_archive('grants') && $query->is_main_query()) {
    $query->set('order', 'DESC');
    $query->set('meta_key', 'grant_start_date');
	$query->set('meta_type', 'DATE');
    $query->set('orderby', 'meta_value_num');
    }
}
add_action('pre_get_posts', 'sort_cars_archive_loop');
	

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

	echo get_nav_markup(); ?>
<?php 
if ( get_field( 'breadcrumb', 'option' ) == 1 ) { ?>
<div class="breadcrumbnav">
	<div class="container">
		<a href="/" title="UCF College of Health Professions and Sciences" class="yellow">College of Health Professions and Sciences</a><span class="hidemobile"> > <a href="<?php echo get_site_url(); ?>" title="<?php bloginfo( 'name' ); ?> at the UCF College of Health Professions and Sciences"><?php bloginfo( 'name' ); ?></a>
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
	else {
		echo get_header_default_markup( $obj );
	}
}
?>

<?php // ADDED BY DAVID JANOSIK
include 'shortcodes.php';

add_action( 'wp_enqueue_scripts', 'my_add_stylesheet' );
function my_add_stylesheet() {
    wp_enqueue_style( 'my-style', get_stylesheet_directory_uri() . '/css/custom.css?'.rand(), false, 'all' );
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


//Exclude AddThis widgets from anything other than posts
add_filter('addthis_post_exclude', 'addthis_post_exclude');
function addthis_post_exclude($display) {
global $post;
if( get_post_type($post->ID) == 'person')
$display = false;
return $display;
}


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

// Adding Custom Theme Settings To Better Control Global Aspects
// ADDED BY DAVID JANOSIK
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

?>
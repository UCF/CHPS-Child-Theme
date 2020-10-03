<?php // [exnews number="" category=""] 
function externalnewsvar( $atts ) {
    $a = shortcode_atts( array(
        'number' => '12',
		'category' => '',
    ), $atts );
switch_to_blog(2);
	if (!empty($a['category'])) { 	
	$externalnews = new WP_Query(array(
			'post_type'	=> 'inthemedia',
			'post_status' => 'publish',
			'orderby' => 'publish_date',
			'order' => 'DESC',
			'posts_per_page' => $a['number'],
		 	'tax_query' => array(
					array (
						'taxonomy' => 'externalnews_unit',
						'field' => 'name',
						'terms' => $a['category'],
					)
				),
			)
		);	
	}
	else {
	$externalnews = new WP_Query(array(
			'post_type'	=> 'inthemedia',
			'post_status' => 'publish',
			'orderby' => 'publish_date',
			'order' => 'DESC',
			'posts_per_page' => $a['number'],
			)
		);
	}
$showexnews = '<div class="container newsmedia"><div class="row narrow-gutter row-flex">';
while($externalnews->have_posts()) : $externalnews->the_post();
	$showexnews .= '<div class="col-lg-3 col-sm-6 col-xs-12"><a href="' . get_field('external_newsmedia_link') . '" title="' . get_the_title() . '" target="_blank"><div class="exInfo">' . get_the_title() . '<p class="newsdate">' . get_field( 'external_newsmedia_name' ) . '</p></div></a></div>';
endwhile;
$showexnews .= '</div></div>';
wp_reset_query();
restore_current_blog();	
return $showexnews;	
}
add_shortcode( 'exnews', 'externalnewsvar' );
?><?php
//  ----------------------------------------------------
// SHORTCODE TO DISPLAY RECENT NEWS VERTICALLY IN BOXES 
// [newsvisual number="4" category="" tag="" column="4" showcats="Yes"]
function newsvisualvar( $atts ) {
    $a = shortcode_atts( array(
        'number' => '4',
        'category' => '',
		'tag' => '',
        'column' => '4',
		'showcats' => '',
    ), $atts );
switch_to_blog(2);
$category_id = get_cat_ID($a['category']);  
	if (!empty($a['tag'])) { 	
	 $visualnews = new WP_Query(array(
                'post_type' => 'post',
                'post_status' => 'publish',
                'orderby' => 'publish_date',
                'order' => 'DESC',
                'posts_per_page' => $a['number'],
                'cat' => $category_id,
				'tax_query' => array(
					array(
						'taxonomy' => 'post_tag',
						'field'    => 'name',
						'terms'    => $a['tag'],
					),
				),
                )
            ); 	
	}
	else {
	 $visualnews = new WP_Query(array(
                'post_type' => 'post',
                'post_status' => 'publish',
                'orderby' => 'publish_date',
                'order' => 'DESC',
                'posts_per_page' => $a['number'],
                'cat' => $category_id,
                )
            ); 
	}
$listnews = '<div class="container newsmedia"><div class="row narrow-gutter row-flex">';
while($visualnews->have_posts()) : $visualnews->the_post();
	$primary_term_id = yoast_get_primary_term_id('category');
	$postTerm = get_term( $primary_term_id );
	//here is the new code
	$perma_cat = yoast_get_primary_term_id('category');
  if ( $perma_cat != null ) {
    $category = get_term( $perma_cat );
  } else {
    $categories = get_the_category();
    $category = $categories[0];
  }
  $category_link = get_category_link($category);
  $category_name = $category->name; 
	//end new code
	$getimgURL = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large', false )[0];
	if ($a['column'] == '3') {	
		$listnews .= '<div class="col-lg-4 col-sm-6 col-xs-12">';
			if ( get_field( 'updatenewstype' ) == 1 ) { 
				 $listnews .= '<a href="' . get_the_permalink() . '" rel="bookmark" title="' . get_the_title() . '" target="_blank">';
			} else { 
				 $listnews .= '<a href="' . get_the_permalink() . '" rel="bookmark" title="' . get_the_title() . '">';
			}
		$listnews .= '<div class="visnews"><div class="media-background-container visnews-photo mx-auto">';
	} else {	
		$listnews .= '<div class="col-lg-3 col-sm-6 col-xs-12">';
			if ( get_field( 'updatenewstype' ) == 1 ) { 
				 $listnews .= '<a href="' . get_the_permalink() . '" rel="bookmark" title="' . get_the_title() . '" target="_blank">';
			} else { 
				 $listnews .= '<a href="' . get_the_permalink() . '" rel="bookmark" title="' . get_the_title() . '">';
			}
		$listnews .= '<div class="visnews"><div class="media-background-container visnews-photo mx-auto">';
	}	
	if ( has_post_thumbnail()) {	
		$listnews .= '<img src="' . $getimgURL . '" alt="' . get_the_title() . '" title="' . get_the_title() . '" class="media-background object-fit-cover">';
	} else { 	
		$listnews .= '<img src="' . get_field('default_news_image', 'option') . '" alt="' . get_the_title() . '" title="' . get_the_title() . '" class="media-background object-fit-cover">';
	}	
	$listnews .= '</div><div class="p-3">';
	if ( !empty($a['showcats'])) {
		$listnews .= '<div class="mb-2"><span class="category-title" href="' . $category_link . '">' . $category_name . '</span></div>';
	}
	else { }
	$listnews .= '' . get_the_title() . '</div></div></a></div>';
endwhile;
$listnews .= '</div></div>';	
wp_reset_query();
restore_current_blog();
return $listnews;		
}
add_shortcode( 'newsvisual', 'newsvisualvar' );	
?><?php
//  ------------------------------------------------------------------------
// SHORTCODE TO DISPLAY RECENT NEWS TEXT LINKS
//
// [recentexnews category="" number=""]
function recexnewsvar( $atts ) {
    $b = shortcode_atts( array(
        'number' => '10',
		//'category' => $catname,
    ), $atts );
$category = get_queried_object();
$catname = $category->name;
if ( is_category() ) {
     $recexnews = new WP_Query(array(
				'post_type'	=> 'inthemedia',
				'post_status' => 'publish',
				'orderby' => 'publish_date',
				'order' => 'DESC',
				'tax_query' => array(
					array (
						'taxonomy' => 'externalnews_unit',
						'field' => 'name',
						'terms' => $catname,
					)
				),
				'posts_per_page' => $b['number'],
				)
			);
} else {	
		$recexnews = new WP_Query(array(
				'post_type'	=> 'inthemedia',
				'post_status' => 'publish',
				'orderby' => 'publish_date',
				'order' => 'DESC',
				'posts_per_page' => $b['number'],
				)
			);
}
?> 
<?php if ($recexnews->have_posts()){?>	
    <div id="categories-4" class="widget widget_categories widgetFix">
		<h2 class="h5 heading-underline">In the Media</h2>	
		<ul>
		<?php while($recexnews->have_posts()) : $recexnews->the_post();?>	
			<li class="cat-item">
				<a href="<?php the_field('external_newsmedia_link'); ?>" title="<?php the_title(); ?>" target="_blank">
				  <?php the_title(); ?>
				</a><br>
				<span class="newsdate-blog mb-2"><?php the_field('external_newsmedia_name'); ?></span>
			</li>
		<?php endwhile; ?>
   		</ul>
	</div>
<?php } ?>
<?php wp_reset_query(); ?> 
<?php }
add_shortcode( 'recentexnews', 'recexnewsvar' );
?><?php
//  ------------------------------------------------------------------------
// SHORTCODE TO DISPLAY RECENT NEWS HORIZONTAL ON HOMEPAGE
//
// [chpsnews category="" cat2="" cat3="" number=""]
function chpsnewsvar( $atts ) {
    $c = shortcode_atts( array(
        'number' => '3',
        'category' => '',
		'cat2' => '',
		'cat3' => '',
    ), $atts );
switch_to_blog(2); 	
$category_id = get_cat_ID($c['category']);
$cat2_id = get_cat_ID($c['cat2']);
$cat3_id = get_cat_ID($c['cat3']);
	if (!empty($c['cat2'])) { 	
		$chpsnews = new WP_Query(array(
				'post_type'	=> 'post',
				'post_status' => 'publish',
				'orderby' => 'publish_date',
				'order' => 'DESC',
				'posts_per_page' => $c['number'],
				'category__in' => array( $category_id, $cat2_id, $cat3_id ),
				)
			);	
	}
	else {
	$chpsnews = new WP_Query(array(
				'post_type'	=> 'post',
				'post_status' => 'publish',
				'orderby' => 'publish_date',
				'order' => 'DESC',
				'posts_per_page' => $c['number'],
				'cat' => $category_id,
				)
			);
	}
$listhnews = '<div class="container"><div class="row">';
while($chpsnews->have_posts()) : $chpsnews->the_post();
	$getimgURL = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large', false )[0];
	$display_name = get_the_author_meta( 'display_name')[0];
	$categories = get_the_category();
	$primary_term_id = yoast_get_primary_term_id('category');
	$postTerm = get_term( $primary_term_id );
	$blog_site = get_blog_details(2);
	$listhnews .= '<div class="row mb-5 chpsnews"><div class="col-lg-3 p-0 media-background-container catlist-photo mx-auto">';
	if ( get_field( 'updatenewstype' ) == 1 ) { 
		 $listhnews .= '<a href="' . get_the_permalink() . '" rel="bookmark" title="' . get_the_title() . '" target="_blank">';
	} else { 
		 $listhnews .= '<a href="' . get_the_permalink() . '" rel="bookmark" title="' . get_the_title() . '">';
	}
	if ( has_post_thumbnail()) {	
		$listhnews .= '<img src="' . $getimgURL . '" alt="' . get_the_title() . '" title="' . get_the_title() . '" class="media-background object-fit-cover">';	
	} else { 
		$listhnews .= '<img src="' . get_field('default_news_image', 'option') . '" alt="' . get_the_title() . '" title="' . get_the_title() . '" class="media-background object-fit-cover">';
	}
	$listhnews .= '</a></div><div class="col-lg-9 px-4 py-0"';
	if ( get_field( 'updatenewstype' ) == 1 ) { 
		$listhnews .= 'id="exLinkIcon"'; 
	}
	$listhnews .= '>';
	if ( $postTerm && ! is_wp_error( $postTerm ) ) {
		$listhnews .= '<a class="category-title" href="' . esc_url( get_term_link( $postTerm->term_id ) ) . '">' . $postTerm->name . '</a>';
	} else { 
		$listhnews .= '<a class="category-title" href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . $categories[0]->name . '</a>';
	}
	$listhnews .= '<h2 class="h5 pt-2 mainnews">';
	if ( get_field( 'updatenewstype' ) == 1 ) { 
		$listhnews .= '<a href="' . get_the_permalink() . '" rel="bookmark" title="' . get_the_title() . '" target="_blank">';
	} else { 
		$listhnews .= '<a href="' . get_the_permalink() . '" rel="bookmark" title="' . get_the_title() . '">';
	}
	$listhnews .= '' . get_the_title() . '</a></h2><div class="entry">';
		$content = get_the_content();
		$content = preg_replace('#\[[^\]]+\]#', '',$content);
		$content = apply_filters('the_content', $content);
	$listhnews .= wp_trim_words( $content, 30, '...' );		
	$listhnews .= '</div></div></div>';	
endwhile;	
$listhnews .= '</div></div>';
wp_reset_query();	
restore_current_blog();
return $listhnews;	
}
add_shortcode( 'chpsnews', 'chpsnewsvar' );	
?><?php
//  ------------------------------------------------------------------------
// SHORTCODE TO SEARCH FIELD
// [searchme posttype="" size="" placeholder="" color="" addposts=""]
function searchmevar( $atts ) {
    $d = shortcode_atts( array(
        'posttype' => 'person',
        'size' => 'large',
		'placeholder' => 'Search',
		'color' => 'yellow',
		'addposts' => 'false',
    ), $atts ); 
$listsearch = '<div><form id="searchform" action="' . get_site_url() . '/" method="get"><div class="row">';
if ($d['size'] == 'large') {
	$listsearch .= '<div class="col-md-9 p-1"><input class="searchbar searchlg" type="text" name="s" placeholder="' . $d['placeholder'] . '" onfocus="this.placeholder = ';	
	$listsearch .= "''";	
	$listsearch .= '" onblur="this.placeholder = ';		
	$listsearch .= "'" . $d['placeholder'] . "'";	
	$listsearch .= '" /><input type="hidden" name="post_type" value="' . $d['posttype'] . '" />';
if ($d['addposts'] == 'true') {	
	$listsearch .= '<input type="hidden" name="post_type" value="posts" />';
}
	$listsearch .= '</div><div class="col-md-3 p-1"><input class="searchsubmit-' . $d['color'] . ' searchsublg" id="searchsubmit" type="submit" alt="Search" value="Search" /></div>';	
} elseif ($d['size'] == 'medium'){
	$listsearch .= '<div class="col-md-10 col-sm-10 p-1"><input class="searchbar searchmd" type="text" name="s" placeholder="' . $d['placeholder'] . '" onfocus="this.placeholder = ';	
	$listsearch .= "''";	
	$listsearch .= '" onblur="this.placeholder = ';		
	$listsearch .= "'" . $d['placeholder'] . "'";	
	$listsearch .= '" /><input type="hidden" name="post_type" value="' . $d['posttype'] . '" />';	
	$listsearch .= '</div><div class="col-md-2 col-sm-2 p-1"><input class="searchsubmit-' . $d['color'] . ' searchsubmd" id="searchsubmit" type="submit" alt="Search" value="Search" /></div>';	
} elseif ($d['size'] == 'small'){	
	$listsearch .= '<div class="col-sm-11 col-xs-6 py-1 pl-1 pr-0"><input class="searchbar searchsm" type="text" name="s" placeholder="' . $d['placeholder'] . '" onfocus="this.placeholder = ';	
	$listsearch .= "''";	
	$listsearch .= '" onblur="this.placeholder = ';		
	$listsearch .= "'" . $d['placeholder'] . "'";	
	$listsearch .= '" /><input type="hidden" name="post_type" value="' . $d['posttype'] . '" />';
	$listsearch .= '</div><div class="col-sm-1 col-xs-6 py-1 pl-0 pr-1"><button class="searchsubmit-' . $d['color'] . ' searchsubsm" id="searchsubmit" alt="Search" type="submit"><i class="fa fa-search fa-lg"></i></button></div>';	
} else {	
	$listsearch .= 'Size Error';
}		
$listsearch .= '</div></form></div>';		
wp_reset_query();
return $listsearch;	
}
add_shortcode( 'searchme', 'searchmevar' );	?><?php
//  ------------------------------------------------------------------------
// SHORTCODE TO DISPLAY SOCIAL MEDIA ICONS 
// [minisocial fb="" tw="" ig="" yt="" in="" fk="" align="" size="fa-lg"]
// Size Options: fa-sm, fa-lg, fa-2x, fa-3x 
function minisocialvar( $atts ) {
    $s = shortcode_atts( array(
        'id' => 'minisocial',
		'fb' => '',
        'tw' => '',
		'ig' => '',
		'yt' => '',
		'in' => '',
		'fk' => '',
		'align' => 'left',
		'size' => '',
    ), $atts ); 
$list = '<div id="' . $s['id'] . '" style="text-align: ' . $s['align'] . ';">';
if (!empty($s['fb'])) { $list .= '<a href="' . $s['fb'] . '" title="Follow Us On Facebook" target="_blank" class="fb-socialicon"><span class="fa-stack ' . $s['size'] . '"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-facebook fa-stack-1x fa-inverse"></i></span></a>'; } 
if (!empty($s['tw'])) { $list .= '<a href="' . $s['tw'] . '" title="Follow Us On Twitter" target="_blank" class="tw-socialicon"><span class="fa-stack ' . $s['size'] . '"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-twitter fa-stack-1x fa-inverse"></i></span></a>'; } 
if (!empty($s['ig'])) { $list .= '<a href="' . $s['ig'] . '" title="Follow Us On Instagram" target="_blank" class="ig-socialicon"><span class="fa-stack ' . $s['size'] . '"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-instagram fa-stack-1x fa-inverse"></i></span></a>'; } 
if (!empty($s['yt'])) { $list .= '<a href="' . $s['yt'] . '" title="Watch Us On YouTube" target="_blank" class="yt-socialicon"><span class="fa-stack ' . $s['size'] . '"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-youtube fa-stack-1x fa-inverse"></i></span></a>'; } 
if (!empty($s['in'])) { $list .= '<a href="' . $s['in'] . '" title="Join Us On LinkedIn" target="_blank" class="in-socialicon"><span class="fa-stack ' . $s['size'] . '"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-linkedin fa-stack-1x fa-inverse"></i></span></a>'; } 
if (!empty($s['fk'])) { $list .= '<a href="' . $s['fk'] . '" title="View Us On Flickr" target="_blank" class="fk-socialicon"><span class="fa-stack ' . $s['size'] . '"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-flickr fa-stack-1x fa-inverse"></i></span></a>'; } 
$list .= '</div>'; 
return $list;
}
add_shortcode( 'minisocial', 'minisocialvar' );
//  ------------------------------------------------------------------------
?><?php
//  ------------------------------------------------------------------------
// SHORTCODE TO DISPLAY RECENT LIST OF TEXT LINKS
// [recentlist class="" posttype="" number="" category="" tax="" taxterm=""]
function reclistvar( $atts ) {
    $b = shortcode_atts( array(
        'class' => 'recentlist',
		'posttype' => 'post',
		'number' => '5',
		'category' => '',
		'tax' => '',
		'taxterm' => '',
    ), $atts );
	if (!empty($b['tax'])) { 
		$reclist = new WP_Query(array(
			'post_type'	=> $b['posttype'],
			'post_status' => 'publish',
			'category_name' => $b['category'],
			'orderby' => 'publish_date',
			'order' => 'DESC',
			'posts_per_page' => $b['number'],
			'tax_query' => array(
			array(
				'taxonomy' => $b['tax'],
				'field' => 'slug',
				'terms' => $b['taxterm'],
				),
			),
		)
	);}
	else {
	$reclist = new WP_Query(array(
		'post_type'	=> $b['posttype'],
		'post_status' => 'publish',
		'category_name' => $b['category'],
		'orderby' => 'publish_date',
		'order' => 'DESC',
		'posts_per_page' => $b['number'],
   ));
}
$list = '<div class="' . $b['class'] . '"><ul>';				
	while($reclist->have_posts()) : $reclist->the_post();
	if ($b['posttype'] == "inthemedia") {
		$list .= '<li><a href="' . get_field('external_newsmedia_link') . '" title="' . get_the_title() . '">' . get_the_title() . '</a></li>';
}
	else {
		$list .= '<li><a href="' . get_the_permalink() . '" title="' . get_the_title() . '">' . get_the_title() . '</a></li>';
	}
	endwhile;
$list .= '</ul></div>';						
wp_reset_query(); 
return $list;
}
add_shortcode( 'recentlist', 'reclistvar' );
?><?php
//  ------------------------------------------------------------------------
// SHORTCODE TO DISPLAY RESEARCH INTERNEST BY DEPARTMENT
// [researchlist department=""]
function researchlistvar( $atts ) {
    $r = shortcode_atts( array(
        'department' => '',
    ), $atts ); ?>
<?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
if (!empty($r['department'])) { 
$args = array(
		'post_type' => 'person',
	    'post_status' => 'publish',
		'posts_per_page' => -1,
	    'paged' => $paged,
		'meta_key' => 'profile_L_name',
		'orderby' => 'meta_value',
		'order' => 'ASC', 
        'tax_query' => array(
            array(
                'taxonomy' => 'departments',
                'field' => 'slug',
                'terms' => $r['department'],
            ),
        ),
     );
}
else {
	$args = array(
		'post_type' => 'person',
	    'post_status' => 'publish',
		'posts_per_page' => -1,
	    'paged' => $paged,
		'meta_key' => 'profile_L_name',
		'orderby' => 'meta_value',
		'order' => 'ASC', 
     );
} ?><?php   
     $loop = new WP_Query($args);
        while($loop->have_posts()) : $loop->the_post(); ?>
<?php if (get_field('research_interests')):	?>          
<?php get_template_part( 'research-result'); ?>
<?php	 endif;
		 endwhile; ?>	<!-- then the pagination links -->
<div class="mt-5">
	<?php wpbeginner_numeric_posts_nav(); ?>
</div>
<?php } add_shortcode( 'researchlist', 'researchlistvar' );
//  ------------------------------------------------------------------------
?><?php
//  ------------------------------------------------------------------------
// SHORTCODE TO INDIVIDUAL PERSON
// [showperson name="" column="" pic=""]
function showpersonvar( $atts ) {
    $r = shortcode_atts( array(
        'name' => '',
		'column' =>'1',
		'pic' => 'true',
	), $atts );
switch_to_blog(2);	
$post = get_page_by_title( $r['name'], OBJECT, 'person' );
$getimageURL = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'large' );
$buildingMap = get_field('building', $post->ID);
$peeps = $r['column'];
$showpic = $r['pic'];	
$ellebell = '';	
$profilelabel = '';	
if ($peeps == '1') {$ellebell = 'col-lg-2 col-md-3 col-sm-5 col-4';}
if ($peeps == '2') {$ellebell = 'col-lg-3 col-md-12 col-sm-5 col-4';}
if ($peeps == '3') {$ellebell = 'col-lg-4 col-md-12 col-sm-5 col-4';}
if ($peeps == '3') {$profilelabel ='style="display:none;"';}	
$listpeeps = '<div class="row mb-1 cat-border personlist-ht"><div class="showpic' . $showpic . ' ' . $ellebell . ' p-0 media-background-container catlist-photo mx-auto"><a href="' . get_permalink($post->ID) . '" title="' . $post->post_title . '" >';	
if ( has_post_thumbnail($post->ID)) {
	$listpeeps .= '<img src="' . $getimageURL . '" alt="' . $post->post_title . '';
	$listpeeps .= "'s profile picture at UCF";
	$listpeeps .= '" title="' . $post->post_title . '" class="media-background object-fit-cover">';
} else { 
	$listpeeps .= '<img src="' . get_field('default_profile_image', 'option') . '" alt="' . $post->post_title . '';
	$listpeeps .= "'s profile picture at UCF";
	$listpeeps .= '" title="' . $post->post_title . '" class="media-background object-fit-cover">';
}
$listpeeps .= '</a></div><div class="col p-3"><h2 class="h4"><a href="' . get_permalink($post->ID) . '" rel="bookmark" title="' . $post->post_title . '">' . $post->post_title . '';	
if( get_field('degrees', $post->ID) ) {
	while ( have_rows('degrees', $post->ID) ) : the_row();
	if (!get_sub_field('degree_aftername', $post->ID)) { continue; }
	 $array[] = get_sub_field('degree_select', $post->ID); 
	endwhile;
	$foo = implode(', ', array_column($array, 'label'));
   $listpeeps .= '<span class"">, ' . $foo . '</span>';
}
$listpeeps .= '</a></h2>';
if(get_field('job_titles_tax', $post->ID)){	
	$listpeeps .= '<div class="profilejobtitle">';	
	// Get a list of terms for this post's custom taxonomy.
	$project_cats = get_the_terms($post->ID, 'job_titles');
	// Renumber array.
	$project_cats = array_values($project_cats);
	for($cat_count=0; $cat_count<count($project_cats); $cat_count++) {
		// Each array item is an object. Display its 'name' value.
		$listpeeps .= $project_cats[$cat_count]->name;	 
		// If there is more than one term, comma separate them.
		if ($cat_count<count($project_cats)-1){
			$listpeeps .= ', ';	 
		}
	}	
$listpeeps .= '</div>';	
}	
if(get_the_terms($post->ID, 'departments')){ 	
	$listpeeps .= '<div class="profiledepartments">';	
	// Get a list of terms for this post's custom taxonomy.
	$project_depts = get_the_terms($post->ID, 'departments');
	// Renumber array.
	$project_depts = array_values($project_depts);
	for($dept_count=0; $dept_count<count($project_depts); $dept_count++) {
		// Each array item is an object. Display its 'name' value.
		$listpeeps .= $project_depts[$dept_count]->name;
		// If there is more than one term, comma separate them.
		if ($dept_count<count($project_depts)-1){
			$listpeeps .= ', ';
		}
	}	
$listpeeps .= '</div>';		
}	
if(get_field('building', $post->ID)){
	$listpeeps .= '<div class="row"><div class="col-xl-12 col-md-12 col-sm-12 person-label"><span ' . $profilelabel . '><i class="fa fa-map-marker icongrey"></i> Location: </span><a href="';
	if ($buildingMap == 'HPA I') {$listpeeps .= 'https://www.ucf.edu/location/health-public-affairs-i/';}
	if ($buildingMap == 'HPA II') {$listpeeps .= 'https://www.ucf.edu/location/health-public-affairs-ii/';}
	if ($buildingMap == 'HS I') {$listpeeps .= 'https://www.ucf.edu/location/health-sciences-i/';}
	if ($buildingMap == 'HS II') {$listpeeps .= 'https://www.ucf.edu/location/health-sciences-ii/';}
	if ($buildingMap == 'Education Complex') {$listpeeps .= 'https://www.ucf.edu/location/education-complex-and-gym/';}
	if ($buildingMap == 'Orlando Tech Center') {$listpeeps .= 'https://www.ucf.edu/location/orlando-tech-center-building-300/';}
	if ($buildingMap == 'Research Pavilion') {$listpeeps .= 'https://www.ucf.edu/location/research-pavilion/';}
	if ($buildingMap == 'Partnership 1') {$listpeeps .= 'https://www.ucf.edu/location/partnership-1/';}
	if ($buildingMap == 'Partnership 2') {$listpeeps .= 'https://www.ucf.edu/location/partnership-2/';}
	if ($buildingMap == 'Innovative Center') {$listpeeps .= 'https://www.ucf.edu/location/innovative-center/';}
	if ($buildingMap == 'Barbara Ying Center - CMMS') {$listpeeps .= 'https://www.ucf.edu/location/barbara-ying-center-cmms/';}
	if ($buildingMap == 'Classroom Building I') {$listpeeps .= 'https://www.ucf.edu/location/classroom-building-i/';}
	$listpeeps .= '" target="_blank" title="Map to ' . get_field('building', $post->ID) . '">';
	$listpeeps .= get_field('building', $post->ID);	
	$listpeeps .= '</a>';
		if(get_field('room_number', $post->ID)){
		$listpeeps .= ' <span>' . get_field('office_type', $post->ID) . ': ' . get_field('room_number', $post->ID) . '';
		$listpeeps .= '</span>';
	}
	$listpeeps .= '</div></div>';	
}	
if(get_field('email_address', $post->ID)){
	$listpeeps .= '<div class="row"><div class="col-xl-12 col-md-12 col-sm-12 person-label"><span ' . $profilelabel . '><i class="fa fa-envelope icongrey"></i> E-mail: </span>';
	if(get_field('hide_email', $post->ID)){
		$listpeeps .= '<a href="mailto:' . get_field('alternate_email', $post->ID) . '">' . get_field('alternate_email', $post->ID) . '</a>';
	} else {
		$listpeeps .= '<a href="mailto:' . get_field('email_address', $post->ID) . '">' . get_field('email_address', $post->ID) . '</a>';
	}
	$listpeeps .= '</div></div>';	
}
if(get_field('phone_number', $post->ID)){	
	$listpeeps .= '<div class="row"><div class="col-xl-12 col-md-12 col-sm-12 person-label"><span ' . $profilelabel . '><i class="fa fa-phone icongrey"></i> Phone: </span><a href="tel:' . get_field('phone_number', $post->ID) . '">' . get_field('phone_number', $post->ID) . '</a></div></div>';	
}
$listpeeps .= '</div></div>';
restore_current_blog();		
return $listpeeps;
} add_shortcode( 'showperson', 'showpersonvar' );
//  ------------------------------------------------------------------------
?><?php
//  ----------------------------------------------------
// SHORTCODE TO DISPLAY SHORTCODES FROM MAIN BLOG 
// [rootcode name="" id=""]
function rootcodevar( $atts ) {
    $rc = shortcode_atts( array(
        'name' => 'wd_asp',
        'id' => '1',
    ), $atts );
switch_to_blog(2);
$rcname = $rc['name'];
$rcid = $rc['id'];		
// Use shortcodes from Main blog.
$listrc = do_shortcode( '[' . $rcname . ' id=' . $rcid . ']' );	
wp_reset_query();	
restore_current_blog();
return $listrc;	
}
add_shortcode( 'rootcode', 'rootcodevar' );	
//  ------------------------------------------------------------------------
?><?php
//  ------------------------------------------------------------------------
// SHORTCODE TO DISPLAY GRANTS
// [showgrants unit="" num="" style="grantSmall"]
function grantlistvar( $atts ) {
    $g = shortcode_atts( array(
        'unit' => '',
		'num' => '-1',
		'style' => '',
    ), $atts ); ?>
<?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
//$grantSmall = $g['style'];
if (!empty($g['unit'])) { 
$args = array(
		'post_type' => 'grants',
	    'post_status' => 'publish',
		'posts_per_page' => $g['num'],
	    'paged' => $paged,
		'meta_key' => 'grant_start_date',
		'orderby' => 'meta_value',
		'order' => 'DESC', 
        'tax_query' => array(
            array(
                'taxonomy' => 'grant_units',
                'field' => 'slug',
                'terms' => $g['unit'],
            ),
        ),
		'meta_query' => array( // WordPress has all the results, now, return only the events after today's date
        	array(
            'key' => 'grant_end_date', // Check the start date field
            'value' => date("Y-m-d"), // Set today's date (note the similar format)
            'compare' => '>=', // Return the ones greater than or equal to today's date
            'type' => 'DATE' // Let WordPress know we're working with date
        	)
    	),
     );
}
else {
	$args = array(
		'post_type' => 'grants',
	    'post_status' => 'publish',
		'posts_per_page' => $g['num'],
	    'paged' => $paged,
		'meta_key' => 'grant_start_date',
		'orderby' => 'meta_value',
		'order' => 'DESC', 
     );
} ?>    
<?php   
$loop = new WP_Query($args);
while($loop->have_posts()) : $loop->the_post(); 
?>
<div class="pt-3 pb-3 grantResult <?php echo $g['style']; ?>">
<?php get_template_part( 'grant-results'); ?>
</div>
<?php endwhile; ?>
<div class="mt-5">
	<?php wpbeginner_numeric_posts_nav(); ?>
</div>
<?php } add_shortcode( 'showgrants', 'grantlistvar' );
//  ------------------------------------------------------------------------
?><?php
//  ----------------------------------------------------
// SHORTCODE TO LIST FACULTY BY GROUP 
// [listfaculty number="-1" unit="" specialty="" column="5 or 4" showjob="Yes"]
function listfacultyvar( $atts ) {
    $a = shortcode_atts( array(
        'number' => '-1',
        'specialty' => '',
		'unit' => '',
        'column' => '5',
		'showjob' => '',
    ), $atts );
switch_to_blog(2);
	if (!empty($a['unit'])) { 	
	 $visualnews = new WP_Query(array(
                'post_type' => 'person',
                'post_status' => 'publish',
                'meta_key' => 'profile_L_name',
				'orderby' => 'meta_value',
				'order' => 'ASC', 
                'posts_per_page' => $a['number'],
				'tax_query' => array(
					array(
						'taxonomy' => 'departments',
						'field' => 'name',
						'terms' => $a['unit'],
					),
				),
                )
            ); 	
	}
	elseif (!empty($a['specialty'])) { 	
	 $visualnews = new WP_Query(array(
                'post_type' => 'person',
                'post_status' => 'publish',
                'meta_key' => 'profile_L_name',
				'orderby' => 'meta_value',
				'order' => 'ASC',
                'posts_per_page' => $a['number'],
				'tax_query' => array(
					array(
						'taxonomy' => 'specialty_unit',
						'field' => 'name',
						'terms' => $a['specialty'],
					),
				),
                )
            );	
	}
	else {
	 $visualnews = new WP_Query(array(
                'post_type' => 'person',
                'post_status' => 'publish',
                'meta_key' => 'profile_L_name',
				'orderby' => 'meta_value',
				'order' => 'ASC',
                'posts_per_page' => $a['number'],
                )
            ); 
	}
$listnews = '<div class="container"><div class="d-flex flex-wrap">';
while($visualnews->have_posts()) : $visualnews->the_post(); 
	$getimgURL = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large', false )[0];
	if ($a['column'] == '4') {	
		$listnews .= '<div class="person-4 mb-4">';
		$listnews .= '<a href="' . get_the_permalink() . '" rel="bookmark" class="noDecoration" title="' . get_the_title() . '">';
		$listnews .= '<div class="listpersonGroup"><div class="media-background-container listpersonG4-pic mx-auto">';
	} else {	
		$listnews .= '<div class="person-5 mb-4">';
		$listnews .= '<a href="' . get_the_permalink() . '" rel="bookmark" class="noDecoration" title="' . get_the_title() . '">';
		$listnews .= '<div class="listpersonGroup"><div class="media-background-container listpersonG-pic mx-auto">';
	}	
	if ( has_post_thumbnail()) {	
		$listnews .= '<img src="' . $getimgURL . '" alt="' . get_the_title() . '" title="' . get_the_title() . '" class="media-background object-fit-cover">';
	} else { 	
		$listnews .= '<img src="' . get_field('default_profile_image', 'option') . '" alt="' . get_the_title() . '" title="' . get_the_title() . '" class="media-background object-fit-cover">';
	}	
	$listnews .= '</div><div class="p-3">';
	$listnews .= '<strong>' . get_the_title() . '</strong>';
	//INSERT DEGREES
if( get_field('degrees', $post->ID) ) {
		while ( have_rows('degrees', $post->ID) ) : the_row();
			  if (!get_sub_field('degree_aftername', $post->ID)) {
				continue;
			  }
		 $showDegree = array();
		 $showDegree[] = get_sub_field('degree_select');
		 $foo = implode(', ', array_column($showDegree, 'label'));
			$listnews .= ', ' . $foo . '';
		endwhile;
		}
	//END DEGREES
	if ( !empty($a['showjob'])) {
			if(get_field('job_titles_tax', $post->ID)){	
			$listnews .= '<span class="mt-2" style="display:block;">';
			// Get a list of terms for this post's custom taxonomy.
			$project_cats = get_the_terms($post->ID, 'job_titles');
			// Renumber array.
			$project_cats = array_values($project_cats);
			for($cat_count=0; $cat_count<count($project_cats); $cat_count++) {
				// Each array item is an object. Display its 'name' value.
				$listnews .= $project_cats[$cat_count]->name;	 
				// If there is more than one term, comma separate them.
				if ($cat_count<count($project_cats)-1){
					$listnews .= ', ';	 
				}
			}
			$listnews .= '</span>';	
		}
	}
	else { }
//$listnews .= '<br>';
	// Get a list of terms for this post's custom taxonomy.
	$project_units = get_the_terms($post->ID, 'departments');
	// Renumber array.
	$project_units = array_values($project_units);
	for($unit_count=0; $unit_count<count($project_units); $unit_count++) {
		// Each array item is an object. Display its 'name' value.
//$listnews .= $project_units[$unit_count]->name;	 
		// If there is more than one term, comma separate them.
		if ($unit_count<count($project_units)-1){
//$listnews .= ', ';	 
		}
	}
	$listnews .= '</div></div></a></div>';				
endwhile;
$listnews .= '</div></div>';	
wp_reset_query();
restore_current_blog();
return $listnews;		
}
add_shortcode( 'listfaculty', 'listfacultyvar' );	
?><?php
//  ----------------------------------------------------
// SHORTCODE TO LIST LABS BY DEPARTMENT 
// [showlabs number="-1" unit=""]
function showlabsvar( $atts ) {
    $a = shortcode_atts( array(
        'number' => '99',
		'unit' => '',
    ), $atts );
switch_to_blog(2);
	if (!empty($a['unit'])) { 	
	 $showlabs = new WP_Query(array(
                'post_type' => 'lab',
                'post_status' => 'publish',
				'orderby' => 'title',
				'order' => 'ASC', 
                'posts_per_page' => $a['number'],
				'tax_query' => array(
					array(
						'taxonomy' => 'departments',
						'field' => 'name',
						'terms' => $a['unit'],
					),
				),
                )
            ); 	
	}
	else {
	 $showlabs = new WP_Query(array(
                'post_type' => 'lab',
                'post_status' => 'publish',
				'orderby' => 'title',
				'order' => 'ASC',
                'posts_per_page' => $a['number'],
                )
            ); 
	}
$looplabs = new WP_Query($showlabs);
while($looplabs->have_posts()) : $looplabs->the_post();	
$getimgURL = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large', false )[0];
$listlabs = '<div class="mb-5 pb-4 labStyle container"><div class="row"><div class="col-12 col-md-4 mb-3">';
$listlabs .= '<a href="https://cfl.ucf-card.org">';
$listlabs .= '<img class="flashIMG" width="100%" src="' . $getimgURL . '" alt=""/>';
$listlabs .= '</a>';
$listlabs .= '</div><div class="col-12 col-md-8"><h4>';
$listlabs .= '<a href="https://cfl.ucf-card.org" target="_blank" rel="noopener noreferrer nofollow external" data-wpel-link="external">';
$listlabs .= get_the_title();
$listlabs .= '</a>';
$listlabs .= '</h4>';
$listlabs .= get_the_content();
$listlabs .= '<div class="vc_btn3-container  btnhover-yellow vc_btn3-left mt-3" >';
$listlabs .= '<a style="background-color:#ffcc00; color:#000000;" class="vc_general vc_btn3 vc_btn3-size-sm vc_btn3-shape-square vc_btn3-style-custom" href="https://cfl.ucf-card.org" title="" target="_blank" rel="nofollow external noopener noreferrer" data-wpel-link="external">Visit the Labs Website</a>';
$listlabs .= '</div></div></div></div>';		
endwhile;
wp_reset_query();
restore_current_blog();
return $listlabs;		
}
add_shortcode( 'showlabs', 'showlabsvar' );	
?>
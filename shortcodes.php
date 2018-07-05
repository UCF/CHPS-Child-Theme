<?php // [exnews number=""] 
function externalnewsvar( $atts ) {
    $a = shortcode_atts( array(
        'number' => '12',
    ), $atts );
		$externalnews = new WP_Query(array(
				'post_type'	=> 'inthemedia',
				'post_status' => 'publish',
				'orderby' => 'publish_date',
				'order' => 'DESC',
				'posts_per_page' => $a['number'],
				)
			);?> 	
 <div class="container newsmedia">
    <div class="row narrow-gutter row-flex">
		<?php while($externalnews->have_posts()) : $externalnews->the_post();?>	
			<!-- START THE REPEAT SECTION -->   
			<div class="col-lg-3 col-sm-6 col-xs-12">
				<a href="<?php the_field('external_newsmedia_link'); ?>" title="<?php the_title(); ?>" target="_blank"><div class="content">
				  <?php the_title(); ?>
				  <p class="newsdate"><?php the_time('F j, Y'); ?></p>
				  </div></a>
			</div>
			<!-- END OF THE REPEAT SECTION -->		
		<?php endwhile; ?>
    </div>
</div>
<?php wp_reset_query(); ?> 
<style>	
.newsmedia .col-xs-12 a {
    color:#000;
    text-decoration:none !important;
}
.row-flex {
  display: flex;
  flex-wrap: wrap;
}
[class*="col-"] {
  margin-bottom: 12px;
}
.newsmedia .content {
  height: 100%;
  padding: 12px;
  color: #000;
  border: solid 1px #ddd;
  line-height:15px;
  font-size: 13px !important;
  font-weight:500;
}
.newsmedia .content:hover {
  background: #eee;
}
.newsmedia .narrow-gutter [class*='col-'] {
  padding-right:6px;
  padding-left:6px;
}
.newsmedia .newsdate {
    margin-top:15px;
    display:block;
    font-weight:normal;
    color: #aaa;
    font-style: italic;
}
</style>
<?php }
add_shortcode( 'exnews', 'externalnewsvar' );
?><?php
//  ------------------------------------------------------------------------
// SHORTCODE TO DISPLAY RECENT NEWS VERTICALLY IN BOXES 
//
// [newsvisual number="" category=""]
function newsvisualvar( $atts ) {
    $a = shortcode_atts( array(
        'number' => '4',
        'category' => '0',
		'column' => '4',
    ), $atts );
$category_id = get_cat_ID($a['category']);	
		$visualnews = new WP_Query(array(
				'post_type'	=> 'post',
				'post_status' => 'publish',
				'orderby' => 'publish_date',
				'order' => 'DESC',
				'posts_per_page' => $a['number'],
				'cat' => $category_id,
				)
			); ?> 							
 <div class="container newsmedia">
    <div class="row narrow-gutter row-flex">
		<?php while($visualnews->have_posts()) : $visualnews->the_post();
	$getimgURL = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large', false )[0];	?><!-- START THE REPEAT SECTION -->   
			<?php if ($a['column'] == '3') { ?> 
				<div class="col-lg-4 col-sm-6 col-xs-12">
					<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
						<div class="visnews">
							<div class="media-background-container visnews-photo mx-auto">
			<?php } else { ?> 
				<div class="col-lg-3 col-sm-6 col-xs-12">
					<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
						<div class="visnews">
							<div class="media-background-container visnews-photo mx-auto">
			<?php } ?>
								<?php if ( has_post_thumbnail()) { ?>
									<img src="<?php echo $getimgURL; ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" class="media-background object-fit-cover">
									<?php } else { ?>
									<img src="<?php the_field('default_news_image', 'option'); ?>" alt="<?php the_title_attribute(); ?>" title="<?php the_title_attribute(); ?>" class="media-background object-fit-cover">
								<?php } ?>
							</div>
							<div class="p-3">
								<?php the_title(); ?>
								<p class="newsdate"><?php the_time('F j, Y'); ?></p>
							</div>
						</div>
					</a>
				</div><!-- END OF THE REPEAT SECTION -->		
		<?php endwhile; ?>
    </div>
</div>
<?php wp_reset_query(); ?> 
<style>	
.visnews-photo {
    height: 200px;
}
@media screen and (max-width: 992px) {
	.visnews-photo {
		width: 100%;
		height:225px;
	}
}	
.newsmedia .visnews {
  height: 100%;
  padding: 0px; 
  color: #000;
  border: solid 1px #ddd;
  line-height:17px;
  font-size: 15px !important;
  font-weight:500;
}
.newsmedia .visnews:hover {
  background: #eee;
}	
.newsmedia .col-xs-12 a {
    color:#000;
    text-decoration:none !important;
}
.row-flex {
  display: flex;
  flex-wrap: wrap;
}
[class*="col-"] {
  margin-bottom: 12px;
}
.newsmedia .narrow-gutter [class*='col-'] {
  padding-right:6px;
  padding-left:6px;
}
.newsmedia .newsdate {
    margin-top:15px;
    display:block;
    font-weight:normal;
    color: #aaa;
    font-style: italic;
} /* START RECURRING STYLING */	
</style>
<?php }
add_shortcode( 'newsvisual', 'newsvisualvar' );
//  ------------------------------------------------------------------------
?><?php
//  ------------------------------------------------------------------------
// SHORTCODE TO DISPLAY RECENT NEWS TEXT LINKS
//
// [recentnews category="" number=""]
function recnewsvar( $atts ) {
    $b = shortcode_atts( array(
        'class' => 'recentlist',
		'number' => '5',
		'posttype' => 'post',
        //'category' => 'something else',
    ), $atts );
		$recnews = new WP_Query(array(
				'post_type'	=> $b['posttype'],
				'post_status' => 'publish',
				'orderby' => 'publish_date',
				'order' => 'DESC',
				'posts_per_page' => $b['number'],
				)
			);?> 	
    <div class="<?php echo $b['class'] ?>">
    	<ul>
		<?php while($recnews->have_posts()) : $recnews->the_post();?>	
			<!-- START THE REPEAT SECTION -->   
			<li class="mb-3 recnews">
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
				  <?php the_title(); ?>
				</a>
			</li>
			<!-- END OF THE REPEAT SECTION -->		
		<?php endwhile; ?>
   		</ul>
   	</div>
<?php wp_reset_query(); ?> 
<?php }
add_shortcode( 'recentnews', 'recnewsvar' );
?><?php
//  ------------------------------------------------------------------------
// SHORTCODE TO DISPLAY RECENT NEWS TEXT LINKS
//
// [recentexnews category="" number=""]
function recexnewsvar( $atts ) {
    $b = shortcode_atts( array(
        'number' => '10',
        //'category' => 'something else',
    ), $atts );
		$recexnews = new WP_Query(array(
				'post_type'	=> 'inthemedia',
				'post_status' => 'publish',
				'orderby' => 'publish_date',
				'order' => 'DESC',
				'posts_per_page' => $b['number'],
				)
			);?> 	
    <div id="categories-4" class="widget widget_categories widgetFix"><h2 class="h5 heading-underline">In the Media</h2>		
    	<ul>
		<?php while($recexnews->have_posts()) : $recexnews->the_post();?>	
			<!-- START THE REPEAT SECTION -->   
			<li class="cat-item">
				<a href="<?php the_field('external_newsmedia_link'); ?>" title="<?php the_title(); ?>" target="_blank">
				  <?php the_title(); ?>
				</a>
			</li>
			<!-- END OF THE REPEAT SECTION -->		
		<?php endwhile; ?>
   		</ul>
	</div>
<?php wp_reset_query(); ?> 
<?php }
add_shortcode( 'recentexnews', 'recexnewsvar' );
?><?php
//  ------------------------------------------------------------------------
// SHORTCODE TO DISPLAY RECENT NEWS HORIZONTAL ON HOMEPAGE
//
// [chpsnews category="" number=""]
function chpsnewsvar( $atts ) {
    $c = shortcode_atts( array(
        'number' => '3',
        'category' => '0',
    ), $atts );
$category_id = get_cat_ID($c['category']);	
		$chpsnews = new WP_Query(array(
				'post_type'	=> 'post',
				'post_status' => 'publish',
				'orderby' => 'publish_date',
				'order' => 'DESC',
				'posts_per_page' => $c['number'],
				'cat' => $category_id,
				)
			);?> 	
 <div class="container">
    <div class="row">
		<?php while($chpsnews->have_posts()) : $chpsnews->the_post();
			$getimgURL = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large', false )[0];
			$display_name = get_the_author_meta( 'display_name')[0];
			$categories = get_the_category(); 	?>	
			<!-- START THE REPEAT SECTION -->   
			<div class="row mb-5 chpsnews">
				<div class="col-lg-3 p-0 media-background-container catlist-photo mx-auto">
					   <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
					   <?php if ( has_post_thumbnail()) { ?>
							<img src="<?php echo $getimgURL; ?>" alt="<?php the_title_attribute(); ?>" title="<?php the_title_attribute(); ?>" class="media-background object-fit-cover">
							<?php } else { ?>
							<img src="<?php the_field('default_news_image', 'option'); ?>" alt="<?php the_title_attribute(); ?>" title="<?php the_title_attribute(); ?>" class="media-background object-fit-cover">
						<?php } ?>
					   </a>
				</div>
				<div class="col-lg-9 px-4 py-0">
					<?php if ( ! empty( $categories ) ) {
							echo '<a class="category-title" href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a>';
						} ?>
					<h2 class="h5 pt-2 mainnews"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
					<div class="entry">
					<?php 			
								$content = get_the_content();
								$content = preg_replace('#\[[^\]]+\]#', '',$content);
								$content = apply_filters('the_content', $content);
								echo wp_trim_words( $content, 30, '...' );
								?>
					</div>
				</div>
			</div>	<!-- END OF THE REPEAT SECTION -->		
		<?php endwhile; ?>
    </div>
</div>
<?php wp_reset_query(); ?> <?php }
add_shortcode( 'chpsnews', 'chpsnewsvar' );
?><?php
//  ------------------------------------------------------------------------
// SHORTCODE TO SEARCH FIELD
//
// [searchme posttype="" size="" placeholder="" color="" addposts=""]
function searchmevar( $atts ) {
    $d = shortcode_atts( array(
        'posttype' => 'person',
        'size' => 'large',
		'placeholder' => 'Search',
		'color' => 'yellow',
		'addposts' => 'false',
    ), $atts ); ?> 	
<div>
	<form id="searchform" action="<?php echo get_site_url(); ?>/" method="get">
		<div class="row">
			<?php if ($d['size'] == 'large') { ?> 
				<div class="col-md-9 p-1">
					<input class="searchbar searchlg" type="text" name="s" placeholder="<?php echo $d['placeholder'] ?>" onfocus="this.placeholder = ''" onblur="this.placeholder = '<?php echo $d['placeholder'] ?>'" />
					<input type="hidden" name="post_type" value="<?php echo $d['posttype'] ?>" />
					<?php if ($d['addposts'] == 'true') { ?>
						<input type="hidden" name="post_type" value="posts" />
					<?php } ?>
				</div>
				<div class="col-md-3 p-1">
					<input class="searchsubmit-<?php echo $d['color'] ?> searchsublg" id="searchsubmit" type="submit" alt="Search" value="Search" />
				</div>
			<?php } elseif ($d['size'] == 'medium'){ ?> 
				<div class="col-md-10 col-sm-10 p-0">
					<input class="searchbar searchmd" type="text" name="s" placeholder="<?php echo $d['placeholder'] ?>" onfocus="this.placeholder = ''" onblur="this.placeholder = '<?php echo $d['placeholder'] ?>'" />
					<input type="hidden" name="post_type" value="<?php echo $d['posttype'] ?>" />
				</div>
				<div class="col-md-2 col-sm-2 p-0">
					<input class="searchsubmit-<?php echo $d['color'] ?> searchsubmd" id="searchsubmit" type="submit" alt="Search" value="Search" />
				</div>
			<?php } elseif ($d['size'] == 'small'){ ?> 
				<div class="col-sm-11 col-xs-6 p-0">
					<input class="searchbar searchsm" type="text" name="s" placeholder="<?php echo $d['placeholder'] ?>" onfocus="this.placeholder = ''" onblur="this.placeholder = '<?php echo $d['placeholder'] ?>'" />
					<input type="hidden" name="post_type" value="<?php echo $d['posttype'] ?>" />
				</div>
				<div class="col-sm-1 col-xs-6 p-0">
					<input class="searchsubmit-<?php echo $d['color'] ?> searchsubsm" id="searchsubmit" type="submit" alt="Search" value="Search" />
				</div>
			<?php } else { ?> 
				Size Error
			<?php } ?>
		</div>
	</form>
</div>
<?php wp_reset_query(); ?> 
<?php	}
add_shortcode( 'searchme', 'searchmevar' ); ?><?php
//  ------------------------------------------------------------------------
// SHORTCODE TO DISPLAY SOCIAL MEDIA ICONS 
//
// [socialicons fb="" tw="" ig="" yt="" in="" align=""]
function socialiconvar( $atts ) {
    $s = shortcode_atts( array(
        'fb' => '',
        'tw' => '',
		'ig' => '',
		'yt' => '',
		'in' => '',
		'align' => 'left',
    ), $atts ); ?>	
<div class="socialicons" style="text-align: <?php echo $s['align']; ?> !important;">
	<div class="scode-socialicons">
		<?php if (!empty($s['fb'])) { ?><a href="<?php echo $s['fb']; ?>" title="Follow Us On Facebook" target="_blank" class="fb-socialicon"><span class="fa-stack fa-lg">
		  <i class="fa fa-circle fa-stack-2x"></i>
		  <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
		</span></a><?php } ?><?php if (!empty($s['tw'])) { ?><a href="<?php echo $s['tw']; ?>" title="Follow Us On Twitter" target="_blank" class="tw-socialicon"><span class="fa-stack fa-lg">
		  <i class="fa fa-circle fa-stack-2x"></i>
		  <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
		</span></a><?php } ?><?php if (!empty($s['ig'])) { ?><a href="<?php echo $s['ig']; ?>" title="Follow Us On Instagram" target="_blank" class="ig-socialicon"><span class="fa-stack fa-lg">
		  <i class="fa fa-circle fa-stack-2x"></i>
		  <i class="fa fa-instagram fa-stack-1x fa-inverse"></i>
		</span></a><?php } ?><?php if (!empty($s['yt'])) { ?><a href="<?php echo $s['yt']; ?>" title="Watch Us On YouTube" target="_blank" class="yt-socialicon"><span class="fa-stack fa-lg">
		  <i class="fa fa-circle fa-stack-2x"></i>
		  <i class="fa fa-youtube fa-stack-1x fa-inverse"></i>
		</span></a><?php } ?><?php if (!empty($s['in'])) { ?><a href="<?php echo $s['in']; ?>" title="Join Us On LinkedIn" target="_blank" class="in-socialicon"><span class="fa-stack fa-lg">
		  <i class="fa fa-circle fa-stack-2x"></i>
		  <i class="fa fa-linkedin fa-stack-1x fa-inverse"></i>
		</span></a><?php } ?>
	</div>
</div>
<?php }
add_shortcode( 'socialicons', 'socialiconvar' );
//  ------------------------------------------------------------------------
?><?php
//  ------------------------------------------------------------------------
// SHORTCODE TO DISPLAY SOCIAL MEDIA ICONS 
//
// [minisocial fb="" tw="" ig="" yt="" in="" fk="" align="" size="fa-lg"]
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
//
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
$list .= '<li><a href="#" title="Name">Name</a></li>';	
endwhile;
$list .= '</ul></div>';						
wp_reset_query(); 
return $list;
}
add_shortcode( 'recentlist', 'reclistvar' );
?><?php
//  ------------------------------------------------------------------------
// SHORTCODE TO DISPLAY RESEARCH INTERNEST BY DEPARTMENT
//
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
?>
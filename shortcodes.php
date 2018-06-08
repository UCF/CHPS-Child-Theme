<?php
// [exnews number=""]
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
<?php	
}
add_shortcode( 'exnews', 'externalnewsvar' );
?>


<?php
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
			);
			
?> 							
 <div class="container newsmedia">
    <div class="row narrow-gutter row-flex">
		<?php while($visualnews->have_posts()) : $visualnews->the_post();
		
	$getimgURL = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large', false )[0];
		?>	
			<!-- START THE REPEAT SECTION -->   
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
				</div>
			<!-- END OF THE REPEAT SECTION -->		
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
/* ----------------------- */	
/*                         */
/* START RECURRING STYLING */
/*                         */	
/* ----------------------- */	
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
}
/* START RECURRING STYLING */	
</style>
<?php	
}
add_shortcode( 'newsvisual', 'newsvisualvar' );
//  ------------------------------------------------------------------------
?>




<?php
//  ------------------------------------------------------------------------
// SHORTCODE TO DISPLAY RECENT NEWS TEXT LINKS
//
// [recentnews category="" number=""]
function recnewsvar( $atts ) {
    $b = shortcode_atts( array(
        'number' => '10',
        //'category' => 'something else',
    ), $atts );
	
		$recnews = new WP_Query(array(
				'post_type'	=> 'post',
				'post_status' => 'publish',
				'orderby' => 'publish_date',
				'order' => 'DESC',
				'posts_per_page' => $b['number'],
				)
			);?> 	
 <div class="container">
    <div class="row">
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
</div>
<?php wp_reset_query(); ?> 
<style>	

</style>
<?php	
}
add_shortcode( 'recentnews', 'recnewsvar' );
?>






<?php
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
			$categories = get_the_category();
		?>	
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
					<?php 
						if ( ! empty( $categories ) ) {
							echo '<a class="category-title" href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a>';
						}
					?>
					<h2 class="h5 pt-2 mainnews"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>

					<!--
					<span class="authortext">Written By: <?php //if(get_field('overwrite_author')){ the_field('overwrite_author');} else { echo $display_name; }?> | <?php //the_time('F j, Y'); ?></span> -->

					<div class="entry">
					<?php
						echo wp_trim_words( get_the_content(), 30, '...' );
					?>
					</div>
				</div>
			</div>
			<!-- END OF THE REPEAT SECTION -->		
		<?php endwhile; ?>
    </div>
    
</div>
<?php wp_reset_query(); ?> 
<style>	

	
</style>
<?php	
}
add_shortcode( 'chpsnews', 'chpsnewsvar' );
?>


<?php
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
    ), $atts );
?> 	
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
<style>	

</style>
<?php	
}
add_shortcode( 'searchme', 'searchmevar' );
?>


<?php
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
    ), $atts );
	
?>	
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
<?php	
}
add_shortcode( 'socialicons', 'socialiconvar' );
//  ------------------------------------------------------------------------
?>



<?php
//  ------------------------------------------------------------------------
// SHORTCODE TO DISPLAY RESEARCH INTERNEST BY DEPARTMENT
//
// [researchlist department=""]
function researchlistvar( $atts ) {
    $r = shortcode_atts( array(
        'department' => '',
    ), $atts );

if (!empty($r['department'])) { 
$args = array(
		'post_type' => 'person',
		'posts_per_page' => -1,
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
		'posts_per_page' => -1,
		'meta_key' => 'profile_L_name',
		'orderby' => 'meta_value',
		'order' => 'ASC', 
     );
}
     $loop = new WP_Query($args);
     if($loop->have_posts()) {

        while($loop->have_posts()) : $loop->the_post(); 
		if (get_field('research_interests')):				
						?>
          
<?php $getimageURL = wp_get_attachment_url( get_post_thumbnail_id(), 'large' ); ?>
<div class="row mb-4 personlist-ht">
	<div class="col-lg-3 col-md-3 col-sm-4 col-4 px-2 py-0">

		   <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
		   <?php if ( has_post_thumbnail()) { ?>
				<img src="<?php echo $getimageURL; ?>" width="100%" alt="<?php echo get_person_name( $post ); ?>'s profile picture at UCF" title="<?php $post->post_title; ?>" class="">
				<?php } else { ?> 
					<?php switch_to_blog(2);?>
						<img src="<?php the_field('default_profile_image', 'option'); ?>"  width="100%"  alt="<?php echo get_person_name( $post ); ?>'s profile picture at UCF" title="<?php $post->post_title; ?>" class="">
					<?php restore_current_blog(); ?>
		<?php } ?>
		   </a> 
	</div>

	<div class="col-lg-9 col-md-9 col-sm-8 col-8 px-4 py-0">

		<h2 class="h4"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>

		<?php
		if(get_field('job_titles_tax')){ ?>
			<div class="profilejobtitle mb-2">
				<?php
				// Get a list of terms for this post's custom taxonomy.
				$project_cats = get_the_terms(get_the_ID(), 'job_titles');
				// Renumber array.
				$project_cats = array_values($project_cats);
				for($cat_count=0; $cat_count<count($project_cats); $cat_count++) {
					// Each array item is an object. Display its 'name' value.
					echo $project_cats[$cat_count]->name;
					// If there is more than one term, comma separate them.
					if ($cat_count<count($project_cats)-1){
						echo ', ';
					}
				}?>
			</div>
		<?php }	?>
	
		<?php if(get_field('email_address')){ ?>
			<div class="row">
					<div class="col-xl-12 col-md-12 col-sm-12 person-label">
						<i class="fa fa-envelope icongrey"></i> E-mail: <a href="mailto:<?php the_field('email_address'); ?>"><?php the_field('email_address'); ?></a>
					</div>
				</div>
		<?php }	?>	

		<?php if(get_field('phone_number')){ ?>
			<div class="row mb-2">
					<div class="col-xl-12 col-md-12 col-sm-12 person-label">
						<i class="fa fa-phone icongrey"></i> Phone: <a href="tel:<?php the_field('phone_number'); ?>"><?php the_field('phone_number'); ?></a>
					</div>
				</div>
		<?php }	?>
		
			<div class="row">
				<div class="col-xl-12 col-md-12 col-sm-12 person-label">
				<?php $termswer = get_field('research_interests');?>
					<ul id="researchIntList">
						<?php foreach( $termswer as $term ): ?>
							<li><i class="fa fa-check fa-lg iconyellow"></i> <?php echo $term->name; ?></li>
						<?php endforeach; ?>
					</ul>
				</div>
			</div>

	</div>
</div>
<?php
echo do_shortcode('[vc_separator style="shadow" border_width="2"]');		 
		 endif;
		 endwhile;
     }
?>	

<?php	
}
add_shortcode( 'researchlist', 'researchlistvar' );
//  ------------------------------------------------------------------------
?>



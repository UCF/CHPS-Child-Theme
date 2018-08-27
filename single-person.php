<?php get_header(); the_post(); 
$project_depts = get_the_terms($post->ID, 'departments');
$getimageURL = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'full' );
$buildingMap = get_field('building');
$ids = get_the_ID();
?>
<div class="container mb-5 mt-3 mt-lg-5">
	<div class="row mb-4">
		<div class="col-lg-6">	
			<header class="archive-header">
				<h1 class="archive-title heading-underline">Faculty and Staff</h1>
			</header>
		</div>
		<div class="col-lg-6">	
			<?php echo do_shortcode( ' [searchme posttype="person" size="large" placeholder="Search by Name"] ' ); ?>
		</div>
		<div class="col-lg-12 pt-2">	
			<a href="/directory/" title="Back to the Directory"><i class="fa fa-chevron-circle-left icongrey"></i><span class="searchresults">Back to the Full Directory</strong></span></a>
		</div>
	</div>
<article class="<?php echo $post->post_status; ?> post-list-item">
	<div class="container">
		<div class="row">
			<div class="col-md-4 mb-5">
				<aside class="person-contact-container">
					<div class="mb-4" style="text-align: center;">
<div id="profileIMG">
	<?php if ( has_post_thumbnail()) { ?>
		<a href="<?php echo $getimageURL ?>" rel="lightbox" title ="<?php echo get_person_name( $post ); ?> at UCF" ><img width="100%" alt="<?php echo get_person_name( $post ); ?>'s profile picture at UCF" src="<?php echo $getimageURL ?>" /></a>
		<?php } else { ?> 
		<?php switch_to_blog(2);?>
			<img width="100%" title="<?php $post->post_title; ?>" alt="<?php echo get_person_name( $post ); ?>'s profile picture at UCF" src="<?php the_field('default_profile_image', 'option'); ?>" />
		<?php restore_current_blog(); ?>	
	<?php } ?>
</div>
					</div>
					<h1 class="h5 person-title text-center mb-2">
						<?php echo get_person_name( $post ); ?><?php if( get_field('degrees') ) {
							while ( have_rows('degrees') ) : the_row();
							 $arrayDegree[] = get_sub_field('degree'); 
							endwhile;
							$degreeIDs = implode(', ', $arrayDegree);
						   echo '<span class"">, ' . $degreeIDs . '</span>';
						}
						?>		
					</h1>
					<div class="person-job-title text-center mb-4">
						<?php
						if(get_field('job_titles_tax')){ ?>
							<div class="profilejobtitle">
								<?php
								// Get a list of terms for this post's custom taxonomy.
								$project_cats = get_the_terms($post->ID, 'job_titles');
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
					</div>
					<?php if (get_field('cv')): ?>	
						<div class="row mt-3 mb-5">
							<div class="col-md offset-md-0 col-8 offset-2 my-1">
								<a href="<?php the_field('cv'); ?>" class="btn btn-primary btn-block">Download CV</a>
							</div>
						</div>
					<?php endif; ?>					
<?php if(get_field('department_tax')){ ?>
	<div class="row">
		<div class="col-xl-4 col-md-12 col-sm-4 person-label">
			Unit<?php if ( count( $project_depts ) > 1 ) { echo 's'; } ?>
		</div>
		<div class="col-xl-8 col-md-12 col-sm-8 person-attr">
			<ul class="list-unstyled mb-0">
				<?php
				$project_depts = array_values($project_depts);
				for($dept_count=0; $dept_count<count($project_depts); $dept_count++) {  ?>
					<li><?php echo $project_depts[$dept_count]->name; ; ?></li>
				<?php } ?>
			</ul>
		</div>
	</div>
	<hr class="my-2">
<?php }	?>	
<?php if(get_field('building')){ ?>
<div class="row">
		<div class="col-xl-4 col-md-12 col-sm-4 person-label">
			Location
		</div>
		<div class="col-xl-8 col-md-12 col-sm-8 person-attr">
			<a href="<?php 
		if ($buildingMap == 'HPA I') {echo 'http://map.ucf.edu/locations/80/health-public-affairs-i/';}
		if ($buildingMap == 'HPA II') {echo 'http://map.ucf.edu/locations/80/health-public-affairs-ii/';}
		if ($buildingMap == 'Education Complex') {echo 'https://map.ucf.edu/locations/21/education-complex-gym/';}
	    if ($buildingMap == 'Wayne Densch Center 1') {echo 'https://map.ucf.edu/locations/38/wayne-densch-center-i-wd1/';}
		if ($buildingMap == 'Orlando Tech Center') {echo 'http://map.ucf.edu/locations/8113/orlando-tech-center-otc3/';}
		if ($buildingMap == 'Research Pavilion') {echo 'http://map.ucf.edu/locations/8102/research-pavilion-pvl/';}
		if ($buildingMap == 'Partnership 1') {echo 'https://map.ucf.edu/locations/8111/partnership-i-cps/';}
		if ($buildingMap == 'Engineering 1') {echo 'https://map.ucf.edu/locations/40/engineering-i-eng1/';}
		if ($buildingMap == 'Millican Hall') {echo 'https://map.ucf.edu/locations/1/millican-hall-mh/';}
		if ($buildingMap == 'Innovative Center') {echo 'https://map.ucf.edu/locations/8112/innovative-center-ic/';}
		if ($buildingMap == 'Biomedical Sciences Building') {echo 'https://med.ucf.edu/biomed/about/ourlocations/biomedical-sciences-building/';}
		?>" target="_blank" title="Map to <?php the_field('building'); ?>">
				<?php the_field('building'); ?>
			</a>
			<?php if(get_field('room_number')){ ?>
			<span>
				<?php the_field('office_type'); ?>: <?php the_field('room_number'); ?>
			</span>
			<?php }
			?>	
		</div>
	</div>
	<hr class="my-2">			
<?php }
?>	
<?php if(get_field('email_address')){ ?>
<div class="row">
		<div class="col-xl-4 col-md-12 col-sm-4 person-label">
			E-mail 333
		</div>
		<div class="col-xl-8 col-md-12 col-sm-8 person-attr">
			<?php if( get_field( 'hide_email' )) {  ?>
			<a href="mailto:<?php the_field('alternate_email'); ?>">
				<?php the_field('alternate_email'); ?>
			</a>			
			<? } else { ?>
			<a href="mailto:<?php the_field('email_address'); ?>">
				<?php the_field('email_address'); ?>
			</a>	
			<?php } ?>
		</div>
	</div>
	<hr class="my-2">			
<?php }
?>	
<?php if(get_field('phone_number')){ ?>
<div class="row">
		<div class="col-xl-4 col-md-12 col-sm-4 person-label">
			Phone
		</div>
		<div class="col-xl-8 col-md-12 col-sm-8 person-attr">
			<a href="tel:<?php the_field('phone_number'); ?>">
				<?php the_field('phone_number'); ?>
			</a>
		</div>
	</div>
	<hr class="my-2">			
<?php }
?>
<?php if(get_field('website_url')||get_field('facebook_url')||get_field('twitter_url')||get_field('youtube_url')||get_field('linkedin_url')){ ?>
<div class="row">
		<div class="col-xl-4 col-md-12 col-sm-4 person-label">
			Connect
		</div>
		<div class="col-xl-8 col-md-12 col-sm-8 person-attr">
			<?php if (get_field('website_url')): ?>
				<a href="<?php the_field('website_url'); ?>" title="Visit My Personal Website" target="_blank"><span class="fa-stack">
					  <i class="fa fa-circle fa-stack-2x profile-social-web"></i>
					  <i class="fa fa-link fa-flip-horizontal fa-stack-1x profile-social-icon"></i>
				</span></a><?php endif; ?><?php if (get_field('facebook_url')): ?><a href="<?php the_field('facebook_url'); ?>" title="Follow Us On Facebook" target="_blank"><span class="fa-stack">
				  <i class="fa fa-circle fa-stack-2x profile-social-fb"></i>
				  <i class="fa fa-facebook fa-stack-1x profile-social-icon"></i>
				</span></a><?php endif; ?><?php if (get_field('twitter_url')): ?><a href="<?php the_field('twitter_url'); ?>" title="Follow Us On Twitter" target="_blank"><span class="fa-stack">
				  <i class="fa fa-circle fa-stack-2x profile-social-tw"></i>
				  <i class="fa fa-twitter fa-stack-1x profile-social-icon"></i>
				</span></a><?php endif; ?><?php if (get_field('youtube_url')): ?><a href="<?php the_field('youtube_url'); ?>" title="Watch Us On YouTube" target="_blank"><span class="fa-stack">
				  <i class="fa fa-circle fa-stack-2x profile-social-yt"></i>
				  <i class="fa fa-youtube fa-stack-1x profile-social-icon"></i>
				</span></a><?php endif; ?><?php if (get_field('linkedin_url')): ?><a href="<?php the_field('linkedin_url'); ?>" title="Join Us On LinkedIn" target="_blank"><span class="fa-stack">
				  <i class="fa fa-circle fa-stack-2x profile-social-lk"></i>
				  <i class="fa fa-linkedin fa-stack-1x profile-social-icon"></i>
				</span></a>
			<?php endif; ?>
		</div>
	</div>
	<hr class="my-2">			
<?php }
?>
<?php if (have_rows('additional_links') ) { 	?>
<div class="row">
		<div class="col-xl-4 col-md-12 col-sm-4 person-label">
			Links
		</div>
		<div class="col-xl-8 col-md-12 col-sm-8 person-attr">
			<ul class="list-unstyled mb-0">
				<?php while (have_rows('additional_links') ): the_row(); ?> 
					<li>
						<a href="<?php the_sub_field('link_url'); ?>" target="_blank" title="<?php the_sub_field('link_title');?>"><?php the_sub_field('link_title');?></a>
					</li>
				<?php endwhile; ?>
			</ul>
		</div>
	</div>
	<hr class="my-2">			
<?php }
?>	
<style>
#profileIMG {
	text-align: center;
	max-width: 250px;
	margin: 0px auto;
	padding: 6px;
	box-shadow: 0 0 5px rgba(0,0,0,.1);
}
header .container .h1, header .container .lead {
	display: none !important;
}	
</style>				
				</aside>
			</div>
			<div class="col-md-8 pl-md-5">
				<section class="person-content">
<?php 
$posts = get_posts(array(
	'numberposts'	=> -1,
	'post_type'		=> 'post',
	'order'         => 'DESC',
	'orderby'       => 'date',
	'meta_query' => array(
		array(  
			'key' => 'tag_person', // slug of custom field
			'value' => $ids, // keep this to match current profile
			'compare' => 'LIKE'
			  )
		 )
));
?>
		<div class="vc_row wpb_row vc_row-fluid"><div class="wpb_column vc_column_container vc_col-sm-8"><div class="vc_column-inner "><div class="wpb_wrapper"><div class="vc_tta-container" data-vc-action="collapse"><div class="vc_general vc_tta vc_tta-tabs vc_tta-color-grey vc_tta-style-classic vc_tta-shape-square vc_tta-spacing-1 vc_tta-o-no-fill vc_tta-tabs-position-top vc_tta-controls-align-left"><div class="vc_tta-tabs-container"><ul class="vc_tta-tabs-list"><?php if (get_field('biography')||get_field('degrees')||get_field('affiliations')): ?><li class="vc_tta-tab vc_active" data-vc-tab><a href="#biography" data-vc-tabs data-vc-container=".vc_tta"><span class="vc_tta-title-text">Biography</span></a></li><?php endif; ?><?php if (get_field('research_info')||get_field('research_interests')): ?><li class="vc_tta-tab" data-vc-tab><a href="#research" data-vc-tabs data-vc-container=".vc_tta"><span class="vc_tta-title-text">Research</span></a></li><?php endif; ?><?php if (have_rows('add_courses')):?><li class="vc_tta-tab" data-vc-tab><a href="#courses" data-vc-tabs data-vc-container=".vc_tta"><span class="vc_tta-title-text">Courses</span></a></li><?php endif; ?><?php if ($posts): ?><li class="vc_tta-tab" data-vc-tab><a href="#news" data-vc-tabs data-vc-container=".vc_tta"><span class="vc_tta-title-text">News</span></a></li><?php endif; ?>	
					</ul></div><div class="vc_tta-panels-container"><div class="vc_tta-panels">
					<?php if (get_field('biography')||get_field('degrees')||get_field('affiliations')): ?>
					<div class="vc_tta-panel vc_active" id="biography" data-vc-content=".vc_tta-panel-body"><div class="vc_tta-panel-heading"><h4 class="vc_tta-panel-title"><a href="#biography" data-vc-accordion data-vc-container=".vc_tta-container"><span class="vc_tta-title-text">Biography</span></a></h4></div><div class="vc_tta-panel-body">
						<div class="wpb_text_column wpb_content_element " >
							<div class="wpb_wrapper">
								<span class="mb-4"><?php the_field('biography'); ?></span>
								<?php if (have_rows('degrees') ) { 	?>
									<div class="mb-4">
										<h5>Credentials</h5>
										<ul>
											<?php while (have_rows('degrees') ): the_row(); ?> 

													<li><?php the_sub_field('degree'); ?><?php if(get_sub_field('degree_discipline')) { ?>, <?php the_sub_field('degree_discipline'); }?><?php if(get_sub_field('degree_location')) { ?>, <?php the_sub_field('degree_location'); }?>
													</li>

											 <?php endwhile; ?>	
										 </ul>
									 </div>
								<?php }?>
								<?php if (have_rows('affiliations') ) { ?>
									<h5>Affiliations</h5>
										<ul>
										<?php while (have_rows('affiliations') ): the_row(); ?> 
												<li><?php if(get_sub_field('aff_url')) { ?><a href="<?php the_sub_field('aff_url'); ?>" title="<?php the_sub_field('aff_name'); ?>" target="_blank"><?php the_sub_field('aff_name'); ?></a><?php }	else {the_sub_field('aff_name');}?></li>
										 <?php endwhile; ?>	
										 </ul>
								<?php }?>
							</div>
						</div>
					</div></div>
					<?php endif; ?>
					<?php if (get_field('research_info')||get_field('research_interests')): ?> <!-- THIS NEEDS FIXING tax? -->
					<div class="vc_tta-panel" id="research" data-vc-content=".vc_tta-panel-body"><div class="vc_tta-panel-heading"><h4 class="vc_tta-panel-title"><a href="#research" data-vc-accordion data-vc-container=".vc_tta-container"><span class="vc_tta-title-text">Research</span></a></h4></div><div class="vc_tta-panel-body">
						<div class="wpb_text_column wpb_content_element " >
							<div class="wpb_wrapper">
								<?php the_field('research_info'); ?>
								<?php $termswer = get_field('research_interests');
									if( $termswer ): 
										echo '<h5>Research Interests</h5>';
								?>
									<ul id="capitalText">
										<?php foreach( $termswer as $term ): ?>
											<li><?php echo $term->name; ?></li>
										<?php endforeach; ?>
									</ul>
									<?php endif; ?>
							</div>
						</div>
					</div></div>
					<?php endif; ?>
					<?php if (have_rows('add_courses')):?>
					<div class="vc_tta-panel" id="courses" data-vc-content=".vc_tta-panel-body"><div class="vc_tta-panel-heading"><h4 class="vc_tta-panel-title"><a href="#courses" data-vc-accordion data-vc-container=".vc_tta-container"><span class="vc_tta-title-text">Courses</span></a></h4></div><div class="vc_tta-panel-body">
						<div class="wpb_text_column wpb_content_element " >
							<div class="wpb_wrapper">
								<?php while (have_rows('add_courses')): the_row(); ?>
									<li class="listnone mb-4">
											<?php if(get_sub_field('course_url')) { ?>
												<a href="<?php the_sub_field('course_url'); ?>" target="_blank">
													<?php }?>
														<h5 class="mb-0"><?php the_sub_field('course_number'); ?>: <?php the_sub_field('course_name'); ?></h5>
															<?php if(get_sub_field('course_url')) { ?>
												</a>
											 <?php }?>
										<?php the_sub_field('course_description'); ?>
										</li>
								<?php endwhile; ?>
							</div>
						</div>
					</div></div>
					<?php endif; ?>
					<?php if ($posts): ?>
						<div class="vc_tta-panel" id="news" data-vc-content=".vc_tta-panel-body"><div class="vc_tta-panel-heading"><h4 class="vc_tta-panel-title"><a href="#news" data-vc-accordion data-vc-container=".vc_tta-container"><span class="vc_tta-title-text">News</span></a></h4></div><div class="vc_tta-panel-body">
						<div class="wpb_text_column wpb_content_element " >
							<div class="wpb_wrapper">
								<?php 
									foreach( $posts as $post ): 
										setup_postdata( $post );
									?>
									<li class="listnone mb-4">
										<a href="<?php the_permalink(); ?>"><h5><?php the_title(); ?></h5></a>
										<?php 			
								$content = get_the_content();
								$content = preg_replace('#\[[^\]]+\]#', '',$content);
								$content = apply_filters('the_content', $content);
								echo wp_trim_words( $content, 30, '...' );
								?>
									</li>
									<?php endforeach; ?>
								<?php wp_reset_postdata(); ?>      	
							</div>
						</div>
					</div></div>
					<?php endif; ?>
				</section>
			</div>
		</div>
			<script>
			$( "ul.vc_tta-tabs-list li" ).first().addClass( "vc_active" );
			$( ".vc_tta-panels .vc_tta-panel" ).first().addClass( "vc_active" );
			</script>	
		</div>
	</article>
</div>   
<link rel='stylesheet' id='vc_tta_style-css'  href='/wp-content/plugins/js_composer/assets/css/js_composer_tta.min.css?ver=5.4.7' type='text/css' media='all' />
<script type='text/javascript' src='/wp-content/plugins/js_composer/assets/lib/vc_accordion/vc-accordion.min.js?ver=5.4.7'></script>
<script type='text/javascript' src='/wp-content/plugins/js_composer/assets/lib/vc-tta-autoplay/vc-tta-autoplay.min.js?ver=5.4.7'></script>
<script type='text/javascript' src='/wp-content/plugins/js_composer/assets/lib/vc_tabs/vc-tabs.min.js?ver=5.4.7'></script>
<?php get_footer(); ?>
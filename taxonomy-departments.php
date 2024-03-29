<?php get_header();
$tax = $wp_query->get_queried_object();
?>
<div class="container mb-5 mt-3 mt-lg-5">
	<article class="<?php echo $post->post_status; ?> post-list-item">
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
			<i class="fa fa-user-circle-o icongrey"></i><span class="searchresults">Currently Viewing: <strong><?php echo ' '. $tax->name . ''; ?></strong></span>
		</div>
	</div>
		<div class="row">
			<div class="col-lg-9 col-md-12">
				<?php //$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
					$people_posts = new WP_Query($query_string."&meta_key=profile_L_name&orderby=meta_value&order=ASC&nopaging=1");
					while($people_posts->have_posts()) : $people_posts->the_post();
				?>
				<?php get_template_part( 'person-result'); ?>	
				<?php endwhile; ?>
				<!-- then the pagination links -->
				<!-- START PART TIME FACULTY -->
					<?php
					$argsPT = array(
					  'post_type'   => 'parttimers',
					  'posts_per_page' => -1,	
					  'meta_key' => 'lname',
					  'orderby' => 'meta_value',
					  'order' => 'ASC',
					  'tax_query'   => array(
						array(
							'taxonomy' => 'departments',
							'field'    => 'name',
							'terms'    => $tax->name
						)
					  )
					 );
					$parttimers = new WP_Query( $argsPT );				
					if( $parttimers->have_posts() ) :
					?>
                    <div class="mt-5 pt-3">
					<h2 class="archive-title heading-underline mt-5 mb-4">Part Time Faculty</h2>
					<div class="row parttimers">   
						<?php while( $parttimers->have_posts() ) :
						  $parttimers->the_post();
						  $getPTimageURL = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'large' ); ?>
						<div class="col-md-3 col-sm-6 col-xs-6 col-6 mb-4">
							<div class="col-10 col-xs-8 col-sm-10 p-0 mb-2 media-background-container parttime-photo mx-auto">
								<?php if ( has_post_thumbnail()) { ?>
									<img src="<?php echo $getPTimageURL; ?>" alt="<?php the_title(); ?>'s profile picture at UCF" title="<?php the_title(); ?>" class="media-background object-fit-cover">
									<?php } else { ?> 
											<img src="<?php the_field('default_profile_image', 'option'); ?>" alt="<?php the_title(); ?>'s profile picture at UCF" title="<?php $post->post_title; ?>" class="media-background object-fit-cover">
								<?php } ?>
							</div>
							<strong><?php the_title(); ?></strong> <?php the_field('degrees'); ?></br>
								<?php if(get_field('jobtitle')){ the_field('jobtitle');?></br><?php } ?>
								<?php if(get_field('business')){ the_field('business');?></br><?php } ?>
								<?php if(get_field('specialty')){ the_field('specialty');?></br><?php }	?>
							<div class="mt-2">
								<?php if(get_field('email')){ ?>
									<div class="person-label">
										<a href="mailto:<?php the_field('email'); ?>" aria-label="<?php the_title(); ?>'s Email"><i class="fa fa-envelope iconlink"></i></a>
									</div>
								<?php }	?>
								<?php if(get_field('phone')){ ?>
									<!--	<div class="person-label">
											<i class="fa fa-phone icongrey"></i> <a href="tel:<?php // the_field('phone'); ?>"><?php // the_field('phone'); ?></a>
										</div> -->
								<?php }	?>	
							</div>
						</div>
						<?php endwhile;
						  wp_reset_postdata(); ?>
					</div>
                </div>
					<?php endif; ?>
<!-- END PART TIME FACULTY -->				
				<!-- START ASSISTANTS -->
					<?php
					$argsAssist = array(
					  'post_type'   => 'assistants',
					  'posts_per_page' => -1,	
					  'meta_key' => 'last_name',
					  'orderby' => 'meta_value',
					  'order' => 'ASC',
					  'tax_query'   => array(
						array(
							'taxonomy' => 'departments',
							'field'    => 'name',
							'terms'    => $tax->name
						)
					  )
					 );
					$getassistants = new WP_Query( $argsAssist );				
					if( $getassistants->have_posts() ) :
					?>
                    <div class="mt-5 pt-3">
					<h2 class="archive-title heading-underline mt-5 mb-4">Graduate Assistants</h2>
					<div class="UCFassistants">   
                    <div class="d-flex flex-wrap">
						<?php while( $getassistants->have_posts() ) :
						  $getassistants->the_post();
						  $getAssistimageURL = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'large' ); ?>
                                <div class="w-20 mb-4">
                                    <div class="p-0 mb-2 media-background-container UCFassistants-photo mx-auto">
                                    <?php if ( get_the_content() ) { ?><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>'s Profile" ><?php } ?>
										<?php if ( has_post_thumbnail()) { ?>
                                            <img src="<?php echo $getAssistimageURL; ?>" alt="<?php the_title(); ?>'s profile picture at UCF" title="<?php the_title(); ?>" class="media-background object-fit-cover">
                                            <?php } else { ?> 
                                                    <img src="<?php the_field('default_profile_image', 'option'); ?>" alt="<?php the_title(); ?>'s profile picture at UCF" title="<?php $post->post_title; ?>" class="media-background object-fit-cover">
                                        <?php } ?>
                                        <?php if ( get_the_content() ) { ?></a><?php } ?>
                                    </div>
                                    <?php if ( get_the_content() ) { ?><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>'s Profile" ><?php } ?>
									<strong><?php the_title(); ?></strong>
                                    <?php if ( get_the_content() ) { ?></a><?php } ?>
                                    </br>
										<?php the_field('kind'); ?>
                                    <div class="mt-2">
                                        
                                            <div class="person-label">
                                                <?php if(get_field('email')){ ?><a href="mailto:<?php the_field('email'); ?>" aria-label="<?php the_title_attribute(); ?>'s Email"><i class="fa fa-envelope iconlink"></i></a><?php }?>
                                                <?php if(get_field('research_link')){ ?><a href="<?php the_field('research_link'); ?>" aria-label="<?php the_title_attribute(); ?>'s Research" target="_blank"><i class="fa fa-file-text iconlink"></i></a><?php }?>
                                                <?php if(get_field('linkedin_link')){ ?><a href="<?php the_field('linkedin_link'); ?>" aria-label="<?php the_title_attribute(); ?>'s LinkedIn" target="_blank"><i class="fa fa-linkedin-square iconlink"></i></a><?php }?>
                                                <?php if(get_field('facebook_link')){ ?><a href="<?php the_field('facebook_link'); ?>" aria-label="<?php the_title_attribute(); ?>'s Facebook" target="_blank"><i class="fa fa-facebook-square iconlink"></i></a><?php }?>
                                                <?php if(get_field('twitter_link')){ ?><a href="<?php the_field('twitter_link'); ?>" aria-label="<?php the_title_attribute(); ?>'s X" target="_blank"><i class="fa fa-twitter-square iconlink"></i></a><?php }?>
                                                <?php if(get_field('instagram_link')){ ?><a href="<?php the_field('instagram_link'); ?>" aria-label="<?php the_title_attribute(); ?>'s Instagram" target="_blank"><i class="fa fa-instagram iconlink"></i></a><?php }?>
                                            </div>
                                        
                                    </div>
                                </div>
								<?php endwhile;
						  		wp_reset_postdata(); ?>
                        	</div>
                    	</div>
                    </div>	
					<?php endif; ?>
<!-- END PART TIME FACULTY -->
<!-- START ASHA FELLOWS -->
					<?php
					$argsAshaHonors = array(
					  'post_type'   => 'person',
					  'post_status' => 'publish',
					  'posts_per_page' => -1,	
					  'meta_key' => 'profile_L_name',
					  'orderby' => 'meta_value',
					  'order' => 'ASC',
					  'tax_query'   => array(
					  	'relation' => 'AND',
						array(
							'taxonomy' => 'departments',
							'field'    => 'name',
							'terms'    => $tax->name
						),
						array(
							'taxonomy' => 'specialty_unit',
							'field'    => 'name',
							'terms'    => 'ASHA Honors',
						)
					  )
					 );
					$ashaHonors = new WP_Query( $argsAshaHonors );				
					if( $ashaHonors->have_posts() && is_tax( 'departments', 'communication-sciences-and-disorders' ) ) :
					?>
                    <div class="mt-5 pt-3">
					<h2 class="archive-title heading-underline mt-5 mb-4">ASHA Honors of the Association</h2>
					<div class="row">
                    	<ul>   
						<?php while( $ashaHonors->have_posts() ) :
						  $ashaHonors->the_post();
					 	?>
						<div class="col">
							<li><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>'s Profile" ><strong><?php the_title(); ?></strong></a></li>
						</div>
						<?php endwhile;
						  wp_reset_postdata(); ?>
                    	</ul>
					</div>
                </div>   
					<?php endif; ?>
<!-- END ASHA FELLOWS -->
<!-- START ASHA FELLOWS -->
					<?php
					$argsFellows = array(
					  'post_type'   => 'person',
					  'post_status' => 'publish',
					  'posts_per_page' => -1,	
					  'meta_key' => 'profile_L_name',
					  'orderby' => 'meta_value',
					  'order' => 'ASC',
					  'tax_query'   => array(
					  	'relation' => 'AND',
						array(
							'taxonomy' => 'departments',
							'field'    => 'name',
							'terms'    => $tax->name
						),
						array(
							'taxonomy' => 'specialty_unit',
							'field'    => 'name',
							'terms'    => 'ASHA Fellow',
						)
					  )
					 );
					$ashafellows = new WP_Query( $argsFellows );				
					if( $ashafellows->have_posts() && is_tax( 'departments', 'communication-sciences-and-disorders' )) :
					?>
                    <div class="mt-5 pt-3">
					<h2 class="archive-title heading-underline mt-5 mb-4">ASHA Fellows</h2>
					<div class="row">
                    	<ul>   
						<?php while( $ashafellows->have_posts() ) :
						  $ashafellows->the_post();
					 	?>
							<li><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>'s Profile" ><strong><?php the_title(); ?></strong></a></li>
						<?php endwhile;
						  wp_reset_postdata(); ?>
                    	</ul>
					</div>
                </div>   
					<?php endif; ?>
<!-- END ASHA FELLOWS -->

				<!-- START EMERITUS FACULTY -->
					<?php
					$argsEmeritus = array(
					  'post_type'   => 'emeritus',
					  'posts_per_page' => -1,	
					  'meta_key' => 'lname',
					  'orderby' => 'meta_value',
					  'order' => 'ASC',
					  'tax_query'   => array(
						array(
							'taxonomy' => 'departments',
							'field'    => 'name',
							'terms'    => $tax->name
						)
					  )
					 );
					$emeritus = new WP_Query( $argsEmeritus );				
					if( $emeritus->have_posts() ) :
					?>
                    <div id="emeritus" class="mt-5 pt-3">
					<h2 class="archive-title heading-underline mt-5 mb-4">Emeritus Faculty</h2>
					<div class="row parttimers">   
						<?php while( $emeritus->have_posts() ) :
						  $emeritus->the_post();
						  $getPTimageURL = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'large' ); ?>
						<div class="col-md-3 col-sm-6 col-xs-6 col-6 mb-4">
							<div class="col-10 col-xs-8 col-sm-10 p-0 mb-2 media-background-container parttime-photo mx-auto">
								<?php if ( has_post_thumbnail()) { ?>
									<img src="<?php echo $getPTimageURL; ?>" alt="<?php the_title(); ?>'s profile picture at UCF" title="<?php the_title(); ?>" class="media-background object-fit-cover">
									<?php } else { ?> 
											<img src="<?php the_field('default_profile_image', 'option'); ?>" alt="<?php the_title(); ?>'s profile picture at UCF" title="<?php $post->post_title; ?>" class="media-background object-fit-cover">
								<?php } ?>
							</div>
							<strong><?php the_title(); ?></strong></br>
								<?php the_field('jobtitle'); ?>
                                <?php if ( get_field( 'dead' ) == 1 ) : ?>
									<?php echo '</br>*deceased'; ?>
                                <?php endif; ?>
						</div>
						<?php endwhile;
						  wp_reset_postdata(); ?>
					</div>
                </div>   
					<?php endif; ?>
<!-- END EMERITUS FACULTY -->				             
			</div>
			<div class="col-lg-3 profilesidebar">
				<?php dynamic_sidebar( 'directory-sidebar' ); ?>
			</div>
		</div>
	</article>
</div>
<style>
.site-header .container h1 {
	display: none !important;
}	
.iconlink {
	font-size: 20px !important;
}
</style>
<?php get_footer(); ?>
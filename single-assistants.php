<?php get_header(); the_post(); 
$project_depts = get_the_terms($post->ID, 'departments');
$getimageURL = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'full' );
$ids = get_the_ID();
?>
<div class="container mb-5 mt-3 mt-lg-5">
	<div class="row mb-4">
		<div class="col-lg-12">	
			<header class="archive-header">
				<h1 class="archive-title heading-underline">Graduate Assistant</h1>
			</header>
		</div>
	</div>
<article class="<?php echo $post->post_status; ?> post-list-item">
	<div class="container">
		<div class="row">
			<div class="col-md-4 mb-5">
				<aside class="person-contact-container">
					<div class="mb-4" style="text-align: center;">
<div class="media-background-container UCFassistants-LGphoto mx-auto">
	<?php if ( has_post_thumbnail()) { ?>
		<a href="<?php echo $getimageURL ?>" rel="lightbox" title ="<?php echo get_person_name( $post ); ?> at UCF" ><img width="100%" alt="<?php echo get_person_name( $post ); ?>'s profile picture at UCF" src="<?php echo $getimageURL ?>" class="media-background object-fit-cover"/></a>
		<?php } else { ?> 
			<img width="100%" title="<?php $post->post_title; ?>" alt="<?php echo get_person_name( $post ); ?>'s profile picture at UCF" src="<?php the_field('default_profile_image', 'option'); ?>" class="media-background object-fit-cover"/>
	<?php } ?>
</div>
					</div>
					<h1 class="h5 person-title text-center mb-2">
						<?php echo get_person_name( $post ); ?><?php if( get_field('degrees') ) {
							while ( have_rows('degrees') ) : the_row();
								  if (!get_sub_field('degree_aftername')) {
									continue;
								  }
							 $array[] = get_sub_field('degree_select'); 
							endwhile;
								$foo = implode(', ', array_column($array, 'label'));
								echo '<span class"">, ' . $foo . '</span>';
							}								
						?>	
					</h1>
					<div class="person-job-title text-center mb-4">
							<div class="profilejobtitle">
								<?php the_field('kind'); ?>
							</div>
					</div>
					<?php if (get_field('research_link')): ?>	
						<div class="row mt-3 mb-5">
							<div class="col-md offset-md-0 col-8 offset-2 my-1">
								<a href="<?php the_field('research_link'); ?>" title="View <?php echo get_person_name( $post ); ?>'s Publications" target="_blank" class="btn btn-primary btn-block"><i class="vc_btn3-icon fa fa-bookmark" style="font-size: 20px; height: 16px; line-height: 16px; margin-right: 15px;"></i> View Publications</a>
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
				for($dept_count=0; $dept_count<count($project_depts); $dept_count++) {  
					echo '<li><a href="'.get_term_link($project_depts[$dept_count]).'">'.$project_depts[$dept_count]->name.'</a></li>';
				} ?>
			</ul>
		</div>
	</div>
	<hr class="my-2">
<?php }	?>	
<?php if(get_field('email')){ ?>
<div class="row">
		<div class="col-xl-4 col-md-12 col-sm-4 person-label">
			E-mail
		</div>
		<div class="col-xl-8 col-md-12 col-sm-8 person-attr">
			<a href="mailto:<?php the_field('email'); ?>">
				<?php the_field('email'); ?>
			</a>	
		</div>
	</div>
	<hr class="my-2">			
<?php }
?>	
<?php if(get_field('facebook_link')||get_field('twitter_link')||get_field('linkedin_link')){ ?>
<div class="row">
		<div class="col-xl-4 col-md-12 col-sm-4 person-label">
			Connect
		</div>
		<div class="col-xl-8 col-md-12 col-sm-8 person-attr">
			<?php if (get_field('facebook_link')): ?><a href="<?php the_field('facebook_link'); ?>" title="Follow Us On Facebook" target="_blank"><span class="fa-stack">
				  <i class="fa fa-circle fa-stack-2x profile-social-fb"></i>
				  <i class="fa fa-facebook fa-stack-1x profile-social-icon"></i>
				</span></a><?php endif; ?><?php if (get_field('twitter_link')): ?><a href="<?php the_field('twitter_link'); ?>" title="Follow Us On Twitter" target="_blank"><span class="fa-stack">
				  <i class="fa fa-circle fa-stack-2x profile-social-tw"></i>
				  <i class="fa fa-twitter fa-stack-1x profile-social-icon"></i>
				</span></a><?php endif; ?><?php if (get_field('linkedin_link')): ?><a href="<?php the_field('linkedin_link'); ?>" title="Join Us On LinkedIn" target="_blank"><span class="fa-stack">
				  <i class="fa fa-circle fa-stack-2x profile-social-lk"></i>
				  <i class="fa fa-linkedin fa-stack-1x profile-social-icon"></i>
				</span></a>
			<?php endif; ?>
		</div>
	</div>
	<hr class="my-2">			
<?php }
?>
<style>
.site-header .container h1 {
	display: none !important;
}	
</style>
    				
				</aside>
			</div>
			<div class="col-md-8 pl-md-5">
				<section class="person-content">
					<span class="mb-4"><?php the_content(); ?></span>
				</section>
			</div>
		</div>
		
		</div>
	</article>
</div>   
<?php get_footer(); ?>
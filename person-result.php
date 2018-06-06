<?php $getimageURL = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'large' ); ?>
<div class="row mb-4 cat-border personlist-ht">
	<div class="col-lg-2 col-md-3 col-sm-4 col-4 p-0 media-background-container catlist-photo mx-auto">

		   <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
		   <?php if ( has_post_thumbnail()) { ?>
				<img src="<?php echo $getimageURL; ?>" alt="<?php echo get_person_name( $post ); ?>'s profile picture at UCF" title="<?php $post->post_title; ?>" class="media-background object-fit-cover">
				<?php } else { ?> 
					<?php switch_to_blog(2);?>
						<img src="<?php the_field('default_profile_image', 'option'); ?>" alt="<?php echo get_person_name( $post ); ?>'s profile picture at UCF" title="<?php $post->post_title; ?>" class="media-background object-fit-cover">
					<?php restore_current_blog(); ?>
		<?php } ?>
		   </a> 
	</div>

	<div class="col-lg-7 col-md-9 col-sm-8 col-8 p-3">

		<h2 class="h4"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>

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

		<?php
		if(get_the_terms($post->ID, 'departments')){ ?>
			<div class="profiledepartments">
				<?php
				// Get a list of terms for this post's custom taxonomy.
				$project_depts = get_the_terms($post->ID, 'departments');
				// Renumber array.
				$project_depts = array_values($project_depts);
				for($dept_count=0; $dept_count<count($project_depts); $dept_count++) {
					// Each array item is an object. Display its 'name' value.
					echo $project_depts[$dept_count]->name;
					// If there is more than one term, comma separate them.
					if ($dept_count<count($project_depts)-1){
						echo ', ';
					}
				}?>
			</div>
		<?php }	?>


		<?php if(get_field('building')){ ?>
			<div class="row">
					<div class="col-xl-12 col-md-12 col-sm-12 person-label">
						<i class="fa fa-map-marker icongrey"></i> Location: <a href="<?php 
					if ($buildingMap == 'HPA I') {echo 'http://map.ucf.edu/locations/80/health-public-affairs-i/';}
					if ($buildingMap == 'HPA II') {echo 'http://map.ucf.edu/locations/80/health-public-affairs-ii/';}
					if ($buildingMap == 'Education') {echo 'https://map.ucf.edu/locations/21/education-complex-gym/';}
					if ($buildingMap == 'Orlando Tech Center') {echo 'http://map.ucf.edu/locations/8113/orlando-tech-center-otc3/';}
					if ($buildingMap == 'Research Pavilion') {echo 'http://map.ucf.edu/locations/8102/research-pavilion-pvl/';}
					if ($buildingMap == 'UCF Cocoa') {echo 'http://map.ucf.edu/locations/cocoa/cocoa/';}
					if ($buildingMap == 'UCF Daytona Beach') {echo 'http://map.ucf.edu/locations/daytona-beach/daytona-beach/';}
					if ($buildingMap == 'UCF Leesburg') {echo 'http://map.ucf.edu/locations/leesburg/leesburg/';}
					if ($buildingMap == 'UCF Ocala') {echo 'http://map.ucf.edu/locations/ocala/ocala/';}
					if ($buildingMap == 'UCF Palm Bay') {echo 'http://map.ucf.edu/locations/palm-bay/palm-bay/';}
					if ($buildingMap == 'UCF Sanford/Lake Mary') {echo 'http://map.ucf.edu/locations/sanford-lake-mary/sanfordlake-mary/';}
					if ($buildingMap == 'UCF South Lake') {echo 'http://map.ucf.edu/locations/south-lake/south-lake/';}
					if ($buildingMap == 'UCF Valencia Osceola') {echo 'http://map.ucf.edu/locations/valencia-osceola/valencia-osceola/';}
					if ($buildingMap == 'UCF Valencia West') {echo 'http://map.ucf.edu/locations/valencia-west/valencia-west/';}
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
		<?php }	?>	
		<?php if(get_field('email_address')){ ?>
			<div class="row">
					<div class="col-xl-12 col-md-12 col-sm-12 person-label">
						<i class="fa fa-envelope icongrey"></i> E-mail: <a href="mailto:<?php the_field('email_address'); ?>"><?php the_field('email_address'); ?></a>
					</div>
				</div>
		<?php }	?>	

		<?php if(get_field('phone_number')){ ?>
			<div class="row">
					<div class="col-xl-12 col-md-12 col-sm-12 person-label">
						<i class="fa fa-phone icongrey"></i> Phone: <a href="tel:<?php the_field('phone_number'); ?>"><?php the_field('phone_number'); ?></a>
					</div>
				</div>
		<?php }	?>



	</div>
	<div class="col-lg-3 p-3 extraprofile">
		<div class="row mt-3 mb-5 pl-3 leftborder">
			<?php if (get_field('cv')): ?>
			<div class="person-label">
				<i class="fa fa-file-text icongrey"></i> <a href="<?php the_field('cv'); ?>">Download CV</a>
			</div>
			<?php endif; ?>
			<?php if (get_field('website_url')): ?>
			<div class="person-label">
				<i class="fa fa-external-link icongrey"></i> <a href="<?php the_field('website_url'); ?>">Personal Website</a>
			</div>
			<?php endif; ?>
			<?php if (get_field('linkedin_url')): ?>
			<div class="person-label">
				<i class="fa fa-linkedin-square icongrey"></i> <a href="<?php the_field('linkedin_url'); ?>">Linkedin</a>
			</div>
			<?php endif; ?>

		</div>
	</div>
</div>
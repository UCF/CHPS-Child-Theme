<?php $getimageURL = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'large' );
$buildingMap = get_field('building');
?>
<div class="row mb-3 personlist-ht">
	<div class="col-lg-2 col-md-3 col-sm-4 col-4 p-0">
		   <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
		   <?php if ( has_post_thumbnail()) { ?>
				<img src="<?php echo $getimageURL; ?>" alt="<?php echo get_person_name( $post ); ?>'s profile picture at UCF" title="<?php $post->post_title; ?>" class="researchIMG">
				<?php } else { ?> 
					<?php switch_to_blog(2);?>
						<img src="<?php the_field('default_profile_image', 'option'); ?>" alt="<?php echo get_person_name( $post ); ?>'s profile picture at UCF" title="<?php $post->post_title; ?>" class="researchIMG">
					<?php restore_current_blog(); ?>
		<?php } ?>
		   </a> 
	</div>
	<div class="col-lg-7 col-md-9 col-sm-8 col-8 pt-0 pl-3 pb-0 pr-3">
		<h2 class="h4"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?><?php if( get_field('degrees') ) {
							while ( have_rows('degrees') ) : the_row();
							 $array[] = get_sub_field('degree_select'); 
							endwhile;
							$foo = implode(', ', array_column($array, 'label'));
							echo '<span class"">, ' . $foo . '</span>';
							}								
						?></a></h2>
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
				if ($buildingMap == 'HPA I') {echo 'https://www.ucf.edu/location/health-public-affairs-i/';}
				if ($buildingMap == 'HPA II') {echo 'https://www.ucf.edu/location/health-public-affairs-ii/';}
				if ($buildingMap == 'Education Complex') {echo 'https://www.ucf.edu/location/education-complex-and-gym/';}
				if ($buildingMap == 'Orlando Tech Center') {echo 'https://www.ucf.edu/location/orlando-tech-center-building-300/';}
				if ($buildingMap == 'Research Pavilion') {echo 'https://www.ucf.edu/location/research-pavilion/';}
				if ($buildingMap == 'Partnership 1') {echo 'https://www.ucf.edu/location/partnership-1/';}
				if ($buildingMap == 'Innovative Center') {echo 'https://www.ucf.edu/location/innovative-center/';}
				if ($buildingMap == 'Barbara Ying Center - CMMS') {echo 'https://www.ucf.edu/location/barbara-ying-center-cmms/';}
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
					<i class="fa fa-envelope icongrey"></i> E-mail: <?php if( get_field( 'hide_email' )) { ?><a href="mailto:<?php the_field('alternate_email'); ?>"><?php the_field('alternate_email'); ?></a><? } else { ?><a href="mailto:<?php the_field('email_address'); ?>"><?php the_field('email_address'); ?></a><?php } ?>
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
		<?php if(get_field('research_interests')){ ?>
			<div class="row">
				<div class="col-xl-12 col-md-12 col-sm-12 person-label mt-3">
					<strong>Research Interests:</strong>
					<?php $termswer = get_field('research_interests');?>
					<ul id="" class="personResearchList">
						<?php foreach( $termswer as $term ): ?>
							<li><i class="fa fa-check fa-lg iconyellow"></i> <?php echo $term->name; ?></li>
					<?php endforeach; ?>
				</div>
			</div>
		<?php }	?>
	</div>
	<div class="col-lg-3 p-3 extraprofile">
		<div class="mt-0 mb-3 pl-3 <?php if(get_field('google_scholar')||get_field('cv')||get_field('website_url')||get_field('linkedin_url')||get_field('twitter_url')){ ?>
leftborder <?php } ?>">
			<?php if (get_field('google_scholar')): ?>
			<div class="person-label">
				<i class="fa fa-bookmark icongrey"></i> <a href="<?php the_field('google_scholar'); ?>" target="_blank">View Bibliography</a>
			</div>
			<?php endif; ?>
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
			<?php if (get_field('twitter_url')): ?>
			<div class="person-label">
				<i class="fa fa-twitter-square icongrey"></i> <a href="<?php the_field('twitter_url'); ?>">Twitter</a>
			</div>
			<?php endif; ?>
		</div>
	</div>
</div>
<?php echo do_shortcode('[vc_separator style="shadow" border_width="2"]'); ?>		
<?php $getimageURL = wp_get_attachment_url( get_post_thumbnail_id(), 'large' ); ?>
<div class="row mb-4 personlist-ht">
	<div class="col-lg-3 col-md-3 col-sm-4 col-4 px-2 py-0">
		   <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
		   <?php if ( has_post_thumbnail()) { ?>
				<img src="<?php echo $getimageURL; ?>" alt="<?php echo get_person_name( $post ); ?>'s profile picture at UCF" title="<?php $post->post_title; ?>" class="researchIMG">
				<?php } else { ?> 
					<?php switch_to_blog(2);?>
						<img src="<?php the_field('default_profile_image', 'option'); ?>"  alt="<?php echo get_person_name( $post ); ?>'s profile picture at UCF" title="<?php $post->post_title; ?>"  class="researchIMG">
					<?php restore_current_blog(); ?>
		<?php } ?>
		   </a> 
	</div>
	<div class="col-lg-9 col-md-9 col-sm-8 col-8 px-4 py-0">
		<h2 class="h4"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?><?php if( get_field('degrees') ) {
							while ( have_rows('degrees') ) : the_row();
							if (!get_sub_field('degree_aftername', $post->ID)) { continue; }
							 $array[] = get_sub_field('degree_select'); 
							endwhile;
							$foo = implode(', ', array_column($array, 'label'));
							echo '<span class"">, ' . $foo . '</span>';
							}								
						?></a></h2>
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
						<i class="fa fa-envelope icongrey"></i> E-mail: <?php if( get_field( 'hide_email' )) { ?><a href="mailto:<?php the_field('alternate_email'); ?>"><?php the_field('alternate_email'); ?></a><? } else { ?><a href="mailto:<?php the_field('email_address'); ?>"><?php the_field('email_address'); ?></a><?php } ?>
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
					<ul class="researchIntList mt-2">
						<?php foreach( $termswer as $term ): ?>
							<li><i class="fa fa-check fa-lg iconyellow"></i> <?php echo $term->name; ?></li>
						<?php endforeach; ?>
					</ul>
				</div>
			</div>
	</div>
</div>
<?php echo do_shortcode('[vc_separator style="shadow" border_width="2"]'); ?>	
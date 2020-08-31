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
				<div class="mt-5 pt-3">
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
					<h1 class="archive-title heading-underline mt-5 mb-4">Part Time Faculty</h1>
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
							<strong><?php the_title(); ?></strong></br>
								<?php the_field('jobtitle'); ?>
							<div class="mt-2">
								<?php if(get_field('email')){ ?>
									<div class="person-label">
										<a href="mailto:<?php the_field('email'); ?>"><i class="fa fa-envelope iconlink"></i></a>
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
					<?php endif; ?>
<!-- END PART TIME FACULTY -->
					<?php //wpbeginner_numeric_posts_nav(); ?>
				</div>
                <div class="mt-5 pt-3">
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
					<h1 class="archive-title heading-underline mt-5 mb-4">Assistants</h1>
					<div class="row parttimers">   
						<?php while( $getassistants->have_posts() ) :
						  $getassistants->the_post();
						  $getAssistimageURL = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'large' ); ?>
						<div class="col-md-3 col-sm-6 col-xs-6 col-6 mb-4">
							<div class="col-10 col-xs-8 col-sm-10 p-0 mb-2 media-background-container UCFassistants-photo mx-auto">
								<?php if ( has_post_thumbnail()) { ?>
									<img src="<?php echo $getAssistimageURL; ?>" alt="<?php the_title(); ?>'s profile picture at UCF" title="<?php the_title(); ?>" class="media-background object-fit-cover">
									<?php } else { ?> 
											<img src="<?php the_field('default_profile_image', 'option'); ?>" alt="<?php the_title(); ?>'s profile picture at UCF" title="<?php $post->post_title; ?>" class="media-background object-fit-cover">
								<?php } ?>
							</div>
							<strong><?php the_title(); ?></strong></br>
								<?php the_field('jobtitle'); ?>
							<div class="mt-2">
								<?php if(get_field('email')){ ?>
									<div class="person-label">
										<a href="mailto:<?php the_field('email'); ?>"><i class="fa fa-envelope iconlink"></i></a>
									</div>
								<?php }	?>
							</div>
						</div>
						<?php endwhile;
						  wp_reset_postdata(); ?>
					</div>
					<?php endif; ?>
<!-- END PART TIME FACULTY -->
					<?php //wpbeginner_numeric_posts_nav(); ?>
				</div>
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
.parttimers {
	font-size: 14px;
	text-align: center;
}	
.parttimers strong {
	font-size: 16px;
}
.parttime-photo {
	height: 200px;
}
.iconlink {
	font-size: 20px !important;
}
</style>
<?php get_footer(); ?>
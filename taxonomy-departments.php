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
				<div class="mt-5">
				<!-- START PART TIME FACULTY -->
<?php
$argsPT = array(
  'post_type'   => 'parttimers',
  'meta_key' => 'lname',
  'orderby' => 'meta_value',
  'order' => 'ASC',
 );
$parttimers = new WP_Query( $argsPT );				
if( $parttimers->have_posts() ) :
?>
<h1 class="archive-title heading-underline mb-5">Part Time Faculty</h1>
<div class="row parttimers">   
    <?php
      while( $parttimers->have_posts() ) :
        $parttimers->the_post();
	$getPTimageURL = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'large' );
        ?>
<div class="col-md-6 col-sm-12 mb-5">
	<div class="row">
      <div class="col-xs-3 col-sm-3 p-0 media-background-container parttime-photo mx-auto">
        <?php if ( has_post_thumbnail()) { ?>
			<img src="<?php echo $getPTimageURL; ?>" alt="<?php the_title(); ?>'s profile picture at UCF" title="<?php the_title(); ?>" class="media-background object-fit-cover">
			<?php } else { ?> 
				<?php switch_to_blog(2);?>
					<img src="<?php the_field('default_profile_image', 'option'); ?>" alt="<?php the_title(); ?>'s profile picture at UCF" title="<?php $post->post_title; ?>" class="media-background object-fit-cover">
				<?php restore_current_blog(); ?>
		<?php } ?>
      </div>
      <div class="col-xs-9 col-sm-9">
        <strong><?php the_title(); ?></strong><?php if(get_field('degrees')){ ?>, <?php the_field('degrees'); ?><?php } ?></br>
			<?php the_field('jobtitle'); ?>
     	<div class="mt-2 pb-5">
			<?php if(get_field('email')){ ?>
					<div class="person-label">
						<i class="fa fa-envelope icongrey"></i> <a href="mailto:<?php the_field('email'); ?>"><?php the_field('email'); ?></a>
					</div>
			<?php }	?>
			<?php if(get_field('phone')){ ?>
					<div class="person-label">
						<i class="fa fa-phone icongrey"></i> <a href="tel:<?php the_field('phone'); ?>"><?php the_field('phone'); ?></a>
					</div>
			<?php }	?>	
		</div>
      </div>
    </div>
</div>
        <?php
      endwhile;
      wp_reset_postdata();
    ?>
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
	text-align: left;
}	
.parttimers strong {
	font-size: 16px;
}
.parttime-photo {
	min-height: 150px;
}
</style>
<?php get_footer(); ?>
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
		<div class="col-lg-6 mb-5 cat-border personlist-ht">
			<div class="col-lg-2 col-md-3 col-sm-4 col-4 p-0 media-background-container catlist-photo mx-auto" style="background-color: blue;">
			 Picture 2
			</div>
          <div class="col-lg-7 col-md-9 col-sm-8 col-8 p-3">
			<strong><?php the_title(); ?></strong><?php if(get_field('degrees')){ ?>, <?php the_field('degrees'); ?><?php } ?></br>
			<?php the_field('jobtitle'); ?>
			<div class="mt-2">
				<?php if(get_field('email')){ ?>
					<div class="row">
						<div class="col-xl-12 col-md-12 col-sm-12 person-label">
							<i class="fa fa-envelope icongrey"></i> <a href="mailto:<?php the_field('email'); ?>"><?php the_field('email'); ?></a>
						</div>
					</div>
				<?php }	?>
				<?php if(get_field('phone')){ ?>
					<div class="row">
						<div class="col-xl-12 col-md-12 col-sm-12 person-label">
							<i class="fa fa-phone icongrey"></i> <a href="tel:<?php the_field('phone'); ?>"><?php the_field('phone'); ?></a>
						</div>
					</div>
				<?php }	?>	
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
</style>
<?php get_footer(); ?>
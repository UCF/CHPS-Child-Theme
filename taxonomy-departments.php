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
<div class="row">
  <div class="col-lg-6 cat-border">
    Level 1: .col-sm-9
    <div class="row">
      <div class="col-xs-8 col-sm-6">
        Level 2: .col-xs-8 .col-sm-6
      </div>
      <div class="col-xs-4 col-sm-6">
        Level 2: .col-xs-4 .col-sm-6
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
</style>
<?php get_footer(); ?>
<?php get_header();?>
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
			<i class="fa fa-search icongrey"></i><span class="searchresults">Search Result for: <strong><?php echo "$s"; ?></strong></span>
		</div>
	</div>
		<div class="row">
			<div class="col-lg-9 col-md-12">
				<?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
				$people_posts = new WP_Query($query_string."&meta_key=profile_L_name&orderby=meta_value&order=ASC");
				while($people_posts->have_posts()) : $people_posts->the_post();
				?>
				<?php get_template_part( 'person-result'); ?>
				<?php endwhile; ?>
				<!-- then the pagination links -->
				<div class="mt-5">
					<?php wpbeginner_numeric_posts_nav(); ?>
				</div>
			</div>
			<div class="col-lg-3 profilesidebar">
				<?php dynamic_sidebar( 'directory-sidebar' ); ?>
			</div>
		</div>
	</article>
</div>
<style>	
header .container h1 {
	display: none !important;
}		
</style>
<?php get_footer(); ?>
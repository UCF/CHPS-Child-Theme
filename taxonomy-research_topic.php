<?php get_header();
$tax = $wp_query->get_queried_object();
?>

<div class="container mb-5 mt-3 mt-lg-5">
	<article class="<?php echo $post->post_status; ?> post-list-item">
	
	<div class="row mb-4">
		<div class="col-lg-6">	
			<header class="archive-header">
				<h1 class="archive-title heading-underline">Search Results</h1>
			</header>
		</div>
		<div class="col-lg-6">	
			<?php echo do_shortcode( ' [wd_asp id=1] ' ); ?>
		</div>
		<div class="col-lg-12 pt-2">
			<i class="fa fa-search icongrey"></i><span class="searchresults">Search Result for: <strong id="capitalText"><?php echo ' '. $tax->name . ''; ?></strong></span>
		</div>
	</div>
		
		<div class="row">
			<div class="col-lg-9 col-md-12">
			<?php if ( have_posts() ) : ?>
			
				<?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
				
				while ( have_posts() ) : the_post();

				?>
				
				<?php if( 'person' == get_post_type() ) { ?>      
					<?php get_template_part( 'research-result'); ?>
					
				<?php }		
				endwhile; ?>

				<!-- then the pagination links -->
				<div class="mt-5">
					<?php wpbeginner_numeric_posts_nav(); ?>
				</div>
		
		<?php else : ?>
 
            Sorry No Pages or News Posts Match Your Search
 
        <?php endif; ?>
			</div>
			<div class="col-lg-3 profilesidebar">
				<?php dynamic_sidebar( 'facresearch-sidebar' ); ?>
			</div>
		</div>
	</article>
</div>
<style>	
header div.container {
	display: none;
}	

.authortext {
	text-transform: uppercase;
	font-size: 12px;
	color: #777;
	margin-top: 20px;
}
h3.widget-title {
	font-size: 18px;
}
h2 {
	text-transform: none !important;
}	
div.widget-content ul {
	margin-left: 10px;
	padding-left: 0px;
}
div.widget-content ul li {
	list-style: none;
	border-bottom: 1px solid #eee;
	padding:6px 0px;
	font-size: 14px !important;
}

</style>
<?php get_footer(); ?>


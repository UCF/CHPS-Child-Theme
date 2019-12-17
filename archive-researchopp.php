<?php get_header();?>
<div class="container mb-5 mt-3 mt-lg-5">
	<article class="<?php echo $post->post_status; ?> post-list-item">
	<div class="row mb-4">
		<div class="col-lg-6">	
			<header class="archive-header">
				<h1 class="archive-title heading-underline">Research Opportunities<h1>
			</header>
		</div>
		<div class="col-lg-6">	
			<?php echo do_shortcode( ' [searchme posttype="code" size="large" placeholder="Search by Keyword"] ' ); ?>
		</div>
		<div class="col-lg-12 pt-2">
			<i class="fa fa-search icongrey"></i><span class="searchresults">Search Result for: <strong><?php echo "$s"; ?></strong></span>
		</div>
	</div>
		<div class="row">
			<div class="col-lg-8 col-md-12">
				<?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
				while ( have_posts() ) : the_post();
				$getimgURL = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'large' );
				$display_name = get_the_author_meta( 'display_name', $post->post_author );
				$categories = get_the_category();
				$terms = get_the_terms( $post->ID , 'code_cat' );
				?>
				<div class="row mb-4 cat-border">
					<div class="col-lg-12 p-4"> 
						<h2 class="h5 pt-2 mainnews"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
						<span class="authortext">Written By: <?php if(get_field('overwrite_author')){ the_field('overwrite_author');} else { echo $display_name; }?> | <?php the_time('F j, Y'); ?></span>
						<div class="entry">
							<?php the_excerpt(); ?>
						</div>
					</div>
				</div>
				<?php endwhile; ?>
				<!-- then the pagination links -->
				<div class="mt-5">
					<?php wpbeginner_numeric_posts_nav(); ?>
				</div>
			</div>
			<div class="col-lg-4 profilesidebar">
				<?php dynamic_sidebar( 'custom-side-bar' ); ?>
			</div>
		</div>
	</article>
</div>
<style>	
header div.container {
	display: none;
}	
</style>
<?php get_footer(); ?>
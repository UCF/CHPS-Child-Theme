<?php
/*
Template Name: FAQs
*/
?>
<?php get_header(); the_post(); ?>


<div class="container mb-5 mt-3 mt-lg-5">
	<article class="<?php echo $post->post_status; ?> post-list-item">
		<div class="row mb-4">
			<div class="col-lg-12">	
				<header class="archive-header">
					<h1 class="archive-title heading-underline">Frequently Asked Questions</h1>
				</header>
			</div>
			<!-- <div class="col-lg-5">	
				<?php // echo do_shortcode( ' [searchme posttype="faq" size="large" placeholder="Search"] ' ); ?>
			</div> -->
		</div>
		
		<div class="row">
			<div class="col-lg-9 col-md-12">
				
				<?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
				$args = array( 
					'post_type' => 'faq', 
					'post_status' => 'publish',
					'posts_per_page' => 10, 
					'paged' => $paged,
					'order' => 'ASC'
				);
				$wp_query = new WP_Query($args);
				while ( have_posts() ) : the_post(); 
				?>
				
				<div class="mb-4">
					<h2 class="h5 titleFIX"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
					<div class="entry">
						<?php echo wp_trim_words( get_the_content(), 45, '...' ); ?>
					</div>
				</div>
				
				<?php endwhile; ?>

				<!-- then the pagination links -->
				<div class="mt-5">
					<?php wpbeginner_numeric_posts_nav(); ?>
				</div>
		
			</div>
			<div class="col-lg-3 profilesidebar">
				<?php dynamic_sidebar( 'faq-sidebar' ); ?>
			</div>
		</div>
	</article>
</div>
<style>
header div.container{display: none;}	
</style>
<?php get_footer(); ?>

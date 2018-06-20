<?php
/*
Template Name: Blog
*/
?>
<?php get_header(); the_post(); ?>
<div class="container mb-5 mt-3 mt-lg-5">
	<article class="<?php echo $post->post_status; ?> post-list-item">
		
	<div class="row mb-4">
		<div class="col-lg-6">	
			<header class="archive-header">
				<h1 class="archive-title heading-underline">Latest News</h1>
			</header>
		</div>
		<div class="col-lg-6">	
			<?php echo do_shortcode( ' [searchme posttype="post" size="large" placeholder="Search News"] ' ); ?>
		</div>
	</div>
		<div class="row">
			<div class="col-md-9">
				<?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
				$args = array( 'post_type' => 'post', 'posts_per_page' => 10, 'paged' => $paged );
				$wp_query = new WP_Query($args);
				while ( have_posts() ) : the_post(); 
					$getimgURL = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'large' );
					$display_name = get_the_author_meta( 'display_name', $post->post_author );
					$categories = get_the_category();
				?>
					<div class="row mb-4 cat-border">
						<div class="col-lg-3 p-0 media-background-container catlist-photo mx-auto">
							   <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
							   <?php if ( has_post_thumbnail()) { ?>
								<img src="<?php echo $getimgURL; ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" class="media-background object-fit-cover">
								<?php } else { ?>
								<?php switch_to_blog(2);?>	
									<img src="<?php the_field('default_news_image', 'option'); ?>" alt="<?php the_title_attribute(); ?>" title="<?php the_title_attribute(); ?>" class="media-background object-fit-cover">
								<?php restore_current_blog(); ?>
							<?php } ?>
							   </a>
						</div>
						<div class="col-lg-9 p-4">
							<?php 
								if ( ! empty( $categories ) ) {
									echo '<a class="category-title" href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a>';
								}
							?>
							<h2 class="h5 pt-2 mainnews"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
							<span class="authortext">Written By: <?php if(get_field('overwrite_author')){ the_field('overwrite_author');} else { echo $display_name; }?> | <?php the_time('F j, Y'); ?></span>
							<div class="entry">
							<?php 			
								$content = get_the_content();
								$content = preg_replace('#\[[^\]]+\]#', '',$content);
								$content = apply_filters('the_content', $content);
								echo wp_trim_words( $content, 25, '...' );
								?>
							</div>
						</div>
					</div>
				<?php endwhile; ?>
				<div class="mt-5">
					<?php wpbeginner_numeric_posts_nav(); ?>
				</div>
			</div>
			<div class="col-md-3">
				<?php if ( is_active_sidebar( 'custom-side-bar' ) ) : ?>
				<?php dynamic_sidebar( 'custom-side-bar' ); ?>
				<?php endif; ?>
			</div>
		</div>
	</article>
</div>
<style>
.site-header .container h1 {
	display: none !important;
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

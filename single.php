<?php get_header(); 
$display_name = get_the_author_meta( 'display_name', $post->post_author );
$getimageURL = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'full' );
$categories = get_the_category();
?>
<div class="container mb-5 mt-3 mt-lg-4">
    <div class="row">
		<div class="col-md-1"></div>
        <div class="col-md-10">
        	<div>
				<?php 
					if ( ! empty( $categories ) ) {
						echo '<a class="cattitle-single" href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a>';
					}
				?>
				<h1 class="posttitle"><?php the_title(); ?></h1>
			</div>
        	<div>
				<?php if ( ! has_excerpt() ) {
      				echo '';
				} else { 
      				the_excerpt();
				} ?>
				<p class="authortext">Written By: <?php if(get_field('overwrite_author')){ the_field('overwrite_author');} else { echo $display_name; }?> | <?php the_time('F j, Y'); ?></p>
			</div>
        	<article class="publish post-list-item">
				 <?php while ( have_posts() ) : the_post(); ?>
                   <?php if ( has_post_thumbnail()) { ?>
					   <?php if( get_field('featimg_location') == 'Full Width' ): ?>
							<div id="postIMG">
									<a href="<?php echo $getimageURL ?>" rel="lightbox" title ="<?php echo the_title(); ?>"><img width="100%" alt="<?php echo the_title(); ?>" src="<?php echo $getimageURL ?>" /></a>
								<div class="featcaption"><?php the_field('featimg_caption'); ?></div>
							</div>
					   <?php endif; ?>
					   <?php if( get_field('featimg_location') == 'Right Aligned' ): ?>
							<div id="imgRight-<?php the_field('featimg_size'); ?>">
								<a href="<?php echo $getimageURL ?>" rel="lightbox" title ="<?php echo the_title(); ?>"><img width="100%" alt="<?php echo the_title(); ?>" src="<?php echo $getimageURL ?>" /></a>
								<div class="featcaption"><?php the_field('featimg_caption'); ?></div>
							</div>
					   <?php endif; ?>
					   <?php if( get_field('featimg_location') == 'Left Aligned' ): ?>
							<div id="imgLeft-<?php the_field('featimg_size'); ?>">
								<a href="<?php echo $getimageURL ?>" rel="lightbox" title ="<?php echo the_title(); ?>"><img width="100%" alt="<?php echo the_title(); ?>" src="<?php echo $getimageURL ?>" /></a>
								<div class="featcaption"><?php the_field('featimg_caption'); ?></div>
							</div>
					   <?php endif; ?>
                   <?php } ?>
                    <?php the_content(); ?> 
                <?php
                	endwhile; //resetting the page loop
                	wp_reset_query(); //resetting the page query
                ?>
			</article>
       		<div class="row mt-5">
				<div class="col-md-6 recborder">
					<h5 class="mb-4">Other Recent News Articles</h5>
					<?php echo do_shortcode('[recentnews number="5"]'); ?>
				</div>
				<div class="col-md-6">
					<h5 class="mb-4">Our Mission</h5>
					<span class="postmission">The College of Health Professions and Sciences prepares students to promote, preserve, and enrich the health and wellness of diverse populations, through innovative and collaborative education, research, service, and practice.</span>
				</div>
			</div>
        </div>
        <div class="col-md-1"></div>
    </div>
</div>
<style>
.site-header .container h1 {display: none !important;}
</style>
<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5ae1f19edbbe0111" async="async"></script>
<?php get_footer(); ?>
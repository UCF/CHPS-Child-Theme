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
        	<article class="publish post-list-item mb-5">
				 <?php while ( have_posts() ) : the_post(); ?>
                   <?php if ( has_post_thumbnail()) { ?>
					   <?php if( get_field('featimg_location') == 'Full Width' ): ?>
							<div id="postIMG">
									<a href="<?php echo $getimageURL ?>" rel="lightbox" title ="<?php echo the_title(); ?>"><img width="100%" alt="<?php echo the_title(); ?>" src="<?php echo $getimageURL ?>" /></a>
								<div class="featcaption"><?php the_field('featimg_caption'); ?></div>
							</div>
					   <?php endif; ?>
					   <?php if( get_field('featimg_location') == 'Right Aligned' ): ?>
							<div id="imgRight">
								<a href="<?php echo $getimageURL ?>" rel="lightbox" title ="<?php echo the_title(); ?>"><img width="100%" alt="<?php echo the_title(); ?>" src="<?php echo $getimageURL ?>" /></a>
								<div class="featcaption"><?php the_field('featimg_caption'); ?></div>
							</div>
					   <?php endif; ?>
					   <?php if( get_field('featimg_location') == 'Left Aligned' ): ?>
							<div id="imgLeft">
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
<?php echo do_shortcode('[vc_section full_width="stretch_row" el_class="disclaimerText"][vc_row][vc_column][vc_column_text]<strong>DISCLAIMER:</strong> While I am happy to share code and various solutions that I have created that work the sites that I am working on, your situation, Wordpress Theme, or other plugins may cause conflicts. The information I have provided is for educational purposes only.  Unfortunately, I will not be able to provide support beyond what I have shared here. Thank you for your understanding![/vc_column_text][/vc_column][/vc_row][/vc_section]'); ?>
       		<div class="row">
				<!--<div class="col-md-6 recborder">-->
					<div class="col-md-2 col-xs-2 mt-3 pt-4">
						<div  class="wpb_single_image wpb_content_element vc_align_left  vc_custom_1530809241075">
							<figure class="wpb_wrapper vc_figure">
								<a href="/person/david-janosik/" target="_blank" class="vc_single_image-wrapper vc_box_shadow_border_circle  vc_box_border_grey"><img class="vc_single_image-img " src="https://healthchpscmsdev.smca.ucf.edu/wp-content/uploads/sites/2/2018/04/david-headshot-1-533x533.jpg" width="533" height="533" alt="david-headshot (1)" title="David Janosik, MBA, PMP" /></a>
							</figure>
						</div>
					</div>
					<div class="col-md-4 col-xs-4 mt-3 pt-4">
						<a href="/person/david-janosik/" target="_blank"><b>David Janosik, MBA, PMP</b></a><br>
						Web Applications Developer<br>
						407-823-5884<br>
						<a href="mailto:djanosik@ucf.edu">djanosik@ucf.edu</a>
					</div>
				<!--</div>-->
				<div class="col-md-6 lBorder py-4">
					<h5 class="mb-3">Other Recent Articles</h5>
					<?php echo do_shortcode('[recentlist class="recentcode" posttype="code"]'); ?>
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
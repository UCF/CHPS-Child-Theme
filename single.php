<?php get_header(); 
$display_name = get_the_author_meta( 'display_name', $post->post_author );
$getimageURL = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'full' );
$categories = get_the_category();
?>

<div class="container mt-3 mt-sm-4 mt-md-5 mb-3">
<div class="row">
        <div class="col-md-9">
	<?php 
		if ( ! empty( $categories ) ) {
			echo '<a class="cattitle-single" href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a>';
		}
	?>
	<h1 class="posttitle"><?php the_title(); ?></h1>


<div class="container">
	<?php the_excerpt(); ?>
	<p class="authortext">Written By: <?php if(get_field('overwrite_author')){ the_field('overwrite_author');} else { echo $display_name; }?> | <?php the_time('F j, Y'); ?></p>
	</div>
	<div class="col-md-3"></div>
	</div></div>
</div>

<div class="container mb-5 mt-3 mt-lg-4">
    <div class="row">
        <div class="col-md-9">
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
        <div class="col-md-3">
        	<?php if ( is_active_sidebar( 'custom-side-bar' ) ) : ?>
    		<?php dynamic_sidebar( 'custom-side-bar' ); ?>
			<?php endif; ?>
        </div>
    </div>
</div>


<style>
.site-header .container h1 {
	display: none !important;
}
.cattitle-single {
	color: #999;
	font-size: 16px;
	font-weight: 700;
	letter-spacing: .5;
	margin-bottom: 12px;
	text-transform: uppercase;
}
.cattitle-single:hover {
	color: #fdc831;
}
.authortext {
	text-transform: uppercase;
	font-size: 12px;
	color: #777;
	margin-top: 20px;
}
#postIMG {
	margin-bottom: 20px;
}
#imgRight {
	max-width: 480px;
	float: right;
	margin: 0px 0px 20px 20px;
}
#imgLeft {
	max-width: 480px;
	float: left;
	margin: 0px 20px 20px 0px;
}	
.recborder {
	border-right: solid 2px #eee;
}
.featcaption {
	color: #777;
	font-size: 13px;
	line-height: 14px;
	font-style: italic;
	margin-top:12px;
}
h3.widget-title {
	font-size: 18px;
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
.postmission {
	font-size:14px;
	line-height: 16px;
}
</style>
<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5ae1f19edbbe0111"></script>

<?php get_footer(); ?>

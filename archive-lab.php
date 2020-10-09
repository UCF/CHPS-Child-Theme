<?php get_header(); 
$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
?>
<div class="header-media header-media-content-block header-media-short media-background-container mb-0 d-flex flex-column">
	<picture class="media-background-picture ">
		<img class="media-background object-fit-cover" src="https://healthchpscmsdev.smca.ucf.edu/wp-content/uploads/sites/2/2020/05/healthTips4-1500x400.jpg" alt="">
	</picture>
	<div class="header-content">
		<div class="container d-flex align-items-center align-items-sm-end">
			<div class="row no-gutters w-100">
				<div class="col-xl-6 col-lg-8 col-md-10">
					<div class="header-title-wrapper">
						<h1 class="header-title">CHPS Research Labs</h1>
						<p class="header-subtitle">UCF <?php echo $term->name; ?></p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<div class="container mb-5 mt-3 mt-lg-5">
	<article class="<?php echo $post->post_status; ?> post-list-item">


		<div class="vc_column-inner">
				<?php if ( have_posts() ) : ?>
				<?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
				while ( have_posts() ) : the_post();
				?>
<!--START-->	<div>
					<?php $getimgURL = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'large' );?>
					<div class="mb-5 pb-5 labStyle container">
                    	<div class="row">
                        	<div class="col-12 col-md-4 mb-3">
                            <a href="<?php the_field('website_url'); ?>">
                            	<img class="flashIMG" width="100%" src="<?php echo $getimgURL; ?>" alt=""/>
                            </a>
                        </div>
                        <div class="col-12 col-md-8">
                        	<h4>
                            	<a href="<?php the_field('website_url'); ?>" target="_blank" rel="noopener noreferrer nofollow external" data-wpel-link="external"><?php the_title(); ?></a>
                            </h4>
							<?php the_content(); ?>
							<div class="btnhover-yellow mt-4">
                            	<a class="archiveYellBTN" href="<?php the_field('website_url'); ?>" title="" target="_blank"><i class="archiveYellBTN-icon fa fa-external-link"></i> Visit the Lab&apos;s Website</a>
                            </div>
                        </div>
                	</div>
  <!--END-->	</div>
				<?php endwhile; ?>
				<!-- then the pagination links -->
				<div class="mt-5">
					<?php wpbeginner_numeric_posts_nav(); ?>
				</div>
				<?php else : ?>
            Sorry No Labs Match Your Search
        <?php endif; ?>
		</div>
	</article>
</div>
<link rel='stylesheet' id='duplicate-post-css'  href='/wp-content/plugins/js_composer/assets/css/js_composer.min.css' type='text/css' media='all' />
<style type="text/css" data-type="vc_shortcodes-custom-css">
.container {
    margin-top: 0px !important;
}
header .container h1 {
    display: none !important;
}
label, select {
    display: block;
    width: 100% !important;
    font-size: 18px;
    padding:6px;
 }</style>
<?php get_footer(); ?>
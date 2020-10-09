<?php get_header(); 
$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
?>
<?php echo do_shortcode( '[vc_section full_width="stretch_row" content_placement="middle" css=".vc_custom_1590163440237{margin-bottom: 0px !important;padding-top: 100px !important;padding-bottom: 100px !important;background-image: url(https://healthchpscmsdev.smca.ucf.edu/wp-content/uploads/sites/2/2020/05/healthTips4.jpg?id=19383) !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}" el_class="mb-4"][vc_row][vc_column width="3/4" css=".vc_custom_1527858038636{padding-right: 80px !important;}"][evc_section_title text_alignment="left" title_tag="h1" custom_class="mainHomeTitle" title="CHPS Research Labs" title_color="#000000"][evc_section_title text_alignment="left" title_tag="h2" custom_class="mainHomeSubtitle" title="UCF College of Health Professions and Sciences" title_color="#ffffff"][/vc_column][vc_column width="1/4"][/vc_column][/vc_row][/vc_section]' );?>

		<div class="header-media  header-media-default media-background-container mb-0 d-flex flex-column">
			<video class="hidden-xs-down media-background media-background-video object-fit-cover" autoplay muted playsinline loop>
				<source src="https://healthprofessions.ucf.edu/wp-content/uploads/sites/2/2020/03/grants-3.webm" type="video/webm">
				<source src="https://healthprofessions.ucf.edu/wp-content/uploads/sites/2/2020/03/grants3.mp4" type="video/mp4">
			</video>
			<button class="media-background-video-toggle btn play-enabled hidden-xs-up" type="button" data-toggle="button" aria-pressed="false" aria-label="Play or pause background videos">
				<span class="fa fa-pause media-background-video-pause" aria-hidden="true"></span>
				<span class="fa fa-play media-background-video-play" aria-hidden="true"></span>
			</button>
			<picture class="media-background-picture ">
				<source srcset="https://i1.wp.com/healthprofessions.ucf.edu/wp-content/uploads/sites/2/2019/09/COHPA-building-BG.jpg?resize=575%2C575&ssl=1" media="(max-width: 575px)">
				<img class="media-background object-fit-cover" src="https://i1.wp.com/healthprofessions.ucf.edu/wp-content/uploads/sites/2/2019/09/COHPA-building-BG.jpg?resize=1600%2C525&ssl=1" alt="">
			</picture>
			<div class="header-content">
				<div class="container d-flex align-items-center align-items-sm-end">
					<div class="row no-gutters w-100">
						<div class="col-xl-10">
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
<style>	
.container h1.mt-sm-4 {
    display: none !important;
}
.header-title-wrapper {
    max-width: 600px;
}
@media (min-width: 576px) {
    .header-media-default {
        min-height: 500px;
    }
}
/*overwrite header styling */	
.header-title-wrapper {
    max-width: 1100px !important;
}	
.header-media-default {
    min-height: 350px !important;
}	
</style>
<?php get_footer(); ?>
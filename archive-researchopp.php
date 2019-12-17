<?php get_header();?>
		<div class="header-media  header-media-default media-background-container mb-0 d-flex flex-column">
			<video class="hidden-xs-down media-background media-background-video object-fit-cover" autoplay muted playsinline loop>
				<source src="https://healthprofessions.ucf.edu/wp-content/uploads/sites/2/2019/10/UndergradResearch-Header.webm" type="video/webm">
				<source src="https://healthprofessions.ucf.edu/wp-content/uploads/sites/2/2019/10/UndergradResearch-Header.mp4" type="video/mp4">
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
								<h1 class="header-title">Research Participation</h1>
								<p class="header-subtitle">College of Health Professions and Sciences</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
<div class="container mb-5 mt-3 mt-lg-5">
	<article class="<?php echo $post->post_status; ?> post-list-item">

		<div class="row">
			<div class="col-lg-8 col-md-12 pt-4">
				<?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
				while ( have_posts() ) : the_post();
				$getimgURL = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'large' );
				$display_name = get_the_author_meta( 'display_name', $post->post_author );
				$categories = get_the_category();
				$terms = get_the_terms( $post->ID , 'code_cat' );
				?>
				<div class="row mb-3">
					<div class="col-lg-12 p-3"> 
						<h2 class="h4"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
							<i class="fa fa-briefcase iconyellow"></i> 
							<?php
							// Get a list of terms for this post's custom taxonomy.
							$project_depts = get_field( 'research_unit' );
							// Renumber array.
							$project_depts = array_values($project_depts);
							for($dept_count=0; $dept_count<count($project_depts); $dept_count++) {
								// Each array item is an object. Display its 'name' value.
								echo $project_depts[$dept_count]->name;
								// If there is more than one term, comma separate them.
								if ($dept_count<count($project_depts)-1){
									echo ', ';
								}
							}?>
						<h3 class="h6 mt-2">Minimum Qualifications:</h3> <!-- style this size -->
						<div class="mb-4 researchOpp-quals">
							<?php the_field('research_qualifications'); ?>
						</div>
					</div>
				</div>
				<?php endwhile; ?>
				<!-- then the pagination links -->
				<div class="mt-5">
					<?php wpbeginner_numeric_posts_nav(); ?>
				</div>
			</div>
			<div class="col-lg-4 profilesidebar pt-4" style="background-color: #f2f2f2;">
				<?php dynamic_sidebar( 'custom-side-bar' ); ?>
			</div>
		</div>
	</article>
</div>
<style>	
.container {
    margin-top: 0px !important;
}
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
	
/* repeated CSS code */
.researchOpp-quals ul {
	list-style-type: none;
}
.researchOpp-quals ul li::before {
	content: "\f058";
	font-family: "FontAwesome";
	padding: 0 10px 0 0;
	color:#ffcc00;
}	
</style>
<?php get_footer(); ?>
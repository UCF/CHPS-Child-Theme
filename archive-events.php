 <?php get_header(); ?>
		<div class="header-media  header-media-default media-background-container mb-0 d-flex flex-column">
			<video class="hidden-xs-down media-background media-background-video object-fit-cover" autoplay muted playsinline loop>
				<source src="https://healthprofessions.ucf.edu/wp-content/uploads/sites/2/2022/05/ucf_28926832-compressed.webm" type="video/webm">
				<source src="https://healthprofessions.ucf.edu/wp-content/uploads/sites/2/2022/05/ucf_28926832-compressed.mp4" type="video/mp4">
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
								<h1 class="header-title">Graduate Programs Admission Events</h1>
								<p class="header-subtitle">UCF College of Health Professions and Sciences</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
<div class="container mb-5 mt-3 mt-lg-5">
	<article class="<?php echo $post->post_status; ?> post-list-item">
		<div class="row">
			<div class="col-lg-12 col-md-12 pt-5">
				
<h3>ATTEND AN ADMISSION EVENT</h3>
<p>The College of Health Professions and Sciences offers a variety of opportunities for a candidate to learn more about UCF and specialized graduate programs. Our admission events listed below provide detailed information about the specific program including curriculum, learning outcomes, program format and schedule, admission requirements, application process, as well as an opportunity to visit the location of the program.</p>

<h4>Upcoming Events</h4>
<p>Each information session provides detailed information about the graduate program, application process and admission process. Participants have the opportunity to ask questions, meet admissions staff, faculty and alumni.</p>

			</div>
			<div class="col-lg-2 col-md-12 pt-3 pb-3" style="text-align: center; background-color:#f2f2f2;">
Filter by Unit:	
			</div>
			<div class="col-lg-10 col-md-12 pt-3 pb-3" style="text-align: center; background-color:#f2f2f2;">
<?php echo do_shortcode( '[searchandfilter slug="slate-events"]' );?>	
			</div>
			<div class="col-lg-12 col-md-12 pt-2">
				<?php if ( have_posts() ) : ?>
				<?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
				while ( have_posts() ) : the_post();
				?>
				<div class="pt-3 pb-3 grantResult">
					<?php get_template_part( 'event-results'); ?>
                </div>
				<?php endwhile; ?>
				<!-- then the pagination links -->
				<div class="mt-5">
					<?php wpbeginner_numeric_posts_nav(); ?>
				</div>
				<?php else : ?>
            Sorry No Events Match Your Search
        <?php endif; ?>
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
.searchandfilter ul {
	margin-left: 0px !important;
	padding-left:0px !important;
}	
.searchandfilter ul li label{
	margin-bottom: 0px !important;
}	

	
.searchandfilter li[data-sf-field-input-type="select"] label{
	width: 100% !important;	
	margin-bottom: 15px;
}
.searchandfilter li[data-sf-field-input-type="select"] label select{
	width: 100% !important;
	font-size: 16px !important;
	padding:8px !important;
}	
.registerBTN-full {
	display: block;
	background-color: #ffcc00;
	color: #000;
	font-weight: 800;
	text-align: center;
	padding: 10px 0px;
	-o-transition:.2s;
	-ms-transition:.2s;
	-moz-transition:.2s;
	-webkit-transition:.2s;
	transition:.2s;
}
.registerBTN-full:hover {
	text-decoration: none;
	background: #cca12e !important;
	color: #fff !important;
}

	
	
	
	
	
	
	
/*overwrite header styling */	
.header-title-wrapper {
    max-width: 1100px !important;
}	
.header-media-default {
    min-height: 500px !important;
}	
/* repeated CSS code */
.researchOpp-quals ul {
	list-style-type: none;
}
.yellowBTN-full {
	display: block; 
	font-size: 16px;  
	padding: 18px 25px; 
	text-align: center; 
	background-color:#ffcc00; 
	color:#000000;
}
.yellowBTN-full:hover {
	text-decoration: none;
}
.blackBTN-full {
	display: block; 
	font-size: 16px;  
	line-height: 20px;
	padding: 18px 25px; 
	text-align: center; 
	background-color:#000; 
	color:#fff;
}
.blackBTN-full:hover {
	text-decoration: none;
}
.btnhover-black a:hover {
    background: #222 !important;
	background-image: none !important;
	color:#fff;
}		
</style>
<?php get_footer(); ?>
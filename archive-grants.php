<?php get_header(); ?>
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
								<h1 class="header-title">Awarded Research Grants</h1>
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
			<div class="col-lg-8 col-md-12 pt-4">
				<?php if ( have_posts() ) : ?>
				<?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
				while ( have_posts() ) : the_post();
				?>
				<div class="pt-3 pb-3 grantResult">
					<?php get_template_part( 'grant-results'); ?>
                </div>
				<?php endwhile; ?>
				<!-- then the pagination links -->
				<div class="mt-5">
					<?php wpbeginner_numeric_posts_nav(); ?>
				</div>
				<?php else : ?>
            Sorry No Grants Match Your Search
        <?php endif; ?>
			</div>
			<div class="col-lg-4 profilesidebar pt-5" style="background-color: #f2f2f2;">
				<?php dynamic_sidebar( 'grants-sidebar' ); ?>
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
}	
.searchandfilter .sf-field-search label {
	width: 100% !important;	
}
.searchandfilter input[name="_sf_search[]"]{
	font-size: 16px !important;
	padding:8px !important;
	border: 0px solid #f2f2f2 !important;
	width: 100% !important;	
	margin-bottom: 15px;
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
.searchandfilter li.sf-field-post-meta-research_sex {
	float: left;
	width:50%;
	margin-bottom: 15px;
}
.searchandfilter li.sf-field-post-meta-research_money {
	float: right;
	width:50%;
	margin-bottom: 15px;
}
.searchandfilter li.sf-field-post-meta-research_format {
	float: left;
	width:50%;
	margin-bottom: 15px;
}
.searchandfilter li.sf-field-post-meta-research_minage {
	float: right;
	width:50%;
	margin-bottom: 15px;
}	
li.sf-field-reset {
	margin-top: 15px;
}
.sf_date_field li {
	float: left;
}
.sf_date_field li input{
	width:120px;
}
.sf-date-postfix {
	padding-right:5px;
}
.searchandfilter li.sf-field-reset{
	clear: both;
}	
.searchandfilter li.sf-field-reset input{
	font-size: 14px;
	padding: 5px 30px;
	background-color: #ccc;
	color: #000;
	border: 0px solid !important;
}
.searchandfilter ul li li {
	padding: 0px !important;
}	
.yellowBTN-full {
	line-height: 20px;
}		
.yellowBTN-full strong {
	font-size:20px;
}	
/*overwrite header styling */	
.header-title-wrapper {
    max-width: 1100px !important;
}	
.header-media-default {
    min-height: 350px !important;
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
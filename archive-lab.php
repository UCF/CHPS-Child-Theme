<?php get_header(); 
$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
?>
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
 }
 </style>
<div class="header-media header-media-content-block header-media-short media-background-container mb-0 d-flex flex-column">
	<picture class="media-background-picture ">
    	<source srcset="https://healthprofessions.ucf.edu/wp-content/uploads/sites/2/2020/12/researchLabsHeader-1500x400.jpg" media="(min-width: 1200px)">
        <source srcset="https://healthprofessions.ucf.edu/wp-content/uploads/sites/2/2020/12/researchLabsHeader-1199x400.jpg" media="(min-width: 992px)">
        <source srcset="https://healthprofessions.ucf.edu/wp-content/uploads/sites/2/2020/12/researchLabsHeader-991x400.jpg" media="(min-width: 768px)">
        <source srcset="https://healthprofessions.ucf.edu/wp-content/uploads/sites/2/2020/12/researchLabsHeader-767x400.jpg" media="(min-width: 576px)">
        <source srcset="https://healthprofessions.ucf.edu/wp-content/uploads/sites/2/2020/12/researchLabsHeader.jpg" media="(max-width: 575px)">
		<img class="media-background object-fit-cover" src="https://healthprofessions.ucf.edu/wp-content/uploads/sites/2/2020/12/researchLabsHeader-1500x400.jpg" alt="">
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
<div style="background:#f2f2f2;" class="mb-5">
	<div class="container d-flex align-items-center align-items-sm-end">
    	<div class="row no-gutters w-100">
        	<div class="col" style="display:flex;justify-content:left;align-items:center;">
            	<a href="../" class="darklink"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> View All Research Labs</a>
            </div>
            <div class="col">
				<?php echo do_shortcode( '[searchandfilter slug="labs"]' ); ?>
			</div>
		</div>
	</div>
</div>
<div class="container mb-5 mt-3 mt-lg-5">
	<article class="<?php echo $post->post_status; ?> post-list-item">
		<div class="vc_column-inner">
				<?php if ( have_posts() ) : ?>
				<?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;?>
<?php echo do_shortcode("[showlabs unit=\"$term->name\" showunit='No']"); ?>
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
<?php get_footer(); ?>
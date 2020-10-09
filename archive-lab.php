<?php get_header(); 
$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
?>
<div class="container mb-5 mt-3 mt-lg-5">
	<article class="publish post-list-item">
		<section data-vc-full-width="true" data-vc-full-width-init="false" class="vc_section mb-4 vc_custom_1590163440237 vc_section-has-fill vc_section-o-content-middle vc_section-flex"><div class="vc_row wpb_row vc_row-fluid"><div class="wpb_column vc_column_container vc_col-sm-9"><div class="vc_column-inner vc_custom_1527858038636"><div class="wpb_wrapper"><div class="evc-section-title evc-shortcode mainHomeTitle" style="text-align: left">
	<div class="evc-st-inner">
					<h1 class="evc-st-title" style="color: #000000">
				CHPS Research Labs			</h1>
									</div>
</div>
<div class="evc-section-title evc-shortcode mainHomeSubtitle" style="text-align: left">
	<div class="evc-st-inner">
					<h2 class="evc-st-title" style="color: #ffffff">
				UCF College of Health Professions and Sciences			</h2>
									</div>
</div>
</div></div></div><div class="wpb_column vc_column_container vc_col-sm-3"><div class="vc_column-inner"><div class="wpb_wrapper"></div></div></div></div></section><div class="vc_row-full-width vc_clearfix"></div><section data-vc-full-width="true" data-vc-full-width-init="false" class="vc_section mb-5 pt-0 filterSearch vc_custom_1602189880899 vc_section-has-fill"><div class="vc_row wpb_row vc_row-fluid"><div class="wpb_column vc_column_container vc_col-sm-6"><div class="vc_column-inner"><div class="wpb_wrapper"></div></div></div><div class="wpb_column vc_column_container vc_col-sm-6"><div class="vc_column-inner"><div class="wpb_wrapper">
	<div class="wpb_text_column wpb_content_element  mb-0" >
		<div class="wpb_wrapper">
			<form data-sf-form-id='19570' data-is-rtl='0' data-maintain-state='' data-ajax-form-url='https://healthchpscmsdev.smca.ucf.edu/?sfid=19570&amp;sf_action=get_data&amp;sf_data=form' data-display-result-method='post_type_archive' data-use-history-api='1' data-template-loaded='0' data-taxonomy-archives='1' data-lang-code='' data-ajax='0' data-init-paged='1' data-auto-update='1' action='' method='post' class='searchandfilter' id='search-filter-form-19570' autocomplete='off' data-instance-count='1'><ul><li class="sf-field-taxonomy-lab_tax" data-sf-field-name="_sft_lab_tax" data-sf-field-type="taxonomy" data-sf-field-input-type="select" data-sf-term-rewrite='["https:\/\/healthchpscmsdev.smca.ucf.edu\/research\/labs\/[0]\/"]'>		<label>

				<select name="_sft_lab_tax[]" class="sf-input-select" title="">

			

						<option class="sf-level-0 sf-item-0 sf-option-active" selected="selected" data-sf-count="0" data-sf-depth="0" value="">Filter by Unit</option>

						<option class="sf-level-0 sf-item-162" data-sf-count="2" data-sf-depth="0" value="athletic-training">Athletic Training&nbsp;&nbsp;(2)</option>

						<option class="sf-level-0 sf-item-166" data-sf-count="1" data-sf-depth="0" value="physical-therapy">Physical Therapy&nbsp;&nbsp;(1)</option>

						<option class="sf-level-0 sf-item-167" data-sf-count="1" data-sf-depth="0" value="social-work">Social Work&nbsp;&nbsp;(1)</option>

					</select>

		</label>		</li></ul></form>

		</div>
	</div>
</div></div></div></div></section><div class="vc_row-full-width vc_clearfix"></div>




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
<style type="text/css" data-type="vc_shortcodes-custom-css">.vc_custom_1590163440237{margin-bottom: 0px !important;padding-top: 100px !important;padding-bottom: 100px !important;background-image: url(https://healthchpscmsdev.smca.ucf.edu/wp-content/uploads/sites/2/2020/05/healthTips4.jpg?id=19383) !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}.vc_custom_1602189880899{background-color: #f2f2f2 !important;}.vc_custom_1527858038636{padding-right: 80px !important;}
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
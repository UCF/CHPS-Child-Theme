<?php get_header(); 
$getimageURL = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'full' );
$categories = get_the_category();
$primary_term_id = yoast_get_primary_term_id('category');
$postTerm = get_term( $primary_term_id );
$thumb_id = get_post_thumbnail_id(get_the_ID());
$research_facultymember = get_field( 'research_facultymember' );
$research_unit_terms = get_field( 'research_unit' );
$today = date("F j, Y");  
$deadline = get_field( 'research_enddate' );
?>
<div class="container mb-5 mt-3 mt-lg-5">
	<article class="publish post-list-item">
	<div class="row">
		<div class="col-md-12 mb-4">
			<a class="cattitle-single" href="../">CHPS RESEARCH OPPORTUNITIES</a>
			<h1><?php the_title(); ?></h1>
		</div>
	</div>
	<div class="row mb-5">
		<div class="col-md-8 pl-3 pr-3"> <!-- padding 15px on left and right -->
			<div class="mb-4">
				<?php if ( has_post_thumbnail()) { ?>
					   <?php if( get_field('featimg_location') == 'Full Width' ): ?>
							<div id="postIMG">
									<a href="<?php echo $getimageURL ?>" rel="lightbox" title ="Enlarge the image for the CHPS News story titled: <?php echo the_title(); ?>"><img width="100%" alt="<?php if (!empty($alt)) { echo $alt; } else { echo the_title(); } ?>" src="<?php echo $getimageURL ?>" /></a>
							</div>
					   <?php endif; ?>
					   <?php if( get_field('featimg_location') == 'Right Aligned' ): ?>
							<div id="imgRight-medium">
								<a href="<?php echo $getimageURL ?>" rel="lightbox" title ="Enlarge the image for the CHPS News story titled: <?php echo the_title(); ?>"><img width="100%" alt="<?php if (!empty($alt)) { echo $alt; } else { echo the_title(); } ?>" src="<?php echo $getimageURL ?>" /></a>
							</div>
					   <?php endif; ?>
				<?php } ?>
				<?php the_content(); ?> 
			</div>
			<h2>Minimum Qualifications:</h2> <!-- style this size -->
			<div class="mb-4 researchOpp-quals">
				<?php the_field('research_qualifications'); ?>
			</div>
			<?php
				if ($today<$deadline) {  ?>
					<div class="pt-4" id="getStarted">
						<div id="participationForm">
						<div id="researchOpp-particiForm">
							<h2>Participate in this Research</h2>
							<span style="font-size: 13px;">Submitting this form will put you in contact with the main point of contact for this project. They will provide more information and determine if you meet all of the qualifications needed.</span>
							<?php echo do_shortcode( '[gravityform id=5 title=false description=false ajax=true field_values="research_me=' . get_field('research_contactemail') . '&amp;opportunity_titlename=' . get_the_title() . '"]' ); ?>
						</div>
						</div>	
					</div>
				<?php } else { } ?>
		</div>
		<div class="col-md-4 pl-0 pr-0" style="background-color: #f2f2f2">
			<div class="researchOpp-dblock"> <!-- add a 1px bottom border & padding to the div -->
				<strong>IRB#:</strong> <?php the_field('research_irb'); ?>
			</div>
			<div class="researchOpp-dblock hidemobile"> 
				<?php
					if ($today<$deadline) {  ?>
						<div class="btnhover-yellow">
							<a href="#getStarted" title="Participate in this Research Project" class="yellowBTN-full">Participate!</a>
						</div>
					<?php } else { ?>
						<div class="btnhover-red">
							<a href="../" title="Participate in this Research Project" class="redBTN-full">This Opportunity Has Closed</a>
						</div>
						<div class="missedOut">Please search our other <a href="../">open opportunities</a> to participate in research studies</div>
				<?php } ?>
				
				<!-- hopefully with GLIDE ALSO MAKE THIS GO AWAY ON MOBILE-->
			</div>
			<div class="researchOpp-dblock"> 
				<i class="fa fa-bell icongrey"></i> <strong>Recruitment Deadline:</strong><br>
				<span style="font-size: 25px;"><?php the_field('research_enddate'); ?></span>  <!-- responsive size? -->
			</div>
			<div class="researchOpp-dblock"> 
				<i class="fa fa-map-marker icongrey"></i> <strong>Location:</strong><br>
				<?php the_field('research_building'); ?><br>   <!-- add link to map maybe? -->
				<?php the_field('research_address'); ?><br>
				<?php the_field('research_city'); ?>, <?php the_field('research_state'); ?> <?php the_field('research_zip'); ?>
			</div>
			<div class="researchOpp-dblock"> 
				<i class="fa fa-calendar icongrey"></i> <strong>Time Commitment:</strong><br>
				Number of visits: <?php the_field('research_visits'); ?><br>
				Expected time per visit: <?php the_field('research_time'); ?> <?php the_field('research_timemeasure'); ?>
			</div>
		<?php if(get_field('research_amount')){ ?>
			<div class="researchOpp-dblock"> 
				<i class="fa fa-money icongreen"></i> <strong>Compensation:</strong><br>
				Amount: $<?php the_field('research_amount'); ?>.00 (USD)<br>
				Format: <?php the_field('research_payment_format'); ?>
			</div>
		<?php }	?>	
			<div class="researchOpp-dblock"> 
				<i class="fa fa-user-circle icongrey"></i> <strong>Contact:</strong><br>
				<?php the_field('research_contactname'); ?>
			</div>
			<div class="researchOpp-dblock"> 
				<?php if ( $research_unit_terms ): ?>
					<?php foreach ( $research_unit_terms as $research_unit_term ): ?>
						<i class="fa fa-briefcase iconyellow"></i> <?php echo $research_unit_term->name; ?><br>
					<?php endforeach; ?>
				<?php endif; ?>
				<?php if ( $research_facultymember ): ?>
					<?php foreach ( $research_facultymember as $p ): ?>
						<i class="fa fa-user iconyellow"></i> <a href="<?php echo get_permalink( $p ); ?>"><?php echo get_the_title( $p ); ?></a><br>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>
		</div>
	</div>	
		<?php
			// get the custom post type's taxonomy terms
			$custom_taxterms = wp_get_object_terms( $post->ID, 'researchopp_unit', array('fields' => 'ids') );
			// arguments
			$args = array(
			'post_type' => 'researchopp',
			'post_status' => 'publish',
			'posts_per_page' => 3, // you may edit this number
			'orderby' => 'rand',
			'tax_query' => array(
				array(
					'taxonomy' => 'researchopp_unit',
					'field' => 'id',
					'terms' => $custom_taxterms
				)
			),
			'meta_query' => array(
				array(
					'key' => 'research_enddate',
				),
				array(
					'key' => 'research_enddate',
					'value' => $today,
					'compare' => '>'
				)
			),		
			'post__not_in' => array ($post->ID),
			);
			$related_items = new WP_Query( $args );
			// loop over query
			if ($related_items->have_posts()) : ?>
		<div class="row">
		<?php echo do_shortcode('[vc_separator style="shadow" border_width="5"]'); ?>
			<div>
				<h2 class="heading-underline">Related Research Participation Opportunities</h2> 	
			</div>
		</div>	
		<div class="container newsmedia">
			<div class="row narrow-gutter row-flex">
			<?php
				while ( $related_items->have_posts() ) : $related_items->the_post();
			?>
				<div class="col-md-4 researchOpp-relateLink">
					<a href="<?php the_permalink(); ?>">
						<div class="researchOpp-relateCard"><?php the_title(); ?></div>
					</a>	
				</div>		
			<?php
				endwhile;
				echo '</div></div>';
				endif;
				// Reset Post Data
				wp_reset_postdata();
			?>
	</div>
	</article>
</div>
<style>
.site-header .container h1 {display: none !important;}
article h2 { font-size: 26px; margin-bottom: 16px;}	
article h3 { font-size: 20px; margin-bottom: 16px;}	
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
.redBTN-full {
	display: block; 
	font-size: 16px;  
	padding: 18px 25px; 
	text-align: center; 
	background-color:#990000; 
	color:#fff;
}
.redBTN-full:hover {
	text-decoration: none;
}
.btnhover-red a:hover {
    background: #830101 !important;
	background-image: none !important;
	color:#fff;
}
.missedOut {
	text-align: center;
	font-size: 13px;
	line-height: 13px;
	margin-top: 5px;
}	
.researchOpp-quals ul {
	list-style-type: none;
}
.researchOpp-quals ul li::before {
	content: "\f058";
	font-family: "FontAwesome";
	padding: 0 10px 0 0;
	color:#ffcc00;
}	
.researchOpp-dblock {
	border-bottom: 1px #dddddd solid;
	padding: 15px;
}
.researchOpp-relateLink {
	padding:10px;
}	
.researchOpp-relateLink a:hover {
	text-decoration: none;
	color:#ffcc00;
}
.researchOpp-relateCard {
	border:1px #ddd solid; 
	padding:25px;
	height: 100%;
    line-height:18px;
    font-size: 16px !important;
}
.researchOpp-relateCard:hover {
	background-color: #000;
}		
.vc_btn3-container {
	margin-bottom: 0px !important;
}
#researchOpp-particiForm {
    background-color:#ffcc00;
    padding:25px 25px 5px 25px;
    min-height:100px;
}
#researchOpp-particiForm h2{
    margin-bottom:0px !important;
}
.gform_wrapper {
    margin-top:0px !important;
}
#researchOpp-particiForm .gfield_label {
    display:none;
}
#researchOpp-particiForm .gform_button {
    padding: 10px 35px;
    font-size: 20px;
    background:#000;
    color:#fff;
    border: 0px solid;
    cursor: pointer;
}
#researchOpp-particiForm .gform_button:hover {
    background:#404040;
}
#researchOpp-particiForm .validation_error {
    color:red !important;
    font-size:15px !important;
}	
</style>
<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5ae1f19edbbe0111" async="async"></script>
<?php get_footer(); ?>

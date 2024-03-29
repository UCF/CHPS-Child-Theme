<?php get_header(); 
$getimageURL = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'full' );
$categories = get_the_category();
$primary_term_id = yoast_get_primary_term_id('category');
$postTerm = get_term( $primary_term_id );
$thumb_id = get_post_thumbnail_id(get_the_ID());
$research_facultymember = get_field( 'research_facultymember' );
$research_unit_terms = get_field( 'research_unit' );
$research_tag_terms = get_field( 'research_tags' );
$today = date("Ymd"); 
$deadline = get_field( 'research_enddate' );
$deadlineShort = date("Ymd", strtotime($deadline));	
$postid = get_the_ID();
?>
<div class="container mb-5 mt-3 mt-lg-5">
	<article class="publish post-list-item">
	<div class="row">
		<div class="col-md-12 mb-4">
			<a class="cattitle-single" href="../">CHPS RESEARCH STUDIES</a>
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
			<?php if (get_field('research_qualifications')){ ?>
            <h2>Inclusion Qualifications:</h2> <!-- style this size -->
			<div class="mb-4 researchOpp-quals">
				<?php the_field('research_qualifications'); ?>
			</div>
            <?php } ?>
            <?php if (get_field('research_exclusion')){ ?>
            <h2 class="mb-0">Exclusion Qualifications:</h2> <!-- style this size -->
            	<span style="font-size:14px;">You may not participate in this research opportunity if any of the following applies to you:</span>
			<div class="mb-4 mt-2 researchOpp-exquals">
				<?php the_field('research_exclusion'); ?>
			</div>
            <?php } ?>
			<?php
				if ($today<$deadlineShort) {  ?>
					<div class="pt-4" id="getStarted">
						<div id="participationForm">
						<div id="researchOpp-particiForm">
							<h2>Participate in this Research</h2>
							<span style="font-size: 13px;">Submitting this form will put you in contact with the main point of contact for this project. They will provide more information and determine if you meet all of the qualifications needed.</span>
							<?php echo do_shortcode( '[gravityform id=5 title=false description=false ajax=true field_values="research_me=' . get_field('research_contactemail') . '&amp;opportunity_titlename=' . get_the_title() . '"]' ); ?>
						</div>
						</div>	
					</div>
				<?php } else { ?>
					<div class="pt-4" id="getStarted">
						<div id="participationForm">
						<div id="researchOpp-missedForm">
							<h2>Get Notified of Future Opportunities</h2>
							<span style="font-size: 13px;">Subscribe to our email list to be automatically notified of all future research participation opportunities as soon as they become available.</span>
							<?php echo do_shortcode( '[gravityform id=6 title=false description=false ajax=true field_values="research_me=' . get_field('research_contactemail') . '&amp;opportunity_titlename=' . get_the_title() . '"]' ); ?>
						</div>
						</div>	
					</div>		
				<?php } ?>
		</div>
		<div id="researchOppColumn" class="col-md-4 pl-0 pr-0" style="background-color: #f2f2f2">
			<div class="researchOpp-dblock"> <!-- add a 1px bottom border & padding to the div -->
				<strong>UCF IRB#:</strong> <?php the_field('research_irb'); ?><br>
				<?php if (get_field('research_trialsURL')){ ?><a href="<?php the_field('research_trialsURL'); ?>" class="darklink" target="_blank" data-wpel-link="external" rel="nofollow external noopener noreferrer">ClinicalTrials.gov ID</a><br><?php } ?>
				<strong>PI:</strong> <?php the_field('research_pi'); ?>
				<?php if (get_field('research_expireDate')){ ?>
				<br><strong>IRB Expiration</strong> <?php the_field('research_expireDate'); ?>
				<?php } ?>
			</div>
			<div class="researchOpp-dblock hidemobile"> 
				<?php
					if ($today<$deadlineShort) {  ?>
						<div class="btnhover-yellow">
							<a href="#getStarted" title="Participate in this Research Project" class="yellowBTN-full">Participate in this Study!</a>
						</div>
					<?php } else { ?>
						<div class="btnhover-red">
							<a href="../" title="Recruitment Has Ended" class="redBTN-full">Recruitment Has Ended</a>
						</div>
						<div class="missedOut">Please consider <a href="#getStarted" class="darklink">subscribing to get notified</a> about future research participation opportunities</div>
				<?php } ?>
			</div>
			<div class="researchOpp-dblock"> 
				<i class="fa fa-bell icongrey"></i> <strong>Recruitment End Date:</strong><br>
				<span style="font-size: 25px;"><?php the_field('research_enddate'); ?></span>  <!-- responsive size? -->
			</div>
			<div class="researchOpp-dblock"> 
				<i class="fa fa-map-marker icongrey"></i> <strong>Location:</strong><br>
                <?php if (get_field('research_building_name')){ ?><?php the_field('research_building_name'); ?><br><?php } ?>
				<?php
					if( get_field('research_format') == 'Online' ) { ?>
					Online
				<?php } elseif ( get_field('research_format') == 'Multisite' ) {?>
					Multisite
				<?php } else { ?>
				<!-- <?php //the_field('research_building'); ?><br>-->    <!-- add link to map maybe? -->
				<?php the_field('research_address'); ?><br>
				<?php if (get_field('research_room')){ ?><?php the_field('research_room'); ?><br><?php } ?>
				<?php the_field('research_city'); ?>, <?php the_field('research_state'); ?> <?php the_field('research_zip'); ?>
				<?php } ?>
				
			</div>
			<?php if (get_field('research_visits')){ ?>
			<div class="researchOpp-dblock"> 
					<i class="fa fa-calendar icongrey"></i> <strong>Time Commitment:</strong><br>
					Number of visits: <?php the_field('research_visits'); ?><br>
				<?php if (get_field('research_time')){ ?>Expected time per visit: <?php the_field('research_time'); ?> <?php the_field('research_timemeasure'); ?><?php } ?>
			</div>
			<?php } ?>
		<?php if( get_field('research_money') == 'Yes' ) { ?>
			<div class="researchOpp-dblock"> 
				<i class="fa fa-money icongreen"></i> <strong>Compensation:</strong><br>
				Type: <?php the_field('research_amount'); ?>
			</div>
		<?php }	?>	
			<div class="researchOpp-dblock"> 
				<i class="fa fa-user-circle icongrey"></i> <strong>Point of Contact:</strong><br>
				<?php the_field('research_contactname'); ?>
			</div>
			<?php if (get_field('research_faculty_name')){ ?>
				<div class="researchOpp-dblock"> 
					<i class="fa fa-user iconyellow"></i> <strong>Faculty Advisors:</strong><br>
					<?php foreach ( $research_facultymember as $p ): ?>
						<a href="<?php echo get_permalink( $p ); ?>" class="darklink"><?php echo get_the_title( $p ); ?></a><br>
					<?php endforeach; ?>
				</div>
			<?php } ?>
			<div class="researchOpp-dblock"> 
				<?php if ( $research_unit_terms ): ?>
					<i class="fa fa-briefcase icongrey"></i> <strong>Associated Units:</strong><br>
					<?php foreach ( $research_unit_terms as $research_unit_term ): ?>
						<?php echo $research_unit_term->name; ?><br>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>
            <?php if ( $research_tag_terms ): ?>
            <div class="researchOpp-dblock"> 
					<i class="fa fa-tags icongrey"></i> <strong>Related Tags:</strong><br>
					<?php foreach ( $research_tag_terms as $research_tag_term ): ?>
						<a href="<?php echo get_term_link($research_tag_term); ?>" class="darklink"><?php echo $research_tag_term->name; ?></a><br>
					<?php endforeach; ?>
			</div>
            <?php endif; ?>
			<div class="researchOpp-dblock"> 
				<div class="btnhover-black">
					<a href="https://healthprofessions.ucf.edu/irb-resource" title="What it mean to be a research participant" class="blackBTN-full" target="_blank" rel="nofollow external noopener noreferrer">What does it mean to be a<br><span style="color:#ffcc00;font-size:25px;font-weight:bold;">Research Participant?</span></a>
				</div>
			</div>
            <div class="researchOpp-dblock">
                <div class="shareResearch">
                    <i class="fa fa-share-alt-square icongrey"></i> <strong>Short URL:</strong> https://chps.ucf.edu/study/<?php echo $postid; ?>/
                </div>
                <!--<div class="shareResearchQR">
					<img src="https://chart.googleapis.com/chart?chs=300x300&amp;cht=qr&amp;chl=https%3A%2F%2Fchps.ucf.edu%2Fstudy%2F<?php //echo $postid; ?>&amp;choe=UTF-8" alt="QR code">          
                    </div>-->
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
				 'value' => $today,
				 'compare' => '>='
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
						<div class="researchOpp-relateCard">
							<strong><?php the_title(); ?></strong><br><br>
							<?php the_excerpt(); ?>
						</div>
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
html {
	scroll-behavior: smooth;
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
.redBTN-full {
	display: block; 
	font-size: 16px;  
	padding: 18px 25px; 
	text-align: center; 
	background-color:#cc0000; 
	color:#fff;
}
.redBTN-full:hover {
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
.btnhover-red a:hover {
    background: #830101 !important;
	background-image: none !important;
	color:#fff;
}
.btnhover-black a:hover {
    background: #222 !important;
	background-image: none !important;
	color:#fff;
}	
.missedOut {
	text-align: center;
	font-size: 13px;
	line-height: 13px;
	margin-top: 5px;
}	
.researchOpp-quals ul, .researchOpp-exquals ul {
	list-style-type: none;
}
.researchOpp-quals ul li::before {
	content: "\f058";
	font-family: "FontAwesome";
	padding: 0 10px 0 0;
	color:#ffcc00;
}	
.researchOpp-exquals ul li::before {
	content: "\f057";
	font-family: "FontAwesome";
	padding: 0 10px 0 0;
	color:#000;
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
.researchOpp-relateCard strong{
    font-size: 19px !important;
}	
.vc_btn3-container {
	margin-bottom: 0px !important;
}
.gform_wrapper {
    margin-top:0px !important;
}
#researchOpp-particiForm {
    background-color:#ffcc00;
    padding:25px 25px 5px 25px;
    min-height:100px;
}
#researchOpp-particiForm h2{
    margin-bottom:0px !important;
}
#researchOpp-particiForm .gfield_label {
   clip-path: inset(100%);
   clip: rect(1px, 1px, 1px, 1px);
   height: 1px;
   overflow: hidden;
   position: absolute;
   white-space: nowrap;
   width: 1px;
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
#researchOpp-particiForm .gfield_checkbox label {
    padding-top: 10px !important;
}	
#researchOpp-missedForm {
    background-color:#000;
    padding:25px 25px 5px 25px;
    min-height:100px;
	color: #fff;
}
#researchOpp-missedForm h2{
    margin-bottom:0px !important;
}
#researchOpp-missedForm .gfield_label {
    display:none;
}
#researchOpp-missedForm .gform_button {
    padding: 10px 35px;
    font-size: 20px;
    background:#ffcc00;
    color:#000;
    border: 0px solid;
    cursor: pointer;
}
#researchOpp-missedForm .gform_button:hover {
    background:#cca12e;
}
#researchOpp-missedForm .validation_error {
    color:red !important;
    font-size:15px !important;
}	
.dislcaimerForm {
	font-size: 11px;
	font-style: italic;
	line-height: 13px;
	color:#3B3D45;
}
.shareResearch {
	background-color: #e1e1e1;
	font-size:13px;
	color:#474747;
	border-radius: 5px;
	padding:8px;
}
.shareResearchQR {
	text-align:center;
	margin:0px auto;
}
.shareResearchQR img {
	max-width:50%;
}
</style>
<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5ae1f19edbbe0111" async="async"></script>
<?php get_footer(); ?>

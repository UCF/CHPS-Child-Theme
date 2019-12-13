<?php get_header(); 
$getimageURL = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'full' );
$categories = get_the_category();
$primary_term_id = yoast_get_primary_term_id('category');
$postTerm = get_term( $primary_term_id );
$thumb_id = get_post_thumbnail_id(get_the_ID());
$research_facultymember = get_field( 'research_facultymember' );
$research_unit_terms = get_field( 'research_unit' );
?>
<div class="container mb-5 mt-3 mt-lg-5">
	<article class="publish post-list-item">
	<div class="row">
		<div class="col-md-12 mb-4">
			<a class="cattitle-single" href="../research-opp/">CHPS RESEARCH OPPORTUNITIES</a>
			<h1><?php the_title(); ?></h1>
		</div>
	</div>
	<div class="row mb-5">
		<div class="col-md-8 pl-3 pr-3"> <!-- padding 15px on left and right -->
			<div class="mb-3">
				<?php the_content(); ?> 
			</div>
			<h2>Minimum Qualifications:</h2> <!-- style this size -->
			<div class="mb-4 researchOpp-quals">
				<?php the_field('research_qualifications'); ?>
			</div>
			<div id="participationForm">
				INSERT GRAVITY FORM HERE
			</div>
		</div>
		<div class="col-md-4 pl-0 pr-0" style="background-color: #f2f2f2">
			<div class="researchOpp-dblock"> <!-- add a 1px bottom border & padding to the div -->
				<strong>IRB#:</strong> <?php the_field('research_irb'); ?>
			</div>
			<div class="researchOpp-dblock hidemobile"> 
				<div class="vc_btn3-container  btnhover-yellow vc_btn3-center" >
					<a style="background-color:#ffcc00; color:#000000;" class="vc_general vc_btn3 vc_btn3-size-lg vc_btn3-shape-square vc_btn3-style-custom vc_btn3-block" href="#getinvolved" title="">Participate!</a>
				</div>
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
	<div class="row">
		<?php echo do_shortcode('[vc_separator style="shadow" border_width="5"]'); ?>
		<div>
			<h2 class="heading-underline">Related Research Participation Opportunities</h2> 	
		</div>
	</div>	
	<div class="row">	
		<div class="col-md-4 researchOpp-relateLink">
			<a href="#">
			<div class="researchOpp-relateCard">
				This is a title of a related research opportunity connected by Unit which could be a long title still
			</div>
			</a>	
		</div>
		<div class="col-md-4 researchOpp-relateLink">
			<a href="#">
			<div class="researchOpp-relateCard">
				This is a title of a related research opportunity connected by Unit which could be a long title still
			</div>
			</a>	
		</div>
		<div class="col-md-4 researchOpp-relateLink">
			<a href="#">
			<div class="researchOpp-relateCard">
				This is a title of a related research opportunity connected by Unit which could be a long title still
			</div>
			</a>	
		</div>
	</div>
	</article>
</div>
<style>
.site-header .container h1 {display: none !important;}
article h2 { font-size: 26px; margin-bottom: 16px;}	
article h3 { font-size: 20px; margin-bottom: 16px;}	
.researchOpp-quals ul {
	list-style-type: none;
}
.researchOpp-quals ul li::before {
	content: "\f058";
	font-family: "Font Awesome 5 Free";
	padding: 0 10px 0 0;
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
	border:1px #d8d8d8 solid; 
	padding:25px;
}
.researchOpp-relateCard:hover {
	background-color: #000;
}		
.vc_btn3-container {
	margin-bottom: 0px !important;
}
</style>
<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5ae1f19edbbe0111" async="async"></script>
<?php get_footer(); ?>

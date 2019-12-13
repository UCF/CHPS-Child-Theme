<?php get_header(); 
$getimageURL = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'full' );
$categories = get_the_category();
$primary_term_id = yoast_get_primary_term_id('category');
$postTerm = get_term( $primary_term_id );

$thumb_id = get_post_thumbnail_id(get_the_ID());
?>
<div class="container mb-5 mt-3 mt-lg-5">
	<article class="publish post-list-item">
	<div class="row">
		<div class="col-md-12 mb-4">
			<a class="cattitle-single" href="../research-opp/">CHPS RESEARCH OPPORTUNITIES</a>
			<h1><?php the_title(); ?></h1>
		</div>
	</div>
	<div class="row mb-4">
		<div class="col-md-8 pl-2 pr-2"> <!-- padding 15px on left and right -->
			<div class="mb-3">
				<?php the_content(); ?> 
			</div>
			<h2>Minimum Qualifications:</h2> <!-- style this size -->
			<div class="mb-3">
				INSERT BULLET POINTS
			</div>
			<div id="participationForm">
				INSERT GRAVITY FORM HERE
			</div>
		</div>
		<div class="col-md-4" style="background-color: #f2f2f2">
			<div class="researchOpp-dblock"> <!-- add a 1px bottom border & padding to the div -->
				<strong>IRB#:</strong> 171987349782
			</div>
			<div class="researchOpp-dblock"> 
				INSERT BUTTON HERE  <!-- hopefully with GLIDE ALSO MAKE THIS GO AWAY ON MOBILE-->
			</div>
			<div class="researchOpp-dblock"> 
				<strong>Recruitment Deadline:</strong><br>
				<span style="font-size: 25px;">December 15, 2020</span>  <!-- responsive size? -->
			</div>
			<div class="researchOpp-dblock"> 
				<strong>Location:</strong><br>
				Name of Building<br>   <!-- add link to map maybe? -->
				12805 Pegasus Drive.<br>
				Orlando, FL 32816
			</div>
			<div class="researchOpp-dblock"> 
				<strong>Compensation:</strong><br>
				Amount: $20.00 (USD)<br>
				Format: Gift Card
			</div>
			<div class="researchOpp-dblock"> 
				<strong>Contact:</strong><br>
				Name of Person
			</div>
			<div class="researchOpp-dblock"> 
				<li>NAME UNIT</li>
				<li>NAME FACULTY MEMBERS</li>
				<li>NAME FACULTY MEMBERS</li>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<?php echo do_shortcode('[vc_separator style="shadow" border_width="5"]'); ?>
			<div>
				<h3 class="heading-underline">Related Research Participation Opportunities</h3> <!-- style this size -->	
			</div>
			<div class="col-md-4" style="padding:10px;">
				<div style="border:1px #d8d8d8 solid; padding:25px;">
					<a href="#">This is a title of a related research opportunity connected by Unit which could be a long title still</a>
				</div>	
			</div>
			<div class="col-md-4" style="padding:10px;">
				<div style="border:1px #d8d8d8 solid; padding:25px;">
					<a href="#">This is a title of a related research opportunity connected by Unit which could be a long title still</a>
				</div>	
			</div>
			<div class="col-md-4" style="padding:10px;">
				<div style="border:1px #d8d8d8 solid; padding:25px;">
					<a href="#">This is a title of a related research opportunity connected by Unit which could be a long title still</a>
				</div>	
			</div>
		</div>
	</div>
	</article>
</div>
<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5ae1f19edbbe0111" async="async"></script>
<?php get_footer(); ?>

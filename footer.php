</main>
<?php switch_to_blog(2);?>
<div id="footerSUBSCRIBE">
    <div class="container">
        <div class="row">
        	<div class="col-lg-12">
            	<h3>Subscribe to our newsletter</h3>
            </div>
            <div class="col-lg-12">
            	<p>Be the first to hear about new things happening in the college!</p>
        	</div>
            <div class="col-lg-12">
            	<?php echo do_shortcode('[gravityform id="'.get_field( 'footer_subscription_formid', 'option' ).'" title="false" description="false"]'); ?>
        	</div>
        </div>
	</div>
</div>

	
		<footer class="site-footer bg-inverse">
			<div class="container">
				<div class="row">
					<div class="col-lg-3">
						<section class="primary-footer-section-center">
							<h2 class="h6 heading-underline letter-spacing-3"><?php the_field( 'footer_column_title1', 'option' ); ?></h2>
							<div class="menu-footer-about-container">
								<?php the_field( 'footer_column1_links', 'option' ); ?>
							</div>
						</section>
					</div>
					<div class="col-lg-3">
						<section class="primary-footer-section-center">
							<h2 class="h6 heading-underline letter-spacing-3"><?php the_field( 'footer_column_title2', 'option' ); ?></h2>
							<div class="menu-footer-about-container">
								<?php the_field( 'footer_column2_links', 'option' ); ?>
							</div>
						</section>
					</div>
					<div class="col-lg-3">
						<section class="primary-footer-section-center">
							<h2 class="h6 heading-underline letter-spacing-3"><?php the_field( 'footer_column_title3', 'option' ); ?></h2>
							<div class="menu-footer-about-container">
								<?php the_field( 'footer_column3_links', 'option' ); ?>
							</div>
						</section>
					</div>
					<div class="col-lg-3">
						<section class="primary-footer-section-center">
							<h2 class="h6 heading-underline letter-spacing-3"><?php the_field( 'footer_column_title4', 'option' ); ?></h2>
							<div class="menu-footer-about-container">
								<?php the_field( 'footer_column4_links', 'option' ); ?>
							</div>
						</section>
					</div>
				</div>
			</div>
		</footer>
		<footer class="ucf-footer">
			<a class="ucf-footer-title" href="/"><?php the_field('footer_college_name', 'option'); ?></a>
				<div class="ucf-social-icons">
					<?php if( get_field('sm_facebook_url', 'option') ): ?><a href="<?php the_field( 'sm_facebook_url', 'option' ); ?>" title="Follow Us On Facebook" target="_blank"><span class="fa-stack fa-lg">
					  <i class="fa fa-circle fa-stack-2x fa-inverse"></i>
					  <i class="fa fa-facebook fa-stack-1x footer-social-icon"></i>
					</span></a><?php endif; ?><?php if( get_field('sm_twitter_url', 'option') ): ?><a href="<?php the_field( 'sm_twitter_url', 'option' ); ?>" title="Follow Us On Twitter" target="_blank"><span class="fa-stack fa-lg">
					  <i class="fa fa-circle fa-stack-2x fa-inverse"></i>
					  <i class="fa fa-twitter fa-stack-1x footer-social-icon"></i>
					</span></a><?php endif; ?><?php if( get_field('sm_instagram_url', 'option') ): ?><a href="<?php the_field( 'sm_instagram_url', 'option' ); ?>" title="Follow Us On Instagram" target="_blank"><span class="fa-stack fa-lg">
					  <i class="fa fa-circle fa-stack-2x fa-inverse"></i>
					  <i class="fa fa-instagram fa-stack-1x footer-social-icon"></i>
					</span></a><?php endif; ?><?php if( get_field('sm_youtube_url', 'option') ): ?><a href="<?php the_field( 'sm_youtube_url', 'option' ); ?>" title="Watch Us On YouTube" target="_blank"><span class="fa-stack fa-lg">
					  <i class="fa fa-circle fa-stack-2x fa-inverse"></i>
					  <i class="fa fa-youtube fa-stack-1x footer-social-icon"></i>
					</span></a><?php endif; ?><?php if( get_field('sm_linkedin_url', 'option') ): ?><a href="<?php the_field( 'sm_linkedin_url', 'option' ); ?>" title="Join Us On LinkedIn" target="_blank"><span class="fa-stack fa-lg">
					  <i class="fa fa-circle fa-stack-2x fa-inverse"></i>
					  <i class="fa fa-linkedin fa-stack-1x footer-social-icon"></i>
					</span></a><?php endif; ?><?php if( get_field('sm_flickr_url', 'option') ): ?><a href="<?php the_field( 'sm_flickr_url', 'option' ); ?>" title="View Us On Flickr" target="_blank"><span class="fa-stack fa-lg">
					  <i class="fa fa-circle fa-stack-2x fa-inverse"></i>
					  <i class="fa fa-flickr fa-stack-1x footer-social-icon"></i>
					</span></a><?php endif; ?>
				</div>
			<div class="ucf-footer-nav">
				<?php the_field('footer_links', 'option'); ?>
			</div>
			<p class="ucf-footer-address">
				<?php the_field('footer_address', 'option'); ?> | <a rel="nofollow" href="tel:<?php the_field('footer_phone_number', 'option'); ?>"><?php the_field('footer_phone_number', 'option'); ?></a>
				<br>
				&copy; <a href="https://www.ucf.edu/">University of Central Florida</a>
			</p>
		</footer>
<style>
.site-footer {
    padding-bottom: 2.5rem !important;
	background: url(<?php the_field('footer_background', 'option'); ?>) no-repeat top center fixed; 
  	-webkit-background-size: cover;
  	-moz-background-size: cover;
  	-o-background-size: cover;
  	background-size: cover;
}
</style>		
<?php the_field('bonus_scripts', 'option'); ?>	
<?php if ( get_field( 'enablepopdom', 'option' ) == 1 ):  ?>
	<script src='https://cdn1.pdmntn.com/a/Byg7AfczV.js'></script>
<?php endif; ?>	
<?php if ( get_field( 'enablehotjar', 'option' ) == 1 ):  ?>
    <script>
        (function(h,o,t,j,a,r){
            h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
            h._hjSettings={hjid:934323,hjsv:6};
            a=o.getElementsByTagName('head')[0];
            r=o.createElement('script');r.async=1;
            r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
            a.appendChild(r);
        })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
    </script>
<?php endif; ?>
<!-- END OF CODE - DAVID JANOSIK REPLICATING UCF FOOTER --> 	
<?php restore_current_blog(); ?>		
		<?php wp_footer(); ?>
	</body>
</html>
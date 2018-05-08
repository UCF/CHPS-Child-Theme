		</main>
		<footer class="site-footer bg-inverse">
			<div class="container">
			<?php switch_to_blog(2);?>
				<div class="row david">
					<div class="col-lg-3">
						<section class="primary-footer-section-center"><?php dynamic_sidebar( 'footer-col-1' ); ?></section>
					</div>
					<div class="col-lg-3">
						<section class="primary-footer-section-center"><?php dynamic_sidebar( 'footer-col-2' ); ?></section>
					</div>
					<div class="col-lg-3">
						<section class="primary-footer-section-center"><?php dynamic_sidebar( 'footer-col-3' ); ?></section>
					</div>
					<div class="col-lg-3">
						<section class="primary-footer-section-center"><?php dynamic_sidebar( 'footer-col-4' ); ?></section>
					</div>
				</div>
			<?php restore_current_blog(); ?>
			</div>
		</footer>
		
<!-- DAVID JANOSIK REPLICATING UCF FOOTER -->
	 		
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

.ucf-footer{background-color:#3e3e3e;box-sizing:border-box;display:block;margin:0;padding:30px 15px;text-align:center;width:100%}

.ucf-footer a,.ucf-footer p,.ucf-footer-title,.ucf-footer span{color:#fff;font-family:"Gotham SSm 3r","Gotham SSm A","Gotham SSm B","Helvetica Neue",Helvetica,Arial,sans-serif;-moz-osx-font-smoothing:auto;-webkit-font-smoothing:auto}
.ucf-footer-title{display:block;font-size:18px;font-weight:300;letter-spacing:3px;line-height:1.4;margin-bottom:12px;text-transform:uppercase}@media (min-width:768px){.ucf-footer{padding:60px}.ucf-footer-title{font-size:22px}}

.ucf-footer-address{font-size:10px;font-weight:300;line-height:1.8;margin-bottom:0;margin-top:25px}@media (min-width:768px){.ucf-footer-address{font-size:12px}}
	
	
	.ucf-footer-nav p {font-size:12px;font-weight:lighter!important;line-height:1.4;color:#E2E2E2;letter-spacing:1px;}
	
	a.ucf-footer-nav{font-size:inherit;font-weight:inherit}a.ucf-footer-nav,a.ucf-footer-nav:active,a.ucf-footer-nav:focus,a.ucf-footer-nav:hover{color:#fff}a.ucf-footer-nav:active,a.ucf-footer-nav:focus,a.ucf-footer-nav:hover{text-decoration:underline}
	.ucf-social-icons .ucf-social-link.grey {color: #3e3e3e;background: #ffffff;}
.site-footer {
    padding-bottom: 2.5rem !important;
	background: url(<?php the_field('footer_background', 'option'); ?>) no-repeat top center fixed; 
  	-webkit-background-size: cover;
  	-moz-background-size: cover;
  	-o-background-size: cover;
  	background-size: cover;
}
	@media (max-width: 991px) {
		.site-footer {
			display: none;
		}		
	}

.primary-footer-section-center h2, .primary-footer-section-center h6 {font-weight: 300 !important; font-size: 14px !important;}
	
.primary-footer-section-center .heading-underline-inverse::after, .primary-footer-section-center .heading-underline::after {
    height: 1px !important;
    min-width: 30px !important;
    width: 30px !important;
}	
	.primary-footer-section-center ul {
		padding-left:0px;
	}
	.primary-footer-section-center ul li {
		padding: 4px 0px;
		list-style: none;
	}	
	.primary-footer-section-center ul li a{
		color: #9c9c9c;
		-o-transition:.2s;
  		-ms-transition:.2s;
  		-moz-transition:.2s;
  		-webkit-transition:.2s;
		transition:.2s;
		font-size: 13px;
	}
	.primary-footer-section-center ul li a:hover {
		color: #fc0;
	}
	.ucf-social-icons {
		margin-bottom: 12px;
	}	
	.footer-social-icon {
		color: #3e3e3e;
		-o-transition:.2s;
  		-ms-transition:.2s;
  		-moz-transition:.2s;
  		-webkit-transition:.2s;
		transition:.2s;
	}
.footer-social-icon:hover {
		color: #fc0;
	}
</style>				
<!-- END OF CODE - DAVID JANOSIK REPLICATING UCF FOOTER --> 	
		
		
		<?php wp_footer(); ?>
	</body>
</html>

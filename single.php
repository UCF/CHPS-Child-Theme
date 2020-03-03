<?php get_header(); 
$display_name = get_the_author_meta( 'display_name', $post->post_author );
$getimageURL = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'full' );
$categories = get_the_category();
$primary_term_id = yoast_get_primary_term_id('category');
$postTerm = get_term( $primary_term_id );

$thumb_id = get_post_thumbnail_id(get_the_ID());
$alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
?>
<div class="container mb-5 mt-3 mt-lg-4">
    <div class="row">
		<div class="col-md-1"></div>
        <?php if ( get_field( 'updatenewstype' ) == 1 ) { 
		 // echo 'true';
			echo '<meta http-equiv="refresh" content="3;url=' . get_field('updatenewsURL') . '" />'; ?>
		<div class="col-md-10" id="redirectPost">
			<div>
			<img src="https://healthprofessions.ucf.edu/wp-content/uploads/sites/2/2019/10/loading4.gif" width="50" alt="spinning loading icon"><br>
			You are now leaving our website in order to read the news article titled:<br>
			<h1 class="posttitle"><?php the_title(); ?></h1>
			<p class="authortext">Written By: <?php if(get_field('overwrite_author')){ the_field('overwrite_author');} else { echo $display_name; }?> | <?php the_time('F j, Y'); ?></p>	
			You will be redirected in 5 seconds. 
			</div>
		</div>

		<?php } else { ?>
		<div class="col-md-10" id="storyPost">
        	<div>
				<?php 
					if ( $postTerm && ! is_wp_error( $postTerm ) ) {
						echo '<a class="cattitle-single" href="' . esc_url( get_term_link( $postTerm->term_id ) ) . '">' . $postTerm->name . '</a>';
					} else { 
						echo '<a class="cattitle-single" href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . $categories[0]->name . '</a>';
					}
				?>
				<h1 class="posttitle"><?php the_title(); ?></h1>
			</div>
        	<div>
				<?php if ( ! has_excerpt() ) {
      				echo '';
				} else { 
      				the_excerpt();
				} ?>
				<p class="authortext">Written By: <?php if(get_field('overwrite_author')){ the_field('overwrite_author');} else { echo $display_name; }?> | <?php the_time('F j, Y'); ?></p>
			</div>
        	<article class="publish post-list-item">
				 <?php while ( have_posts() ) : the_post(); ?>
                   <?php if ( has_post_thumbnail()) { ?>
					   <?php if( get_field('featimg_location') == 'Full Width' ): ?>
							<div id="postIMG">
									<a href="<?php echo $getimageURL ?>" rel="lightbox" title ="Enlarge the image for the CHPS News story titled: <?php echo the_title(); ?>"><img width="100%" alt="<?php if (!empty($alt)) { echo $alt; } else { echo the_title(); } ?>" src="<?php echo $getimageURL ?>" /></a>
								<div class="featcaption"><?php the_field('featimg_caption'); ?></div>
							</div>
					   <?php endif; ?>
					   <?php if( get_field('featimg_location') == 'Right Aligned' ): ?>
							<div id="imgRight-<?php the_field('featimg_size'); ?>">
								<a href="<?php echo $getimageURL ?>" rel="lightbox" title ="Enlarge the image for the CHPS News story titled: <?php echo the_title(); ?>"><img width="100%" alt="<?php if (!empty($alt)) { echo $alt; } else { echo the_title(); } ?>" src="<?php echo $getimageURL ?>" /></a>
								<div class="featcaption"><?php the_field('featimg_caption'); ?></div>
							</div>
					   <?php endif; ?>
					   <?php if( get_field('featimg_location') == 'Left Aligned' ): ?>
							<div id="imgLeft-<?php the_field('featimg_size'); ?>">
								<a href="<?php echo $getimageURL ?>" rel="lightbox" title ="Enlarge the image for the CHPS News story titled: <?php echo the_title(); ?>"><img width="100%" alt="<?php if (!empty($alt)) { echo $alt; } else { echo the_title(); } ?>" src="<?php echo $getimageURL ?>" /></a>
								<div class="featcaption"><?php the_field('featimg_caption'); ?></div>
							</div>
					   <?php endif; ?>
                   <?php } ?>
                    <?php the_content(); ?> 
                   	<div class="chps-tag-cloud mb-4 mb-md-5 mt-4 mt-md-5">
						<h2 class="h6 text-uppercase text-default-aw mb-4">More Topics</h2>
                        <?php 
						$categories = get_the_category();
						$tags = get_the_tags();
                        $separator = ' ';
                        $output = '';
                        if ( ! empty( $categories ) ) {
                            foreach( $categories as $category ) {
							if ( !in_array($category->name, array('Homepage','UCF News'), true ) ) {	
                                $output .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" alt="' . esc_attr( sprintf( __( 'View all posts in %s', 'textdomain' ), $category->name ) ) . '" class="chpsTAGS">' . esc_html( $category->name ) . '</a>' . $separator;
                            } 
						}
						if ( ! empty( $tags ) ) { 
						foreach ( $tags as $tag ) {
						$output .= '<a href="' . esc_url( get_tag_link( $tag->term_id ) ) . '" alt="' . esc_attr( sprintf( __( 'View all posts in %s', 'textdomain' ), $tag->name ) ) . '" class="chpsTAGS">' . esc_html( $tag->name ) . '</a>' . $separator;
                            }	
						}
                            echo trim( $output, $separator );
                        } ?> 
					</div> 
                <?php
                	endwhile; //resetting the page loop
                	wp_reset_query(); //resetting the page query
                ?>
			</article> 
<?php
// Default arguments
$args = array(
	'posts_per_page' => 6, // How many items to display
	'post__not_in'   => array( get_the_ID() ), // Exclude current post
	'no_found_rows'  => true, // We don't ned pagination so this speeds up the query
);
// Check for current post category and add tax_query to the query arguments
$cats = wp_get_post_terms( get_the_ID(), 'category' ); 
$cats_ids = array();  
foreach( $cats as $wpex_related_cat ) {
	$cats_ids[] = $wpex_related_cat->term_id; 
}
if ( ! empty( $cats_ids ) ) {
	$args['category__in'] = $cats_ids;
}
// Query posts
$wpex_query = new wp_query( $args );
// Loop through posts ?>
<hr class="mb-5" />
<h2 class="text-center h6 text-uppercase mb-4 pb-2">Related News Articles</h2>
<div class="container newsmedia"><div class="row narrow-gutter row-flex">
<?php
foreach( $wpex_query->posts as $post ) : setup_postdata( $post ); 
$getrelatedIMG = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large', false )[0];
?>
  	<div class="col-lg-4 col-sm-6 col-xs-12">        
        <?php if ( get_field( 'updatenewstype' ) == 1 ) { ?>
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" target="_blank">
		<?php } else { ?>
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
		<?php } ?>
        	<div class="visnews">
            	<div class="media-background-container visnews-photo mx-auto">
                	<?php if ( has_post_thumbnail()) { ?>
						<img src="<?php echo $getrelatedIMG ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" class="media-background object-fit-cover">
                    <?php } else {  ?>
                    	<img src="<?php the_field('default_news_image', 'option') ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" class="noTEST media-background object-fit-cover">
                    <?php } ?>
            	</div>
                <div class="p-3">
            		<?php the_title(); ?>
                </div>
           </div>
        </a>
	</div>
<?php
// End loop
endforeach;
// Reset post data
wp_reset_postdata(); ?>
</div></div>        
       		<div class="row mt-5">
				<div class="col-md-6 recborder">
					<h5 class="mb-4">Recent CHPS News</h5>
					<?php echo do_shortcode('[recentlist number="5"]'); ?>
				</div>
				<div class="col-md-6">
					<h5 class="mb-4">Our Mission</h5>
					<span class="postmission"><?php the_field('mission_statement', 'option'); ?></span>
				</div>
			</div>
        </div>
		<?php } ?>
        
        <div class="col-md-1"></div>
    </div>
</div>
<style>
.site-header .container h1 {display: none !important;}
article h2 { font-size: 26px; margin-bottom: 16px;}	
article h3 { font-size: 20px; margin-bottom: 16px;}	
#redirectPost { 
	text-align: center;
	padding: 50px 0px 200px 0px;
}	
#redirectPost img{ 
	margin-bottom:25px;
}
.chpsTAGS {
    background: #eee;
    border: 2px solid #d6d6d6;
    border-radius: .5rem;
    color: #5f5f5f;
    display: inline-block;
    font-size: 85%;
    margin-bottom: .5rem;
    margin-right: .5rem;
    padding: .3rem .7rem;
}		
.chpsTAGS:hover{
	background:#d6d6d6;
	color:#3d3d3d;
	text-decoration:none;
}
</style>
<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5ae1f19edbbe0111" async="async"></script>
<?php get_footer(); ?>
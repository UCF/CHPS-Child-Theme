<?php
//  ------------------------------------------------------------------------
// SHORTCODE TO SEARCH FIELD
//
// [searchme posttype="" size="" placeholder="" color="" addposts=""]
function searchmevar( $atts ) {
    $d = shortcode_atts( array(
        'posttype' => 'person',
        'size' => 'large',
		'placeholder' => 'Search',
		'color' => 'yellow',
		'addposts' => 'false',
    ), $atts ); ?> 	
<div>
	<form id="searchform" action="<?php echo get_site_url(); ?>/" method="get">
		<div class="row">
			<?php if ($d['size'] == 'large') { ?> 
				<div class="col-md-9 p-1">
					<input class="searchbar searchlg" type="text" name="s" placeholder="<?php echo $d['placeholder'] ?>" onfocus="this.placeholder = ''" onblur="this.placeholder = '<?php echo $d['placeholder'] ?>'" />
					<input type="hidden" name="post_type" value="<?php echo $d['posttype'] ?>" />
					<?php if ($d['addposts'] == 'true') { ?>
						<input type="hidden" name="post_type" value="posts" />
					<?php } ?>
				</div>
				<div class="col-md-3 p-1">
					<input class="searchsubmit-<?php echo $d['color'] ?> searchsublg" id="searchsubmit" type="submit" alt="Search" value="Search" />
				</div>
			<?php } elseif ($d['size'] == 'medium'){ ?> 
				<div class="col-md-10 col-sm-10 p-0">
					<input class="searchbar searchmd" type="text" name="s" placeholder="<?php echo $d['placeholder'] ?>" onfocus="this.placeholder = ''" onblur="this.placeholder = '<?php echo $d['placeholder'] ?>'" />
					<input type="hidden" name="post_type" value="<?php echo $d['posttype'] ?>" />
				</div>
				<div class="col-md-2 col-sm-2 p-0">
					<input class="searchsubmit-<?php echo $d['color'] ?> searchsubmd" id="searchsubmit" type="submit" alt="Search" value="Search" />
				</div>
			<?php } elseif ($d['size'] == 'small'){ ?> 
				<div class="col-sm-11 col-xs-6 p-0">
					<input class="searchbar searchsm" type="text" name="s" placeholder="<?php echo $d['placeholder'] ?>" onfocus="this.placeholder = ''" onblur="this.placeholder = '<?php echo $d['placeholder'] ?>'" />
					<input type="hidden" name="post_type" value="<?php echo $d['posttype'] ?>" />
				</div>
				<div class="col-sm-1 col-xs-6 p-0">
					<input class="searchsubmit-<?php echo $d['color'] ?> searchsubsm" id="searchsubmit" type="submit" alt="Search" value="Search" />
				</div>
			<?php } else { ?> 
				Size Error
			<?php } ?>
		</div>
	</form>
</div>
<?php wp_reset_query(); ?> 
<?php	}
add_shortcode( 'searchme', 'searchmevar' ); ?><?php
//  ------------------------------------------------------------------------
// SHORTCODE TO DISPLAY SOCIAL MEDIA ICONS 
//
// [socialicons fb="" tw="" ig="" yt="" in="" align=""]
function socialiconvar( $atts ) {
    $s = shortcode_atts( array(
        'fb' => '',
        'tw' => '',
		'ig' => '',
		'yt' => '',
		'in' => '',
		'align' => 'left',
    ), $atts ); ?>	
<div class="socialicons" style="text-align: <?php echo $s['align']; ?> !important;">
	<div class="scode-socialicons">
		<?php if (!empty($s['fb'])) { ?><a href="<?php echo $s['fb']; ?>" title="Follow Us On Facebook" target="_blank" class="fb-socialicon"><span class="fa-stack fa-lg">
		  <i class="fa fa-circle fa-stack-2x"></i>
		  <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
		</span></a><?php } ?><?php if (!empty($s['tw'])) { ?><a href="<?php echo $s['tw']; ?>" title="Follow Us On Twitter" target="_blank" class="tw-socialicon"><span class="fa-stack fa-lg">
		  <i class="fa fa-circle fa-stack-2x"></i>
		  <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
		</span></a><?php } ?><?php if (!empty($s['ig'])) { ?><a href="<?php echo $s['ig']; ?>" title="Follow Us On Instagram" target="_blank" class="ig-socialicon"><span class="fa-stack fa-lg">
		  <i class="fa fa-circle fa-stack-2x"></i>
		  <i class="fa fa-instagram fa-stack-1x fa-inverse"></i>
		</span></a><?php } ?><?php if (!empty($s['yt'])) { ?><a href="<?php echo $s['yt']; ?>" title="Watch Us On YouTube" target="_blank" class="yt-socialicon"><span class="fa-stack fa-lg">
		  <i class="fa fa-circle fa-stack-2x"></i>
		  <i class="fa fa-youtube fa-stack-1x fa-inverse"></i>
		</span></a><?php } ?><?php if (!empty($s['in'])) { ?><a href="<?php echo $s['in']; ?>" title="Join Us On LinkedIn" target="_blank" class="in-socialicon"><span class="fa-stack fa-lg">
		  <i class="fa fa-circle fa-stack-2x"></i>
		  <i class="fa fa-linkedin fa-stack-1x fa-inverse"></i>
		</span></a><?php } ?>
	</div>
</div>
<?php }
add_shortcode( 'socialicons', 'socialiconvar' );
//  ------------------------------------------------------------------------
?><?php
//  ------------------------------------------------------------------------
// SHORTCODE TO DISPLAY SOCIAL MEDIA ICONS 
//
// [minisocial fb="" tw="" ig="" yt="" in="" align="" size="fa-lg"]
function minisocialvar( $atts ) {
    $s = shortcode_atts( array(
        'fb' => '',
        'tw' => '',
		'ig' => '',
		'yt' => '',
		'in' => '',
		'align' => 'left',
		'size' => '',
    ), $atts ); ?>	
<div style="text-align: <?php echo $s['align']; ?>;"><?php if (!empty($s['fb'])) { ?><a href="<?php echo $s['fb']; ?>" title="Follow Us On Facebook" target="_blank" class="fb-socialicon"><span class="fa-stack <?php echo $s['size']; ?>"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-facebook fa-stack-1x fa-inverse"></i></span></a><?php } ?><?php if (!empty($s['tw'])) { ?><a href="<?php echo $s['tw']; ?>" title="Follow Us On Twitter" target="_blank" class="tw-socialicon"><span class="fa-stack <?php echo $s['size']; ?>"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-twitter fa-stack-1x fa-inverse"></i></span></a><?php } ?><?php if (!empty($s['ig'])) { ?><a href="<?php echo $s['ig']; ?>" title="Follow Us On Instagram" target="_blank" class="ig-socialicon"><span class="fa-stack <?php echo $s['size']; ?>"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-instagram fa-stack-1x fa-inverse"></i></span></a><?php } ?><?php if (!empty($s['yt'])) { ?><a href="<?php echo $s['yt']; ?>" title="Watch Us On YouTube" target="_blank" class="yt-socialicon"><span class="fa-stack <?php echo $s['size']; ?>"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-youtube fa-stack-1x fa-inverse"></i></span></a><?php } ?><?php if (!empty($s['in'])) { ?><a href="<?php echo $s['in']; ?>" title="Join Us On LinkedIn" target="_blank" class="in-socialicon"><span class="fa-stack <?php echo $s['size']; ?>"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-linkedin fa-stack-1x fa-inverse"></i></span></a></span><?php } ?><?php }
add_shortcode( 'minisocial', 'minisocialvar' );
//  ------------------------------------------------------------------------
?><?php
//  ------------------------------------------------------------------------
// SHORTCODE TO DISPLAY RESEARCH INTERNEST BY DEPARTMENT
//
// [researchlist department=""]
function researchlistvar( $atts ) {
    $r = shortcode_atts( array(
        'department' => '',
    ), $atts ); ?>
<?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
if (!empty($r['department'])) { 
$args = array(
		'post_type' => 'person',
	    'post_status' => 'publish',
		'posts_per_page' => -1,
	    'paged' => $paged,
		'meta_key' => 'profile_L_name',
		'orderby' => 'meta_value',
		'order' => 'ASC', 
        'tax_query' => array(
            array(
                'taxonomy' => 'departments',
                'field' => 'slug',
                'terms' => $r['department'],
            ),
        ),
     );
}
else {
	$args = array(
		'post_type' => 'person',
	    'post_status' => 'publish',
		'posts_per_page' => -1,
	    'paged' => $paged,
		'meta_key' => 'profile_L_name',
		'orderby' => 'meta_value',
		'order' => 'ASC', 
     );
} ?><?php   
     $loop = new WP_Query($args);
        while($loop->have_posts()) : $loop->the_post(); ?>
<?php if (get_field('research_interests')):	?>          
<?php get_template_part( 'research-result'); ?>
<?php	 endif;
		 endwhile; ?>	<!-- then the pagination links -->
<div class="mt-5">
	<?php wpbeginner_numeric_posts_nav(); ?>
</div>
<?php } add_shortcode( 'researchlist', 'researchlistvar' );
//  ------------------------------------------------------------------------
?>
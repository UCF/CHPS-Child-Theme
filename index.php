<?php get_header();?>
<div class="container mb-5 mt-3 mt-lg-5">
	<article class="<?php echo $post->post_status; ?> post-list-item">
        <div class="row mb-4">
                <div class="col-lg-6">	
                    <header class="archive-header">
                        <h1 class="archive-title heading-underline">Search Results</h1>
                    </header>
                </div>
                <div class="col-lg-6">	
                    <?php echo do_shortcode( ' [searchme posttype="post" size="large" placeholder="Search News"] ' ); ?>
                </div>
                <div class="col-lg-12 pt-2">
                    <i class="fa fa-search icongrey"></i><span class="searchresults">Search Result for: <strong><?php echo "$s"; ?></strong></span>
                </div>
            </div>
            
            
            
            
            
            
            
            
            
</article>
</div>

<style>	
header .container h1 {
	display: none !important;
}		
.authortext {
	text-transform: uppercase;
	font-size: 12px;
	color: #777;
	margin-top: 20px;
}
h3.widget-title {
	font-size: 18px;
}
h2 {
	text-transform: none !important;
}	
div.widget-content ul {
	margin-left: 10px;
	padding-left: 0px;
}
div.widget-content ul li {
	list-style: none;
	border-bottom: 1px solid #eee;
	padding:6px 0px;
	font-size: 14px !important;
}
</style>
<?php get_footer(); ?>
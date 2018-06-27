<?php get_header(); 
$display_name = get_the_author_meta( 'display_name', $post->post_author );
$getimageURL = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'full' );
$categories = get_the_category();
?>
<div class="container mt-3 mt-sm-4 mt-md-5 mb-3">
	<?php 
		if ( ! empty( $categories ) ) {
			echo '<a class="cattitle-single" href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a>';
		}
	?>
	<h1 class="posttitle"><?php the_title(); ?></h1>
</div>
<div class="container">
	<p class="authortext">Written By: <?php if(get_field('overwrite_author')){ the_field('overwrite_author');} else { echo $display_name; }?> | <?php the_time('F j, Y'); ?></p>
</div>
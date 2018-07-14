<!DOCTYPE html>
<html lang="en-us">
	<head>
		<?php wp_head(); ?>
	</head>
	<body ontouchstart <?php body_class(); ?>>
		<?php do_action( 'after_body_open' ); ?>
		<header class="site-header">
			<?php echo get_header_markup(); ?>
		</header>
		<main id="main" class="site-main">
<?php 
if ( get_field( 'breadcrumb', 'option' ) == 1 ) { ?>
<div class="breadcrumbnav">
	<div class="container">
		<a href="/" title="UCF College of Health Professions and Sciences" class="yellow">College of Health Professions and Sciences</a><span class="hidemobile"> > <a href="<?php echo get_site_url(); ?>" title="<?php bloginfo( 'name' ); ?> at the UCF College of Health Professions and Sciences"><?php bloginfo( 'name' ); ?></a>
       	<?php if ( !is_front_page() ) { ?>
         	> <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?> at the <?php bloginfo( 'name' ); ?>"><?php the_title(); ?></a></span>
    	<?php } ?>
    </div>
</div>
<?php } ?>
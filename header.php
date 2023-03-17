<!DOCTYPE html>
<html lang="en-us">
	<head>
		<!-- Google tag (gtag.js) -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=G-9DL6KTQRXX"></script>
		<script>
		  window.dataLayer = window.dataLayer || [];
		  function gtag(){dataLayer.push(arguments);}
		  gtag('js', new Date());

		  gtag('config', 'G-9DL6KTQRXX');
		</script>
		
		<?php wp_head(); ?>
	</head>
	<body ontouchstart <?php body_class(); ?>>
		<?php do_action( 'after_body_open' ); ?>
		<header class="site-header">
			<?php echo get_header_markup_dave(); ?>
		</header>
		<main id="main" class="site-main">

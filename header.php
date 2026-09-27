<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<header id="head">
	<div class="header">
		<div class='utilities'>
			<div class='container'>
				<?php get_template_part( 'skiplinks' ); ?>
			</div>
		</div>
		<div class="header-content">
		<?php
		$custom_logo_id = get_theme_mod( 'custom_logo' );
		$custom_logo    = wp_get_attachment_image( $custom_logo_id, array( 120, 120 ), false );
		echo $custom_logo;
		?>
		<div class="branding">
		<?php
		if ( is_front_page() ) {
			?>
			<h1 class="site-title"><a href="<?php echo home_url() ?>"> <?php bloginfo( 'title' ); ?></a></h1>
		<?php } else { ?>
			<p class='site-title'><a href="<?php echo home_url() ?>"><?php bloginfo( 'title' ); ?></a></p>
		<?php } ?>
			<p class="site-description">
				<?php bloginfo( 'description' ); ?>
			</p>
		</div>
		</div>
	</div>
	<?php get_template_part( 'searchform' ); ?>
</header>
<hr class="break" />
<div id="wrap">
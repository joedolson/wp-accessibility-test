<!DOCTYPE html>
<html>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<header>
	<nav aria-label="Primary">
		<ul>
			<li><a href="/" title="Home page">Home</a></li>
			<li><a href="/about/" title="About us">About</a></li>
		</ul>
	</nav>

	<!-- Unlabeled search field, with a title that should become an aria-label. -->
	<form role="search" method="get" action="/">
		<input type="search" name="s" title="Search the site">
		<button type="submit" title="Submit search">Go</button>
	</form>
</header>
<hr class="break" />
<div id="wrap">
<?php get_header(); ?>
<div id="outer" class="missing">
	<main id="content">
		<div class='breadcrumb'>
		<?php if ( function_exists('yoast_breadcrumb') ) {
			yoast_breadcrumb('<p id="breadcrumbs">','</p>');
		} ?>
		</div>
		<div class="page-content content">
		<h1 class="page-title">Sorry, I couldn't find that page!</h1>

		<p>Believe me, I looked, but it's just not coming to me.</p>
		<p>
		Maybe the link you followed is incorrect (and if you got here from a link on my own site, <a href="https://www.joedolson.com/contact/">let me know</a>), or the page it refers to has been deleted or moved. Regardless, if you think that the link you followed <em>should</em> have had a result, please get in touch!
		<p>
		Thanks, 
		</p>
		<p>
		Joe Dolson, Accessible Web Design
		</p>
		<h2>Pages you might have been looking for...</h2>
		<ul id="sitemap">
			<?php wp_list_pages('sort_column=title&title_li='); ?>
		</ul>
		</div>
	</main>

<?php get_footer(); ?>

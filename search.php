<?php get_header(); ?>

<div id="outer">
	<main id="content">
		<?php if (have_posts()) : ?>

			<h1 class="page-title">Search Results for "<?php echo esc_html( get_search_query() ); ?>"</h1>
			<div class='breadcrumb'>
			<?php if ( function_exists('yoast_breadcrumb') ) {
				yoast_breadcrumb('<p id="breadcrumbs">','</p>');
			} ?>
			</div>
			<div class="search-results">
			<?php while (have_posts()) : the_post(); ?>
				<div class="search-result">
					<h2 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
					<div class="search-excerpt"><?php the_excerpt(); ?> <i><?php the_time( 'l, F jS, Y' ); ?>.</i></div>
				</div>
			<?php endwhile; ?>
			</div>
		<?php else : ?>

			<h1 class="page-title">No posts found. Try a different search?</h1>
			<?php get_template_part('searchform' ); ?>

		<?php endif; ?>
		<div class="prev_next">
			<p><?php posts_nav_link(' &harr; ', __('&larr; Newer Results'), __('Older Results &rarr;')); ?></p>
		</div>

	</main> 

<?php get_sidebar(); ?>
<?php get_footer(); ?>
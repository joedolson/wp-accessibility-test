<?php get_header(); ?>
<div id="outer" class="p<?php the_ID(); ?>">
	<main id="content">
		<div class="breadcrumb">
		<?php
		if ( function_exists('yoast_breadcrumb') ) {
			yoast_breadcrumb('<p id="breadcrumbs">','</p>');
		}
		?>
		</div>
		<?php
			if (have_posts()) : while (have_posts()) : the_post();

			if ( !is_page( 'shop' ) ) {
				the_post_thumbnail( array(672,218) );
			} ?>
			<h1 class="page-title" id="page-<?php the_ID(); ?>"><?php the_title(); ?></h1>
			<div class="page-content content">

			<?php
				the_content( '<p>Read the rest of this page &raquo;</p>');
				wp_link_pages( '<p><strong>Pages:</strong> ', '</p>', 'number');
				edit_post_link( 'Edit this entry.', '<p class="edit">', '</p>');
			?>
			</div>
		<?php
		endwhile; endif;

		comments_template(); ?>
	</main>
<?php get_footer(); ?>
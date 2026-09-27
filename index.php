<?php get_header(); ?>

<div id="outer">
	<main id="content">

		<?php
		if ( is_archive() ) {
			the_archive_title( '<h1 class="archive-title">', '</h1>' );
		}
		if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<article>
			<div class="layout">
				<div class="post-content content">
					<header>
					<?php
					if ( ! is_single() ) {
						?>
						<h2 class="entry-title" id="post-<?php the_ID(); ?>"><a href="<?php esc_url( the_permalink() ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
						<?php
					} else {
						$post_type = get_post_type();
						?>
						<h1 class="<?php echo $post_type; ?>-title" id="post-<?php the_ID(); ?>"><?php the_title(); ?></h1>
						<?php
						the_post_thumbnail( array(672,218) );
					}

					if ( is_single() ) {
						the_content( "Read more: " . esc_html( get_the_title('', '', false) ) );

					} else {
					?>
					</header>
					<div class='post-excerpt'>
						<?php
							if ( has_post_thumbnail() ) {
								the_post_thumbnail( 'thumbnail' );
							}
							the_excerpt();
						?>
					</div>
					<?php
				}
				?>
				</div>
			</div>
			</article>

		<?php
		endwhile; else:
		?>
		<p>Sorry, no posts matched your criteria.</p>
		<?php endif; ?>

		<div class="prev_next">
			<p><?php posts_nav_link( ' &harr; ', __( '&larr; Next Issues' ), __( 'Previous Issues &rarr;' ) ); ?></p>
		</div>

	</main> 

<?php get_footer(); ?>
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
						<h2 class="entry-title" id="post-<?php the_ID(); ?>"><a href="<?php esc_url( the_permalink() ); ?>" rel="bookmark"><?php the_title(); ?></a><?php show_resolution(); ?></h2>
						<?php
					} else {
						$post_type = get_post_type();
						?>
						<h1 class="<?php echo $post_type; ?>-title" id="post-<?php the_ID(); ?>"><?php the_title(); ?><?php show_resolution(); ?></h1>
						<?php
						the_post_thumbnail( array(672,218) );
					}

					if ( is_single() ) {
						if ( 'wcag' === get_post_type() ) {
							echo '<a href="' . esc_url( get_post_meta( get_the_ID(), '_url', true ) ) . '"><strong>Learn more:</strong> Understanding ' . get_the_title() . '</a>';
						}

						the_content( "Read more: " . esc_html( get_the_title('', '', false) ) );

					} else {
					?>
					</header>
					<div class='post-excerpt'>
						<?php
							if ( has_post_thumbnail() ) {
								the_post_thumbnail( 'thumbnail' );
							} else {
								?>
								<img class="wp-post-image size-thumbnail" src="/wp-content/themes/docs/na.svg" alt="Not applicable" width="150" height="150" style="width: 150px" />
								<?php
							}
							the_excerpt();
						?>
					</div>
					<?php
				}
				?>
				</div>
				<div class="meta">
					<?php
					if ( 'post' === get_post_type() ) {
						?>
						<p>
						Workflow: <?php the_category(', ') ?>.
						</p>
						<?php
						audit_get_criteria();
						issue_resolution();
						if ( get_post_meta( get_the_ID(), 'url', true ) ) {
							?>
							<p>
							<a href="<?php echo esc_url( get_post_meta( get_the_ID(), 'url', true ) ); ?>">Issue URL</a>
							</p>
							<?php
						}
					} elseif ( 'wcag' === get_post_type() ) {
						wcag_get_issues();
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
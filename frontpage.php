<?php
/*
Template Name: Front Page
*/
?>
<?php get_header(); ?>
<div id="outer" class="p<?php the_ID(); ?>">
	<main id="content">
		<?php
		if ( have_posts() ) : while ( have_posts() ) : the_post(); 
			
			the_content('<p class="serif">Read the rest of this page &raquo;</p>'); 
			$page = '
			<div class="page-content content table">
				<div class="row">
					<div class="cell"><a href="https://www.joedolson.com/web-site-accessibility-services/" class="primary">' . wp_get_attachment_image( 41073, 'large' ) . '<h2 class="front-page">Accessibility</h2></a><p>I speak on web accessibility and contribute to the accessibility of WordPress. Check out my WordPress accessibility projects: <a href="https://www.joedolson.com/access-monitor/">Access Monitor</a> and <a href="https://www.joedolson.com/wp-accessibility/">WP Accessibility</a>.</p></div>
					<div class="cell"><a href="https://www.joedolson.com/my-calendar/" class="primary">' . wp_get_attachment_image( 41072, 'large' ) . '<h2 class="front-page">My Calendar</h2></a><p>My Calendar is a WordPress plug-in that manages your events. Purchase <a href="https://www.joedolson.com/my-calendar/pro/">My Calendar Pro</a> to get the best in accessible WordPress events management!</p></div>
					<div class="cell"><a href="https://www.joedolson.com/my-tickets/" class="primary">' . wp_get_attachment_image( 41074, 'large' ) . '<h2 class="front-page">My Tickets</h2></a><p>My Tickets is a simple event ticketing platform for WordPress. You can purchase <a href="https://www.joedolson.com/my-tickets/add-ons/">extensions to My Tickets</a> to expand your event ticketing capabilities!</p></div>
				</div>
			</div>';
			echo $page;
		?>
	</main>
		<?php 
		endwhile; endif; 
		comments_template(); 
	?>

<?php get_footer(); ?>
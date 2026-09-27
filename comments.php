<?php if ( ! is_page() ) { ?>
<div id="respond">
<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

	if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && 'comments.php' == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
		die ('Please do not load this page directly. Thanks!');
	}

	if ( post_password_required() ) {
		?>
		<p class="nocomments">This post is password protected. Enter the password to view comments.</p>
		<?php
		return;
	}
	if ( comments_open() ) : ?>
		<div class="comment-form">
		<h2 class="comment-title"><?php comment_form_title( 'Have something to contribute?', 'Post your response to %s' ); ?></h2>

		<div class="cancel-comment-reply">
			<small><?php cancel_comment_reply_link(); ?></small>
		</div>

		<?php
		if ( get_option('comment_registration') && !is_user_logged_in() ) :
			?>
			<p>You must be <a href="<?php echo wp_login_url( get_permalink() ); ?>">logged in</a> to post a comment.</p>
			<?php
		else :
			?>

			<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

			<?php if ( is_user_logged_in() ) : ?>
			<p>Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo esc_html( $user_identity ); ?></a>. <a href="<?php echo esc_url( wp_logout_url( get_permalink() ) ); ?>">Log out &raquo;</a></p>
			<?php else : ?>

			<p><label for="author">Name <span>(required)</span></label><br /><input type="text" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" size="30" aria-required='true' /></p>
			<p><label for="email">E-mail <span>(not published, but required)</span></label><br /><input type="email" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" size="30" aria-required='true' /></p>
			<p><label for="url">Web site <span>(totally optional)</span></label><br /><input type="url" name="url" id="url" value="<?php echo esc_attr($comment_author_url); ?>" size="30" /></p>
			<?php endif; ?>

		<p><label for="comment">Your Comment</label><textarea name="comment" id="comment" cols="55" rows="11"></textarea></p>

		<?php do_action('comment_form', $post->ID); ?>

		<p>
		<input name="submit" type="submit" class="button" value="Submit your comment" /> &laquo; <a href="http://www.joedolson.com/information.php#comment-policy">Read my Comment Policy</a>
		<?php comment_id_fields(); ?>
		</p>
		</form>
		</div>
		<div id="utilities">
		<p>
		<?php comments_rss_link(__('<abbr title="Really Simple Syndication">RSS</abbr> feed for comments on this post.')); ?>
		</p>
		</div>
<?php endif; 
endif;
	
	if ( have_comments() ) {
		?>
		<h3 id="comments"><?php comments_number('No Comments', '1 Comment', '% Comments' );?> on &#8220;<?php esc_html( the_title() ); ?>&#8221;</h3>

		<ol id="commentlist">
		<?php wp_list_comments( array( 'callback' => 'jd_comment' ) ); ?>
		</ol>

		<?php
	}
	?>

</div>
<?php } ?>
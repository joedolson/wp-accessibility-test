<?php get_header(); ?>

<div id="outer">

	<main id="content">
		<article class="hentry entry-content">
			<h1>Test content</h1>

			<h2>Titles</h2>
			<!-- Image with a title and no alt: title becomes alt. -->
			<img src="data:image/gif;base64,R0lGODlhAQABAAAAACw=" width="40" height="40" title="Decorative image title">
			<!-- Link with text: title is removed. -->
			<a href="/with-text/" title="Redundant link title">Link with text</a>
			<!-- Link without text: title becomes aria-label. -->
			<a href="/no-text/" title="Icon-only link"></a>
			<!-- Button without text: title becomes aria-label. -->
			<button type="button" title="Icon-only button"></button>
			<!-- Field with no label: title becomes aria-label. -->
			<input type="text" name="untitled" title="Field with only a title">

			<h2>Link targets</h2>
			<a href="https://example.com/" target="_blank">External link opening a new window</a>
			<a href="#content" target="_self">Fragment link with a target</a>
			<!-- Exceptions that keep their target. -->
			<a href="https://www.facebook.com/example" target="_blank">Facebook link</a>
			<a href="https://example.com/allowed/" target="_blank" class="wpa-allow-target">Allowed target</a>

			<h2>Tabindex</h2>
			<!-- Natively focusable elements: tabindex is removed. -->
			<a href="/tabindex-link/" tabindex="0">Link with tabindex</a>
			<button type="button" tabindex="3">Button with tabindex</button>
			<input type="text" name="tabindex-field" aria-label="Field with tabindex" tabindex="5">
			<!-- Intentionally hidden element: tabindex is kept. -->
			<a href="/hidden/" tabindex="-1" aria-hidden="true">Hidden link</a>
			<!-- Elements that look interactive but are not focusable: tabindex="0" is added. -->
			<div role="button">Fake button</div>
			<a role="button">Anchor button without href</a>
			<span role="link">Fake link</span>
			<a>Anchor without href</a>

			<h2>Video</h2>
			<div class="video-wrap">
				<video autoplay muted loop playsinline width="320" height="180"></video>
			</div>

			<h2>Images with alt text</h2>
			<!-- Large enough (width x height >= 45000) to get an alt toggle. -->
			<img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='400' height='300'%3E%3Crect width='400' height='300' fill='%23ccc'/%3E%3C/svg%3E" width="400" height="300" alt="A grey rectangle used as test content">

			<h2>Long descriptions</h2>
			<!-- Image with a longdesc attribute. -->
			<img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='400' height='300'%3E%3Crect width='400' height='300' fill='%23aac'/%3E%3C/svg%3E" width="400" height="300" alt="A blue rectangle" class="wp-image-9002" longdesc="/?longdesc=9002&amp;referrer=1">

			<!-- Image using the long description block style. -->
			<figure class="wp-block-image is-style-longdesc">
				<img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='400' height='300'%3E%3Crect width='400' height='300' fill='%23acA'/%3E%3C/svg%3E" width="400" height="300" alt="A green rectangle" class="wp-image-9003">
				<figcaption>Green rectangle</figcaption>
			</figure>
		</article>

		<section>
			<h2>Leave a comment</h2>
			<!-- Unlabeled comment fields. -->
			<form action="/wp-comments-post.php" method="post">
				<textarea name="comment" cols="45" rows="4"></textarea>
				<input type="text" name="author">
				<input type="email" name="email">
				<input type="url" name="url">
				<button type="submit">Post comment</button>
			</form>
		</section>
	</main>

<?php get_footer(); ?>
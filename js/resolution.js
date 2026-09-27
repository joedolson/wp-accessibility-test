(function ($) {
	'use strict';
	$(function () {
		$( '#resolve_issue').on( 'change', function() {
			let post_id = $( this ).data('post_id');
			var data    = {
				'action': set.action,
				'security': set.security,
				'resolution': $( this ).prop('checked'),
				'post_id': post_id,
			};
			$.post( set.url, data, function( response ) {
				let heading = $( '#post-' + post_id );
				if ( response ) {
					heading.append( '<span class="resolved-issue"><span class="dashicons dashicons-yes" aria-hidden="true"></span> Resolved</span>' );
					wp.a11y.speak( 'Issue marked resolved' );
				} else {
					let resolved = heading.find( '.resolved-issue' );
					resolved.hide();
					wp.a11y.speak( 'Issue marked as unresolved' );
				}
			});
		});
	});
}(jQuery));
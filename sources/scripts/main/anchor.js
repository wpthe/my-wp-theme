const { transitionDuration } = window.myMain;

const $body = $( 'body' );

export default function initAnchor() {
	$body.on( 'click', '.my-anchor', function({ preventDefault }) {
		preventDefault();

		const $this = $( this );
		const target = $this.attr( 'href' ) !== undefined ? $this.attr( 'href' ) : $this.data( 'my-target' );
		const options = {
			topSpacing: $body.data( 'my-top-spacing' ) !== undefined ? $body.data( 'my-top-spacing' ) : 0
		};

		scrollToAnchor( target, options );
	});
}

export function scrollToAnchor( target, options ) {
	const defaults = {
		topSpacing: 0,
		duration: transitionDuration * 2
	};
	const { topSpacing, duration } = $.extend({}, defaults, options );

	$( 'html, body' ).animate({
		scrollTop: $( target ).offset().top - topSpacing
	}, duration );
}

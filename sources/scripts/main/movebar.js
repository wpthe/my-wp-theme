const { transitionDuration, screen } = window.myMain;

const $toggle = $( '[data-my-toggle="movebar"]' );
const $movebar = $( '.my-movebar' );
const $backdrop = $( '.my-movebar__backdrop' );
const $coupled = $( '.my-movebar__coupled' );

const movedClass = 'my-movebar_moved';

export default function initMovebar() {
	$( window ).on( 'resize', function() {
		if ( $( window ).width() > screen.md.max && $movebar.hasClass( movedClass ) ) {
			toggle();
		}
	});

	$( document ).on( 'keydown', function({ keyCode }) {
		if ( 27 === keyCode && $movebar.hasClass( movedClass ) ) {
			toggle();
		}
	});

	$backdrop.on( 'click', function() {
		toggle();
	});

	$toggle.on( 'click', function() {
		toggle();
	});
}

function toggle() {
	$( 'body' ).toggleClass( '_my-overflow-hidden' );
	$movebar.toggleClass( movedClass );
	$coupled.toggleClass( 'my-movebar__coupled_moved' );

	if ( $movebar.hasClass( movedClass ) ) {
		$backdrop.fadeIn( transitionDuration );
		$movebar.focus();

	} else {
		$backdrop.fadeOut( transitionDuration );
		$toggle.focus();
	}
}

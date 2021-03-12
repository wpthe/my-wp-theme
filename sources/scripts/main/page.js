import { notify } from './notify';

const { transitionDuration, msgOffline } = window.myMain;

const $page = $( '.my-page' );

const $loadIcon = $( '.my-page__load-icon' );
const $overlay = $( '.my-page__load-overlay' );

export default function initPage() {
	$page.on( 'click', 'a:not([href*="#"]):not([href^="tel:"]):not([href^="mailto:"])', function( event ) {
		const $this = $( this );
		const href = $this.attr( 'href' );

		if ( false !== $this.data( 'my-flip' ) &&
			href !== undefined &&
			'button' !== $this.attr( 'role' ) &&
			$this.attr( 'target' ) === undefined &&
			$this.data( 'target' ) === undefined &&
			$this.data( 'toggle' ) === undefined &&
			$this.data( 'my-target' ) === undefined &&
			$this.data( 'my-toggle' ) === undefined ) {

			flipPage({ href, event });
		}
	});
}

export function flipPage( options ) {
	const defaults = {
		href: null,
		event: false
	};
	const { href, event } = $.extend({}, defaults, options );

	if ( false !== event ) {
		event.preventDefault();

		if ( event.ctrlKey || event.metaKey ) {
			window.open( href );
			return false;
		}
	}

	if ( null === href ) {
		$page.trigger( 'flip.my.page' );
		$overlay.fadeIn( transitionDuration * 2 );

	} else if ( navigator.onLine || navigator.onLine === undefined ) {
		$page.trigger( 'flip.my.page' );
		$overlay.fadeIn( transitionDuration * 2, function() {
			window.location.href = href;
		});

	} else {
		notify({
			color: 'danger',
			msg: msgOffline
		});
	}
}

export function onFlippedPage() {
	$page.trigger( 'start.flipped.my.page' );
	$loadIcon.fadeOut( transitionDuration, function() {
		$overlay.fadeOut( transitionDuration, function() {
			$page.trigger( 'end.flipped.my.page' );
		});
	});
}

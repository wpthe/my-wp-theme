const { transitionDuration } = window.myMain;

const $body = $( 'body' );
const $notify = $( '.my-notify' );

const itemClass = 'my-notify__item';
const shownClass = 'my-notify__item_shown';

const defaults = {
	color: null,
	stay: 5000,
	msg: ''
};

export default function initNotify() {
	$body.on( 'click', '.my-notify__close', function() {
		closeNotify( $( this ).closest( '.' + itemClass ) );
	});
}

function getTemplate( color, msg ) {
	return `
		<div class="my-notify__item ${ null === color ? '' : 'my-notify__item_' + color }" role="alert">
			<div class="my-notify__inner">
				<div class="my-notify__message">${msg}</div>
				<button type="button" class="my-notify__close"><span class="my-icon my-icon_close" aria-hidden="true"></span></button>
			</div>
		</div>
	`;
}

export function notify( option ) {
	if ( ! $notify.length ) {
		throw new Error( '"div.my-notify" must be added to the "body".' );
	}

	const { color, stay, msg } = $.extend({}, defaults, option );

	$notify.append( getTemplate( color, msg ) );
	$( '.' + itemClass ).trigger( 'send.my.notify' );

	setTimeout( function() {
		$( '.' + itemClass ).each( function() {
			const $item = $( this );

			if ( ! $item.hasClass( shownClass ) ) {
				$item.addClass( shownClass );

				if ( 'number' === typeof stay ) {
					setTimeout( function() {
						closeNotify( $item );
					}, stay );
				}
			}
		});
	}, 0 );
}

export function closeNotify( $item ) {
	$item.trigger( 'close.my.notify' );
	$item.removeClass( shownClass );

	$item.one( 'bsTransitionEnd', function() {
		$item.slideUp( transitionDuration, function() {
			$item.remove();
			$item.trigger( 'closed.my.notify' );
		});
	}).emulateTransitionEnd( transitionDuration * 2 );
}

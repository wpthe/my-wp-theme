import 'masonry-layout/dist/masonry.pkgd';
import initImg from './img';

const { ajaxUrl, transitionDuration } = window.myMain;

export default function initCards() {
	initMasonry();
	$( 'body' ).on( 'click', '.my-cards__load-btn', onClickLoadBtn );
}

function initMasonry() {
	$( '.my-cards__row' ).each( function() {
		const $row = $( this );

		$row.masonry({
			columnWidth: '.my-cards__sizer',
			itemSelector: '.my-cards__item',
			transitionDuration: '0s',
			hiddenStyle: false,
			visibleStyle: false
		});

		onLoadedImg( $row );
	});
}

function onClickLoadBtn( event ) {
	event.preventDefault();

	const $btn = $( this );
	const $cards = $btn.closest( '.my-cards' );
	const $row = $cards.find( '.my-cards__row' );
	const $load = $cards.find( '.my-cards__load' );
	const $loadIconWrap = $cards.find( '.my-cards__load-icon-wrap' );
	const $loadIcon = $cards.find( '.my-cards__load-icon' );
	const loadIconShownClass = 'my-cards__load-icon_shown';
	const $pagination = $cards.find( '.my-cards__pagination' );
	const currentPage = Number( $cards.data( 'my-current-page' ) );

	$btn.attr( 'disabled', 'disabled' );
	$loadIconWrap.slideDown( transitionDuration / 2, function() {
		$loadIcon.addClass( loadIconShownClass );
	});

	$.ajax({
		url: ajaxUrl,
		data: {
			'action': 'my_load_cards',
			'query_vars': $cards.data( 'my-query-vars' ),
			'page': currentPage,
			'card_class': $cards.data( 'my-card-class' )
		},
		type: 'POST',

		success: function( items ) {
			if ( items ) {
				const $items = $( items );
				const newCurrentPage = currentPage + 1;

				$cards.data( 'my-current-page', newCurrentPage );
				$row.append( $items ).masonry( 'appended', $items );
				initImg();
				onLoadedImg( $row );

				$btn.removeAttr( 'disabled' );
				$loadIconWrap.hide();
				$loadIcon.removeClass( loadIconShownClass );
				$pagination.find( ':contains(' + newCurrentPage + ')' ).addClass( 'current' );

				if ( newCurrentPage >= $cards.data( 'my-max-pages' ) ) {
					hideLoad( $load, $pagination );
				}

			} else {
				hideLoad( $load, $pagination );
			}
		}
	});
}

function onLoadedImg( $row ) {
	$row.find( 'img' ).on( 'load', function() {
		$row.masonry( 'layout' );
	});
}

function hideLoad( $load, $pagination ) {
	$load.hide().addClass( 'my-cards__loader_hidden' );
	$pagination.find( '.next' ).hide();
}

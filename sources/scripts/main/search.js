import { flipPage } from './page';

export default function initSearch() {
	$( '.my-search' ).on( 'submit', function( event ) {
		const $this = $( this );
		const val = $this.find( '.my-search__input' ).val();

		if ( 3 <= val.length ) {
			flipPage({
				href: $this.attr( 'action' ) + '?s=' + val,
				event
			});
		}
	});
}

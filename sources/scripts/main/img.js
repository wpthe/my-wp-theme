import 'jquery-lazy';

const imgClass = 'my-img';
const loadedClass = 'my-img_loaded';

export default function initImg() {
	$( '.' + imgClass ).not( loadedClass ).each( function() {
		const $this = $( this );
		const $img = $this.find( 'img' );
		const dataLoadedClass = $this.data( 'my-loaded-class' );

		$img.lazy({
			depay: 0,
			defaultImage: ''
		});

		$img.on( 'load', function() {
			$this.addClass( loadedClass + ( dataLoadedClass !== undefined ? ' ' + dataLoadedClass : '' ) );
		});

		$( 'body' ).on( 'mousedown', 'img', function() {
			return false;
		});
	});
};

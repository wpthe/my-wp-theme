const $urlInput = $( '#custom-menu-item-url' );
const $navMenus = $( '.nav-menus-php' );

export default function menuEditor() {
	if ( $navMenus.length ) {
		$urlInput.val( '#' );

		$( '[data-name="my_type"] select' ).each( function() {
			const $this = $( this );

			urlToggle( $this );
			titleToggle( $this );
		});

		$urlInput.on( 'focus', function() {
			urlFocus( $( this ) );

		}).on( 'blur', function() {
			urlBlur( $( this ) );
		});

		$navMenus.on( 'focus', '.field-url input', function() {
			urlFocus( $( this ) );

		}).on( 'blur', '.field-url input', function() {
			urlBlur( $( this ) );

		}).on( 'change', '[data-name="my_type"] select', function() {
			const $this = $( this );

			urlToggle( $this );
			titleToggle( $this );
		});

		$( document ).ajaxComplete( function() {
			if ( '' === $urlInput.val() ) {
				$urlInput.val( '#' );
			}
		});
	}
}

function urlFocus( $input ) {
	if ( '#' === $input.val() ) {
		$input.select();
	}
}

function urlBlur( $input ) {
	if ( '' === $input.val() ) {
		$input.val( '#' );
	}
}

function urlToggle( $select ) {
	const $field = $select.closest( '.menu-item' ).find( '.field-url' );

	if ( 'default' !== $select.val() ) {
		$field.hide();

	} else {
		$field.show();
	}
}

function titleToggle( $select ) {
	const $field = $select.closest( '.menu-item' ).find( '.edit-menu-item-title' ).closest( '.description' );

	if ( 'scroll_top' === $select.val() ) {
		$field.hide();

	} else {
		$field.show();
	}
}

<?php

namespace My_Theme\Walkers;

use My_Theme\Utils;

defined( 'ABSPATH' ) || exit;

class Header_Menu extends \Walker_Nav_Menu {

	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		if ( class_exists( 'acf_pro' ) ) {
			$indent  = str_repeat( "\t", $depth );
			$output .= "\n$indent<ul role='menu' class='dropdown-menu _my-ul-clean'>\n";
		}
	}

	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		if ( class_exists( 'acf_pro' ) ) {
			$indent      = $depth ? str_repeat( "\t", $depth ) : '';
			$item_id     = 'menu-item-' . $item->ID;
			$type        = get_field( 'my_type', $item->ID );
			$item_class  = ( ! empty( $item->classes ) ? join( ' ', array_filter( $item->classes ) ) : '' );
			$item_class .= ' ' . $item_id;

			if ( $args->has_children ) {
				$item_class .= ' dropdown';
			}

			$item_attrs  = $item_class ? ' class="' . $item_class . '"' : '';
			$item_attrs .= ' id="' . $item_id . '"';
			$output     .= $indent . '<li' . $item_attrs . '>';
			$attrs       = ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) . '"' : '';
			$title       = $item->title;

			if ( 0 === $depth && $args->has_children ) {
				$attrs .= ' type="button" class="dropdown-toggle" data-toggle="dropdown"';

			} elseif ( 'tel' === $type ) {
				$attrs .= ' href="' . esc_attr( Utils::tel_to_url( $title ) ) . '"';

			} else {
				$attrs .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) . '"' : '';
				$attrs .= ! empty( $item->url ) ? ' href="' . esc_url( $item->url ) . '"' : '';
			}

			$output  .= $args->before;
			$icon_tel = '<span class="my-icon my-icon_tel"></span>';

			if ( 0 === $depth && $args->has_children ) {
				$output .= '<button' . $attrs . '>' . ( 'tel' === $type ? $icon_tel : '' );

			} else {
				$output .= '<a' . $attrs . '>' . ( 'tel' === $type && 0 === $depth ? $icon_tel : '' );
			}

			$output    .= $args->link_before . $title . $args->link_after;
			$icon_caret = '<span class="my-icon my-icon_caret"></span>';

			if ( 0 === $depth && $args->has_children ) {
				$output .= $icon_caret . '</button>';

			} else {
				$output .= '</a>';
			}

			$output .= $args->after;
		}
	}

	public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
		if ( class_exists( 'acf_pro' ) ) {
			if ( ! $element ) {
				return;
			}

			$id_field  = $this->db_fields['id'];
			$type      = get_field( 'my_type', $id_field );
			$max_depth = ( ! 'default' === $type && ! 'tel' === $type ) ? 1 : 2;

			if ( is_object( $args[0] ) ) {
				$args[0]->has_children = ! empty( $children_elements[ $element->$id_field ] );
			}

			parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
		}
	}
}

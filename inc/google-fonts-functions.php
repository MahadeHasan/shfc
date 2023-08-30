<?php
if ( ! function_exists( 'genz_recognized_font_families' ) ) {

	/**
	 * Recognized font families
	 *
	 * Returns an array of all recognized font families.
	 * Keys are intended to be stored in the database
	 * while values are ready for display in html.
	 * Renamed in version 2.0 to avoid name collisions.
	 *
	 * @uses apply_filters()
	 *
	 * @param string $field_id ID that's passed to the filter.
	 *
	 * @return array
	 *
	 */
	function genz_recognized_font_families( $field_id ) {

		$families = array(
			'arial'     => 'Arial',
			'georgia'   => 'Georgia',
			'helvetica' => 'Helvetica',
			'palatino'  => 'Palatino',
			'tahoma'    => 'Tahoma',
			'times'     => '"Times New Roman", sans-serif',
			'trebuchet' => 'Trebuchet',
			'verdana'   => 'Verdana',
			'plusjakartasans' => '"Plus Jakarta Sans", sans-serif',
		);

		return apply_filters( 'genz_recognized_font_families', $families, $field_id );
	}
}

if ( ! function_exists( 'genz_google_font_stack' ) ) {

	/**
	 * Filters the typography font-family to add Google fonts dynamically.
	 *
	 * @param array  $families An array of all recognized font families.
	 * @param string $field_id ID of the field being filtered.
	 *
	 * @return array
	 */
	function genz_google_font_stack( $families, $field_id ) {

		if ( ! is_array( $families ) ) {
			return array();
		}

		$google_fonts     = get_option( 'genz_google_fonts', array() );
		$set_google_fonts = get_theme_mod( 'genz_set_google_fonts', array() );

		if ( ! empty( $set_google_fonts ) ) {
			foreach ( $set_google_fonts as $id => $sets ) {
				foreach ( $sets as $value ) {
					$family = isset( $value['family'] ) ? $value['family'] : '';
					if ( $family && isset( $google_fonts[ $family ] ) ) {
						$spaces              = explode( ' ', $google_fonts[ $family ]['family'] );
						$font_stack          = count( $spaces ) > 1 ? '"' . $google_fonts[ $family ]['family'] . '"' : $google_fonts[ $family ]['family'];
						$families[ $family ] = apply_filters( 'genz_google_font_stack', $font_stack, $family, $field_id );
					}
				}
			}
		}


		return $families;
	}

	add_filter( 'genz_recognized_font_families', 'genz_google_font_stack', 1, 2 );
}


if ( ! function_exists( 'genz_recognized_google_font_families' ) ) {

	/**
	 * Recognized Google font families
	 *
	 * @uses apply_filters()
	 *
	 * @param string $field_id ID that's passed to the filter.
	 *
	 * @return array
	 */
	function genz_recognized_google_font_families( $field_id ) {

		$families = Genz\Google_Fonts::font_family_options();

		return apply_filters( 'genz_recognized_google_font_families', $families, $field_id );
	}
}
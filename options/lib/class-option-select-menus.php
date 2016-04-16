<?php

if ( ! defined( 'ABSPATH' ) ) { exit; // Exit if accessed directly
}
class TitanFrameworkOptionSelectMenus extends TitanFrameworkOption {
	/*
	 * Display for options and meta
	 */
	public function display() {
		$this->echoOptionHeader();

		$menus = get_registered_nav_menus();

		echo "<select name='" . esc_attr( $this->getID() ) . "'>";

		// The default value (nothing is selected)
		printf( "<option value='%s' %s>%s</option>",
			'0',
			selected( $this->getValue(), '0', false ),
			'— ' . __( 'Select', TF_I18NDOMAIN ) . ' —'
		);

		// Print all the other pages
		foreach ( $menus as $location => $name ) {
			printf( "<option value='%s' %s>%s</option>",
				$location,
				selected( $this->getValue(), $location, false ),
				$name
			);
		}
		echo '</select>';

		$this->echoOptionFooter();
	}
}

<?php
/**
 * Include Titan Framework.
 *
 * @package   Titan
 * @author    Tung Du <dinhtungdu@gmail.com>
 * @license   GPL-2.0+
 * @link      http://dinhtung.info
 * @copyright 2015 TungDu
 */

class AMPSK_Titan {

	/**
	 * Instance of this class.
	 *
	 * @since    1.0.0
	 * @var      object
	 */
	protected static $instance = null;

	public function __construct() {
		add_action( 'after_setup_theme', array( $this, 'load_titan_framework' ), 12 );
	}

	/**
	 * Return an instance of this class.
	 *
	 * @since     3.0.0
	 * @return    object    A single instance of this class.
	 */
	public static function get_instance() {

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	/**
	 * Load Titan Framework.
	 *
	 * @link   http://www.titanframework.net/embedding-titan-framework-in-your-project/
	 * @since  3.0.0
	 */
	public function load_titan_framework() {

		/*
		 * When using the embedded framework, use it only if the framework
		 * plugin isn't activated.
		 */

		// Don't do anything when we're activating a plugin to prevent errors
		// on redeclaring Titan classes
		if ( ! empty( $_GET['action'] ) && ! empty( $_GET['plugin'] ) ) {
			if ( $_GET['action'] == 'activate' ) {
				return;
			}
		}

		// Check if the framework plugin is activated
		$useEmbeddedFramework = true;
		$activePlugins = get_option('active_plugins');
		if ( is_array( $activePlugins ) ) {
			foreach ( $activePlugins as $plugin ) {
				if ( is_string( $plugin ) ) {
					if ( stripos( $plugin, '/titan-framework.php' ) !== false ) {
						$useEmbeddedFramework = false;
						break;
					}
				}
			}
		}

		// Use the embedded Titan Framework
		if ( $useEmbeddedFramework && ! class_exists( 'TitanFramework' ) ) {
			require_once( AMPSK_PATH . 'options/titan-framework.php' );
		}

		/*
		 * Start your Titan code below
		 */
		$titan = TitanFramework::getInstance( 'ampsk' );

                $generalTab = $titan->createAdminPage( array(
                        'name'       => __( 'AMP Swift Knife', 'amp-sk' ),
                        'title'      => __( 'AMP Swift Knife Setting', 'amp-sk' ),
                        'id'         => 'amp-sk-settings',
                        'parent'     => 'options-general.php',
		) );

		$customizerHeader = $titan->createThemeCustomizerSection( array(
			'panel' => 'AMP Swift Knife',
			'name' => 'Header'
		) );

		//$generalTab = $settings->createTab( array(
			//'name' => 'General Options',
		//) );

		$generalTab->createOption( array(
			'name' => 'AMP Endpoint',
			'desc' => 'If you don\'t want to use the default /amp endpoint',
			'id' => 'amp_sk_endpoint',
			'type' => 'text',
			'default' => 'amp'
		) );
		$generalTab->createOption( array(
			'name' => 'Google Analytics ID',
			'desc' => 'Add Google analytics support for AMP. Your ID is similiar to: UA-XXXXXXX',
			'id' => 'amp_sk_gan',
			'type' => 'text',
			'default' => '',
		) );
		$generalTab->createOption( array(
			'name'	=> 'Choose menu',
			'id'	=> 'amp_sk_menu',
			'type'	=> 'select-menus',
		) );
		$generalTab->createOption( array(
			'name'	=> 'Access customizer',
			'id'	=> 'amp_sk_customizer',
			'type'	=> 'amp-customizer',
		) );
		$generalTab->createOption( array(
			'type' => 'save'
		) );

		$customizerHeader->createOption(
			array(
				'name'	=> 'Logo',
				'id'	=> 'amp_sk_logo',
				'type'	=> 'upload',
				'size'	=> 'full'
			)
		);
		$customizerHeader->createOption(
			array(
				'name'	=> 'Logo Height',
				'id'	=> 'amp_sk_logo_height',
				'type'	=> 'number',
				'desc'	=> 'Give your logo height in px',
				'default' => '32',
				'min'	=> '32',
				'max'	=> '100',
			)
		);
		$customizerHeader->createOption( array(
			'name'	=> 'Logo Position',
			'id'	=> 'amp_sk_logo_position',
			'type'	=> 'select',
			'options' => array(
				'1' => 'Left',
				'2' => 'Center',
				'3' => 'Right',
			),
			'default' => '1',
		) );
		$customizerHeader->createOption( array(
			'name'	=> 'Display Site name?',
			'id'	=> 'amp_sk_site_name',
			'type'	=> 'checkbox',
			'default' => '1',
		) );
		$customizerHeader->createOption( array(
			'name'	=> 'Site title color',
			'id'	=> 'amp_sk_site_title_color',
			'type'	=> 'color',
			'default' => '#fff',
		) );
		$customizerHeader->createOption( array(
			'name'	=> 'Header Background Color',
			'id'	=> 'amp_sk_header_bg',
			'type'	=> 'color',
			'default' => '#0a89c0',
		) );
		$customizerMenu = $titan->createThemeCustomizerSection( array(
			'panel' => 'AMP Swift Knife',
			'name' => 'Menu'
		) );
		$customizerMenu->createOption( array(
			'name'	=> 'Show Menu',
			'id'	=> 'amp_sk_header_menu',
			'type'	=> 'checkbox',
			'default' => '1',
		) );
		$customizerMenu->createOption( array(
			'name'	=> 'Menu height',
			'id'	=> 'amp_sk_menu_height',
			'type'	=> 'number',
			'default' => '240',
			'min'	=> '100',
		) );
		$customizerMenu->createOption( array(
			'name'	=> 'Menu item Color',
			'id'	=> 'amp_sk_menu_color',
			'type'	=> 'color',
			'default' => '#0a89c0',
		) );
		$customizerMenu->createOption( array(
			'name'	=> 'Menu item Border Color',
			'id'	=> 'amp_sk_menu_border_color',
			'type'	=> 'color',
			'alpha' => true,
			'default' => '#fff',
		) );
		$customizerMenu->createOption( array(
			'name'	=> 'Menu Trigger icon Color',
			'id'	=> 'amp_sk_menu_hamburger_color',
			'type'	=> 'color',
			'default' => '#333',
		) );
		$customizerMenu->createOption( array(
			'name'	=> 'Display Menu close button?',
			'id'	=> 'amp_sk_menu_close',
			'type'	=> 'checkbox',
			'default' => '1',
		) );
		$customizerTypo = $titan->createThemeCustomizerSection( array(
			'panel' => 'AMP Swift Knife',
			'name' => 'Typography'
		) );
		$customizerTypo->createOption(array(
			'id'	=> 'amp_sk_typo_fontfamily',
			'name'	=> 'Choose a font family for your AMP site.',
			'type'	=> 'font',
			'show_websafe_fonts' => true,
			'show_google_fonts' => false,
			'show_color' => true,
			'show_font_size' => true,
			'show_font_weight' => false,
			'show_font_style' => false,
			'show_line_height' => false,
			'show_letter_spacing' => false,
			'show_text_transform' => false,
			'show_font_variant' => false,
			'show_text_shadow' => false,
			'show_preview' => false,
			'default' => array(
				'font-family'	=> 'Arial, Helvetica, sans-serif',
				'font-size'	=> '16px',
				'color'	=> '#333',
			),
		));
		$customizerTypo->createOption(
			array(
				'name'	=> 'Heading color',
				'id'	=> 'amp_sk_typo_h_color',
				'type'	=> 'color',
				'default' => '#2e4453',
			)
		);
		$customizerTypo->createOption(
			array(
				'name'	=> 'h1 Font Size',
				'id'	=> 'amp_sk_typo_size_h1',
				'type'	=> 'number',
				'default' => '32',
				'min'	=> '10',
				'max'	=> '72',
			)
		);
		$customizerTypo->createOption(
			array(
				'name'	=> 'h2 Font Size',
				'id'	=> 'amp_sk_typo_size_h2',
				'type'	=> 'number',
				'default' => '24',
				'min'	=> '10',
				'max'	=> '72',
			)
		);
		$customizerTypo->createOption(
			array(
				'name'	=> 'h3 Font Size',
				'id'	=> 'amp_sk_typo_size_h3',
				'type'	=> 'number',
				'default' => '19',
				'min'	=> '10',
				'max'	=> '72',
			)
		);
		$customizerTypo->createOption(
			array(
				'name'	=> 'h4 Font Size',
				'id'	=> 'amp_sk_typo_size_h4',
				'type'	=> 'number',
				'default' => '17',
				'min'	=> '10',
				'max'	=> '72',
			)
		);
		$customizerTypo->createOption(
			array(
				'name'	=> 'h5 Font Size',
				'id'	=> 'amp_sk_typo_size_h5',
				'type'	=> 'number',
				'default' => '13',
				'min'	=> '10',
				'max'	=> '72',
			)
		);
		$customizerTypo->createOption(
			array(
				'name'	=> 'h6 Font Size',
				'id'	=> 'amp_sk_typo_size_h6',
				'type'	=> 'number',
				'default' => '11',
				'min'	=> '10',
				'max'	=> '72',
			)
		);
		$customizerTypo->createOption( array(
			'name'	=> 'Anchor (Link) Color',
			'id'	=> 'amp_sk_typo_a_color',
			'type'	=> 'color',
			'default' => '#0087be',
		) );
		$customizerTypo->createOption( array(
			'name'	=> 'Anchor (Link) Color Hover',
			'id'	=> 'amp_sk_typo_a_color_hover',
			'type'	=> 'color',
			'default' => '#22a7f0',
		) );

		$customizerLayout = $titan->createThemeCustomizerSection( array(
			'panel' => 'AMP Swift Knife',
			'name' => 'Layout & Styling'
		) );
		$customizerLayout->createOption( array(
			'name'	=> 'Content Width',
			'id'	=> 'amp_sk_layout_content_width',
			'type'	=> 'number',
			'default' => '600',
			'min'	=> '320',
		));
		$customizerLayout->createOption( array(
			'name'	=> 'Background Color',
			'id'	=> 'amp_sk_layout_bg',
			'type'	=> 'color',
			'default' => '#fff',
		) );
		$customizerLayout->createOption( array(
			'name'	=> 'Layout Elements',
			'id'	=> 'amp_sk_layout_elements',
			'type'	=> 'sortable',
			'desc'	=> 'You can sort the order of these elements',
			'options' => array(
				'post_meta' => 'Post Meta',
				'content' => 'Content',
				'comments'	=> 'Comments',
				'related_posts'	=> 'Related Post',
			),
			'default' => array(
				'post_meta',
				'content',
				'comments',
				'related_posts',
			),
		) );
		$customizerLayout->createOption( array(
			'name'	=> 'Display Featured Image?',
			'id'	=> 'amp_sk_layout_ft_img',
			'type'	=> 'checkbox',
			'default' => '1',
		) );
		$customizerLayout->createOption( array(
			'name'	=> 'Custom CSS',
			'id'	=> 'amp_sk_layout_css',
			'type'	=> 'textarea',
			'is_code' => true,
			'livepreview' => '$("#livepreview").html("<style>" + value + "</style>");',
		) );

		$postMetaBox = $titan->createMetaBox( array(
			'name' => 'AMP Swift Knife Options',
			'post_type' => 'post',
		) );
		$postMetaBox->createOption(array(
			'name'	=> 'Show Featured Image',
			'desc'	=> 'Override the default Featured Image display for this post',
			'id'	=> 'amp_sk_post_ft_img',
			'type'	=> 'checkbox',
			'default' => '1',
		));
		$postMetaBox->createOption(array(
			'name'	=> 'Show Comment',
			'desc'	=> 'Override the default Comment display for this post',
			'id'	=> 'amp_sk_post_comment',
			'type'	=> 'checkbox',
			'default' => '1',
		));
	}

}

AMPSK_Titan::get_instance();

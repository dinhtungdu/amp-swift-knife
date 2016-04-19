<?php
/*
Plugin Name: Swife Knife for AMP
Plugin URI:  http://dinhtung.info/
Description: Make your AMP not only fast, but beautiful.
Version:     0.1
Author:      Tung Du
Author URI:  http://dinhtung.info/
Text Domain: amp-sk
*/

/* Exit if accessed directly */
if ( ! defined( 'ABSPATH' ) ) exit;

class TD_AMP_SK {

	/**
	 * @since 0.1
	 * @access public
	 */
	public function __construct() {

		$this->define_constants();
		$this->includes();
		add_action('init', array( $this, 'init'));
	}

	private $version = '0.1';

	/**
	 * Define constant if not already set
	 * @param  string $name
	 * @param  string|bool $value
	 */
	private function define( $name, $value ) {
		if ( ! defined( $name ) ) {
			define( $name, $value );
		}
	}

	/**
	 * Define Plugin Constants
	 */
	private function define_constants() {
		$upload_dir = wp_upload_dir();

		$this->define( 'AMPSK_PLUGIN_FILE', __FILE__ );
		$this->define( 'AMPSK_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
		$this->define( 'AMPSK_VERSION', $this->version );
		$this->define( 'AMPSK_PATH', trailingslashit(plugin_dir_path( __FILE__ ) ) );
		$this->define( 'CS_ACTIVE_METABOX',    false ); // default true
		$this->define( 'CS_ACTIVE_TAXONOMY',   false ); // default true
		$this->define( 'CS_ACTIVE_SHORTCODE',  false ); // default true
	}

	public function includes() {
//		require_once('settings/cs-framework.php');
		require_once('inc/class-titan.php');
	}

	public function init() {
		add_action('admin_notices', array( $this, 'admin_notices' ) );
		add_filter( 'amp_post_template_file', array( $this, 'override_templates'), 10, 3 );
		add_action( 'pre_amp_render_post', array( $this, 'amp_sk_add_custom_actions' ));
		add_filter( 'amp_post_template_data', array( $this, 'amp_sk_scripts') );
		add_action( 'amp_post_template_footer', array( $this, 'amp_sk_analytics') );
	}

	public function admin_notices() {
		if(!is_plugin_active( 'amp/amp.php' )) :
		?>
		<div class="notice notice-warning">
			<p><?php _e( 'AMP Swift Knife plugin requires AMP plugin activated to work. Please install it from <a href="https://wordpress.org/plugins/amp" target="_blank">here</a>', 'amp-sk' ); ?></p>
		</div>
		<?php endif;
	}

	public function override_templates($file, $type, $post) {
		if ( 'single' === $type ) {
			$file = AMPSK_PATH . '/templates/single.php';
		}
		if ( 'style' === $type ) {
			$file = AMPSK_PATH . '/templates/style.php';
		}
		return $file;
	}
	public function amp_sk_add_custom_actions() {
		$titan = TitanFramework::getInstance( 'ampsk' );
		if( $titan->getOption('amp_sk_layout_ft_img') == 1 && $titan->getOption('amp_sk_post_ft_img') == 1 ) {
			add_filter( 'the_content', array( $this,'amp_sk_add_featured_image' ) );
		}
	}

	public function amp_sk_add_featured_image( $content ) {
		if ( has_post_thumbnail() ) {
			// Just add the raw <img /> tag; our sanitizer will take care of it later.
			$image = sprintf( '<p class="amp-sk-featured-image">%s</p>', get_the_post_thumbnail( null, 'large') );
			$content = $image . $content;
		}
		return $content;
	}
	public function amp_sk_scripts( $data ) {
		$data['amp_component_scripts']['amp-analytics'] = 'https://cdn.ampproject.org/v0/amp-analytics-0.1.js';
		return $data;
	}
	/**
	 * Add amp-analytics to the amp post template footer
	 */
	public function amp_sk_analytics() {
		$titan = TitanFramework::getInstance('ampsk');
		if( $titan->getOption('amp_sk_gan') != '' ):
		?>
			<amp-analytics type="googleanalytics">
				<script type="application/json">
					{
						"vars": {
							"account": <?php echo $titan->getOption('amp_sk_gan'); ?>
						},
						"triggers": {
							"trackPageview": {
								"on": "visible",
								"request": "pageview"
							}
						}
					}
				</script>
			</amp-analytics>
		<?php endif;
	}
}

function td_amp_instantiate() {
	new TD_AMP_SK();
}

function change_endpoint() {
	$titan = TitanFramework::getInstance( 'ampsk' );
	return $titan->getOption('amp_sk_endpoint');
}

add_action( 'plugins_loaded', 'td_amp_instantiate' );
add_action('amp_query_var', 'change_endpoint');

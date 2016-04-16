<?php
/**
 * AMPCustomizer option
 *
 * @package Titan Framework
 */

if ( ! defined( 'ABSPATH' ) ) { exit; // Exit if accessed directly.
}

/**
 * AMPCustomizer Option
 *
 * A heading for separating your options in an admin page or meta box
 *
 * <strong>Creating a heading option with a description:</strong>
 * <pre>$adminPage->createOption( array(
 *     'name' => __( 'General Settings', 'default' ),
 *     'type' => 'heading',
 *     'desc' => __( 'Settings for the general usage of the plugin', 'default' ),
 * ) );</pre>
 *
 * @since 1.0
 * @type heading
 * @availability Admin Pages|Meta Boxes|Customizer
 * @no id,default,livepreview,css,hidden
 */
class TitanFrameworkOptionAMPCustomizer extends TitanFrameworkOption {

	/**
	 * Display for options and meta
	 */
	public function display() {
		$ampCustomizer = str_replace( ' ', '-', strtolower( $this->settings['name'] ) );
		?>
		<tr valign="top" class="even">
			<th scope="row" class="first">
				<label id="<?php echo esc_attr( $ampCustomizer ) ?>"><?php echo $this->settings['name'] ?></label>
				<?php
				if ( ! empty( $this->settings['desc'] ) ) {
					?><p class='description'><?php echo $this->settings['desc'] ?></p><?php
				}
				?>
			</th>
			<td class="second">
				<?php
				$args = array(
					'post_type'=> 'post',
					'order'    => 'DESC',
					'posts_per_page' => 1,
				);
				$titan = TitanFramework::getInstance( 'ampsk' );
				$the_query = new WP_Query( $args );
				if($the_query->have_posts() ) : ?>
					<?php while ( $the_query->have_posts() ) : ?>
						<?php $the_query->the_post(); ?>
						<?php printf( '<a class="button button-primary" href="%1$s/wp-admin/customize.php?url=%2$s/%3$s&return=/wp-admin/options-general.php/page/amp-sk-settings">Access Customizer</a>',
							site_url(),
							get_the_permalink(),
							$titan->getOption( 'amp_sk_endpoint' )
						); ?>
					<?php endwhile; ?>
				<?php endif; ?>
				<?php wp_reset_query(); ?>
			</td>
		</tr>
		<?php
	}
}


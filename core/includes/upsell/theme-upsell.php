<?php
/**
 * Title: Theme Upsell.
 *
 * Description: Displays list of all CyberChimps theme linking to it's pro and free versions.
 *
 * Please do not edit this file. This file is part of the CyberChimps Framework and all modifications
 * should be made in a child theme.
 *
 * @category CyberChimps Framework
 * @package  Framework
 * @since    1.0
 * @author   CyberChimps
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v3.0 (or later)
 * @link     http://www.cyberchimps.com/
 */

// Add stylesheet and JS for upsell page.
function cyberchimps_upsell_style() {

	// Set template directory uri
	$directory_uri = get_template_directory_uri();

	wp_enqueue_style( 'bootstrap', $directory_uri . '/core/includes/upsell/bootstrap/css/bootstrap.css' );
	wp_enqueue_style( 'bootstrap-responsive', $directory_uri . '/core/includes/upsell/bootstrap/css/bootstrap-responsive.css', 'bootstrap' );
	wp_enqueue_style( 'cyberchimps-responsive', $directory_uri . '/core/includes/upsell/bootstrap/css/cyberchimps-responsive.css', array( 'bootstrap', 'bootstrap-responsive' ) );

	//wp_enqueue_script( 'bootstrap-js', $directory_uri . '/core/includes/upsell/bootstrap/js/bootstrap.min.js', array( 'jquery' ) );

	wp_enqueue_style( 'upsell_style', get_template_directory_uri() . '/core/includes/upsell/css/upsell.css' );
}

// Add upsell page to the menu.
function cyberchimps_add_upsell() {
	$page = add_theme_page( 'More Themes', 'More Themes', 'administrator', 'cyberchimps-themes', 'cyberchimps_display_upsell' );

	add_action( 'admin_print_styles-' . $page, 'cyberchimps_upsell_style' );
}

add_action( 'admin_menu', 'cyberchimps_add_upsell' );

// Define markup for the upsell page.
function cyberchimps_display_upsell() {

	// Set template directory uri
	$directory_uri = get_template_directory_uri();
	?>
	<div class="wrap">
		<div class="container-fluid">
			<div id="upsell_container">
				<div class="row-fluid">
					<div id="upsell_header" class="span12">
						<h2>
							<a href="http://cyberchimps.com" target="_blank">
								<img src="<?php echo $directory_uri; ?>/core/includes/upsell/images/upsell-logo.png"/>
							</a>
						</h2>

						<h3><?php _e( 'Themes You Can Trust', 'cyberchimps_core' ); ?></h3>
					</div>
				</div>

				<div id="upsell_themes" class="row-fluid">
					<?php
					// Set the argument array with author name.
					$args = array(
						'author' => 'cyberchimps',
					);

					// Set the $request array.
					$request = array(
						'body' => array(
							'action'  => 'query_themes',
							'request' => serialize( (object)$args )
						)
					);
					$themes = cyberchimps_get_themes( $request );
					$active_theme = wp_get_theme()->get( 'Name' );
					$counter = 1;

					// For currently active theme.
					foreach ( $themes->themes as $theme ) {
						if( $active_theme == $theme->name ) {?>

							<div id="<?php echo $theme->slug; ?>" class="theme-container span4">
								<div class="image-container">
									<img class="theme-screenshot" src="<?php echo $theme->screenshot_url ?>"/>

									<div class="theme-description">
										<p><?php echo $theme->description; ?></p>
									</div>
								</div>
								<div class="theme-details active">
									<span class="theme-name"><?php echo $theme->name; ?>: Current theme</span>
									<a class="button button-secondary customize right" target="_blank" href="<?php echo get_site_url(). '/wp-admin/customize.php' ?>">Customize</a>
								</div>
							</div>

						<?php
						$counter++;
						break;
						}
					}

					// For all other themes.
					foreach ( $themes->themes as $theme ) {
						if( $active_theme != $theme->name ) {

							// Set the argument array with author name.
							$args = array(
								'slug' => $theme->slug,
							);

							// Set the $request array.
							$request = array(
								'body' => array(
									'action'  => 'theme_information',
									'request' => serialize( (object)$args )
								)
							);

							$theme_details = cyberchimps_get_themes( $request );
							?>

							<div id="<?php echo $theme->slug; ?>" class="theme-container span4 <?php echo $counter % 3 == 1 ? 'no-left-megin' : ""; ?>">
								<div class="image-container">
									<img class="theme-screenshot" src="<?php echo $theme->screenshot_url ?>"/>

									<div class="theme-description">
										<p><?php echo $theme->description; ?></p>
									</div>
								</div>
								<div class="theme-details">
									<span class="theme-name"><?php echo $theme->name; ?></span>

									<!-- Check if the theme is installed -->
									<?php if( wp_get_theme( $theme->slug )->exists() ) { ?>

										<!-- Show the tick image notifying the theme is already installed. -->
										<img data-toggle="tooltip" title="Already installed" data-placement="bottom" class="theme-exists" src="<?php echo $directory_uri ?>/core/includes/upsell/images/tick.png"/>

										<!-- Activate Button -->
										<a  class="button button-primary activate right"
											href="<?php echo wp_nonce_url( admin_url( 'themes.php?action=activate&amp;stylesheet=' . urlencode( $theme->slug ) ), 'switch-theme_' . $theme->slug );?>" >Activate</a>
									<?php }
									else {

										// Set the install url for the theme.
										$install_url = add_query_arg( array(
												'action' => 'install-theme',
												'theme'  => $theme->slug,
											), self_admin_url( 'update.php' ) );
									?>
										<!-- Install Button -->
										<a data-toggle="tooltip" data-placement="bottom" title="<?php echo 'Downloaded ' . number_format( $theme_details->downloaded ) . ' times'; ?>" class="button button-primary install right" href="<?php echo esc_url( wp_nonce_url( $install_url, 'install-theme_' . $theme->slug ) ); ?>" >Install Now</a>
									<?php } ?>

									<!-- Preview button -->
									<a class="button button-secondary preview right" target="_blank" href="<?php echo $theme->preview_url; ?>">Live Preview</a>
								</div>
							</div>
							<?php
							$counter++;
						}
					}?>
				</div>
			</div>
		</div>
	</div>

	<script>
		jQuery(function () {
			jQuery('.download').tooltip();
			jQuery('.theme-exists').tooltip();
		});
	</script>
<?php
}

// Get all CyberChimps themes by using API.
function cyberchimps_get_themes( $request ) {

	// Generate a cache key that would hold the response for this request:
	$key = 'cyberchimps_' . md5( serialize( $request ) );

	// Check transient. If it's there - use that, if not re fetch the theme
	if ( false === ( $themes = get_transient( $key ) ) ) {

		// Transient expired/does not exist. Send request to the API.
		$response = wp_remote_post( 'http://api.wordpress.org/themes/info/1.0/', $request );

		// Check for the error.
		if ( !is_wp_error( $response ) ) {

			$themes = unserialize( wp_remote_retrieve_body( $response ) );

			if ( !is_object( $themes ) && !is_array( $themes ) ) {

				// Response body does not contain an object/array
				return new WP_Error( 'theme_api_error', 'An unexpected error has occurred' );
			}

			// Set transient for next time... keep it for 24 hours should be good
			set_transient( $key, $themes, 60 * 60 * 24 );
		}
		else {
			// Error object returned
			return $response;
		}
	}

	return $themes;
}

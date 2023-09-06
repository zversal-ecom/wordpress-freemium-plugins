<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://https://zversal.com/
 * @since      1.0.0
 *
 * @package    Zweather_Widget
 * @subpackage Zweather_Widget/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Zweather_Widget
 * @subpackage Zweather_Widget/admin
 * @author     Zversal <wordpress@zversal.com>
 */
class Zweather_Widget_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Zweather_Widget_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Zweather_Widget_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/zweather-widget-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Zweather_Widget_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Zweather_Widget_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/zweather-widget-admin.js', array( 'jquery' ), $this->version, false );

	}
	

}
// Register plugin settings and options page
function zversal_weather_register_settings() {
    // Register the settings with a unique option name
    register_setting('zversal_weather_options_group', 'zversal_weather_api_key', 'sanitize_callback');
}

function zversal_weather_create_menu() {
    // Use a more appropriate parent menu slug
    add_menu_page(
        'Zversal Weather Plugin Settings', // Page title
        'Weather Settings', // Menu title
        'manage_options', // Capability
        'zversal-weather-settings', // Menu slug
        'zversal_weather_settings_page', // Callback function
        'dashicons-cloud' // Icon for the menu
    );
}

function zversal_weather_settings_page() {
    ?>
    <div class="wrap">
        <h2>Zversal Weather Plugin Settings</h2>
        <p>This plugin allows you to display weather information on your website using the WeatherAPI.com service.</p>
        <p>Before you begin, please make sure to:</p>
        <ol>
            <li>Sign up for an API key on the WeatherAPI.com website: <a href="https://rapidapi.com/weatherapi/api/weatherapi-com" target="_blank">WeatherAPI.com</a></li>
            <li>Enter your API key below to enable weather functionality on your site.</li>
        </ol>
		<p>Use the following shortcode to display the weather widget on any page or post:</p>
        <code>[zversal_weather_widget]</code>
        <p>You can also customize the widget by specifying a city, like this:</p>
        <code>[zversal_weather_widget city="New York"]</code>
        <form method="post" action="options.php">
            <?php settings_fields('zversal_weather_options_group'); ?>
            <?php do_settings_sections('zversal_weather_options_group'); ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">API Key:</th>
                    <td><input type="text" name="zversal_weather_api_key" value="<?php echo esc_attr(get_option('zversal_weather_api_key')); ?>" /></td>
                </tr>
            </table>
            <?php submit_button('Save Settings'); ?>
        </form>
    </div>
    <?php
}


// Sanitize and validate the API key input
function sanitize_callback($input) {
    $sanitized_input = sanitize_text_field($input);
    
    // Add additional validation if needed (e.g., API key format validation)

    return $sanitized_input;
}

add_action('admin_init', 'zversal_weather_register_settings');
add_action('admin_menu', 'zversal_weather_create_menu');

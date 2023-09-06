<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://https://zversal.com/
 * @since      1.0.0
 *
 * @package    Zweather_Widget
 * @subpackage Zweather_Widget/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Zweather_Widget
 * @subpackage Zweather_Widget/includes
 * @author     Zversal <wordpress@zversal.com>
 */
class Zweather_Widget {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Zweather_Widget_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'ZWEATHER_WIDGET_VERSION' ) ) {
			$this->version = ZWEATHER_WIDGET_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'zweather-widget';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Zweather_Widget_Loader. Orchestrates the hooks of the plugin.
	 * - Zweather_Widget_i18n. Defines internationalization functionality.
	 * - Zweather_Widget_Admin. Defines all hooks for the admin area.
	 * - Zweather_Widget_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-zweather-widget-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-zweather-widget-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-zweather-widget-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-zweather-widget-public.php';

		$this->loader = new Zweather_Widget_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Zweather_Widget_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Zweather_Widget_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Zweather_Widget_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Zweather_Widget_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Zweather_Widget_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
// Function to fetch weather data
function get_weather_data($city) {
    $api_key = get_option('zversal_weather_api_key'); // Get API key from options
    $url = "https://weatherapi-com.p.rapidapi.com/current.json?q={$city}";
    
	$args = array(
        'method' => 'GET',
        'headers' => array(
            'X-RapidAPI-Key' => $api_key,
            'X-RapidAPI-Host' => 'weatherapi-com.p.rapidapi.com',
        ),
    );

    $response = wp_remote_get($url,$args);
   
    if (is_wp_error($response)) {
        return false;
    }

    $body = wp_remote_retrieve_body($response);
	
    return json_decode($body);
}


// Function to display the weather form and weather data
// Function to display the weather form and weather data
function display_weather_widget($atts) {
    $atts = shortcode_atts(array(
        'city' => 'New York', // Default city
    ), $atts);

    $city = sanitize_text_field($atts['city']);
    $weather_data = get_weather_data($city);

    $output = '<div class="weather-container">';
    if ($weather_data) {
        $location = $weather_data->location;
        $current = $weather_data->current;

        $temperature_c = $current->temp_c; // Temperature in Celsius
        $temperature_f = $current->temp_f; // Temperature in Fahrenheit
        $condition_text = $current->condition->text;
        $last_updated = $current->last_updated;

        // Map weather condition text to Font Awesome icons and colors
        $weather_icons = array(
            'Sunny' => array('icon' => 'sun', 'color' => 'yellow'),
            'Clear' => array('icon' => 'sun', 'color' => 'yellow'),
            'Partly cloudy' => array('icon' => 'cloud-sun', 'color' => 'lightblue'),
            'Cloudy' => array('icon' => 'cloud', 'color' => 'gray'),
            'Rain' => array('icon' => 'cloud-showers-heavy', 'color' => 'blue'),
            'Showers' => array('icon' => 'cloud-showers-heavy', 'color' => 'blue'),
            'Thunderstorm' => array('icon' => 'bolt', 'color' => 'purple'),
            'Snow' => array('icon' => 'snowflake', 'color' => 'white'),
        );

        $weather_info = isset($weather_icons[$condition_text]) ? $weather_icons[$condition_text] : null;

        $output .= '<div class="weather-widget">';
        $output .= "<p class='location'>Weather in {$location->name}, {$location->country}:</p>";
        $output .= "<p class='temperature'>Temperature: {$temperature_c}°C ({$temperature_f}°F)</p>";

        if ($weather_info) {
            $output .= "<p class='condition'><i class='fas fa-{$weather_info['icon']}' style='color: {$weather_info['color']}'></i> {$condition_text}</p>";
        } else {
            $output .= "<p class='condition'><i class='fas fa-question-circle' style='color: gray'></i> {$condition_text}</p>";
        }

        $output .= "<p class='updated'>Last Updated: {$last_updated}</p>";
        $output .= '</div>';
    } else {
        $output .= '<p class="error">Unable to fetch weather data. Please check your API key or location.</p>';
    }

    $output .= '</div>';

    // Add CSS styles for centering the container
    $output .= '<style>
        .weather-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .weather-widget {
            border: 1px solid #ccc;
            padding: 10px;
        }

        .location {
            font-size: 18px;
            font-weight: bold;
        }

        .temperature {
            font-size: 16px;
        }

        .condition {
            font-size: 16px;
        }

        .condition i {
            margin-right: 10px;
        }

        .updated {
            font-size: 14px;
            color: #777;
        }

        .error {
            color: red;
        }
    </style>';

    return $output;
}



// Register the shortcode
function register_weather_shortcode() {
    add_shortcode('zversal_weather_widget', 'display_weather_widget');
}

add_action('init', 'register_weather_shortcode');
// Enqueue Font Awesome
function enqueue_font_awesome() {
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css');
}
add_action('wp_enqueue_scripts', 'enqueue_font_awesome');
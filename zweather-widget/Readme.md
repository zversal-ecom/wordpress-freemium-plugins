# Zversal Weather Plugin

The Zversal Weather Plugin is a WordPress plugin that allows you to display weather information on your website using data from the WeatherAPI.com service.

## Installation

1. **Download the Latest Release**
   - Go to the [Releases](https://github.com/zversal-ecom/wordpress-freemium-plugins/releases) page of this GitHub repository.
   - Download the latest release ZIP file.

2. **Install the Plugin**
   - In your WordPress dashboard, navigate to Plugins > Add New.
   - Click the "Upload Plugin" button, and select the ZIP file you downloaded.
   - Click "Install Now" and then activate the plugin.

3. **API Key Setup**
   - Sign up for an API key on the WeatherAPI.com website: [WeatherAPI.com](https://rapidapi.com/weatherapi/api/weatherapi-com).
   - In your WordPress dashboard, go to Settings > Weather Plugin Settings.
   - Enter your WeatherAPI.com API key in the "API Key" field.
   - Click "Save Settings."

## Usage

### Displaying the Weather Widget

To display the weather widget on any page or post, use the following shortcode:

<code>[zversal_weather_widget]</code>


You can also specify a city by adding the `city` attribute to the shortcode:

<code>[zversal_weather_widget city="New York"]</code>


The weather widget will display weather information for the specified city.

## Settings

- **API Key:** Enter your WeatherAPI.com API key in the plugin settings to enable weather functionality on your site. You can obtain an API key by signing up at [WeatherAPI.com](https://rapidapi.com/weatherapi/api/weatherapi-com).

## Contributing

Contributions to this plugin are welcome! If you have any suggestions, bug reports, or feature requests, please [open an issue](https://github.com/zversal-ecom/wordpress-freemium-plugins/issues) or submit a pull request.

## License

This plugin is provided as-is without a specified license. You are free to use and modify it for your own purposes. However, redistribution or rebranding of this plugin is not allowed without permission.

---


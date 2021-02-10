<?php
/*
Plugin Name: Advanced Custom Fields: SVG Icon [MODIFIED]
Version: 2.0.5
Description: Add an ACF SVG icon selector.
Domain Path: languages
Text Domain: acf-svg-icon
 */

if (!defined('ABSPATH')) {
    die();
}

define('ACF_SVG_ICON_VER', '2.0.5');
define('ACF_SVG_ICON_URL', plugin_dir_url(__FILE__));
define('ACF_SVG_ICON_DIR', plugin_dir_path(__FILE__));

class acf_field_svg_icon_plugin
{

    /**
     * Constructor.
     *
     * Load plugin's translation and register acf svg fields.
     *
     * @since 1.0.0
     */
    public function __construct()
    {
        add_action('init', [__CLASS__, 'load_translation'], 1);

        // Register ACF fields
        add_action('acf/include_field_types', [__CLASS__, 'register_field_v5']);
    }

    /**
     * Load plugin translation.
     *
     * @since 1.0.0
     */
    public static function load_translation()
    {
        load_plugin_textdomain('acf-svg-icon', false, dirname(plugin_basename(__FILE__)) . '/languages');
    }

    /**
     * Register SVG icon field for ACF v5 or v5.6 depending on ACF version.
     *
     * @since 1.0.0
     */
    public static function register_field_v5()
    {
        $version = version_compare(acf_get_setting('version'), '5.6.O', '>=') ? 56 : 5;

        // Include the corresponding files
        include_once sprintf('%sfields/acf-base.php', ACF_SVG_ICON_DIR);
        include_once sprintf('%sfields/acf-%s.php', ACF_SVG_ICON_DIR, $version);

        /**
         * Instantiate the corresponding class
         * @see acf_field_svg_icon_56
         * @see acf_field_svg_icon_5
         */
        $klass = sprintf('acf_field_svg_icon_%s', $version);
        new $klass();
    }
}

/**
 * Init plugin.
 *
 * @since 1.0.0
 */
function acf_field_svg_icon()
{
    new acf_field_svg_icon_plugin();
}

add_action('plugins_loaded', 'acf_field_svg_icon');

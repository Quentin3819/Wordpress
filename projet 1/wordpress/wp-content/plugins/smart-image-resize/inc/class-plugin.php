<?php

namespace WP_Smart_Image_Resize;

/**
 * Class WP_Smart_Image_Resize\Plugin
 *
 * @package WP_Smart_Image_Resize\Inc
 */

if (!defined('ABSPATH')) {
    exit();
}

if (!class_exists('\WP_Smart_Image_Resize\Plugin')) :
    class Plugin
    {
        /**
         * Run plugin
         */
        public function run()
        {


            $this->define_hooks();
            $this->load_dependencies();
        }

        /**
         * Load js scripts.
         *
         * @return void
         */
        public function enqueue_scripts()
        {
            wp_enqueue_script('wp-color-picker');
            wp_enqueue_script(
                'multi-select',
                WP_SIR_URL . 'js/multiselect.min.js',
                ['jquery'],
                null,
                true
            );
            wp_enqueue_script(
                WP_SIR_NAME,
                WP_SIR_URL . 'js/scripts.js',
                ['multi-select', 'wp-color-picker'],
                WP_SIR_VERSION,
                true
            );
        }

        /**
         * Load css.
         *
         * @return void
         */
        public function enqueue_styles()
        {
            wp_enqueue_style('wp-color-picker');
            $wp_scripts = wp_scripts();

            wp_enqueue_style(
                'jquery-ui-theme-smoothness',
                sprintf(
                    '//ajax.googleapis.com/ajax/libs/jqueryui/%s/themes/smoothness/jquery-ui.css',
                    $wp_scripts->registered['jquery-ui-core']->ver
                )
            );
            wp_enqueue_style(
                'multi-select',
                WP_SIR_URL . 'css/multiselect.min.css',
                [],
                WP_SIR_VERSION
            );
            wp_enqueue_style(
                WP_SIR_NAME,
                WP_SIR_URL . 'css/style.css',
                ['wp-color-picker', 'multi-select'],
                WP_SIR_VERSION
            );
        }

        /**
         * Load plugin dependencies.
         *
         * @return void
         */
        public function load_dependencies()
        {
            require WP_SIR_DIR . 'inc/vendor/autoload.php';
            require_once WP_SIR_DIR . 'functions.php';
            require_once WP_SIR_DIR . 'inc/class-wp-sir.php';
            require_once WP_SIR_DIR . 'inc/class-resize.php';
            require_once WP_SIR_DIR . 'inc/class-settings.php';

            if (extension_loaded('fileinfo')) {

                $config = ['driver' => apply_filters('wp_sir_driver', 'imagick')];

                if ($config['driver'] === 'imagick' && !wp_sir_is_imagick_installed()) {
                    $config = [];
                }
                $manager = new \Intervention\Image\ImageManager($config);
                (new Resize($manager))->init();
            }

            (new Settings())->init();
        }

        /**
         * Load plugin text domain.
         *
         * @return void
         */
        public function set_locale()
        {
            load_plugin_textdomain(
                WP_SIR_NAME,
                false,
                WP_SIR_DIR . '/languages/'
            );
        }

        /**
         * Define run hooks.
         *
         * @return void
         */
        public function define_hooks()
        {
            add_action('plugins_loaded', [$this, 'set_locale']);
            add_action('admin_enqueue_scripts', [$this, 'enqueue_scripts']);
            add_action('admin_enqueue_scripts', [$this, 'enqueue_styles']);
        }
    }
endif;

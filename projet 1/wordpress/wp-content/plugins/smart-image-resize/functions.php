<?php

/**
 * Get plugin settings
 *
 * @return array
 */
if (!function_exists('wp_sir_get_settings')) :
	function wp_sir_get_settings()
	{
		$defaults = [
			'enable'      => 1,
			'bg_color'    => null,
			'jpg_quality' => 10,
			'sizes'       => array_keys(wp_sir_get_additional_sizes()),
			'jpg_convert' => 0,
			'enable_webp' => 0,
			'enable_trim' => 0,
		];
		_wp_sir_set_compat_settings();

		$settings = wp_parse_args(get_option('wp_sir_settings'), $defaults);

		if (empty($settings['sizes'])) {
			$settings['sizes'] = array_keys(wp_sir_get_additional_sizes());
		}

		return $settings;
	}
endif;

if (!function_exists('_wp_sir_set_compat_settings')) {
	function _wp_sir_set_compat_settings()
	{

		$settings = get_option('wp_sir_settings') ?: [];
		if (!empty($settings)) {
			return;
		}

		$legacy_settings = get_option('ppsir_settings');
		if (empty($legacy_settings)) {
			return;
		}

		$settings['enable'] = isset($legacy_settings['enable'])
			&& $legacy_settings['enable']
			? 1 : 0;

		if (isset($legacy_settings['bg_color'])) {
			$settings['bg_color'] = $legacy_settings['bg_color'];
		}
		if (isset($legacy_settings['jpg_quality'])) {
			$settings['jpg_quality'] = 100 - absint($legacy_settings['jpg_quality']);
		}

		add_option('wp_sir_settings', $settings);
		delete_option('ppsir_settings');
	}
}


/**
 * Get working images sizes
 *
 * @return array
 */
if (!function_exists('wp_sir_get_image_sizes')) :
	function wp_sir_get_image_sizes()
	{
		$sizes = wp_get_additional_image_sizes();
		foreach (['thumbnail', 'medium', 'medium_large', 'large'] as $name) {
			$sizes[$name] = [
				'width'  => absint(get_option("{$name}_size_w")),
				'height' => absint(get_option("{$name}_size_h")),
			];
		}

		foreach ($sizes as $name => $data) {
			if (absint($data['width']) === 0) {
				$sizes[$name]['width'] = $sizes[$name]['height'];
			} elseif (absint($data['height']) === 0) {
				$sizes[$name]['height'] = $sizes[$name]['width'];
			}
		}

		return $sizes;
	}
endif;

if (!function_exists('wp_sir_get_size_dimensions')) :
	function wp_sir_get_size_dimensions($name)
	{
		$size = null;

		foreach (wp_sir_get_image_sizes() as $n => $data) {
			if ($n === $name) {
				$size = $data;
				break;
			}
		}

		if (
			!$size || !isset($size['width'], $size['height'])
			|| min($size['width'], $size['height']) === 0
		) {
			return null;
		}

		return $size;
	}
endif;

/**
 * Get WP uploads directory path
 */
if (!function_exists('wp_sir_get_upload_dir')) {
	function wp_sir_get_upload_dir($file = "")
	{
		return wp_get_upload_dir()['basedir'] . ($file === "" ? '' : '/' . $file);
	}
}

/**
 * Get sizes except default ones.
 */
if (!function_exists('wp_sir_get_additional_sizes')) :
	function wp_sir_get_additional_sizes()
	{
		$sizes        = wp_sir_get_image_sizes();
		$custom_sizes = [];
		foreach ($sizes as $k => $size) {
			if (!in_array($k, array(
				'thumbnail',
				'medium',
				'medium_large',
				'large',
				'woocommerce_single',
				'shop_single',
			))) {
				$custom_sizes[$k] = $size;
			}
		}

		return $custom_sizes;
	}
endif;


if (!function_exists('wp_sir_webp_supported')) {

	/**
	 * Check if WebP format is supported by browser.
	 *
	 * @return bool
	 */
	function wp_sir_is_webp_supported()
	{
		return (!wp_is_mobile() && strpos($_SERVER['HTTP_ACCEPT'], 'image/webp') !== false);
	}
}

if (!function_exists('_wp_sir_update_quota')) {
	function _wp_sir_update_quota($attachment_id)
	{
		$attachments_count = get_option('wp_sir_processed_attachments') ?: [];
		if (isset($attachments_count[$attachment_id])) {
			$attachments_count[$attachment_id]++;
		} else {
			$attachments_count[$attachment_id] = 1;
		}
		update_option('wp_sir_processed_attachments', $attachments_count);
	}
}

if (!function_exists('_wp_sir_is_quota_exceeded')) {
	function _wp_sir_is_quota_exceeded()
	{
		$count_total = _wp_sir_processed_quota();

		return $count_total > 150;
	}
}

if (!function_exists('_wp_sir_processed_quota')) {

	/**
	 * Update quota
	 *
	 */
	function _wp_sir_processed_quota()
	{
		$attachments_count = get_option('wp_sir_processed_attachments') ?: [];

		return array_reduce($attachments_count, function ($count, $cur) {
			return $count + absint($cur);
		}, 0);
	}
}
if (!function_exists('_wp_sir_is_quota_exceeding_soon')) {

	/**
	 * Returns true if the quota is exceeding soon
	 *
	 */
	function _wp_sir_is_quota_exceeding_soon()
	{
		$count_total = _wp_sir_processed_quota();

		return $count_total > 100 && $count_total < 150;
	}
}


if (!function_exists('wp_sir_is_attached_to')) {

	/**
	 * Returns true if the given attachment is attached to the given post type.
	 *
	 * @param int $attachment_id
	 * @param string|array|null $post_type
	 *
	 * @return bool
	 */
	function wp_sir_is_attached_to($attachment_id, $post_type = null)
	{

		// invalid attachment.
		if (empty($attachment_id) || !get_post($attachment_id)) return false;

		// no post type, then all uploaded images will be proceeded.
		if (empty($post_type)) {
			return true;
		}

		$parent_id = wp_get_post_parent_id($attachment_id);

		if (empty($parent_id)) {
			return false;
		}

		return in_array(get_post_type($parent_id), (array) $post_type);
	}


	if (!function_exists('wp_sir_is_imagick_installed')) {

		/**
		 * Return true if ImageMagick is installed.
		 */
		function wp_sir_is_imagick_installed()
		{
			return (extension_loaded('imagick') && class_exists('Imagick'));
		}
	}


	if (!function_exists('wp_sir_is_webp_installed')) {

		function wp_sir_is_webp_installed()
		{
			return function_exists('imagewebp');
		}
	}
}

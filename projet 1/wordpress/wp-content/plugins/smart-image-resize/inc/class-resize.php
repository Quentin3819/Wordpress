<?php

namespace WP_Smart_Image_Resize;

use \Exception;

/*
 * Class WP_Smart_Image_Resize\Resize
 *
 * @package WP_Smart_Image_Resize\Inc
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

if ( ! class_exists( '\WP_Smart_Image_Resize\Resize' ) ) :
	class Resize extends WP_SIR {

		/**
		 * Register hooks.
		 */
		public function init() {
			add_filter(
				'wp_generate_attachment_metadata',
				[ $this, 'maybe_resize' ],
				PHP_INT_MAX,
				2
			);

			add_filter(
				'wp_get_attachment_image_src',
				[ $this, 'maybe_use_webp' ],
				PHP_INT_MAX,
				4
			);
			add_action( 'delete_attachment', [
				__CLASS__,
				'maybe_delete_webp_images',
			] );

			add_filter(
				'woocommerce_image_sizes_to_resize',
				'__return_empty_array'
			);

			add_filter( 'jetpack_photon_skip_image', '__return_true' );
		}

		/**
		 * Proceed resize.
		 *
		 * @param array $metadata
		 * @param int $attachment_id
		 *
		 * @return array
		 */
		public function maybe_resize( $metadata, $attachment_id ) {
			if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
				error_reporting( E_ALL );
				ini_set( 'display_errors', 1 );
			}

			if (
				! $this->is_enabled()
				|| empty( $metadata )
				|| ! wp_attachment_is_image( $attachment_id )
			) {
				return $metadata;
			}
			try {

				/* block-f */
				if ( _wp_sir_is_quota_exceeded() ) {
					return $metadata;
				}
				/* #block-f */

				// limit resize to the current post type.
				if ( $this->is_attached_to( $attachment_id, apply_filters( 'wp_sir_resize_post_type', null, $attachment_id ) ) === false ) {
					return $metadata;
				}

				$upload_dir = wp_sir_get_upload_dir();

				$origin_image = pathinfo( $metadata[ 'file' ] );

				$original_image_full_path = "$upload_dir/{$metadata['file']}";

				if ( ! file_exists( $original_image_full_path ) ) {
					return $metadata;
				}

				$sizes = apply_filters(
					'wp_sir_sizes',
					wp_sir_get_settings()[ 'sizes' ],
					$attachment_id
				);

				$output = [];

				$image = $this->manager->make( $original_image_full_path );

				$this->maybe_trim( $image );

				/* block-p */
/* #block-p */

				$image->backup();

				// Resize to the selected sizes.
				foreach ( $sizes as $size_key ) {
					$size = wp_sir_get_size_dimensions( $size_key );

					// Size not found
					if ( null === $size ) {
						continue;
					}

					$output_width  = absint( $size[ 'width' ] );
					$output_height = absint( $size[ 'height' ] );


					// Resize to the given size while preserving the aspect ration.
					$image->resize( $output_width, $output_height, function (
						$constraint
					) {
						$constraint->aspectRatio();
					} );

					// Resize the canvas to the given size.
					$background_color = sanitize_hex_color( wp_sir_get_settings()[ 'bg_color' ] ) ?: null;

					$image->resizeCanvas(
						$output_width,
						$output_height,
						'center',
						false,
						$background_color
					);

					// Output dirname.
					$dirname = $origin_image[ 'dirname' ];

					// Image filename without extension.
					$filename = $origin_image[ 'filename' ];

					// Original image's extension.
					$extension = $origin_image[ 'extension' ];

					$origin_ext = $extension;

					// Convert to JPG if enabled.

					/* block-p */
/* #block-p */

					// Output filename (without extension)
					$filename = "{$filename}-{$output_width}x{$output_height}";

					// Append extension to filename.
					$basename = "$filename.$extension";
					$jpg_quality
					          = 100 - absint( wp_sir_get_settings()[ 'jpg_quality' ] );

					$this->delete_old_thumbnail( $metadata, $size_key );
					$image = $image->save( "{$upload_dir}/{$dirname}/{$basename}", $jpg_quality );

					// Add/replace thumbnail.
					$output[ $size_key ] = [
						'width'     => $output_width,
						'height'    => $output_height,
						'file'      => $basename,
						'mime-type' => $image->mime(),
					];

					// Remove old thumbnail if the new thumbnail
					// has different extension (in case of convert to JPG option is enabled).
					/* block-p */
/* #block-p */

					// Create the WebP copy of the thumbnail.
					/* block-p */
/* #block-p */

					$image->reset();
				}

				$metadata[ 'sizes' ] = array_merge( $metadata[ 'sizes' ], $output );

				_wp_sir_update_quota( $attachment_id );

				return $metadata;
			} catch ( Exception $e ) {
				wp_send_json_error( [
					'message' => "Smart Image Resize: {$e->getMessage()}",
				] );
			}
		}

		/**
		 *
		 * Remove old thumbnail to clean up Media Library.
		 *
		 * @param array $metadata
		 * @param string $size_key
		 *
		 * @return void
		 *
		 */
		function delete_old_thumbnail( $metadata, $size_key ) {
			if ( ! isset( $metadata[ 'sizes' ][ $size_key ] ) ) {
				return;
			}

			$upload_dir = wp_sir_get_upload_dir();
			$sub_dir    = dirname( $metadata[ 'file' ] );

			$image_path = $upload_dir . '/' . $sub_dir . '/' . $metadata[ 'sizes' ][ $size_key ][ 'file' ];

			if ( file_exists( $image_path ) ) {
				@unlink( $image_path );
			}
		}

		/**
		 * @return bool
		 */
		public function is_jpg_enabled() {
			return wp_sir_get_settings()[ 'jpg_convert' ];
		}

		/**
		 * @param int $attachment_id
		 * @param string|null $post_type
		 *
		 * @return bool
		 */
		public function is_attached_to( $attachment_id, $post_type = null ) {
			if ( empty( $post_type ) ) {
				return true;
			}

			$post_type = (array) $post_type;

			$referer = wp_get_referer();

			if ( ! $referer ) {
				return false;
			}

			foreach ( $post_type as $item ) {
				if ( false !== strpos( $referer, 'post_type=' . $item ) ) {
					return true;
				}
			}


			$url = wp_parse_url( $referer );

			$defaults = [
				'path'  => '',
				'query' => '',
			];

			$url = wp_parse_args( $url, $defaults );

			if ( false !== strpos( $url[ 'path' ], 'post.php' ) ) {

				if ( empty( $url[ 'query' ] ) ) {
					return false;
				}
				/**
				 * @var array $params
				 */
				wp_parse_args( wp_parse_str( $url[ 'query' ], $params ), [
					'post' => - 1,
				] );

				return in_array( get_post_type( $params[ 'post' ] ), $post_type );
			}

			return wp_sir_is_attached_to( $attachment_id, $post_type );
		}

		/**
		 * Returns true if the resize functionality is enabled.
		 *
		 * @return bool
		 */
		private function is_enabled() {
			return wp_sir_get_settings()[ 'enable' ];
		}

		/**
		 * Use WebP if enabled and supported by the browser.
		 * Fallback to standard format.
		 *
		 * @param array|false $image
		 * @param int $attachment_id
		 * @param string|array $size
		 * @param bool $icon
		 *
		 * @return array|false
		 */
		public function maybe_use_webp( $image, $attachment_id, $size, $icon ) {
			if (
				! wp_sir_get_settings()[ 'enable_webp' ]
				|| ! wp_sir_is_webp_supported()
				|| ! wp_sir_is_attached_to(
					$attachment_id,
					apply_filters( 'wp_sir_resize_post_type', null, $attachment_id )
				)
				|| is_admin()
				|| ! $image
			) {
				return $image;
			}

			list( $url ) = $image;

			// Get generated sizes metadata.
			$metadata = wp_get_attachment_metadata( $attachment_id );

			// If by change there is no metadata, abort.
			if ( empty( $metadata ) ) {
				return $image;
			}

			if ( is_array( $size ) ) {
				$intermediate_size = image_get_intermediate_size(
					$attachment_id,
					$size
				);

				if ( ! $intermediate_size ) {
					return $image;
				}

				$_size = array_filter( $metadata[ 'sizes' ], function ( $file ) use (
					$intermediate_size
				) {
					return $intermediate_size[ 'file' ] === $file[ 'file' ];
				} );

				if ( empty( $_size ) ) {
					return $image;
				}

				$_size = array_keys( $_size );
				$size  = array_shift( $_size );
			}

			if ( 'full' === $size ) {
				$origin_file = pathinfo( $metadata[ 'file' ] );
				$webp_file   = wp_sir_get_upload_dir(
					"{$origin_file['dirname']}/{$origin_file['filename']}.webp"
				);
				$this->maybe_generate_webp_image(
					$webp_file,
					wp_sir_get_upload_dir( $metadata[ 'file' ] )
				);
				if ( ! file_exists( $webp_file ) ) {
					return $image;
				}
				$image[ 0 ] = str_replace(
					$origin_file[ 'extension' ],
					'webp',
					$url
				);

				return $image;
			} elseif ( isset( $metadata[ 'sizes' ][ $size ] ) ) {

				$filename = pathinfo( $metadata[ 'sizes' ][ $size ][ 'file' ], PATHINFO_FILENAME );

				$attachment_dir = dirname( $metadata[ 'file' ] );

				// Expected WebP thumbnail basename.
				$webp_file = wp_sir_get_upload_dir( "$attachment_dir/$filename.webp" );

				$this->maybe_generate_webp_image(
					$webp_file,
					wp_sir_get_upload_dir(
						"$attachment_dir/{$metadata['sizes'][$size]['file']}"
					)
				);
				if ( ! file_exists( $webp_file ) ) {
					return $image;
				}
				$url        = str_replace( wp_basename( $url ), "$filename.webp", $url );
				$image[ 0 ] = $url;
			}

			return $image;
		}

		/**
		 * Generate WebP format image if it doesn't exist.
		 *
		 * @param string $webp_file
		 * @param string $source_file
		 *
		 * @return void
		 */
		private function maybe_generate_webp_image( $webp_file, $source_file ) {
			if ( file_exists( $webp_file ) || ! function_exists( 'imagewebp' ) ) {
				return;
			}
			$image = $this->manager->make( $source_file );
			$image->save( $webp_file );
		}

		/**
		 * Delete WebP linked to the given attachment.
		 *
		 * @param int $attachment_id
		 */
		public static function maybe_delete_webp_images( $attachment_id ) {
			if ( ! wp_attachment_is_image( $attachment_id ) ) {
				return;
			}

			$metadata = wp_get_attachment_metadata( $attachment_id );

			$origin_file = pathinfo( $metadata[ 'file' ] );

			// Delete WebP thumbnails.
			foreach ( $metadata[ 'sizes' ] as $size ) {
				$filename = pathinfo( $size[ 'file' ], PATHINFO_FILENAME );
				wp_delete_file( wp_sir_get_upload_dir( "{$origin_file['dirname']}/$filename.webp" ) );
			}

			// Delete original WebP image.
			$image_fullpath = "{$origin_file['dirname']}/{$origin_file['filename']}.webp";
			wp_delete_file( wp_sir_get_upload_dir( $image_fullpath ) );
		}

		/**
		 * Returns true if WebP is enabled by user
		 * and installed on the server.
		 *
		 * @return bool
		 */
		function is_webp_enabled() {
			return wp_sir_get_settings()[ 'enable_webp' ] && function_exists( 'imagewebp' );
		}

		/**
		 * Return true if whitespace trimming is enabled.
		 *
		 * @return bool
		 */
		function is_trim_enabled() {
			return wp_sir_get_settings()[ 'enable_trim' ];
		}

		/**
		 * Remove empty white and gray background from the given image
		 *
		 * @param \Intervention\Image\Image $image
		 *
		 * @return void
		 */
		function maybe_trim( &$image ) {
			if ( ! $this->is_trim_enabled() ) {
				return;
			}

			try {
				$image->trim(
					apply_filters( 'wp_sir_trim_base', null ),
					apply_filters( 'wp_sir_trim_away', null ),
					apply_filters( 'wp_sir_trim_tolerance', 5 ),
					apply_filters( 'wp_sir_trim_feather', 0 )
				);
			} catch ( Exception $e ) {
			}
		}
	}

endif;

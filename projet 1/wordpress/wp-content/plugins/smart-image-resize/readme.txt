=== Smart Image Resize for WooCommerce ===
Contributors: nlemsieh
Donate link: https://paypal.me/nlemsieh
Tags: WooCommerce product image resize, fix image crop, resize, image, picture resize, square image, square thumbnail, uniform image, same size, category image size, image crop, image resize without cropping, image resize, resize thumbnails, resize images in WooCommerce
Requires at least: 4.0
Tested up to: 5.3
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl.html
Requires PHP: 5.4
Stable tag: 1.2.1

Make WooCommerce products images the same size and uniform without cropping.

== Description ==

[Smart Image Resize](https://sirplugin.com/) makes all products images the same size and uniform without cropping. 

- Zero configuration.
- No more manual image editing and photo resizing.

### Lite Features

- Resize up to 150 images
- Remove unwanted whitespace around image.
- Set a custom background color of the emerging (new empty) area.
- Compress thumbnails to reduce file size.
- Select which sizes to generate.

### Pro Features

- **♾ Unlimited Images:**  Unlimited images resizing.

-  **✈️ Convert to JPG format:** Reduce image file size and boost page speed.

- **🚀 Use WebP Images:** Reduce image file up to 90% while still providing transparency and the same quality.  

- **🔒Insert watermark (coming soon):** Insert logo, name, SKU, and other info on all images, attracting new potential customers through search engines, and keep images safe from unauthorized use (especially if you sell digital products or if you want to keep the copyright safe for the images you publish online such as photos, pictures, comic strips, etc.)

- **👨‍💻 Get priority support:**
Get faster and real-time email support. 

[Check out Smart Image Resize PRO!](https://sirplugin.com?utm_source=wp&utm_medium=link&utm_campaign=lite_version)

### Usage

Smart Image Resize plugin doesn't require any configuration. Just enable it under WooCommerce > Smart Image Resize, and you're ready to start uploading your images!

You can change settings to fit your needs under WooCommerce > Smart Image Resize.

> Note, to regenerate exising thumbnails, follow the quick steps below:
1. Install <a href="https://wordpress.org/plugins/regenerate-thumbnails/" target="_blank">Regenerate Thumbnails plugin</a>.
2. Navigate to Tools > Regenerate Thumbnails.
3. Uncheck **Skip regenerating existing correctly sized thumbnails (faster)**
4. Finally, click on **Regenerate Thumbnails for the N Featured Images Only** button.

== Installation ==

1. Upload `smart-image-resize` folder to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
 
 _**Note**: Make sure PHP Fileinfo extension is enabled in you server._

 == Frequently Asked Questions == 

= How can I regenerate thumbnails I already added to the media library? =

To regenerate thumbnails, please install [Regenerate Thumbnails plugin](https://wordpress.org/plugins/regenerate-thumbnails/). Make sure to uncheck **Skip regenerating existing correctly sized thumbnails (faster)**


= I get an error when I upload an image =

Make sure PHP extension `fileinfo` is enabled. 

== Screenshots ==

1. Before and after using the plugin.
2. Settings page.
3. Select sizes to generated.
4. Add custom background color of the new area.

== Changelog ==

= 1.2.1 =
* Added settings page link under Installed Plugins.

= 1.2.0 =
* Added Whitespace Trimming feature.
* Various improvements. 

= 1.1.12 =

* Fixed crash when Fileinfo extension is disabled. 

= 1.1.11 =

* Added support for Jetpack. 

= 1.1.10 =

* Fixed conflict with some plugins. 

= 1.1.9 =

* Prevent dynamic resize in WooCommerce.

= 1.1.8 =

* Handle WebP not installed.

= 1.1.7 =

* Fixed mbstring polyfill conflict with WP `mb_strlen` function


= 1.1.6 =
* Added polyfill for PHP mbstring extension

= 1.1.5 =
* Force square image when height is set to auto.

= 1.1.4 =
* Fixed empty sizes list 

= 1.1.3 =
* Fixed empty sizes list 

= 1.1.2 =

* Added settings improvements
* Added processed images notice.

= 1.1.1 =

* Added fileinfo and PHP version notices
* Improved settings page experience.

= 1.1.0 =

* Introducing Smart Image Resize Pro features
* Various improvements

= 1.0.13 =

* Fixed some images not resized correctly.

= 1.0.12 =

* Minor bugfix

= 1.0.11 =

* Errors messages now are displayed in media uploader. This will help debug occured problems while resizing.

= 1.0.10 =

* The PHP Fileinfo extension is required. Now you can see notice when it isn't enabled. 

= 1.0.9 =

* Fixed bug that prevents upload of non-image files to the media library. 

= 1.0.8 =

* Skip woocommerce_single resize

= 1.0.7 =

* Stability improvement

= 1.0.6 =

* Bugfix


= 1.0.5 =

* Bugfix

= 1.0.4 =

* Removed deprecated option.

= 1.0.3 =

* Small images resize improvement.

= 1.0.2 =

Improve stability

= 1.0.1 =

- Add ability to add custom color in settings.
- Fixbug for some PHP versions.

= 1.0.0 =

* Public Release

 == Upgrade Notice ==
 
 = 1.0.0 =

* Public Release
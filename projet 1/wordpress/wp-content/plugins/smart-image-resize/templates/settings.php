<?php
/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://nabillemsieh.com
 * @since      1.0.0
 *
 * @package    WP_Smart_Image_Resize
 * @subpackage WP_Smart_Image_Resize/templates
 */
?>
<div class="wrap">
    <?php /* block-p */
/* #block-p */ ?>
    <?php /* block-f */ ?>
    <h1><?php echo _e( 'Smart Image Resize for WooCommerce', WP_SIR_NAME ); ?></h1>
    <?php /* #block-f */ ?>
    <form method="post" action="options.php">
        <?php
        settings_fields( WP_SIR_NAME );
        do_settings_sections( WP_SIR_NAME );
        submit_button();
        ?>
    </form>

</div>
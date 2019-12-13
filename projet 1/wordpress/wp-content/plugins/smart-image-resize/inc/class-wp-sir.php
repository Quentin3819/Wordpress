<?php
namespace WP_Smart_Image_Resize;

/**
 * Class WP_Smart_Image_Resize\WP_SIR
 * @package WP_Smart_Image_Resize\Inc
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if(!class_exists('\WP_Smart_Image_Resize\WP_SIR')):
class WP_SIR
{
    /**
     * ImageManager instance.
     *
     * @var \Intervention\Image\ImageManager
     */
    protected $manager;

    /**
     * Plugin settings.
     *
     * @var array
     */

    
    public function __construct($manager)
    {
        $this->manager  = $manager;
    }
}
endif;

<?php
/*
Widget Name: RA Image Carousel
Description: A simple image carousel widget using Owl Carousel.
Author: Rotsen Mark Acob
Author URI: http://rotsenacob.com
*/

class RAWB_Image_Carousel_Widget extends SiteOrigin_Widget {
    function __construct() {
        parent::__construct(
            'rawb-image-carousel',
            __( 'RA Image Carousel', 'ra-widgets-bundle' ),
            array(
                'description' => __( 'A simple image carousel widget using Owl Carousel', 'ra-widgets-bundle' ),
                'help' => ''
            ),
            array(),
            array(
				'title' => array(
					'type' => 'text',
					'label' => __( 'Title', 'ra-widgets-bundle' ),
					'default' => ''
				),
				'class' => array(
					'type' => 'text',
					'label' => __( 'Class', 'ra-widgets-bundle' ),
				),
				'images' => array(
					'type' => 'repeater',
					'label' => __( 'Add Images', 'ra-widgets-bundle' ),
					'item_name' => __( 'Image', 'ra-widgets-bundle' ),
					'item_label' => array(
						'selector' => "[id*='image']",
						'update_event' => 'change',
						'value_method' => 'val'
					),
					'fields' => array(
						'image' => array(
							'type' => 'media',
							'label' => __( 'Choose an image', 'ra-widgets-bundle' ),
							'choose' => __( 'Choose image', 'ra-widgets-bundle' ),
							'update' => __( 'Set image', 'ra-widgets-bundle' ),
							'library' => 'image'
						),
						'alt' => array(
							'type' => 'text',
							'label' => __( 'Alt text', 'ra-widgets-bundle' ),
							'default' => ''
						),
						'link' => array(
							'type' => 'text',
							'label' => __( 'Image link', 'ra-widgets-bundle' ),
							'default' => ''
						)
					)
				),
				'settings' => array(
					'type' => 'section',
					'label' => __( 'Image Settings', 'ra-widgets-bundle' ),
					'hide' => true,
					'fields' => array(
						'size' => array(
							'type' => 'select',
							'label' => __( 'Image Size', 'ra-widgets-bundle' ),
							'options' => rawb_thumb_sizes(),
							'default' => 'full'
						),
					)
				),
				'slideshow' => array(
					'type' => 'section',
					'label' => __( 'Slideshow Settings', 'ra-widgets-bundle' ),
					'hide' => true,
					'fields' => array(
						'slides' => array(
							'type' => 'number',
							'default' => 1,
							'label' => __( 'Slides', 'ra-widgets-bundle' )
						),
						'margin' => array(
							'type' => 'number',
							'default' => 0,
							'label' => __( 'Slide margin', 'ra-widgets-bundle' ),
						),
						'duration' => array(
							'type' => 'number',
							'default' => 250,
							'label' => __( 'Duration', 'ra-widgets-bundle' ),
						),
						'speed' => array(
							'type' => 'number',
							'default' => 250,
							'label' => __( 'Speed', 'ra-widgets-bundle' ),
						),
						'autoplay' => array(
							'type' => 'checkbox',
							'default' => false,
							'label' => __( 'Enable autoplay?', 'ra-widgets-bundle' ),
						),
						'navigation' => array(
							'type' => 'checkbox',
							'default' => true,
							'label' => __( 'Display navigation?', 'ra-widgets-bundle' ),
						),
						'pagination' => array(
							'type' => 'checkbox',
							'default' => false,
							'label' => __( 'Display pagination?', 'ra-widgets-bundle' ),
						),
						'lazyload' => array(
							'type' => 'checkbox',
							'default' => false,
							'label' => __( 'Enable lazyload?', 'ra-widgets-bundle' ),
						),
						'autowidth' => array(
							'type' => 'checkbox',
							'default' => false,
							'label' => __( 'Enable autowidth?', 'ra-widgets-bundle' ),
						),
						'center' => array(
							'type' => 'checkbox',
							'default' => false,
							'label' => __( 'Center item', 'ra-widgets-bundle' ),
						),
						'mergefit' => array(
							'type' => 'checkbox',
							'default' => false,
							'label' => __( 'Fit merged items?', 'ra-widgets-bundle' ),
						),
						'loop' => array(
							'type' => 'checkbox',
							'default' => true,
							'label' => __( 'Loop items?', 'ra-widgets-bundle' )
						)
					)
				),
				'responsive' => array(
					'type' => 'section',
					'label' => __( 'Responsive Settings', 'ra-widgets-bundle' ),
					'hide' => true,
					'fields' => array(
						'mobile' => array(
							'type' => 'number',
							'label' => __( 'Slides for mobile', 'ra-widgets-bundle' ),
							'default' => 1
						),
						'tablet' => array(
							'type' => 'number',
							'label' => __( 'Slides for tablets', 'ra-widgets-bundle' ),
							'default' => 1
						),
					)
				),
				'template' => array(
					'type' => 'select',
					'label' => __( 'Choose template', 'ra-widgets-bundle' ),
					'options' => array(
						'default' => __( 'Default', 'ra-widgets-bundle' )
					),
					'default' => 'default'
				)
			),
            plugin_dir_path( __FILE__ ) . 'widgets/'
        );
    }

    function get_template_name( $instance ) {
        switch ( $instance['template'] ) {
            case 'default':
            default:
                return 'default';
                break;
        }
    }

    function get_style_name( $instance ) {
        return false;
    }

	function get_template_variables( $instance, $args ) {
		return array(
    		'title' => $instance['title'],
			'class' => $instance['class'],
			'size' => $instance['settings']['size'],
    		'template' => $instance['template'],
			'slides' => $instance['slideshow']['slides'],
			'margin' => $instance['slideshow']['margin'],
			'duration' => $instance['slideshow']['duration'],
			'speed' => $instance['slideshow']['speed'],
			'autoplay' => $instance['slideshow']['autoplay'],
			'navigation' => $instance['slideshow']['navigation'],
			'pagination' => $instance['slideshow']['pagination'],
			'autowidth' => $instance['slideshow']['autowidth'],
			'lazyload' => $instance['slideshow']['autoheight'],
			'center' => $instance['slideshow']['center'],
			'mergefit' => $instance['slideshow']['mergefit'],
			'loop' => $instance['slideshow']['loop'],
			'slides_mobile' => $instance['responsive']['mobile'],
			'slides_tablet' => $instance['responsive']['tablet']
    	);
	}
}

siteorigin_widget_register( 'rawb-image-carousel', __FILE__, 'RAWB_Image_Carousel_Widget' );
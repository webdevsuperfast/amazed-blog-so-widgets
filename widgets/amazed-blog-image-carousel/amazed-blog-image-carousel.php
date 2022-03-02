<?php
/*
Widget Name: Amazed Blog Image Carousel
Description: A simple image carousel widget.
Author: Amazed Blog
Author URI: http://amazed.blog
*/

class ABSW_Image_Carousel_Widget extends SiteOrigin_Widget {
    function __construct() {
        parent::__construct(
            'amazed-blog-image-carousel',
            __( 'Amazed Blog Image Carousel', 'absw-blog-so-widgets' ),
            array(
                'description' => __( 'A simple image carousel widget.', 'absw-blog-so-widgets' ),
                'help' => ''
            ),
            array(),
            false,
            plugin_dir_path( __FILE__ ) . 'widgets/'
        );
    }

		function get_widget_form() {
			return array(
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
				'slider' => array(
          'type' => 'section',
          'label' => __( 'Slider Settings', 'amazed-blog-so-widgets' ),
          'hide' => true,
          'fields' => array(
            'slider' => array(
              'type' => 'checkbox',
              'label' => __( 'Enable Slider', 'amazed-blog-so-widgets' ),
              'default' => true,
              'state_emitter' => array(
                'callback' => 'conditional',
                'args' => array( 'slider: val' )
              )
            ),
            'slider_space_between' => array(
              'type' => 'number',
              'label' => __( 'Space Between', 'amazed-blog-so-widgets' ),
              'default' => 40,
              'state_handler' => array(
                'slider[true]' => array( 'show' )
              )
            ),
            'slider_per_view' => array(
              'type' => 'number', 
              'label' => __( 'Slides Per View', 'amazed-blog-so-widgets' ),
              'default' => 1,
              'state_handler' => array(
                'slider[true]' => array( 'show' )
              )
            )
          ),
        ),
        'responsive' => array(
          'type' => 'section',
          'label' => __( 'Responsive Settings', 'amazed-blog-so-widgets' ),
          'hide' => true,
          'fields' => array(
            'responsive_mobile' => array(
              'type' => 'number',
              'label' => __( 'Mobile', 'amazed-blog-so-widgets' ),
              'default' => 1,
              'description' => __( 'Slides to show on mobile.', 'amazed-blog-so-widgets' )
            ),
            'responsive_tablet' => array(
              'type' => 'number',
              'label' => __( 'Tablet', 'amazed-blog-so-widgets' ),
              'default' => 1,
              'description' => __( 'Slides to show on tablets.', 'amazed-blog-so-widgets' )
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
			'images' => $instance['images'],
			'size' => $instance['settings']['size'],
			'template' => $instance['template'],
			'slider_enable' => $instance['slider']['slider'],
      'slider_space_between' => $instance['slider']['slider_space_between'],
      'slider_per_view' => $instance['slider']['slider_per_view'],
      'responsive_mobile' => $instance['responsive']['responsive_mobile'],
      'responsive_tablet' => $instance['responsive']['responsive_tablet'],
			'template' => $instance['template'],
    	);
	}
}

siteorigin_widget_register( 'amazed-blog-image-carousel', __FILE__, 'ABSW_Image_Carousel_Widget' );
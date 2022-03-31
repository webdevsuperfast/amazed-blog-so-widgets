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
            __( 'Amazed Blog Image Carousel', 'amazed-blog-so-widgets' ),
            array(
                'description' => __( 'A simple image carousel widget.', 'amazed-blog-so-widgets' ),
                'help' => ''
            ),
            array(),
            false,
            plugin_dir_path( __FILE__ ) . 'widgets/'
        );
    }

		function get_widget_form() {
      global $_wp_additional_image_sizes;
 
        $sizes = array(
        'full' => __( 'Full', 'ra-widgets-bundle' )
      );

      $get_intermediate_image_sizes = get_intermediate_image_sizes();

      
      
      foreach( $get_intermediate_image_sizes as $_size ) {
        if ( in_array( $_size, array( 'thumbnail', 'medium', 'large' ) ) ) {
          $sizes[ $_size ] = ucwords( $_size ); // strtouppercase
        }
      }

			return array(
				'title' => array(
					'type' => 'text',
					'label' => __( 'Title', 'amazed-blog-so-widgets' ),
					'default' => ''
				),
				'class' => array(
					'type' => 'text',
					'label' => __( 'Class', 'amazed-blog-so-widgets' ),
				),
				'images' => array(
					'type' => 'repeater',
					'label' => __( 'Add Images', 'amazed-blog-so-widgets' ),
					'item_name' => __( 'Image', 'amazed-blog-so-widgets' ),
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
					'label' => __( 'Image Settings', 'amazed-blog-so-widgets' ),
					'hide' => true,
					'fields' => array(
						'size' => array(
							'type' => 'select',
							'label' => __( 'Image Size', 'amazed-blog-so-widgets' ),
							'options' => $sizes,
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
            'slider_navigation' => array(
              'type' => 'checkbox',
              'label' => __( 'Enable Navigation', 'amazed-blog-so-widgets' ),
              'default' => true,
              'state_handler' => array(
                'slider[true]' => array( 'show' )
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
            ),
            'slider_rewind' => array(
              'type' => 'checkbox',
              'label' => __( 'Enable rewind slides', 'amazed-blog-so-widgets' ),
              'default' => false,
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
            'responsive_view' => array(
              'type' => 'checkbox',
              'label' => __( 'Set slides view to auto', 'amazed-blog-so-widgets' ),
              'default' => false,
            )
          )
        ),
				'template' => array(
					'type' => 'select',
					'label' => __( 'Choose template', 'amazed-blog-so-widgets' ),
					'options' => array(
						'default' => __( 'Default', 'amazed-blog-so-widgets' )
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
      'slider_enable_navigation' => $instance['slider']['slider_navigation'],
      'slider_rewind' => $instance['slider']['slider_rewind'],
      'responsive_mobile' => $instance['responsive']['responsive_mobile'],
      'responsive_tablet' => $instance['responsive']['responsive_tablet'],
      'responsive_view' => $instance['responsive']['responsive_view'],
			'template' => $instance['template'],
    	);
	}
}

siteorigin_widget_register( 'amazed-blog-image-carousel', __FILE__, 'ABSW_Image_Carousel_Widget' );
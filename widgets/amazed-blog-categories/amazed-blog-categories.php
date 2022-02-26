<?php
/*
Widget Name: Amazed Blog Categories
Description: A simple category widget.
Author: Amazed Blog
Author URI: https://amazed.blog
*/

class Amazed_Blog_Categories_Widget extends SiteOrigin_Widget {
    function __construct() {
        parent::__construct(
            'amazed-blog-categories',
            __( 'Amazed Blog Categories', 'amazed-blog-so-widgets' ),
            array(
                'description' => __( 'A simple category widget', 'amazed-blog-so-widgets' ),
                'help' => ''
            ),
            array(),
            false,
            plugin_dir_path( __FILE__ ) . 'widgets'
        );
    }

    function get_widget_form() {
    	return array(
				'title' => array(
					'type' => 'text',
					'label' => __('Title', 'amazed-blog-so-widgets'),
					'default' => ''
				),
				'class' => array(
					'type' => 'text',
					'label' => __( 'Class', 'amazed-blog-so-widgets' )
        ),
        'catsnum' => array(
          'type' => 'number',
          'label' => __( 'Number of categories to show', 'amazed-blog-so-widgets' ),
        ),
        'structure' => array(
          'type' => 'section',
          'label' => __( 'Category Settings', 'amazed-blog-so-widgets' ),
          'hide' => true,
          'fields' => array(
            'display' => array(
              'type' => 'checkboxes',
              'label' => __( 'Display Settings', 'amazed-blog-so-widgets' ),
              'options' => array(
                'thumbnail' => __( 'Category Thumbnail', 'amazed-blog-so-widgets' ),
                'title' => __( 'Category Title', 'amazed-blog-so-widgets' ),
                'content' => __( 'Category Content', 'amazed-blog-so-widgets' )
              ),
              'default' => 'thumbnail',
              'state_emitter' => array(
                'callback' => 'conditional',
                'args' => array( 'display: val == "thumbnail"' )
              )
            ),
            'size' => array(
              'type' => 'image-size',
              'label' => __( 'Thumbnail Size', 'amazed-blog-so-widgets' ),
              'custom_size' => true,
              'state_handler' => array(
                'display[thumbnail]' => array( 'show' )
              )
            )
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
              'default' => false,
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

    function get_template_variables( $instance, $args ) {
    	return array(
			'title' => $instance['title'],
			'class' => $instance['class'],
      'catsnum' => $instance['catsnum'],
			'structure' => $instance['structure'],
			'size' => $instance['structure']['size'],
      'slider_enable' => $instance['slider']['slider'],
      'slider_space_between' => $instance['slider']['slider_space_between'],
      'slider_per_view' => $instance['slider']['slider_per_view'],
      'responsive_mobile' => $instance['responsive']['responsive_mobile'],
      'responsive_tablet' => $instance['responsive']['responsive_tablet'],
			'template' => $instance['template'],
      'display' => $instance['structure']['display'],
    	);
    }
}

siteorigin_widget_register( 'amazed-blog-categories', __FILE__, 'Amazed_Blog_Categories_Widget' );
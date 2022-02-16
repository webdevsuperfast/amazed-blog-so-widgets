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
        'structure' => array(
          'type' => 'section',
          'label' => __( 'Category Settings', 'ra-post-carousel-widget' ),
          'hide' => true,
          'fields' => array(
            'display' => array(
              'type' => 'checkboxes',
              'label' => __( 'Display Settings', 'ra-post-carousel-widget' ),
              'options' => array(
                'thumbnail' => __( 'Category Thumbnail', 'ra-post-carousel-widget' ),
                'title' => __( 'Category Title', 'ra-post-carousel-widget' ),
                'content' => __( 'Category Content', 'ra-post-carousel-widget' )
              ),
              'default' => 'thumbnail',
              'state_emitter' => array(
                'callback' => 'conditional',
                'args' => array( 'display: val == "thumbnail"' )
              )
            ),
            'size' => array(
              'type' => 'image-size',
              'label' => __( 'Thumbnail Size', 'ra-post-carousel-widget' ),
              'custom_size' => true,
              'state_handler' => array(
                'display[thumbnail]' => array( 'show' )
              )
            )
          )
        ),
        'template' => array(
          'type' => 'select',
          'label' => __( 'Choose template', 'ra-post-carousel-widget' ),
          'options' => array(
            'default' => __( 'Default', 'ra-post-carousel-widget' )
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
			'structure' => $instance['structure'],
			'size' => $instance['structure']['size'],
			'template' => $instance['template'],
    	);
    }
}

siteorigin_widget_register( 'amazed-blog-categories', __FILE__, 'Amazed_Blog_Categories_Widget' );
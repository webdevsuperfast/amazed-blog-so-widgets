<?php
/*
Widget Name: Amazed Blog Posts
Description: A simple posts widget.
Author: Amazed Blog
Author URI: https://amazed.blog
*/

class Amazed_Blog_Posts_Widget extends SiteOrigin_Widget {
    function __construct() {
        parent::__construct(
            'amazed-blog-posts',
            __( 'Amazed Blog Posts', 'amazed-blog-so-widgets' ),
            array(
                'description' => __( 'A simple posts widget', 'amazed-blog-so-widgets' ),
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
        'post' => array(
          'type' => 'posts',
          'label' => __( 'Post Query', 'ra-post-carousel-widget' )
        ),
        'structure' => array(
          'type' => 'section',
          'label' => __( 'Post Settings', 'ra-post-carousel-widget' ),
          'hide' => true,
          'fields' => array(
            'display' => array(
              'type' => 'checkboxes',
              'label' => __( 'Display Settings', 'ra-post-carousel-widget' ),
              'options' => array(
                'thumbnail' => __( 'Post Thumbnail', 'ra-post-carousel-widget' ),
                'title' => __( 'Post Title', 'ra-post-carousel-widget' ),
                'content' => __( 'Post Content', 'ra-post-carousel-widget' )
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
            ),
            'content_type' => array(
              'type' => 'select',
              'label' => __( 'Content Type', 'ra-post-carousel-widget' ),
              'default' => 'excerpt',
              'options' => array(
                'excerpt' => __( 'Excerpt', 'ra-post-carousel-widget' ),
                'content' => __( 'Full Content', 'ra-post-carousel-widget' )
              ),
              'state_handler' => array(
                'display[content]' => array( 'show' )
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
      'post' => $instance['post'],
			'structure' => $instance['structure'],
			'display' => $instance['structure']['display'],
			'size' => $instance['structure']['size'],
      'content_type' => $instance['structure']['content_type'],
			'template' => $instance['template'],
    	);
    }
}

siteorigin_widget_register( 'amazed-blog-posts', __FILE__, 'Amazed_Blog_Posts_Widget' );
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
          'label' => __( 'Post Query', 'amazed-blog-so-widgets' )
        ),
        'structure' => array(
          'type' => 'section',
          'label' => __( 'Post Settings', 'amazed-blog-so-widgets' ),
          'hide' => true,
          'fields' => array(
            'display' => array(
              'type' => 'checkboxes',
              'label' => __( 'Display Settings', 'amazed-blog-so-widgets' ),
              'options' => array(
                'thumbnail' => __( 'Post Thumbnail', 'amazed-blog-so-widgets' ),
                'title' => __( 'Post Title', 'amazed-blog-so-widgets' ),
                'content' => __( 'Post Content', 'amazed-blog-so-widgets' ),
                'meta' => __( 'Post Meta', 'amazed-blog-so-widgets' ),
                'info' => __( 'Post Info', 'amazed-blog-so-widgets' ),
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
            ),
            'content_type' => array(
              'type' => 'select',
              'label' => __( 'Content Type', 'amazed-blog-so-widgets' ),
              'default' => 'excerpt',
              'options' => array(
                'excerpt' => __( 'Excerpt', 'amazed-blog-so-widgets' ),
                'content' => __( 'Full Content', 'amazed-blog-so-widgets' )
              ),
              'state_handler' => array(
                'display[content]' => array( 'show' )
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
            'column-layout' => __( 'Column', 'amazed-blog-so-widgets' ),
            'grid-layout' => __( 'Grid', 'amazed-blog-so-widgets' ),
            'full-width-layout' => __( 'Full Width', 'amazed-blog-so-widgets' ),
          ),
          'default' => 'column-layout'
        )
			);
    }

    function get_template_name( $instance ) {
      switch ( $instance['template'] ) {
        case 'column-layout':
        default:
          return 'column-layout';
          break;

        case 'grid-layout':
        case 'grid-layout-slider':
          return 'grid-layout';
          break;
        
        case 'full-width-layout':
          return 'full-width-layout';
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
      'slider_enable' => $instance['slider']['slider'],
      'slider_space_between' => $instance['slider']['slider_space_between'],
      'slider_per_view' => $instance['slider']['slider_per_view'],
      'responsive_mobile' => $instance['responsive']['responsive_mobile'],
      'responsive_tablet' => $instance['responsive']['responsive_tablet'],
			'template' => $instance['template'],
    	);
    }
}

siteorigin_widget_register( 'amazed-blog-posts', __FILE__, 'Amazed_Blog_Posts_Widget' );
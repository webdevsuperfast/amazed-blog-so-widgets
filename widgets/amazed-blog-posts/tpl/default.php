<?php
if ( $title ) {
    echo $args['before_title'] . apply_filters( 'widget_title', $title ) . $args['after_title'];
}

$widget_id = $args['widget_id'];
$widget_id = preg_replace( '/[^0-9]/', '', $widget_id );

$attributes = array();

$classes = array();
$classes[] = 'amazed-blog-posts';
$classes[] = $class;

$attributes = array(
    'class' => esc_attr( implode( ' ', $classes ) ),
    'id' => 'amazed-blog-posts-' . (int)$widget_id,
    'data-instance' => (int)$widget_id
); ?>

<?php $post_args = siteorigin_widget_post_selector_process_query( $post );

$loop = new WP_Query( $post_args ); ?>

<?php if ( $loop->have_posts() ) : ?>
  <div <?php foreach( $attributes as $name => $value ) echo $name . '="' . $value . '" ' ?>>
  <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
    <div class="post-carousel-wrapper">
      <?php if ( in_array( 'thumbnail', $display ) ) : ?>
        <div class="post-carousel-image">
          <a href="<?php echo get_permalink(); ?>">
          <?php
          if ( $size == 'custom_size' && ! empty( $instance['structure']['size_width'] ) && ! empty( $instance['structure']['size_height'] ) ) {
            $size = array(
              (int) $instance['structure']['size_width'],
              (int) $instance['structure']['size_height']
            );
          }
          the_post_thumbnail( $size );
          ?>
          </a>
        </div>
      <?php endif; ?>
      <?php if ( in_array( 'title', $display ) || in_array( 'content', $display ) ) : ?>
        <div class="content-wrap">
          <?php echo ( in_array( 'title', $display ) ? '<h4>' . apply_filters( 'ra_post_carousel_title', get_the_title(), $postid ) . '</h4>' : '' ); ?>

          <?php var_dump( $content_type ); ?>
          
          <?php if ( in_array( 'content', $display ) && $content_type == 'content' ) : ?>
            <div class="post-carousel-content">
              <?php the_content(); ?>
            </div>
          <?php else : ?>
            <div class="post-carousel-excerpt">
              <?php the_excerpt(); ?>
            </div>
          <?php endif; ?>
        </div>
      <?php endif; ?>
    </div>
  <?php endwhile; ?>
    <?php wp_reset_query(); ?>
  <?php else : ?>
    <?php echo __( 'No posts found.', 'ra-post-carousel-widget' ); ?>

  </div>
  <?php endif; ?>
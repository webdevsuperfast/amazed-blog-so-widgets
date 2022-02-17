<?php
if ( $title ) {
    echo $args['before_title'] . apply_filters( 'widget_title', $title ) . $args['after_title'];
}

$widget_id = $args['widget_id'];
$widget_id = preg_replace( '/[^0-9]/', '', $widget_id );

$attributes = array();

$classes = array();
$classes[] = 'amazed-blog-categories';
$classes[] = $class;

$attributes = array(
    'class' => esc_attr( implode( ' ', $classes ) ),
    'id' => 'amazed-blog-categories-' . (int)$widget_id,
    'data-instance' => (int)$widget_id
); ?>

<?php $categories = get_terms( 'category', array(
  'orderby' => 'count',
  'hide_empty' => true
) ); ?>

<div <?php foreach( $attributes as $name => $value ) echo $name . '="' . $value . '" ' ?>>
  <?php if ( $categories ) : ?>
      <?php foreach( $categories as $category ) : ?>
          <div class="category">
            <?php if ( in_array( 'thumbnail', $display ) && function_exists( 'z_taxonomy_image_url' ) ) : ?>
            <div class="category-image">
              <?php 
              if ( $size == 'custom_size' && ! empty( $instance['structure']['size_width'] ) && ! empty( $instance['structure']['size_height'] ) ) {
                $size = array(
                  (int) $instance['structure']['size_width'],
                  (int) $instance['structure']['size_height']
                );
              }
              
              if ( get_option( 'z_taxonomy_image' . $category->term_id ) ) :
                echo '<img src=" '. z_taxonomy_image_url( $category->term_id, $size ) .'" alt="'. $category->name .'">';
              endif; 
              ?>
            </div>
            <?php endif; ?>

            <?php if ( in_array( 'title', $display ) ) : ?>
            <div class="category-title">
              <a href="<?php echo get_term_link( $category->term_id ); ?>">
                <?php echo $category->name; ?>
              </a>
            </div>
            <?php endif; ?>

            <?php if ( in_array( 'content', $display ) ) : ?>
              <div class="category-info">
                <p class="category-count"><?php echo $category->count; ?></p>
              </div>
            <?php endif; ?>
          </div>
      <?php endforeach; ?>
  <?php endif; ?>
</div>
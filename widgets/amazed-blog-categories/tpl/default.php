<?php
if ( $title ) {
    echo $args['before_title'] . apply_filters( 'widget_title', $title ) . $args['after_title'];
}

$widget_id = $args['widget_id'];
$widget_id = preg_replace( '/[^0-9]/', '', $widget_id );

$attributes = array();

$classes = array();
$classes[] = 'amazed-blog-categories';
  // $classes[] = 'row';
$classes[] = 'absw-grid absw-grid-cols-none sm:absw-grid-cols-2 md:absw-grid-cols-4 absw-gap-8 absw-underline-none';
$classes[] = $class;

$attributes = array(
    'class' => esc_attr( implode( ' ', $classes ) ),
    'id' => 'amazed-blog-categories-' . (int)$widget_id,
    'data-instance' => (int)$widget_id
);

$catargs = array(
  'taxonomy' => 'category',
  'orderby' => 'count',
  'hide_empty' => true
); 

$catargs['number'] = $catsnum ? (int) $catsnum : 0;
?>

<?php $categories = get_terms( $catargs ); ?>

<div <?php foreach( $attributes as $name => $value ) echo $name . '="' . $value . '" ' ?>>
  <?php if ( $categories ) : ?>
    <?php foreach( $categories as $category ) : ?>
      <div class="category category-<?php echo $category->term_slug; ?>">
        <?php if ( in_array( 'thumbnail', $display ) && function_exists( 'z_taxonomy_image_url' ) ) : ?>
        <div class="category-image absw-overflow-hidden absw-shadow absw-rounded absw-mb-5 absw-leading-none">
          <?php 
          if ( $size == 'custom_size' && ! empty( $instance['structure']['size_width'] ) && ! empty( $instance['structure']['size_height'] ) ) {
            $size = array(
              (int) $instance['structure']['size_width'],
              (int) $instance['structure']['size_height']
            );
          }
          
          if ( get_option( 'z_taxonomy_image' . $category->term_id ) ) :
            echo '<a class="absw-block absw-leading-none relative" href="' . get_term_link( $category->term_id ) . '">';
            echo '<img class="absw-block absw-w-full absw-h-48 absw-object-cover" src=" '. z_taxonomy_image_url( $category->term_id, $size ) .'" alt="'. $category->name .'">';
            echo '</a>';
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
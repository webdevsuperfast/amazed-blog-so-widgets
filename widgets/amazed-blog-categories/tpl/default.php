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

<?php $categories = get_terms( 'category', array(
  'orderby' => 'count',
  'hide_empty' => true
) ); ?>

<?php if ( $categories ) : ?>
  <div <?php foreach( $attributes as $name => $value ) echo $name . '="' . $value . '" ' ?>>
    <?php foreach( $categories as $category ) : ?>
      <?php echo $category->name; ?>
    <?php endforeach; ?>
  </div>
<?php endif; ?>
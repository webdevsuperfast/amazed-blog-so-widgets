<?php
$widget_id = $args['widget_id'];
$widget_id = preg_replace( '/[^0-9]/', '', $widget_id );

if ( $title ) {
  echo $args['before_title'] . apply_filters( 'widget_title', $title ) . $args['after_title'];
}

$attributes = array();

$classes = array();
$classes[] = 'amazed-blog-image-carousel';
$classes[] = 'amazed-blog-image-carousel-' . (int) $widget_id;
$classes[] = $slider_enable ? 'swiper' : '';
$classes[] = $slider_enable ? 'swiper-' . (int) $widget_id : '';
$classes[] = $slider_enable ? 'absw-w-full absw-h-full' : 'absw-grid absw-grid-cols-none sm:absw-grid-cols-2 md:absw-grid-cols-4 absw-gap-8 absw-underline-none';
$classes[] = $class;

$attributes = array(
    'class' => esc_attr( implode( ' ', $classes ) ),
    'id' => 'amazed-blog-categories-' . (int)$widget_id,
    'data-instance' => (int)$widget_id,
    'data-spacing' => (int)$slider_space_between,
    'data-slides' => (int)$slider_per_view,
    'data-responsive-mobile' => (int)$responsive_mobile,
    'data-responsive-tablet' => (int)$responsive_tablet,
);
?>

<?php if ( is_array( $images ) && !is_wp_error( $images ) ) { ?>
  <div <?php foreach( $attributes as $name => $value ) echo $name . '="' . $value . '" ' ?>>
    <?php echo $slider_enable ? '<div class="swiper-wrapper">' : ''; ?>
      <?php foreach( $images as $image ) {
        $link = sow_esc_url( $image['link'] );
        $alt = $image['alt'];
        $imagesource = wp_get_attachment_image_src( $image['image'], 'full' );
        $url = $imagesource[0];

        echo $slider_enable ?'<div class="swiper-slide">' : '';
        echo $link ? '<a href="'.$link.'">' : '';
          if ( $options['lazyload'] ) {
            echo wp_get_attachment_image( $image['image'], $imageattr['size'], null, array(
              'class' => 'owl-lazy',
              'data-src' => wp_get_attachment_image_url( $image['image'], $imageattr['size'] )
            ) );
          } else {
            echo wp_get_attachment_image( $image['image'], $imageattr['size'] );
          }
        echo $link ? '</a>' : '';
        echo $slider_enable ? '</div>' : '';
      } ?>
    <?php echo $slider_enable ? '</div>' : ''; ?>
  </div>
<?php }
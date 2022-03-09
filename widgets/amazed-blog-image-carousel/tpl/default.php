<?php
$widget_id = $args['widget_id'];
$widget_id = preg_replace( '/[^0-9]/', '', $widget_id );

$slider_navigation = '';
$slider_navigation .= '<div class="slider-navigation absw-flex">';

$slider_navigation .= '<div class="swiper-prev-'. (int) $widget_id .'">'. apply_filters( 'absw_image_carousel_prev_text' , 'Prev' ) .'</div>';
$slider_navigation .= '<div class="swiper-next-'. (int) $widget_id .'">'. apply_filters( 'absw_image_carousel_next_text' , 'Next' ) .'</div>';

$slider_navigation .= '</div>';

if ( ! $slider_enable ) {
  $slider_navigation = '';
}

if ( ! $slider_navigation ) {
  $slider_navigation = '';
}

$before_title = preg_replace( '/<h3(.*?)>/', '<div class="absw-flex absw-flex-nowrap absw-items-center"><h3 class="absw-grow widget-title">', $args['before_title'] );
$after_title = preg_replace( '/<\/h3>/', '</h3>' . $slider_navigation . '</div>', $args['after_title'] );

if ( $title ) {
  echo $before_title . apply_filters( 'widget_title', $title ) . $after_title;
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
    'id' => 'amazed-blog-image-carousel-' . (int)$widget_id,
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
        echo $slider_enable ?'<div class="swiper-slide">' : '';
        echo $link ? '<a href="'.$link.'">' : '';
          echo wp_get_attachment_image( $image['image'], $size, '', array( 'class' => 'absw-object-cover !absw-w-full' ) );
        echo $link ? '</a>' : '';
        echo $slider_enable ? '</div>' : '';
      } ?>
    <?php echo $slider_enable ? '</div>' : ''; ?>
  </div>
<?php }
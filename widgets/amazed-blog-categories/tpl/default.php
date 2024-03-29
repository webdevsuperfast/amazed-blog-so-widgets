<?php
$post_args = siteorigin_widget_post_selector_process_query( $post );

$widget_id = $args['widget_id'];
$widget_id = preg_replace( '/[^0-9]/', '', $widget_id );

$slider_navigation = '';
$slider_navigation .= '<div class="slider-navigation absw-flex">';


$term_link = get_post_type_archive_link( 'post' );

$slider_navigation .= '<a class="absw-mr-4" href="' . esc_url( apply_filters( 'absw_category_link', $term_link ) ) . '">View More</a>';



if ( $slider_enable_navigation ) :
  $slider_navigation .= '<div class="swiper-prev-'. (int) $widget_id .'">'. apply_filters( 'absw_prev_text' , 'Prev' ) .'</div>';
  $slider_navigation .= '<div class="swiper-next-'. (int) $widget_id .'">'. apply_filters( 'absw_next_text' , 'Next' ) .'</div>';
endif;

$slider_navigation .= '</div>';

if ( ! $slider_enable ) {
  $slider_navigation = '';
}

$before_title = preg_replace( '/<h3(.*?)>/', '<div class="absw-flex absw-flex-nowrap absw-items-center"><h3 class="absw-grow widget-title">', $args['before_title'] );
$after_title = preg_replace( '/<\/h3>/', '</h3>' . $slider_navigation . '</div>', $args['after_title'] );

if ( $title ) {
  echo $before_title . apply_filters( 'widget_title', $title ) . $after_title;
}

$attributes = array();

$classes = array();
$classes[] = 'amazed-blog-categories';
$classes[] = 'amazed-blog-categories-' . (int) $widget_id;
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
    'data-rewind' => $slider_rewind,
    'data-responsive-mobile' => (int)$responsive_mobile,
    'data-responsive-tablet' => (int)$responsive_tablet,
    'data-responsive-view' => $responsive_view
);

$catargs = array(
  'taxonomy' => 'category',
  'orderby' => 'count',
  'hide_empty' => true,
  'order' => 'DESC',
); 

$catargs['number'] = $catsnum ? (int) $catsnum : 0;
?>

<?php $categories = get_terms( $catargs ); ?>

<div <?php foreach( $attributes as $name => $value ) echo $name . '="' . $value . '" ' ?>>
  <?php echo $slider_enable ? '<div class="swiper-wrapper">' : ''; ?>
  <?php if ( $categories ) : ?>
    <?php foreach( $categories as $category ) : ?>
      <div class="<?php echo $slider_enable ? 'swiper-slide' : ''; ?> <?php echo $responsive_view ? ' view-auto' : ''; ?> category">
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
            echo '<a class="relative absw-block absw-leading-none" href="' . get_term_link( $category->term_id ) . '">';
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
            <p class="category-count"><?php echo $category->count; ?> Articles </p>
          </div>
        <?php endif; ?>
      </div>
    <?php endforeach; ?>
  <?php endif; ?>
  <?php echo $slider_enable ? '</div><!-- end .swiper-wrapper -->' : ''; ?>
</div><!-- end .amazed-blog-categories -->
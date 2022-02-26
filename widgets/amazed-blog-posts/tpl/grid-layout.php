<?php
$post_args = siteorigin_widget_post_selector_process_query( $post );
$term = get_term_by( 'slug', $post_args['tax_query'][0]['terms'], 'category' );

$widget_id = $args['widget_id'];
$widget_id = preg_replace( '/[^0-9]/', '', $widget_id );

$slider_navigation = '';
$slider_navigation .= '<div class="slider-navigation absw-flex">';

if ( ! empty( $term ) ) {
  $term_link = get_term_link( $term, 'category' );
  $slider_navigation .= '<a class="absw-mr-4" href="' . esc_url( $term_link ) . '">Show All</a>';
} else {
  $term_link = get_permalink( get_option( 'page_for_posts' ) );
  $slider_navigation .= '<a class="absw-mr-4" href="' . esc_url( $term_link ) . '">Show All</a>';
}

$slider_navigation .= '<div class="swiper-prev-'. (int) $widget_id .'">'. apply_filters( 'absw_prev_text' , 'Prev' ) .'</div>';
$slider_navigation .= '<div class="swiper-next-'. (int) $widget_id .'">'. apply_filters( 'absw_next_text', 'Next' ) .'</div>';

$slider_navigation .= '</div>';

if ( ! $slider_enable ) {
  $slider_navigation = '';
}

$before_title = preg_replace( '/<h3(.*?)>/', '<div class="absw-flex absw-flex-nowrap absw-items-center"><h3 class="absw-grow widget-title">', $args['before_title'] );
$after_title = preg_replace( '/<\/h3>/', '</h3>' . $slider_navigation . '</div>', $args['after_title'] );

if ( $title || ! empty( $term ) ) {
  echo $before_title . apply_filters( 'widget_title', $title ) . $after_title;
}

$attributes = array();

$classes = array();
$classes[] = 'amazed-blog-posts';
$classes[] = 'amazed-blog-posts-' . (int) $widget_id;
$classes[] = $slider_enable ? 'swiper absw-w-full absw-block' : '';
$classes[] = $slider_enable ? 'swiper-' . (int) $widget_id : '';
$classes[] = 'amazed-blog-posts-grid';
$classes[] = 'amazed-blog-posts-grid-' . (int) $widget_id;
$classes[] = $slider_enable ? '' : 'absw-grid absw-grid-cols-none sm:absw-grid-rows-4 sm:absw-grid-cols-3 md:absw-grid-cols-10 lg:absw-grid-cols-20 absw-gap-8';
$classes[] = $class;

$attributes = array(
    'class' => esc_attr( implode( ' ', $classes ) ),
    'id' => 'amazed-blog-posts-grid-slider-' . (int) $widget_id,
    'data-instance' => (int)$widget_id,
    'data-spacing' => (int)$slider_space_between,
    'data-slides' => (int)$slider_per_view,
    'data-responsive-mobile' => (int)$responsive_mobile,
    'data-responsive-tablet' => (int)$responsive_tablet,
);

$i = 1;
$grid = 2;
$loop = new WP_Query( $post_args ); ?>
<div <?php foreach( $attributes as $name => $value ) echo $name . '="' . $value . '" ' ?>>
<?php echo $slider_enable ? '<div class="swiper-wrapper">' : ''; ?>
<?php echo $slider_enable ? '<div class="swiper-slide absw-grid absw-grid-cols-none sm:absw-grid-rows-4 sm:absw-grid-cols-3 md:absw-grid-cols-10 lg:absw-grid-cols-20 absw-gap-8">' : ''; ?>
  <?php if ( $loop->have_posts() ) : while ( $loop->have_posts() ) : $loop->the_post(); ?>
  <?php if ( $i % 5 == 1 ) {
    $class = 'post-featured sm:absw-col-span-2 md:absw-col-span-6 lg:absw-col-span-11 sm:absw-row-span-full';
  } else {
    $class = 'absw-grid absw-grid-cols-4 absw-gap-4 sm:absw-col-span-4 md:abswd-col-span-4 lg:absw-col-span-9 sm:absw-row-span-1';
  } ?>
  <div <?php post_class( 'post-wrapper absw-relative ' . $class ); ?>>
      <?php if ( in_array( 'thumbnail', $display ) && has_post_thumbnail() ) : ?>
        <div class="post-carousel-image absw-relative <?php echo $i % 5 == 1 ? 'absw-w-full absw-h-full' : 'absw-col-span-1';?>">
          <?php if ( $i % 5 != 1 ) {
            echo '<a href="' . get_permalink() . '" class="absw-block">';
          } ?>
          <?php
            if ( $size == 'custom_size' && ! empty( $instance['structure']['size_width'] ) && ! empty( $instance['structure']['size_height'] ) ) {
              $size = array(
                (int) $instance['structure']['size_width'],
                (int) $instance['structure']['size_height']
              );
            }
            if ( $i % 5 == 1 ) {
              the_post_thumbnail( 'full', ['class' => 'absw-absolute !absw-w-full !absw-h-full absw-object-cover' ] );
            } else {
              the_post_thumbnail( $size, ['class' => 'absw-object-cover' ] );
            }
          ?>
          <?php if ( $i % 5 != 1 ) {
            echo '</a>';
          } ?>
          <?php if ( $i % 5 == 1 ) { ?>
            <a class="absw-absolute absw-w-full absw-h-full absw-top-0 absw-left-0 absw-indent-[-9999px] absw-z-20" href="<?php echo get_permalink(); ?>"><?php _e( 'Read More', 'amazed-blog-so-widgets' ); ?></a>
          <?php } ?>
        </div>
      <?php endif; ?>
      
      <?php if ( in_array( 'title', $display ) || in_array( 'content', $display ) || in_array( 'info', $display ) || in_array( 'meta', $display ) ) : ?>
        <div class="content-wrap <?php echo $i % 5 == 1 ? 'absw-absolute absw-left-0 absw-bottom-0 absw-w-full absw-z-10' : ( has_post_thumbnail() ? 'absw-col-span-3' : 'absw-col-span-full' ); ?>">
          <?php if ( in_array( 'meta', $display) ) : ?>
            <div class="post-metadata">
              <?php the_category(', '); ?>
            </div>
          <?php endif; ?>
          <?php echo ( in_array( 'title', $display ) ? '<h4>' . '<a href="'. get_permalink() .'">'.get_the_title() . '</a>' . '</h4>' : '' ); ?>
          
          <?php if ( in_array( 'content', $display ) && $content_type == 'content' ) : ?>
            <div class="post-entry">
              <?php the_content(); ?>
            </div>
          <?php elseif ( in_array( 'content', $display ) && $content_type == 'excerpt' ) : ?>
            <div class="post-entry">
              <?php the_excerpt(); ?>
            </div>
          <?php else: ?>
            
          <?php endif; ?>
          <?php if ( in_array( 'info', $display ) ) : ?>
            <div class="post-info">
              <span class="post-author"><?php the_author_posts_link(); ?></span>
              <span>•</span>
              <span class="post-time"><?php the_time( 'F jS, Y' ); ?></span>
            </div>
          <?php endif; ?>
        </div>
      <?php endif; ?>
    </div>
    <?php if ( $i % 5 == 0 ) { ?>
      </div><!-- end every 5th post -->
      <?php if ( $slider_enable ) { ?>
        <div class="swiper-slide absw-grid absw-grid-cols-none sm:absw-grid-rows-4 sm:absw-grid-cols-3 md:absw-grid-cols-10 lg:absw-grid-cols-20 absw-gap-8">
      <?php } else { ?>
        <div <?php foreach( $attributes as $name => $value ) echo $name . '="' . $value . '" ' ?>>
      <?php } ?>
    <?php } ?>
  <?php $i++; endwhile; wp_reset_query(); endif; ?>
</div><!-- end every 5th post -->
<?php echo $slider_enable ? '</div>' : ''; ?>
</div>
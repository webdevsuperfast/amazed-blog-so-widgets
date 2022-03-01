<?php
$post_args = siteorigin_widget_post_selector_process_query( $post );
$term = get_term_by( 'slug', $post_args['tax_query'][0]['terms'], 'category' );

$widget_id = $args['widget_id'];
$widget_id = preg_replace( '/[^0-9]/', '', $widget_id );

$slider_navigation = '';
$slider_navigation .= '<div class="slider-navigation absw-flex">';

if ( ! empty( $term ) ) {
  $term_link = get_term_link( $term, 'category' );
  $slider_navigation .= '<a class="absw-mr-4" href="' . esc_url( $term_link ) . '">View More</a>';
} else {
  $term_link = get_permalink( get_option( 'page_for_posts' ) );
  $slider_navigation .= '<a class="absw-mr-4" href="' . esc_url( $term_link ) . '">View More</a>';
}

$slider_navigation .= '<div class="swiper-prev-'. (int) $widget_id .'">'. apply_filters( 'absw_prev_text' , 'Prev' ) .'</div>';
$slider_navigation .= '<div class="swiper-next-'. (int) $widget_id .'">'. apply_filters( 'absw_next_text', 'Next' ) .'</div>';

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
$classes[] = 'amazed-blog-posts';
$classes[] = 'amazed-blog-posts-column';
$classes[] = 'amazed-blog-posts-column-' . (int) $widget_id;
$classes[] = $slider_enable ? 'swiper absw-w-full absw-block' : 'absw-grid absw-grid-cols-none sm:absw-grid-cols-2 md:absw-grid-cols-3 lg:absw-grid-cols-4 absw-gap-8';
$classes[] = $slider_enable ? 'swiper-' . $widget_id : '';
$classes[] = $class;

$attributes = array(
    'class' => esc_attr( implode( ' ', $classes ) ),
    'id' => 'amazed-blog-posts-column-' . (int)$widget_id,
    'data-instance' => (int)$widget_id,
    'data-spacing' => (int)$slider_space_between,
    'data-slides' => (int)$slider_per_view,
    'data-responsive-mobile' => (int)$responsive_mobile,
    'data-responsive-tablet' => (int)$responsive_tablet,
); ?>

<?php
$loop = new WP_Query( $post_args ); ?>

<div <?php foreach( $attributes as $name => $value ) echo $name . '="' . $value . '" ' ?>>
<?php if ( $loop->have_posts() ) : ?>
  <?php echo $slider_enable ? '<div class="swiper-wrapper">' : ''; ?>
  <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
    <?php $do_not_duplicate[] = get_the_ID(); // Add to variable current posts on loop 
      $classes = array(
        'post-wrapper',
        'absw-rounded',
        'absw-overflow-hidden',
        'absw-shadow', 
        'absw-bg-gray-100'
      );
      $classes[] = $slider_enable ? 'swiper-slide' : '';
    ?>
    <div <?php post_class( $classes ); ?>>
      <?php if ( in_array( 'thumbnail', $display ) && has_post_thumbnail() ) : ?>
        <div class="post-carousel-image absw-relative absw-leading-none">
          <a href="<?php echo get_permalink(); ?>">
            <?php
            if ( $size == 'custom_size' && ! empty( $instance['structure']['size_width'] ) && ! empty( $instance['structure']['size_height'] ) ) {
              $size = array(
                (int) $instance['structure']['size_width'],
                (int) $instance['structure']['size_height']
              );
            }
            the_post_thumbnail( $size, ['class' => 'absw-block !absw-w-full !absw-h-48 absw-object-cover'] );
          ?>
          </a>
        </div>
      <?php endif; ?>
      
      <?php if ( in_array( 'title', $display ) || in_array( 'content', $display ) || in_array( 'info', $display ) || in_array( 'meta', $display ) ) : ?>
        <div class="content-wrap absw-p-5">
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
  <?php endwhile; ?>
    <?php wp_reset_query(); ?>
  <?php else : ?>
    <?php echo __( 'No posts found.', 'amazed-blog-so-widgets' ); ?>
  <?php endif; ?>
  <?php echo $slider_enable ? '</div>' : ''; ?>
</div>
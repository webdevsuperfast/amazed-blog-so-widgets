<?php
if ( $title ) {
    echo $args['before_title'] . apply_filters( 'widget_title', $title ) . $args['after_title'];
}

$widget_id = $args['widget_id'];
$widget_id = preg_replace( '/[^0-9]/', '', $widget_id );

$attributes = array();

$classes = array();
$classes[] = 'amazed-blog-posts';
$classes[] = 'amazed-blog-posts-' . (int) $widget_id;
$classes[] = 'swiper-slide absw-w-full absw-block';
// $classes[] = 'swiper-' . (int) $widget_id;
$classes[] = 'amazed-blog-posts-grid';
$classes[] = 'absw-grid absw-grid-cols-none sm:absw-grid-rows-4 sm:absw-grid-cols-3 md:absw-grid-cols-10 lg:absw-grid-cols-20 absw-gap-8';
$classes[] = $class;

$attributes = array(
    'class' => esc_attr( implode( ' ', $classes ) ),
    'id' => 'amazed-blog-posts-' . (int) $widget_id,
    // 'data-instance' => (int)$widget_id
); ?>

<?php $post_args = siteorigin_widget_post_selector_process_query( $post );
$i = 1;
$grid = 2;
$loop = new WP_Query( $post_args ); ?>
<div class="swiper swiper-<?php echo (int) $widget_id; ?> absw-w-full absw-h-full" data-instance="<?php echo (int) $widget_id; ?>"><div class="swiper-wrapper">
<div <?php foreach( $attributes as $name => $value ) echo $name . '="' . $value . '" ' ?>>
  <?php if ( $loop->have_posts() ) : while ( $loop->have_posts() ) : $loop->the_post(); ?>
  <?php if ( $i % 5 == 1 ) {
    $class = 'post-featured sm:absw-col-span-2 md:absw-col-span-6 lg:absw-col-span-11 sm:absw-row-span-full';
  } else {
    $class = 'absw-grid absw-grid-cols-4 absw-gap-4 sm:absw-col-span-1 md:abswd-col-span-4 lg:absw-col-span-9 sm:absw-row-span-1';
  } ?>
  <div <?php post_class( 'post-wrapper absw-relative ' . $class ); ?>>
      <?php if ( in_array( 'thumbnail', $display ) && has_post_thumbnail() ) : ?>
        <div class="post-carousel-image absw-relative <?php echo $i % 5 == 1 ? 'absw-w-full absw-h-full' : 'absw-col-span-1';?>">
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
          <a class="absw-absolute absw-w-full absw-h-full absw-top-0 absw-left-0" href="<?php echo get_permalink(); ?>">&nbsp;</a>
        </div>
      <?php endif; ?>
      
      <?php if ( in_array( 'title', $display ) || in_array( 'content', $display ) || in_array( 'info', $display ) || in_array( 'meta', $display ) ) : ?>
        <div class="content-wrap <?php echo $i % 5 == 1 ? 'absw-absolute absw-left-0 absw-bottom-0 absw-w-full' : ( has_post_thumbnail() ? 'absw-col-span-3' : 'absw-col-span-full' ); ?>">
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
      <div <?php foreach( $attributes as $name => $value ) echo $name . '="' . $value . '" ' ?>>
    <?php } ?>
  <?php $i++; endwhile; wp_reset_query(); endif; ?>
</div><!-- end every 5th post -->
</div></div>
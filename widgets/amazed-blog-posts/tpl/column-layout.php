<?php
if ( $title ) {
    echo $args['before_title'] . apply_filters( 'widget_title', $title ) . $args['after_title'];
}

$widget_id = $args['widget_id'];
$widget_id = preg_replace( '/[^0-9]/', '', $widget_id );

$attributes = array();

$classes = array();
$classes[] = 'amazed-blog-posts';
$classes[] = 'amazed-blog-posts-column';
$classes[] = 'absw-grid absw-grid-cols-none sm:absw-grid-cols-2 md:absw-grid-cols-4 absw-gap-8 absw-underline-none'; // Tailwind utility classes
$classes[] = $class;

$attributes = array(
    'class' => esc_attr( implode( ' ', $classes ) ),
    'id' => 'amazed-blog-posts-' . (int)$widget_id,
    'data-instance' => (int)$widget_id
); ?>

<?php $post_args = siteorigin_widget_post_selector_process_query( $post );

$loop = new WP_Query( $post_args ); ?>

<div <?php foreach( $attributes as $name => $value ) echo $name . '="' . $value . '" ' ?>>
<?php if ( $loop->have_posts() ) : ?>
  <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
    <?php $do_not_duplicate[] = $post->ID; // Add to variable current posts on loop ?>
    <div <?php post_class( "post-wrapper absw-rounded absw-overflow-hidden absw-shadow absw-bg-gray-100" ); ?>>
	 <a class="absw-block absw-leading-none" href="<?php echo get_permalink(); ?>">
      <?php if ( in_array( 'thumbnail', $display ) ) : ?>
        <div class="post-carousel-image absw-relative absw-leading-none">
         
          <?php
          if ( $size == 'custom_size' && ! empty( $instance['structure']['size_width'] ) && ! empty( $instance['structure']['size_height'] ) ) {
            $size = array(
              (int) $instance['structure']['size_width'],
              (int) $instance['structure']['size_height']
            );
          }
          the_post_thumbnail( $size, ['class' => 'absw-block absw-w-full absw-h-48 absw-object-cover'] );
          ?>
         
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
	   </a>
    </div>
  <?php endwhile; ?>
    <?php wp_reset_query(); ?>
  <?php else : ?>
    <?php echo __( 'No posts found.', 'amazed-blog-so-widgets' ); ?>
  <?php endif; ?>
</div>
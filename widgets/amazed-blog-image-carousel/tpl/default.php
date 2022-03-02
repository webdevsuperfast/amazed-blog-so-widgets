<?php
$title = $instance['title'];

if ( $title ) {
    echo $args['before_title'] . apply_filters( 'widget_title', $title ) . $args['after_title'];
}

$widget_id = $args['widget_id'];

$widget_id = preg_replace( '/[^0-9]/', '', $widget_id );

echo '<div class="image-carousel-widget">';
    $images = $instance['images'];
    $options = $instance['slideshow'];
    $imageattr = $instance['settings'];

    $classes = array();

    $classes[] = 'rawb-image-carousel';
    $classes[] = 'owl-carousel';
    $classes[] = 'owl-theme';
    $classes[] = $options['class'] ? ' ' . $options['class'] : '';

    $attr = array(
        'id' => 'image-carousel-' . (int)$widget_id,
        'class' => esc_attr( implode( ' ', $classes ) ),
        'data-instance' => (int)$widget_id
    );

    $attributes = array();

    $attributes['items'] = (int) $slides;

    $attributes['navigation'] = $options['navigation'] == true ? 'true' : 'false';
    $attributes['pagination'] = $options['pagination'] == true ? 'true' : 'false';
    $attributes['autoplay'] = $options['autoplay'] == true ? 'true' : 'false';
    $attributes['smartspeed'] = $options['duration'] ? (int) $options['duration'] : '250';
    $attributes['fluidspeed'] = $options['speed'] ? (int) $options['speed'] : '250';
    $attributes['lazyload'] = $options['lazyload'] == true ? 'true' : 'false';
    $attributes['autowidth'] = $options['autowidth'] == true ? 'true' : 'false';
    $attributes['mergefit'] = $options['mergefit'] == true ? 'true' : 'false';
    $attributes['center'] = $options['center'] == true ? 'true' : 'false';
    $attributes['margin'] = $options['margin'];
    $attributes['id'] = 'image-carousel-' . (int) $widget_id;
    $attributes['slidesmobile'] =  $slides_mobile ? (int) $slides_mobile : (int) $slides;
    $attributes['slidestablet'] = $slides_tablet ? (int) $slides_tablet : (int) $slides;
    $attributes['loop'] = $options['loop'] == true ? 'true' : 'false';

    wp_enqueue_script( 'rawb-owl-carousel-js' );
    wp_enqueue_script( 'rawb-widgets-js' );
    wp_localize_script( 'rawb-widgets-js', 'imagecarousel' . (int)$widget_id, $attributes );

    if ( is_array( $images ) && !is_wp_error( $images ) ) { ?>
        <div <?php foreach( $attr as $name => $value ) echo $name . '="' . $value . '" ' ?>>
            <?php foreach( $images as $image ) {
                $link = sow_esc_url( $image['link'] );
                $alt = $image['alt'];
                $imagesource = wp_get_attachment_image_src( $image['image'], 'full' );
                $url = $imagesource[0];

                echo '<div>';
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
                echo '</div>';
            } ?>
        </div>
    <?php }
echo '</div>';
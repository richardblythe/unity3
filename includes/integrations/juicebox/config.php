<?php
$result = explode( "wp-content" , __FILE__ );
require($result[0] . "wp-load.php" );
echo '<?xml version="1.0" encoding="'. get_option('blog_charset').'"?'.'>'; 
    $post_id = (int) $_GET['id'];
    $images = get_post_meta( $post_id, 'unity3_gallery_images', true );

    echo '<juiceboxgallery>';
    foreach ( $images as $image_id ) {
        if (!$attachment = get_post($image_id))
            continue;

        $large = wp_get_attachment_image_src($image_id, 'large');
        $thumbnail = wp_get_attachment_image_src($image_id, 'thumbnail');
        echo '<image 
              imageURL="' . $large[0] . '" 
              thumbURL="' . $thumbnail[0] . '"
              linkURL="' . get_the_permalink() . '"
              linkTarget="_blank">' .
//            (apply_filters('juicebox_show_title', true) ? "<title><![CDATA[{$attachment->post_title}]]></title>" : '') .
            (apply_filters('juicebox_show_caption', true) ? "<caption><![CDATA[{$attachment->post_excerpt}]]></caption>" : '') .
            '</image>';
    };

    echo '</juiceboxgallery>';
die();
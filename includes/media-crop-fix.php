<?php

function rblythe_image_resize_dimensions( $output, $orig_w, $orig_h, $dest_w, $dest_h, $crop  ) {
    if ( $crop ) {
        // crop the largest possible portion of the original image that we can size to $dest_w x $dest_h
        $aspect_ratio = $orig_w / $orig_h;
        $new_w = min($dest_w, $orig_w);
        $new_h = min($dest_h, $orig_h);

        if ( ! $new_w ) {
            $new_w = (int) round( $new_h * $aspect_ratio );
        }

        if ( ! $new_h ) {
            $new_h = (int) round( $new_w / $aspect_ratio );
        }

        $size_ratio = max($new_w / $orig_w, $new_h / $orig_h);

        $crop_w = round($new_w / $size_ratio);
        $crop_h = round($new_h / $size_ratio);

        if ( ! is_array( $crop ) || count( $crop ) !== 2 ) {
            $crop = array( 'center', 'center' );
        }

        list( $x, $y ) = $crop;

        if ( 'left' === $x ) {
            $s_x = 0;
        } elseif ( 'right' === $x ) {
            $s_x = $orig_w - $crop_w;
        } else {
            $s_x = floor( ( $orig_w - $crop_w ) / 2 );
        }

        if ( 'top' === $y ) {
            $s_y = 0;
        } elseif ( 'bottom' === $y ) {
            $s_y = $orig_h - $crop_h;
        } else {
            $s_y = floor( ( $orig_h - $crop_h ) / 2 );
        }
    } else {
        // don't crop, just resize using $dest_w x $dest_h as a maximum bounding box
        $crop_w = $orig_w;
        $crop_h = $orig_h;

        $s_x = 0;
        $s_y = 0;

        list( $new_w, $new_h ) = wp_constrain_dimensions( $orig_w, $orig_h, $dest_w, $dest_h );
    }
    
    /**ADDED checks to see if the src image has been cropped */
    $src_cropped = false;
    if ( !empty($_REQUEST['history']) ) {
        $changes = json_decode( wp_unslash($_REQUEST['history']) );
        foreach ( $changes as $key => $obj ) {
            if ($src_cropped = isset($obj->c))
                break;                    
        }
    }

    /**ADDED skip the WP evaulation if $src_cropped is true**/
    // if the resulting image would be the same size or larger we don't want to resize it
    if (!$src_cropped && $new_w >= $orig_w && $new_h >= $orig_h && $dest_w != $orig_w && $dest_h != $orig_h ) {
        return false;
    }

    // the return array matches the parameters to imagecopyresampled()
    // int dst_x, int dst_y, int src_x, int src_y, int dst_w, int dst_h, int src_w, int src_h
    return array( 0, 0, (int) $s_x, (int) $s_y, (int) $new_w, (int) $new_h, (int) $crop_w, (int) $crop_h );
    
}
add_filter( 'image_resize_dimensions', 'rblythe_image_resize_dimensions', 10, 6);


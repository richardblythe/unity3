<?php

function aos_global_options( $localize ) {
    $localize = array_merge($localize,   array(
        'aos' => array(
            'init' => array(
                'once' => true,
                'duration' => 1000
        ))
    ));
    return $localize;
}
add_filter('unity3/localize/front', 'aos_global_options', 10, 1);

//patch for some blocks that throw an error with added attributes
add_action( 'wp_loaded', function() {

    $registered_blocks = WP_Block_Type_Registry::get_instance()->get_all_registered();

    foreach( $registered_blocks as $name => $block ) {

        $block->attributes['aosEffect'] = array(
            'type'    => 'string',
            'default' => '',
        );
    }

}, 100);

add_filter( 'render_block',  function( $block_content, $block ) {

    if ( isset($block['attrs']['aosEffect'] ) && false === strpos($block_content, 'data-aos=') ) {
        return '<div data-aos="' . $block['attrs']['aosEffect'] . '">' . $block_content . '</div>';
    }
    return $block_content;

}, 100, 2 );
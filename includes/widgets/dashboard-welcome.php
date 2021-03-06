<?php

// add new dashboard widgets
function unity3_add_dashboard_widgets() {
    wp_add_dashboard_widget( 'unity3_dashboard_welcome', 'Welcome', 'unity3_add_welcome_widget' );
}
function unity3_add_welcome_widget(){ ?>
    <img style="float: left; margin-right: 10px;" src="<?php echo Unity3::$url . '/assets/images/unity3_logo_100.png'; ?>" />
    This content management system has been create for you by Unity 3 Software.  Located on the left is the main menu bar,
    which allows you to manage the content of your website.  You can add/edit text content as well as add/edit
    images with the integrated image gallery control. If you have any questions regarding this admin area, <a href="mailto:unity3software@gmail.com" target="_blank">please feel free to email.</a>
<?php }

add_action( 'wp_dashboard_setup', 'unity3_add_dashboard_widgets' );
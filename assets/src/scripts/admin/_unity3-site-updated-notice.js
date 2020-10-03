/*
Site Update Notice
 */
jQuery(document).ready( function($) {

    var isUpdating = false;
    var $popup = $( "#update-site-notice-popup" );
    if ( $popup.length === 0)
        return;

    $popup.on('click', '.status-ok', function (e) {
        e.preventDefault();

        if (isUpdating)
            return;

        isUpdating = true;
        var $this = $(this);
        $.ajax({
            url: ajaxurl,
            data: {
                action: 'unity3_site_updated_notice',
                unity3_time: $("#unity3-site-update-time").val(),
                unity3_message: $("#unity3-site-update-message").val()
            },
            success: function(data) {
                if ($.trim(data)) {
                    $('.unity3-site-updated-notice .content').html(data.data);
                }
                $popup.close();
                isUpdating = false;
            }
        });
    });

    $(document).on( 'click', '.unity3-site-updated-notice .notice-dismiss', function() {

        $.ajax({
            url: ajaxurl,
            data: {
                action: 'unity3_site_updated_notice_dismiss'
            }
        })

    });

});



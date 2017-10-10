jQuery(document).ready( function($) {

    "use strict";

    $( "#unity3-site-update-dialog" ).dialog({
        autoOpen: false,
        modal: true,
        buttons: {
            "Update": function() {
                var $this = $(this);
                $.ajax({
                    url: ajaxurl,
                    data: {
                        action: 'unity3_site_updated_notice',
                        unity3_time: $("#unity3-site-update-time").val(),
                        unity3_inspiration: $("#unity3-site-update-inspiration").val()
                    },
                    success: function(data) {
                        $this.dialog( "close" );
                    }
                });
            },
            "Cancel": function() {
                $( this ).dialog( "close" );
            }
        }
    });

    $(document).on( 'click', '#wp-admin-bar-unity3-site-updated-notice', function() {

        $( "#unity3-site-update-dialog" ).dialog( "open" );

    })

    $(document).on( 'click', '.unity3-site-updated-notice .notice-dismiss', function() {

        $.ajax({
            url: ajaxurl,
            data: {
                action: 'unity3_site_updated_notice_dismiss'
            }
        })

    })

});



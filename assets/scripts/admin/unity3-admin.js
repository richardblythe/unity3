/*
Adminimize
 */
jQuery(document).ready( function($) {

    //adminimize helper function
    $('.settings_page_adminimize-adminimize').on('click', 'input[type="checkbox"]', function(e) {
        if (e.shiftKey) {
            var checkstate = $(this).is(":checked");
            //check all sibling checkboxes
            $(this).parents('tr').find('input[type="checkbox"]').prop('checked', checkstate);
        }
    });
});
/*
Drag Sort Posts
 */
jQuery(document).ready( function($) {

    "use strict";

    //Attach sortable to the tbody, NOT tr
    $("tbody#the-list").sortable({
        cursor: "move",
        axis: "y",
        start: function(e, ui){
            ui.placeholder.height(ui.item.height());
        },
        update: function(event, ui) {
            var serialized = {};

            $(this).children().each( function(index, el) {
                serialized[el.id.split("-")[1]] = index;
            });

            $.post(ajaxurl, {
                action:'unity3_drag_sort_posts',
                posts: serialized
            });
        }
    });

    $("#the-list .column-dragsort").attr('title', unity3.dragsort.tooltip);
});

/*
Site Update Notice
 */
jQuery(document).ready( function($) {

    "use strict";

    $( "#unity3-site-update-dialog" ).dialog({
        autoOpen: false,
        modal: true,

        open: function( event, ui ) {
            var $buttonset = $('#unity3-site-update-dialog').parent().find('.ui-dialog-buttonset');
            var $progress = $buttonset.find('.ajax-progress');
            //if the ajax progress bar does not exists...
            if (0 === $progress.length) {
                $progress = $('<img style="display: none;" class="ajax-progress">');
                $progress.attr("src", unity3.site_update.progress_gif);
                $buttonset.append($progress);
            }
            $buttonset.find('.ui-button').show();
            $progress.hide();
        },

        buttons: {
            "Update": function() {
                var $this = $(this);
                var $buttonset = $('#unity3-site-update-dialog').parent().find('.ui-dialog-buttonset');
                $buttonset.children().hide();
                $buttonset.find('.ajax-progress').show();
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



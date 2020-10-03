/*
Confirmation Popup
 */
jQuery(document).ready(function($){

    $(".cd-popup").each(function(){
        $this = $(this);

        $this.init.prototype.open = function(e) {
            $(this).find('.spinner').css('visibility', 'hidden');
            $(this).addClass('is-visible').trigger('open');
        };

        $this.init.prototype.close = function(e) {
            $(this).removeClass('is-visible').trigger('close');
        };

    }).on('click','.status-ok', function(e){

        $(this).closest('.cd-popup').find('.spinner').css('visibility', 'visible');

    }).on('click','.cd-popup-close', function(e){
        e.preventDefault();
        $(this).closest('.cd-popup').close();
    });


    //open a popup via registered trigger element
    $('.cd-popup-trigger').on('click', function(event){
        event.preventDefault();
        var $this = $(this);
        var popup_id;

        if ($this.is('a')) {
            //get the popup id from the href
            popup_id = (this).attr('href');
        } else if( $this.find('a').length ) {
            //get the popup id from a child a.href
            popup_id = $this.find('a')[0].href
        } else if ( $this.closest('a').length ) {
            //get the popup id from a parent a.href
            popup_id = $this.closest('a');
        }

        if (typeof popup_id === 'string') {
            var hash_index = popup_id.indexOf('#');
            if (hash_index >= 0) {
                $( popup_id.substr(hash_index) ).open();
            }
        }
    });


    //close popup when clicking the esc keyboard button
    $(document).keyup(function(event){
        if(event.which === '27'){
            $('.cd-popup.is-visible').close();
        }
    });
});
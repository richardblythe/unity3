jQuery(document).ready( function($) {

    //target elements
    var $slide_preset_ul = $('div[data-name="ss3_slide_preset"] ul.acf-image-select-list');
    //if the plugin is not active, there will be no Slide Presets
    if (0 === $slide_preset_ul.length)
        return;

    var $selected_preset_li = $slide_preset_ul.find('.acf-image-select-selected').closest("li");
    var $slide_image_top_label = $('label[for="acf-unity3_slide_field_image"]');
    var $slide_image_bg = $('div[data-key="unity3_slide_field_image"] .image-wrap.show-if-value');
    var $slide_image = $slide_image_bg.find('img[data-name="image"]');

    //

    //input elements...
    var $input_bg_color = $('input[name="acf[unity3_slide_smartslider3_appearance_background_color]"]');
    var $input_opacity = $('input[name="acf[unity3_slide_smartslider3_appearance_background_image_opacity]"]');
    var $input_blur = $('input[name="acf[unity3_slide_smartslider3_appearance_background_image_blur]"]');

    //functions
    var set_bg_color = function (bg_color) {
        if ('string' !== typeof bg_color) {
            bg_color = '';
        }
        bg_color = bg_color.trim();
        bg_color = ('' === bg_color ? 'transparent' : bg_color);
        $slide_image_bg.css('background-color', bg_color);
    };

    var set_opacity = function (opacity) {
        opacity = parseInt(opacity);
        opacity = (-1 === opacity ? 100 : opacity);
        $slide_image.css('opacity', opacity + '%');
    };

    var set_blur = function (blur) {
        blur = parseInt(blur);
        blur = (-1 === blur ? 0 : blur);
        $slide_image.css('filter', 'blur(' + blur + 'px)');
    };

    //set the initial state...
    set_bg_color($input_bg_color.val());
    set_opacity($input_opacity.val());
    set_blur($input_blur.val());

    //scroll to the current slide preset
    var leftOffset = $selected_preset_li.offset().left - $slide_preset_ul.offset().left + $slide_preset_ul.scrollLeft();
    $slide_preset_ul.animate({scrollLeft: leftOffset});

    //listen for changes
    $input_bg_color.on('change', function (e) {
        set_bg_color($(this).val());
    });
    $input_opacity.on('change', function (e) {
        set_opacity($(this).val());
    });
    $input_blur.on('change', function (e) {
        set_blur($(this).val());
    });

    //wire up the custom preset popup dialog
    var $popup = $('#ss3_custom_popup');
    $('#acf-ss3_slide_preset-custom').on('click', function (e) {
        $popup.open();
    });

    $popup.on('click', '.status-ok', function (e) {
        $(window).off("beforeunload", null);
    });
});
/*
 *   Vendor Patch: acf-image-select
 */
(function($){

    var Field = acf.Field.extend({

        type: 'image_select',

        events: {
            'click input[type="radio"]': 'onClick'
        },

        $control: function(){
            return this.$('.acf-image-select');
        },

        $input: function(){
            return this.$('input:checked');
        },

        setValue: function( val ){
            this.$('input[value="' + val + '"]').prop('checked', true).trigger('change');
        },

        onClick: function( e, $el ){

            // vars
            var $label = $el.parent('label');
            var selected = $label.hasClass('selected');

            // remove previous selected
            this.$('.selected').removeClass('selected');

            // add active class
            $label.addClass('selected');
            //of the clicked item was not already selected, trigger the change event
            if (!selected) {
                $el.prop('checked', true).trigger('change');
            }
            // allow null
            if( this.get('allow_null') && selected ) {
                $label.removeClass('selected');
                $el.prop('checked', false).trigger('change');
            }
        }
    });

    acf.registerFieldType( Field );
    acf.registerConditionForFieldType('selectEqualTo', 'image_select');
    acf.registerConditionForFieldType('selectNotEqualTo', 'image_select');

})(jQuery);
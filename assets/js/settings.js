jQuery(document).ready(function ($) {

    // Color Picker
    options = {
        defaultColor: '#FFFFFF3F',
        color: false,
        mode: 'hsl',
        controls: {
            horiz: 's', // horizontal defaults to saturation
            vert: 'l', // vertical defaults to lightness
            strip: 'h' // right strip defaults to hue
        },
        hide: true, // hide the color picker by default
        border: true, // draw a border around the collection of UI elements
        target: false, // a DOM element / jQuery selector that the element will be appended within. Only used when called on an input.
        width: 200, // the width of the collection of UI elements
        palettes: ['#125', '#459', '#78b', '#ab0', '#de3', '#f0f'], // show a palette of basic colors beneath the square.
        change: function(event, ui) {
            // event = standard jQuery event, produced by whichever control was changed.
            // ui = standard jQuery UI object, with a color member containing a Color.js object

            // change the headline color
            $("#headlinethatchanges").css( 'color', ui.color.toString());
        }
    }
    $('#col-color').wpColorPicker(options);


    // Uploader
    var background_uploader;
    $('#background-selector').click(function () {
        if(background_uploader !== undefined) {
            background_uploader.open();
            return;
        }
        background_uploader = wp.media({
            title: 'Select background image',
            button: {
                text: 'Select',
            },
            // multiple: true,
            library: {
                type: 'image',
                // type: ['image', 'audio', 'video'],
            }
        });
        background_uploader.on('select', function () {
            let selected = background_uploader.state().get('selection').first().toJSON().url;
            console.log(selected);
            $('#background').val(selected);
            $('#background-preview').attr('src',selected)
        });

        background_uploader.open();
    });


    // Code Editor
    wp.codeEditor.initialize($('#css_code'), mekatron_code_mirror_settings);

});
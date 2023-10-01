jQuery(document).ready(function ($) {
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

});
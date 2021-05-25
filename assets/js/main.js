(function($) {
    'use strict';
    
    $(document).on('click', '.ips', function(event) {
        event.preventDefault();

        $('html, body').animate({
            scrollTop: $(this.hash).offset().top
        }, 600);
    });

}(jQuery));

$("#js-rotating").Morphext({
    animation: "bounceIn",
    separator: ",",
    speed: 3000,
});

$(document).ready( function () {
    $('#manage_items').DataTable({
        responsive: true
    });
} );
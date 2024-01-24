$(document).ready(function(){
    // Timeleft
    const hours = $(".tl-h");
    const minutes = $(".tl-m");
    const seconds = $(".tl-s");
    const targetDate = window.targetDate;
    const zeroPad = (num, places) => String(num).padStart(places, '0')

    function convertMillis(milliseconds, format) {
        var hours, minutes, seconds, total_hours, total_minutes, total_seconds;
        
        total_seconds = parseInt(Math.floor(milliseconds / 1000));
        total_minutes = parseInt(Math.floor(total_seconds / 60));
        total_hours = parseInt(Math.floor(total_minutes / 60));

        seconds = parseInt(total_seconds % 60);
        minutes = parseInt(total_minutes % 60);
        hours = parseInt(total_hours % 24);
        
        switch(format) {
            case 's':
                return total_seconds;
            case 'm':
                return total_minutes;
            case 'h':
                return total_hours;
            default:
                return { h: hours, m: minutes, s: seconds };
        }
    };

    window.setInterval( function()
    {
        var date = Date.now();
        if (date > targetDate)
        {
            $('#spinner').removeClass('bounce');
            $('#spinner').addClass('rotate-center');
            clearInterval();
            if(typeof a === 'undefined') {
                var a = setTimeout(function() {
                    window.location = window.targetLocation;
                }, 3000);
            }
        } else {
            var millis = targetDate - date;
            var millisObject = convertMillis(millis);

            hours.text(zeroPad(millisObject.h, 2));
            minutes.text(zeroPad(millisObject.m), 2);
            seconds.text(zeroPad(millisObject.s, 2));
        };
    }, 1000);
});
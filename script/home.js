

$(function () {
    $('#john-cha').hover(function () {
        $('#john-cha').css('width', '50%');
        $('#john-cha-img').css('opacity', '1');
        $('#members-text').css('width', '20%')
    }, function () {
        // on mouseout, reset
        $('#john-cha').css('width', '');
        $('#john-cha-img').css('opacity', '');
        $('#members-text').css('width', '')
    });
});

$(function () {
    $('#kim-daniel').hover(function () {
        $('#kim-daniel').css('width', '50%');
        $('#kim-daniel-img').css('opacity', '1');
        $('#members-text').css('width', '20%')
    }, function () {
        // on mouseout, reset
        $('#kim-daniel').css('width', '');
        $('#kim-daniel-img').css('opacity', '');
        $('#members-text').css('width', '')
    });
});

$(function () {
    $('#shin-donggyu').hover(function () {
        $('#shin-donggyu').css('width', '50%');
        $('#shin-donggyu-img').css('opacity', '1');
        $('#members-text').css('width', '20%')
    }, function () {
        // on mouseout, reset
        $('#shin-donggyu').css('width', '');
        $('#shin-donggyu-img').css('opacity', '');
        $('#members-text').css('width', '')
    });
});


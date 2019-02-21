$(function() {

    'use strict';
    //Dashboard
    $('.toggle-info').click(function() {

        $(this).toggleClass('selected').parent().next('.panel-body').fadeToggle(100);

        if ($(this).hasClass('selected')) {

            $(this).html('<i class="fa fa-minus fa-lg"></i>');

        } else {

            $(this).html('<i class="fa fa-plus fa-lg"></i>');

        }

    });

    // Adjust Slider Height
    var winH = $(window).height(),
        upperH = $('.upper-bar').innerHeight(),
        navH = $('.navbar').innerHeight();
    $('.slider, .carousel-item').height(winH - (upperH + navH));

    // Featured Work Shuffle
    $('.featured-work ul li').on('click', function() {
        $(this).addClass('active').siblings().removeClass('active');
        if ($(this).data('class') === 'all') {
            $('.shuffle-imgs .col-md').css('opacity', 1);
        } else {
            $('.shuffle-imgs .col-md').css('opacity', '.08');
            $($(this).data('class')).parent().css('opacity', 1);
        }
    });




    // Hide Placeholder On Form Focus

    $('[placeholder]').focus(function() {

        $(this).attr('data-text', $(this).attr('placeholder'));

        $(this).attr('placeholder', '');

    }).blur(function() {

        $(this).attr('placeholder', $(this).attr('data-text'));

    });

    $("select").selectBoxIt({

        autoWidth: false

    });

    // Convert Password Field To Text Field On Hover

    var passField = $('.password');

    $('.show-pass').hover(function() {

        passField.attr('type', 'text');

    }, function() {

        passField.attr('type', 'password');

    });

    // Confirmation Message On Button

    $('.confirm').click(function() {

        return confirm('Are You Sure?');

    });



});
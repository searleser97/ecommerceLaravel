
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('./bootstrap-editable')
require('./material');
require('./ripples');

$.fn.editable.defaults.mode = 'inline';
$.fn.editable.defaults.ajaxOptions = {type: 'PUT'};
$(document).ready(function() {
    $('.set-guide-number').editable();
    $('.select-status').editable({
        source: [
        {value: 'created', text: 'Created'},
        {value: 'sent', text: 'Sent'},
        {value: 'received', text: 'Received'}
        ]
    });

    $('.add-to-cart').on('submit', function(e) {
        e.preventDefault();
        var form = $(this);

        var button = form.find("[type='submit']");
        $.ajax({
            url: form.attr('action'),
            method: form.attr('method'),
            data: form.serialize(),
            beforeSend: function() {
                button.val('Loading...');
            },
            success: function() {
                button.css('background-color', '#00c853').val('Added');

                setTimeout(function() {
                    restartButton(button);
                }, 2000);
            },
            error: function(err) {
                button.css('background-color', '#d50000').val('Error');

                setTimeout(function() {
                    restartButton(button);
                }, 2000);
            }
        });
        return false;
    });

    function restartButton(button) {
        button.val('Add to cart').attr('style', '');
    }
});

$.material.init();

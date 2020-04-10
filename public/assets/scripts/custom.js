$(document).ready(function () {

    // Show/Hide Password
    $('.toggleViewPassword').on('click', function() {

        let $input = $(this).closest('.wrapperPassword').find('input');
        let $icon = $(this).closest('.wrapperPassword').find('.fa');

        if ($input.attr('type') == "text") {
            $input.attr('type', 'password');
            $icon.removeClass('fa-eye-slash');
            $icon.addClass('fa-eye');
        } else if ($input.attr('type') == 'password') {
            $input.attr('type', 'text');
            $icon.removeClass('fa-eye');
            $icon.addClass('fa-eye-slash');
        }
        
    });
    // END Show/Hide Password

});
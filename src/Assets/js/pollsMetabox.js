(function ($) {
    const addButton = $('.polliest-add_option');
    const optionsContainer = $('#polliest-options');

    const postID = $('input[data-id]').data('id');

    console.log(postID);

    addButton.on('click', function (evt) {
        evt.preventDefault();

        optionsContainer.append(`<input type="text" name="${postID}-option[]" data-option="${postID}-option">`);
    });

})(jQuery);
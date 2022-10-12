(function ($) {
    const addButton = $('.quiziest-add_option');
    const optionsContainer = $('#quiziest-options');

    const postID = $('input[data-id]').data('id');

    const correctOption = $('#quiziest-options input[data-correct]');

    console.log(postID);

    addButton.on('click', function (evt) {
        evt.preventDefault();

        optionsContainer.append(`
            <div class="quiziest-option">
                <input type="text" name="${postID}-option[]" data-option="${postID}-option">
                <div class="quiziest-option__actions">
                    <button class="quiziest-option__remove">Remove</button>
                    <div class="quiziest-option__select">
                        <p>select</p>
                    </div>
                </div>
            </div>
        `);
    });

    optionsContainer.on('click', '.quiziest-option__remove', function (evt) {
        evt.preventDefault();

        $(this).parent().remove();
    });

    optionsContainer.on('click', '.quiziest-option__select', function (evt) {
        evt.preventDefault();

        $('.quiziest-option').removeClass('selected');
        $(this).parents('.quiziest-option').addClass('selected');

        correctOption.val()
    });

})(jQuery);
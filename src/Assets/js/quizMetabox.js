(function ($) {
    const addButton = $('.quiziest-add__option');
    const saveButton = $('.quiziest-option__save');
    const optionsContainer = $('#quiziest-options');

    const postID = $('input[data-id]').data('id');

    console.log(postID);

    addButton.on('click', function (evt) {
        evt.preventDefault();

        optionsContainer.append(`
            <div class="quiziest-option">
                <input type="text" name="option" data-id="${Date.now()}">
                <div class="quiziest-option__actions">
                    <button class="quiziest-option__remove">Remove</button>
                    <div class="quiziest-option__select">
                        <p>select</p>
                    </div>
                </div>
            </div>
        `);
    });

    saveButton.on('click', function (evt) {
        evt.preventDefault();

        const options = $('input[name="option"]');
        const correctOption = $('.quiziest-option.selected > input[name="option"]').data('id');

        console.log(correctOption);

        $.ajax({
            type: 'post',
            url: ajax.url,
            data: {
                action: 'saveQuizOptions',
                data: {
                    postID,
                    options: [...options].map(function (el) {
                        return {
                            value: el.value,
                            id: el.dataset.id
                        }
                    }),
                    correctOption
                }
            },
            success: function (res) {
                console.log('Success: ', res);
            },
            error: function (err) {
                console.error(err.message);
            }
        })
    });

    // Remove button
    optionsContainer.on('click', '.quiziest-option__remove', function (evt) {
        evt.preventDefault();

        $(this).parents('.quiziest-option').remove();
    });

    // Select correct option button
    optionsContainer.on('click', '.quiziest-option__select', function (evt) {
        evt.preventDefault();

        $('.quiziest-option').removeClass('selected');
        $(this).parents('.quiziest-option').addClass('selected');
    });

})(jQuery);

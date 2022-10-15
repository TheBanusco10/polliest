<button class="quiziest-add__option">Add option</button>

<section id="quiziest-options">
    {{--    {!! wp_nonce_field() !!}--}}
    <input type="hidden" data-id="{{$post_ID}}">
    <input type="hidden" name="{{$post_ID}}-correct" data-correct>

    @if (!empty($options) && $correctOption)
        @foreach($options as $option)
            <div class="quiziest-option {{$correctOption === $option['id'] ? 'selected' : ''}}">
                <input type="text" name="option" data-id="{{$option['id']}}" value="{{$option['value']}}">
                <div class="quiziest-option__actions">
                    <button class="quiziest-option__remove">Remove</button>
                    <div class="quiziest-option__select">
                        <p>select</p>
                    </div>
                </div>
            </div>
        @endforeach
    @endif

</section>

<section>
    <button class="quiziest-option__save">Save</button>
</section>
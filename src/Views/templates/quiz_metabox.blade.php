<button class="quiziest-add_option">Add option</button>

<section id="quiziest-options">
    {{--    {!! wp_nonce_field() !!}--}}
    <input type="hidden" data-id="{{$post_ID}}">
    <input type="hidden" name="{{$post_ID}}-correct" data-correct>

    @if (!empty($options))
        @foreach($options as $option)
            <div class="quiziest-option">
                <input type="text" name="{{$post_ID}}-option[]" value="{{$option}}">
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
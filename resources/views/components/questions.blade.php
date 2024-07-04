<div class="questions">
    @foreach ($questions as $question)
        <div class="question__item">
            <h3 class="question__header h4">{{ $question->question }}</h3>
            <p class="question__body">{{ $question->answer }}</p>
        </div>    
    @endforeach
</div>

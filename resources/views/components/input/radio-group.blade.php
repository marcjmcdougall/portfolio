<div class="form-group__radio-wrap">
    @if(true === $showAll)
        <div class="form-item form-item--radio">
            <label for="all-{{ $name }}">
                <input type="radio" 
                    id="all-{{ $name }}" 
                    name="{{ $name }}" 
                    value="" 
                    @isset($model) wire:model.live.debounce="{{ $model }}" @endisset />
                <span>All</span>
            </label>
        </div>
    @endif

    @foreach ($optionsWithKeys as $key => $value)
        <div class="form-item form-item--radio">
            <label for="{{ $key }}">
                <input id="{{ $key }}" 
                    type="radio" 
                    name="{{ $name }}" 
                    value="{{ $key }}" 
                    @isset($model) wire:model.live.debounce="{{ $model }}" @endisset />
                <span>{{ $value }}</span>
            </label>
        </div>
    @endforeach
</div>
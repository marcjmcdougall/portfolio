<div class="form-group__radio-wrap">
    @foreach ($optionsWithKeys as $key => $value)
        <div class="form-item form-item--radio">
            <label for="{{ $key }}">
                <input id="{{ $key }}" 
                    type="checkbox" 
                    name="{{ $name }}[]" 
                    value="{{ $key }}" 
                    @isset($model) wire:model.live="{{ $model }}" @endisset />
                <span>{{ $value }}</span>
            </label>
        </div>
    @endforeach
</div>
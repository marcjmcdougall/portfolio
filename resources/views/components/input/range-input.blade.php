<div class="form-item__input-wrap">
    <input type="range" 
        name="{{ $name }}"
        min="50000" 
        max="300000"
        @isset($model) wire:model.live.debounce.500ms="{{ $model }}" @endisset>
    <p>Value: {{ $value }}</p>
</div>
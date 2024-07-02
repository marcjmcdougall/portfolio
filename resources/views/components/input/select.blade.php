<div class="form-group__select-wrap">
    <select class="form-group__select-item" 
            name="{{ $name }}"
            @isset($model) wire:model.live.debounce.500ms="{{ $model }}" @endisset>
        <option value="">Select an option</option>
        @foreach ($optionsWithKeys as $key => $value)
            <option value="{{ $key }}" {{ $selected == $key ? 'selected' : '' }}>{{ $value }}</option>
        @endforeach
    </select>
    <span class="form-group__select-dropdown">
        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25" fill="none">
            <path d="M6.87476 9.5415L12.8748 15.5415L18.8748 9.5415" stroke="#353535" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </span>
</div>
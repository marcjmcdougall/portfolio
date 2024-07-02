<div @class([
            'form-item__input-wrap',
            'has-icon' => $name === 'search',
            'layout' => $layout,
        ])>
    @if('textarea' != $type)
        {{-- @if('' != $value && $clearable)
            <a class="form-item__input-clear" wire:click="$dispatch('clear-filter', { name : '{{ $name }}' } );">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </a>
        @endif --}}

        @if('search' == $name)
            <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path d="M11 19C15.4183 19 19 15.4183 19 11C19 6.58172 15.4183 3 11 3C6.58172 3 3 6.58172 3 11C3 15.4183 6.58172 19 11 19Z" stroke="#B3B3B3" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M21 21L16.65 16.65" stroke="#B3B3B3" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        @endif

        <input id="{{ $name }}" 
            type="{{ $type }}" 
            placeholder="{{ $placeholder }}" 
            name="{{ $name }}"
            value="{{ old($name, $value) }}"
            {{ $disabled ? 'disabled' : '' }}
            @class([
                'error' => $errors->has($name),
                'disabled' => $disabled,
            ])
            @isset ($model) wire:model.live.debounce.500ms="{{ $model }}" @endisset />

        @if ( null != $helpText )
            <div class="form-item__help-text">{{ $helpText }}</div>
        @endif
    @else
        <textarea
            data-help-text="{{ $helpText }}"
            id="{{ $name }}"
            placeholder="{{ $placeholder }}" 
            name="{{ $name }}"
            style="min-height: {{ $height }}px"
            {{ $disabled ? 'disabled' : '' }}
            @class([
                'error' => $errors->has($name),
                'disabled' => $disabled,
            ])
            @isset($model) wire:model.live.debounce.500ms="{{ $model }}" @endisset >{{ old($name, $value) }}</textarea>

        @if ( null != $helpText )
            <div class="form-item__help-text">{{ $helpText }}</div>
        @endif
    @endif
</div>
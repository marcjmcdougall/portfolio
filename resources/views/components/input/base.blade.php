<div class="form-item {{ $layout ?? 'block' }}" @if(isset($width)) style="max-width: {{ $width }}px;" @endif>
    @empty ( $hideLabel )
        <div class="form-item__label">
            <label for="{{ $name }}">
                {{ $label }}
                @isset ( $required )
                    <span class="required">*</span>
                @endisset
            </label>
            @isset ( $description )
                <p class="form-item__description">{{ $description }}</p>
            @endisset
        </div>
    @endisset
    <div class="form-item__content">
        {{ $slot }}

        @error($name)
            <div class="error-label">{{ $message }}</div>
        @enderror
    </div>
</div>
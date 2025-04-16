@php
    $formId = Str::uuid();
@endphp

<form action="/resources/quick-scan" method="POST" class="form {{ 'horizontal' == ($orientation ?? 'vertical') ? 'form--inline' : '' }} layout--{{ $orientation ?? 'vertical' }}" id="{{ $formId }}">
    @csrf

    <!-- URL Input -->
    <div class="form-item">
        <label class="form-group__label" for="url">Landing Page</label>
        <input type="text" value="{{ old('url') }}" id="url" name="url" required placeholder="https://example.com">
        @error('url')
            <p>{{ $message }}</p>
        @enderror
    </div>
    
    <!-- Email Input -->
    <div class="form-item">
        <label class="form-group__label" for="email">Your Email</label>
        <input type="email" value="{{ old('email') }}" id="email" name="email" required placeholder="Email">
        @error('email')
            <p>{{ $message }}</p>
        @enderror
    </div>
    
    @if('veritcal' == ($orientation ?? 'vertical'))
        <!-- Consent Checkbox -->
        <div>
            <div class="form-item--checkbox">
                <input type="checkbox" id="consent--{{ $formId }}" name="consent" required>
                <label for="consent--{{ $formId }}">
                    I agree to receive occasional (very fun) marketing emails.
                </label>
            </div>
            @error('terms')
                <p>{{ $message }}</p>
            @enderror
        </div>
    @endif

    @error('limit_reached')
        <div class="alert alert-warning">
            {{ $message }}
        </div>
    @enderror
    
    <!-- Submit Button -->
    <div class="quick-scan-hero__actions">
        @if($glimmer ?? true)
            <div class="glimmer-container">
                <span class="blob"></span>
                <button class="btn btn--secondary btn--large quick-scan-hero__button homepage-hero__btn" type="submit">Analyze Landing Page</button>
            </div>
        @else
            <button class="btn btn--secondary btn--large quick-scan-hero__button homepage-hero__btn" type="submit">Analyze Landing Page</button>
        @endif
        <p class="newsletter-opt-in__aside margin-bottom--strip">100% free.  Limited to 1 analysis / day.</p>
    </div>

    @if('horizontal' == ($orientation ?? 'vertical'))
        <!-- Consent Checkbox -->
        <div>
            <div class="form-item--checkbox">
                <input type="checkbox" id="consent--{{ $formId }}" name="consent" required>
                <label for="consent--{{ $formId }}">
                    I agree to receive occasional (very fun) marketing emails.
                </label>
            </div>
            @error('terms')
                <p>{{ $message }}</p>
            @enderror
        </div>
    @endif
</form>
@props([
    'quickScanEnabled' => $quickScanEnabled ?? true,
])

@php
    $formId = Str::uuid();
@endphp

<form action="/resources/quick-scan" method="POST" class="form form--{{ !$quickScanEnabled ? 'disabled' : '' }}" id="{{ $formId }}">
    @csrf

    <!-- URL Input -->
    <div class="form-item">
        <label class="form-group__label" for="url">Landing Page</label>
        <input type="text" value="{{ old('url') }}" {{ !$quickScanEnabled ? 'disabled' : '' }} class="@error('url') input--error @enderror" id="url" name="url" required placeholder="https://example.com">
        @error('url')
            <p class="error--inline">{{ $message }}</p>
        @enderror
    </div>
    
    <!-- Email Input -->
    <div class="form-item">
        <label class="form-group__label" for="email">Your Email</label>
        <input type="email" value="{{ old('email') }}" {{ !$quickScanEnabled ? 'disabled' : '' }} class="@error('email') input--error @enderror" id="email" name="email" required placeholder="Email">
        @error('email')
            <p class="error--inline">{{ $message }}</p>
        @enderror
    </div>
    
    <!-- Consent Checkbox -->
    <div>
        <div class="form-item--checkbox">
            <input type="checkbox" {{ !$quickScanEnabled ? 'disabled' : '' }} class="@error('consent') input--error @enderror" id="consent--{{ $formId }}" name="consent" required>
            <label for="consent--{{ $formId }}">
                I agree to receive occasional (very fun) marketing emails.
            </label>
        </div>
        @error('consent')
            <p class="error--inline">{{ $message }}</p>
        @enderror
    </div>

    @error('limit_reached')
        <div class="alert alert-warning">
            {{ $message }}
        </div>
    @enderror
    
    @if ($errors->has('g-recaptcha-response'))
        <div class="alert alert-error">
            <p>ReCaptcha challenge failed</p>
        </div>
    @endif
    
    @if($quickScanEnabled )
        <!-- Submit Button -->
        <div class="quick-scan-hero__actions">
            @if($glimmer ?? true)
                <div class="glimmer-container">
                    <span class="blob"></span>
                    {{-- <button class="btn btn--secondary btn--large quick-scan-hero__button homepage-hero__btn" type="submit">Analyze Landing Page</button> --}}
                    {!! Anhskohbo\NoCaptcha\Facades\NoCaptcha::displaySubmit($formId, 'Analyze Landing Page', ['class' => 'btn btn--secondary btn--large quick-scan-hero__button homepage-hero__btn']) !!}
                </div>
            @else
                <button class="btn btn--secondary btn--large quick-scan-hero__button homepage-hero__btn" type="submit">Analyze Landing Page</button>
            @endif
            <p class="newsletter-opt-in__aside margin-bottom--strip">100% free.  Limited to 1 analysis / day.</p>
        </div>
    @else
        @if(!$quickScanEnabled)
            <div class="alert alert-warning">
                <p>Sorry! The QuickScan function is currently disabled – please check back later.</p>
            </div>
        @endif
    @endif
</form>
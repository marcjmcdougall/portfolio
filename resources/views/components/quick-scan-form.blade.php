    <form action="/resources/quick-scan" method="POST" class="form">
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
        
        <!-- Consent Checkbox -->
        <div>
            <div class="form-item--checkbox">
                <input type="checkbox" id="consent" name="consent" required>
                <label for="consent">
                    I agree to receive occasional (very fun) marketing emails.
                </label>
            </div>
            @error('terms')
                <p>{{ $message }}</p>
            @enderror
        </div>

        @error('limit_reached')
            <div class="alert alert-warning">
                {{ $message }}
            </div>
        @enderror
        
        <!-- Submit Button -->
        <div class="quick-scan-hero__actions">
            <div class="glimmer-container">
                <button class="btn btn--secondary btn--large quick-scan-hero__button homepage-hero__btn" type="submit">Analyze Landing Page</button>
            </div>
            <p class="newsletter-opt-in__aside margin-bottom--strip">100% free.  Limited to 1 analysis per day.</p>
        </div>
    </form>
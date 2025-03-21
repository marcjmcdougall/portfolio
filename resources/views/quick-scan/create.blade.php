<x-base> 
    <div class="container">
        <article class="quick-scan-hero">
        <div class="row">
            <div class="quick-scan-hero__text col-7">
                <h1 class="text--hero margin-top--strip">Unlock the hidden <span class="highlight">revenue</span> in your landing page.</h1>
                <form action="/resources/quick-scan" method="POST" class="form">
                    @csrf

                    <!-- URL Input -->
                    <div class="form-item">
                        <label class="form-group__label" for="url">Landing Page URL</label>
                        <input type="text" value="{{ old('url') }}" id="url" name="url" required placeholder="example.com">
                        @error('url')
                            <p>{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Email Input -->
                    <div class="form-item">
                        <label class="form-group__label" for="email">Your Email</label>
                        <input type="email" value="{{ old('email') }}" id="email" name="email" required placeholder="you@example.com">
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
                        <button class="btn btn--secondary btn--large quick-scan-hero button" type="submit">Analyze Landing Page</button>
                        <p class="newsletter-opt-in__aside margin-bottom--strip">100% free.  Limited to 1 analysis per day.</p>
                    </div>
                </form>
            </div>
            <div class="col-5 vcenter">
                <x-quick-scan-visualizer></x-quick-scan-visualizer>
            </div>
        </div>
    </div>
</x-base>
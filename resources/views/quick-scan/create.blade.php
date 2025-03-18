<x-base> 
    <div class="container">
        <article class="article">
        <div class="row">
            <div class="col-12">
                <form action="/quick-scan" method="POST">
                    @csrf
                    <h2>Website Analysis</h2>
                    
                    <!-- URL Input -->
                    <div>
                        <label for="url">Website URL</label>
                        <input type="url" value="{{ old('url') }}" id="url" name="url" required placeholder="https://example.com">
                        @error('url')
                            <p>{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Email Input -->
                    <div>
                        <label for="email">Email Address</label>
                        <input type="email" value="{{ old('email') }}" id="email" name="email" required placeholder="you@example.com">
                        @error('email')
                            <p>{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Terms Checkbox -->
                    <div>
                        <div>
                            <input type="checkbox" id="terms" name="terms" required>
                            <label for="terms">
                                I understand that by submitted this form, I am consenting to receiving some fun marketing emails from Marc.
                            </label>
                        </div>
                        @error('terms')
                            <p>{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Submit Button -->
                    <div>
                        <button type="submit">Analyze Website</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-base>
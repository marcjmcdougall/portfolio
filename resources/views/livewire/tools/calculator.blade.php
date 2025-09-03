<div class="pricing-calculator">
    <div class="row">
        <div class="col-6">
            <form class="form">
                <div class="form-item">
                    <label class="form-group__label" for="ltv">What is your customer lifetime value?</label>
                    <input type="number" 
                        value="{{ old('ltv') }}" 
                        class="@error('ltv') input--error @enderror"
                        wire:model.live="ltv"
                        id="ltv" name="ltv" 
                        required 
                        placeholder="$1,000" />
                    @error('ltv')
                        <p class="error--inline">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-item">
                    <label class="form-group__label" for="ltv">How many visitors does your site get each month?</label>
                    <input type="number" 
                        value="{{ old('traffic') }}" 
                        class="@error('traffic') input--error @enderror" 
                        id="traffic" name="traffic"
                        wire:model.live="traffic"
                        required 
                        placeholder="5,000" />
                    @error('traffic')
                        <p class="error--inline">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-item">
                    <label class="form-group__label" for="ltv">How many new leads does your website generate per month?</label>
                    <input type="number" 
                        value="{{ old('leads') }}" 
                        class="@error('leads') input--error @enderror" 
                        id="leads" name="leads"
                        wire:model.live="leads"
                        required 
                        placeholder="5,000" />
                    @error('leads')
                        <p class="error--inline">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-item">
                    <label class="form-group__label" for="ltv">How many new customers does this result in each month?</label>
                    <input type="number" 
                        value="{{ old('customers') }}" 
                        class="@error('customers') input--error @enderror" 
                        id="customers" name="customers"
                        wire:model.live="customers"
                        required 
                        placeholder="50" />
                    @error('customers')
                        <p class="error--inline">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-item">
                    <label for="tolerance" class="form-group__label">What level of risk is acceptable to you?</label>
                    <div class="radio-group">
                        <label class="radio-label">
                            <input 
                                type="radio" 
                                wire:model.live="tolerance" 
                                value="low"
                                id="low"
                            />
                            <span>Low</span>
                        </label>
                        
                        <label class="radio-label">
                            <input 
                                type="radio" 
                                wire:model.live="tolerance" 
                                value="moderate"
                                id="moderate"
                            />
                            <span>Moderate</span>
                        </label>
                        
                        <label class="radio-label">
                            <input 
                                type="radio" 
                                wire:model.live="tolerance" 
                                value="high"
                                id="high"
                            />
                            <span>High</span>
                        </label>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-6">
            <div class="pricing-calculator--statistic">
                <h2 class="pricing-calculator--statistic__value h3">{{ $this->formatCurrency($currentARR) }} / yr.</h2>
                <p class="pricing-calculator--statistic__label">Current revenue, with a traffic conversion rate of {{ $this->formatPercent($currentLeadConversionRate) }}, and a customer conversion rate of {{ $this->formatPercent($currentCustomerConversionRate) }}</p>
            </div>
            <p style="opacity: 0.4;">How we could improve:</p>
            <div class="pricing-calculator--options">
                <div class="pricing-calculator--option">
                    <h2 class="pricing-calculator--option__value h4">{{ $this->formatCurrency($fivePercentIncrease) }} / yr. <span class="pricing-calculator--option__diff">(+ {{ $this->formatCurrency($fivePercentIncrease - $currentARR)}} / yr.)</span></h2>
                    <p class="pricing-calculator--option__label">5% more traffic conversions</p>
                </div>
                <div class="pricing-calculator--option">
                    <h2 class="pricing-calculator--option__value h4">{{ $this->formatCurrency($onePercentIncrease) }} / yr. <span class="pricing-calculator--option__diff">(+ {{ $this->formatCurrency($onePercentIncrease - $currentARR)}} / yr.)</span></h2>
                    <p class="pricing-calculator--option__label">1% more traffic conversions</p>
                </div>
                <div class="pricing-calculator--option">
                    <h2 class="pricing-calculator--option__value h4">{{ $this->formatCurrency($pointOnePercentIncrease) }} / yr. <span class="pricing-calculator--option__diff">(+ {{ $this->formatCurrency($pointOnePercentIncrease - $currentARR)}} / yr.)</span></h2>
                    <p class="pricing-calculator--option__label">0.1% more traffic conversions</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row pricing-calculator__result">
        <div class="col-12">
            <h2 class="h4">You should spend {{ $this->formatCurrency($suggestedPrice) }}</h2>
            <p>For a site like this, it makes sense to spend around {{ $this->formatCurrency($suggestedPrice) }} on a site redesign, based on your risk tolerance, and you should expect to see a positive ROI within ~2 months of release.</p>
        </div>
    </div>
</div>
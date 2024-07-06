<div class="roi-calculator">
    <div class="row vcenter">
        <div class="col-7">
            <h2>How much are you leaving on the table?</h2>
            <p>Articles about design, software product development, marketing, and conversion-rate optimization.</p>
        </div>

        <div class="col-5">
            <form class="form form--stretch-inputs">
                <x-input.base name="FNAME" label="First name" hide-label>
                    <x-input.text-input name="FNAME" placeholder="First name" value="{{ old('FNAME') }}"></x-input.text-input>
                </x-input.base>

                <x-input.base name="EMAIL" label="Email" hide-label>
                    <x-input.text-input name="EMAIL" placeholder="Email" type="email" value="{{ old('EMAIL') }}"></x-input.text-input>
                </x-input.base>

                <input type="submit" value="Calculate" class="btn btn--secondary" />
            </form>
        </div>
    </div>
</div>
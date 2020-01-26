<section id="calculator-form">
    <div id="calculator-container" class="container">
        <h1>Insurance Policy Calculator</h1>
        <form id="calculator" action="/calculate" method="POST">
            <input
                type="hidden"
                name="orderTime"
                id="order-time"
                />
            <div class="form-field">
                <label for="car-value">Estimated value of the car</label>
                <input
                    type="number"
                    id="car-value"
                    name="carValue"
                    placeholder="100 - 100,000 EUR"
                    />
                <span class="range-input-show" id="car-value-show">EUR</span>
            </div>
            <div class="form-field">
                <label for="tax-percentage">Tax percentage</label>
                <input
                    type="range"
                    id="tax-percentage"
                    name="taxPercentage"
                    min="0"
                    max="100"
                    value="10"
                    />
                <span class="range-input-show" id="tax-percentage-show">%</span>
            </div>
            <div class="form-field">
                <label for="instalments-number">Number of instalments</label>
                <input
                    type="range"
                    id="instalments-number"
                    name="instalmentsNumber"
                    min="1"
                    max="12"
                    value="2"
                    />
                <span class="range-input-show" id="instalments-number-show"></span>
            </div>
            <div class="form-field">
                <input class="button" type="submit" value="Submit">
            </div>
        </form>
    </div>
</section>
document.addEventListener('DOMContentLoaded', () => {

    if (document.getElementById("calculator-form")) {        
        const carValueInput = document.getElementById('car-value');
        const taxPercentageInput = document.getElementById('tax-percentage');
        const instalmentsNumberInput = document.getElementById('instalments-number');
        const orderTimeInput = document.getElementById('order-time');

        /**
         * It's not reliable approach for getting user's loacal time
         */
        orderTimeInput.value = new Date().toLocaleString();

        updateInstalments(instalmentsNumberInput.value);
        updateTax(taxPercentageInput.value);
        updateCarValue(carValueInput.value)

        instalmentsNumberInput.addEventListener('input', () => updateInstalments(instalmentsNumberInput.value));
        taxPercentageInput.addEventListener('input', () => updateTax(taxPercentageInput.value));
        carValueInput.addEventListener('keyup', () => updateCarValue(carValueInput.value));
        carValueInput.addEventListener('change', () => updateCarValue(carValueInput.value));
    }
})

function updateTax(val) {
    document.getElementById('tax-percentage-show').innerHTML = val + ' %';
}

function updateInstalments(val) {
    document.getElementById('instalments-number-show').innerHTML = val;
}

function updateCarValue(val) {
    val = val.replace(/\B(?=(\d{3})+(?!\d))/g, ",");    
    document.getElementById('car-value-show').innerHTML = val + ' EUR';
}


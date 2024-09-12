
    document.addEventListener('DOMContentLoaded', function() {
        const freeTicketRadio = document.getElementById('free-ticket');
        const paidTicketRadio = document.getElementById('paid-ticket');
        const priceField = document.getElementById('price').parentElement;

        // Function to toggle price field visibility
        function togglePriceField() {
            if (freeTicketRadio.checked) {
                priceField.style.display = 'none';  // Hide the price field
                document.getElementById('price').value = '';  // Clear the price value
            } else {
                priceField.style.display = 'block';  // Show the price field
            }
        }

        // Add event listeners for change events on the radio buttons
        freeTicketRadio.addEventListener('change', togglePriceField);
        paidTicketRadio.addEventListener('change', togglePriceField);

        // Run the toggle function on page load to handle pre-selected values
        togglePriceField();
    });


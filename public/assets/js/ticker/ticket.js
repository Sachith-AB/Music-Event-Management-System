document.addEventListener('DOMContentLoaded', () => {
    const opportunityContainer = document.getElementById('opportunity-container');
    const addOpportunityButton = document.getElementById('add-opportunity');

    // Add new opportunity input field
    addOpportunityButton.addEventListener('click', () => {
        const input = document.createElement('input');
        input.type = 'text';
        input.name = 'restrictions[]'; // Use array notation for all inputs
        input.classList.add('opportunity-input');
        input.placeholder = 'Enter opportunity';
        opportunityContainer.appendChild(input);
    });
    // Restrict sale start and end dates to future only
    const today = new Date().toISOString().split('T')[0]; // Get today's date in YYYY-MM-DD

    const saleStartDate = document.getElementById('sale-strt-date');
    const saleEndDate = document.getElementById('sale-end-date');

    if (saleStartDate) saleStartDate.setAttribute('min', today);
    if (saleEndDate) saleEndDate.setAttribute('min', today);
});

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
});

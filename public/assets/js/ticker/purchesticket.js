function openModal() {
    const modal = document.getElementById('summaryModal');
    if (modal) {
        modal.style.display = 'flex';
    } else {
        console.error("Modal element with id 'summaryModal' not found.");
    }
}

function closeModal() {
    const modal = document.getElementById('summaryModal');
    if (modal) {
        modal.style.display = 'none';
    } else {
        console.error("Modal element with id 'summaryModal' not found.");
    }
}

function increaseQuantity() {
    const ticketCount = document.getElementById('ticketCount');
    let value = parseInt(ticketCount.value);
    ticketCount.value = value + 1;
}

function decreaseQuantity() {
    const ticketCount = document.getElementById('ticketCount');
    let value = parseInt(ticketCount.value);
    if (value > 1) {  // Ensure the ticket count doesn't go below 1
        ticketCount.value = value - 1;
    }
}

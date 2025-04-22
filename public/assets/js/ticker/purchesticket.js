function openModal() {
    const modal = document.getElementById('summaryModal');
    const ticketCount = parseInt(document.getElementById('ticketCount').value);
    
    if (modal) {
        // Populate modal with purchase summary
        const pricePerTicket = ticketDetails.price;
        const ticketType = ticketDetails.type;
        const subtotal = ticketCount * pricePerTicket;
        const discount = ticketDetails.discount * ticketCount; // 10% discount
        const total = subtotal - discount;

        // Update modal content
        document.getElementById('ticketCountDisplay').textContent = `${ticketCount} x`;
        document.getElementById('ticketTypeDisplay').textContent = `LKR ${pricePerTicket} / ${ticketType} Ticket`;
        document.getElementById('subtotalDisplay').textContent = `LKR ${subtotal}`;
        document.getElementById('discountDisplay').textContent = `- LKR ${discount}`;
        document.getElementById('totalDisplay').textContent = `LKR ${total}`;

        // Display modal
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



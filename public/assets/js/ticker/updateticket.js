function openModal() {
    const modal = document.getElementById('UpdateTicket');
    if (modal) {
        modal.style.display = 'flex';
    } else {
        console.error("Modal element with id 'UpdateTicket' not found.");
    }
}

function closeModal() {
    const modal = document.getElementById('UpdateTicket');
    if (modal) {
        modal.style.display = 'none';
    } else {
        console.error("Modal element with id 'UpdateTicket' not found.");
    }
}


function openUpdateModal(ticketType) {
    document.getElementById('updateModal').style.display = 'block';
    document.getElementById('ticketType').value = ticketType;
}

function closeUpdateModal() {
    document.getElementById('updateModal').style.display = 'none';
}

function confirmDelete(ticketType) {
    if (confirm(`Are you sure you want to delete the ${ticketType}?`)) {
        // Perform delete action
    }
}
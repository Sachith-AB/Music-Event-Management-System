/*function openModal() {
    document.getElementById('ticketModal').style.display = 'flex';
}

function closeModal() {
    document.getElementById('ticketModal').style.display = 'none';
}*/


function openModal() {
    const modal = document.getElementById('ticketModal');
    if (modal) {
        modal.style.display = 'flex';
    } else {
        console.error("Modal element with id 'ticketModal' not found.");
    }
}

function closeModal() {
    const modal = document.getElementById('ticketModal');
    if (modal) {
        modal.style.display = 'none';
    } else {
        console.error("Modal element with id 'ticketModal' not found.");
    }
}


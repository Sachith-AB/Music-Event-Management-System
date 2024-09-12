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
function openNoteModal(eventId) {
    const modal = document.getElementById("noteModal");
    const eventIdInput = modal.querySelector("input[name='event_id']");
    
    // Set the event_id value dynamically based on the event clicked
    eventIdInput.value = eventId;

    // Show the modal
    modal.classList.remove("hidden");
}

function closeNoteModal() {
    const modal = document.getElementById("noteModal");
    modal.classList.add("hidden");
}

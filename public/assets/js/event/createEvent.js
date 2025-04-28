document.querySelector('form').addEventListener('submit', function (e) {
    const date = document.getElementById('event-date').value;
    const startTime = document.getElementById('start-time').value;
    const endTime = document.getElementById('end-time').value;

    if (date && startTime) {
        const startDateTime = `${date}T${startTime}:00`; // Combine date and time for start
        const endDateTime = `${date}T${endTime}:00`;     // Combine date and time for end

        // Set the values of the hidden inputs
        document.getElementById('hidden-start-time').value = startDateTime;
        document.getElementById('hidden-end-time').value = endDateTime;
    }
});
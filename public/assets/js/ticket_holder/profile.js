function showTab(tab) {
    // Hide both
    document.getElementById('past').style.display = 'none';
    document.getElementById('upcoming').style.display = 'none';

    // Remove active class from buttons
    document.querySelectorAll('.tab-button').forEach(btn => btn.classList.remove('active'));

    // Show selected
    document.getElementById(tab).style.display = 'block';
    document.querySelector(`.tab-button[onclick="showTab('${tab}')"]`).classList.add('active');
}


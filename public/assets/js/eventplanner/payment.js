// Fetch the payment chart data
const paymentCanvas = document.getElementById('paymentChart');

if (paymentCanvas) {
    const paymentData = {
        user_id: JSON.parse(paymentCanvas.dataset.user_id || '[]'),
        total_cost: JSON.parse(paymentCanvas.dataset.total_cost || '[]'),
    };

    const paymentCtx = paymentCanvas.getContext('2d');
    new Chart(paymentCtx, {
        type: 'bar',
        data: {
            labels: paymentData.user_id, // Collaborator IDs
            datasets: [{
                label: 'Total Payment (LKR)',
                data: paymentData.total_cost, // Payment amounts
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1,
            }],
        },
        options: {
            responsive: true,
            scales: {
                x: { title: { display: true, text: 'Collaborators' } },
                y: { beginAtZero: true, title: { display: true, text: 'Total Cost (LKR)' } },
            },
        },
    });
}

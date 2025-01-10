// Income Over Time Chart Data
const incomeData = {
    dates: JSON.parse(document.getElementById('incomeChart').dataset.dates || '[]'),
    incomes: JSON.parse(document.getElementById('incomeChart').dataset.incomes || '[]'),
};

const incomeCtx = document.getElementById('incomeChart').getContext('2d');
new Chart(incomeCtx, {
    type: 'line',
    data: {
        labels: incomeData.dates,
        datasets: [{
            label: 'Income Over Time (LKR)',
            data: incomeData.incomes,
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 2,
            fill: true
        }]
    },
    options: {
        responsive: true,
        scales: {
            x: { title: { display: true, text: 'Date' }},
            y: { beginAtZero: true, title: { display: true, text: 'Income (LKR)' }}
        }
    }
});

// Ticket Progress Chart Data
const ticketData = {
    types: JSON.parse(document.getElementById('ticketProgressChart').dataset.types || '[]'),
    totalTickets: JSON.parse(document.getElementById('ticketProgressChart').dataset.total || '[]'),
    soldTickets: JSON.parse(document.getElementById('ticketProgressChart').dataset.sold || '[]'),
};

const ticketCtx = document.getElementById('ticketProgressChart').getContext('2d');
new Chart(ticketCtx, {
    type: 'bar',
    data: {
        labels: ticketData.types,
        datasets: [
            {
                label: 'Total Tickets',
                data: ticketData.totalTickets,
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            },
            {
                label: 'Sold Tickets',
                data: ticketData.soldTickets,
                backgroundColor: 'rgba(255, 99, 132, 0.6)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }
        ]
    },
    options: {
        responsive: true,
        scales: {
            x: { title: { display: true, text: 'Ticket Types' }},
            y: { beginAtZero: true, title: { display: true, text: 'Tickets Count' }}
        }
    }
});


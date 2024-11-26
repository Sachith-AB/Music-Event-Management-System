// Get references to UI elements
const calendarGrid = document.querySelector(".calendar-grid");
const currentMonthEl = document.getElementById("currentMonth");
const eventList = document.getElementById("eventList");

// Get today's date
const today = new Date();
let currentMonth = today.getMonth();
let currentYear = today.getFullYear();

// Example events data (you'll fetch this from the database in a real app)
const events = [
    { date: "2024-12-01", description: "Performance at XYZ Event" },
    { date: "2024-12-05", description: "Rehearsal for ABC Show" },
];

// Function to populate the calendar
function populateCalendar(month, year) {
    calendarGrid.innerHTML = ""; // Clear existing calendar cells

    const firstDay = new Date(year, month, 1).getDay(); // Day of the week for 1st day
    const daysInMonth = new Date(year, month + 1, 0).getDate(); // Total days in month

    // Add empty cells for days before the first day of the month
    for (let i = 0; i < firstDay; i++) {
        const emptyCell = document.createElement("div");
        calendarGrid.appendChild(emptyCell);
    }

    // Add days of the month
    for (let day = 1; day <= daysInMonth; day++) {
        const cell = document.createElement("div");
        const cellDate = new Date(year, month, day).toISOString().split("T")[0];

        cell.textContent = day;

        // Highlight if there's an event
        const event = events.find(e => e.date === cellDate);
        if (event) {
            cell.classList.add("has-event");
            cell.addEventListener("click", () => showEventDetails(event));
        }

        calendarGrid.appendChild(cell);
    }

    // Update current month display
    const monthNames = [
        "January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"
    ];
    currentMonthEl.textContent = `${monthNames[month]} ${year}`;
}

// Function to show event details
function showEventDetails(event) {
    alert(`Event: ${event.description}\nDate: ${event.date}`);
}

// Function to list events
function populateEventList() {
    eventList.innerHTML = ""; // Clear existing events
    events.forEach(event => {
        const listItem = document.createElement("li");
        listItem.textContent = `${event.date}: ${event.description}`;
        eventList.appendChild(listItem);
    });
}

// Event listeners for month navigation
document.getElementById("prevMonth").addEventListener("click", () => {
    currentMonth--;
    if (currentMonth < 0) {
        currentMonth = 11;
        currentYear--;
    }
    populateCalendar(currentMonth, currentYear);
});

document.getElementById("nextMonth").addEventListener("click", () => {
    currentMonth++;
    if (currentMonth > 11) {
        currentMonth = 0;
        currentYear++;
    }
    populateCalendar(currentMonth, currentYear);
});

// Initialize the calendar and event list
populateCalendar(currentMonth, currentYear);
populateEventList();

// Get references to UI elements
const calendarGrid = document.querySelector(".calendar-grid");
const currentMonthEl = document.getElementById("currentMonth");
const eventList = document.getElementById("eventList");
const eventN = document.getElementById("events")?.textContent?.trim();
const events = eventN ? JSON.parse(eventN) : [];

// Get today's date
const today = new Date();
let currentMonth = today.getMonth();
let currentYear = today.getFullYear();

// Function to populate the calendar
function populateCalendar(month, year) {
    calendarGrid.innerHTML = "";
    const firstDay = new Date(year, month, 1).getDay();
    const daysInMonth = new Date(year, month + 1, 0).getDate();
    const todayDate = today.toISOString().split("T")[0];

    // Add empty cells for days before first day
    for (let i = 0; i < firstDay; i++) {
        calendarGrid.appendChild(document.createElement("div"));
    }

    for (let day = 1; day <= daysInMonth; day++) {
        const cell = document.createElement("div");
        const cellDate = `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
        cell.textContent = day;
        cell.className = 'calendar-day';

        // Highlight today
        if (cellDate === todayDate) {
            cell.classList.add("today");
        }

        // Find matching events (format dates properly)
        const dayEvents = events.filter(e => {
            const eventDate = new Date(e.start_time);
            return eventDate.toISOString().split('T')[0] === cellDate;
        });

        if (dayEvents.length > 0) {
            const status = dayEvents[0].status; // Show first event's status
            cell.classList.add(`has-event-${status}`);
            cell.addEventListener("click", () => showEventDetails(dayEvents[0]));
        }

        calendarGrid.appendChild(cell);
    }

    // Update month header
    currentMonthEl.textContent = new Date(year, month).toLocaleString('default', {
        month: 'long',
        year: 'numeric'
    });
}

// Improved modal handling
let modalVisible = false;
function showEventDetails(event) {
    const modal = document.getElementById("eventModal");
    if (!modal) return;

    // Update modal content
    document.getElementById("eventName").textContent = event.event_name;
    document.getElementById("eventDescription").textContent = event.description;
    document.getElementById("eventDate").textContent = new Date(event.start_time).toLocaleDateString();
    
    const eventImage = document.getElementById("eventImage");
    if (event.cover_images) {
        eventImage.src = `/uploads/${event.cover_images}`;
        eventImage.style.display = "block";
    }

    // Show modal
    modal.style.display = "block";
    modalVisible = true;
}

// Close modal properly
document.addEventListener('click', (e) => {
    const modal = document.getElementById("eventModal");
    if (modalVisible && (e.target.closest('.close') || !e.target.closest('.modal-content'))) {
        modal.style.display = "none";
        modalVisible = false;
    }
});

// Initialize calendar
populateCalendar(currentMonth, currentYear);

// Navigation handlers
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
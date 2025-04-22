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

// Function to format time
function formatTime(timeString) {
    if (!timeString) return '';
    try {
        // If time is "All Day", return as is
        if (timeString === 'All Day') {
            return timeString;
        }
        
        // If time is already in 12-hour format (contains AM/PM), return as is
        if (timeString.includes('AM') || timeString.includes('PM')) {
            return timeString;
        }

        // Parse the time string
        const [hours, minutes] = timeString.split(':');
        const hour = parseInt(hours);
        const ampm = hour >= 12 ? 'PM' : 'AM';
        const hour12 = hour % 12 || 12;
        return `${hour12}:${minutes} ${ampm}`;
    } catch (e) {
        console.error('Error formatting time:', e);
        return timeString;
    }
}

// Function to format date
function formatDate(dateString) {
    if (!dateString) return '';
    try {
        const date = new Date(dateString);
        return date.toLocaleDateString('en-US', {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });
    } catch (e) {
        console.error('Error formatting date:', e);
        return dateString;
    }
}

// Function to populate the calendar
function populateCalendar(month, year) {
    calendarGrid.innerHTML = ""; // Clear existing calendar cells

    // Add day headers
    const dayNames = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
    dayNames.forEach(day => {
        const dayHeader = document.createElement("div");
        dayHeader.className = "day-header";
        dayHeader.textContent = day;
        calendarGrid.appendChild(dayHeader);
    });

    const firstDay = new Date(year, month, 1).getDay(); // Day of the week for 1st day
    const daysInMonth = new Date(year, month + 1, 0).getDate(); // Total days in month
    const todayDate = new Date().toISOString().split("T")[0];

    // Add empty cells for days before the first day of the month
    for (let i = 0; i < firstDay; i++) {
        const emptyCell = document.createElement("div");
        emptyCell.className = "day empty";
        calendarGrid.appendChild(emptyCell);
    }

    // Add days of the month
    for (let day = 1; day <= daysInMonth; day++) {
        const cell = document.createElement("div");
        cell.className = "day";
        const cellDate = `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
    
        cell.textContent = day;

        if (cellDate === todayDate) {
            cell.classList.add("today");
        }
    
        // Highlight if there's an event
        const event = events.find(e => e.eventDate === cellDate);
        if (event) {
            if (event.status === 'unavailable') {
                cell.classList.add("unavailable");
            } else {
                cell.classList.add("has-event");
            }
            cell.addEventListener("click", () => showEventDetails(event));
        }
    
        calendarGrid.appendChild(cell);
    }

    // Add empty cells for remaining days to complete the grid
    const totalCells = dayNames.length * Math.ceil((firstDay + daysInMonth) / 7);
    const remainingCells = totalCells - (firstDay + daysInMonth);
    for (let i = 0; i < remainingCells; i++) {
        const emptyCell = document.createElement("div");
        emptyCell.className = "day empty";
        calendarGrid.appendChild(emptyCell);
    }

    // Update current month display
    const monthNames = [
        "January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"
    ];
    currentMonthEl.textContent = `${monthNames[month]} ${year}`;
}

// Function to show event details in a modal
function showEventDetails(event) {
    const ROOT = "http://localhost/Music-Event-Management-System/public";

    // Set event name
    document.getElementById("eventName").textContent = event.event_name || 'Event';
    
    // Set event description
    document.getElementById("eventDescription").textContent = event.description || 'No description available';
    
    // Set event date
    document.getElementById("eventDate").textContent = formatDate(event.eventDate);
    
    // Set event time
    const timeEl = document.getElementById("eventTime");
    if (event.status === 'unavailable') {
        timeEl.textContent = 'All Day - Unavailable';
    } else if (event.start_time && event.end_time) {
        timeEl.textContent = `${formatTime(event.start_time)} - ${formatTime(event.end_time)}`;
    } else {
        timeEl.textContent = 'Time not specified';
    }

    // Handle image
    const eventImage = document.getElementById("eventImage");
    if (event.cover_images) {
        eventImage.src = `${ROOT}/assets/images/events/${event.cover_images}`;
        eventImage.style.display = "block";
    } else {
        eventImage.style.display = "none";
    }

    // Show the modal
    const modal = document.getElementById("eventModal");
    modal.style.display = "block";
}

// Close modal when clicking the close button
document.getElementById("closeModal").addEventListener("click", () => {
    const modal = document.getElementById("eventModal");
    modal.style.display = "none";
});

// Close modal when clicking outside
window.addEventListener("click", (event) => {
    const modal = document.getElementById("eventModal");
    if (event.target === modal) {
        modal.style.display = "none";
    }
});

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

// Initialize the calendar
populateCalendar(currentMonth, currentYear);

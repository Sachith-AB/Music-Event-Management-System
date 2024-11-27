// Get references to UI elements
const calendarGrid = document.querySelector(".calendar-grid");
const currentMonthEl = document.getElementById("currentMonth");
const eventList = document.getElementById("eventList");
const eventN = document.getElementById("events").value;
const events = JSON.parse(eventN); // Convert JSON to object
console.log(events);


// Get today's date
const today = new Date();
let currentMonth = today.getMonth();
let currentYear = today.getFullYear();

// Function to populate the calendar
function populateCalendar(month, year) {
    calendarGrid.innerHTML = ""; // Clear existing calendar cells

    const firstDay = new Date(year, month, 1).getDay(); // Day of the week for 1st day
    const daysInMonth = new Date(year, month + 1, 0).getDate(); // Total days in month

    const todayDate = new Date().toISOString().split("T")[0]; 

    // Add empty cells for days before the first day of the month
    for (let i = 0; i < firstDay; i++) {
        const emptyCell = document.createElement("div");
        calendarGrid.appendChild(emptyCell);
    }


    for (let day = 1; day <= daysInMonth; day++) {
        const cell = document.createElement("div");
        const cellDate = `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
    
        cell.textContent = day;

        if (cellDate === todayDate) {
            cell.classList.add("today"); // Add a class for today's date
            cell.style.backgroundColor = "#FFDDC1"; // Example color for highlighting today's date
        }
    
        // Highlight if there's an event
        const event = events.find(e => e.eventDate === cellDate);
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

// Function to show event details in a modal
function showEventDetails(event) {

    const ROOT = "http://localhost/Music-Event-Management-System/public";

    document.getElementById("eventName").textContent = event.event_name;
    document.getElementById("eventDescription").textContent = event.description;
    document.getElementById("eventDate").textContent = event.eventDate;
    const eventImage = document.getElementById("eventImage"); 
    eventImage.src = `${ROOT}/assets/images/events/${event.cover_images}`;
    eventImage.style.display = "block";

    // Show the modal
    const modal = document.getElementById("eventModal");
    modal.style.display = "block";

    // Close the modal when the close button is clicked
    document.getElementById("closeModal").addEventListener("click", () => {
    const modal = document.getElementById("eventModal");
    modal.style.display = "none"; // Hide the modal
});
}

// Function to list events
function populateEventList() {
    eventList.innerHTML = ""; // Clear existing events

    events.sort((a,b)=> new Date (a.eventDate) - new Date(b.eventDate));

    events.forEach(event => {
        const listItem = document.createElement("li");
        listItem.textContent = `${event.start_time} ${event.event_name}: ${event.description}`;
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

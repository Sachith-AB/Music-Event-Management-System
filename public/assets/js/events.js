let currentCity = 'colombo';
let currentCategory = 'All';


const eventsData = {
    'colombo': [
        { title: 'Rock Festival', date: 'Saturday, Oct 7, 2024', time: '08:00 PM', price: 'From LKR 2000',type: 'Outdoor' },
        { title: 'One Mic', date: 'Sunday, Oct 15, 2024', time: '10:00 AM', price: 'Free Entry', type: 'Indoor' },
        { title: 'Alee', date: 'Friday, Oct 20, 2024', time: '06:00 PM', price: 'From LKR 2500', type: 'Outdoor' },
        { title: 'Stringfield', date: 'Sunday, Feb 20', time: '11:00 AM', price: 'From LKR 2500', type: 'Indoor' },
        { title: 'Ether Wave', date: 'Saturday, Aug 14, 2024', time: '05:00 PM', price: 'From LKR 1500', type: 'Indoor' }
    ],
    'kandy': [
        { title: 'Prison Break', date: 'Friday, Nov 10, 2024', time: '06:00 PM', price: 'From LKR 1500', type: 'Indoor' },
        { title: 'Spirit', date: 'Friday, Nov 26, 2024', time: '08:00 PM', price: 'From LKR 2500', type: 'Outdoor' }
    ],

    'galle': [
        { title: 'Galle Literary Festival', date: 'Monday, Dec 1', time: '10:00 AM', price: 'From LKR 1000', type: 'Indoor' }
    ],
    'jaffna': [
        { title: 'Rock Fest', date: 'Saturday, Jan 12', time: '04:00 PM', price: 'From LKR 1700', type: 'Outdoor' }
    ],
    'kurunegala': [
        { title: 'Stringfield', date: 'Sunday, Feb 20', time: '11:00 AM', price: 'From LKR 2500', type: 'Indoor' }
    ]
};





function updateEventsForCityAndCategory(city, category) {
    currentCity = city;
    const eventsContainer = document.getElementById('events-container');
    eventsContainer.innerHTML = ''; // Clear current events

    let filteredEvents = eventsData[city] || [];
    console.log(`Filtered events:`, filteredEvents);


    if (category !== 'All') {
        filteredEvents = filteredEvents.filter(event => event.type === category);
        console.log(`Events after category filter:`, filteredEvents);
    }

    
    const eventsHTML = filteredEvents.map((event, index) => `
        <div class="event-card" style="display: ${index < 3 ? 'block' : 'none'};">
            <img src="images/${event.title}.png" alt="${event.title}">
            <h3>${event.title}</h3>
            <p>${event.date} | ${event.time}</p>
            <p>${event.price}</p>
        </div>
    `).join('');

    
    eventsContainer.innerHTML = eventsHTML;

   
    const viewMoreButton = document.querySelector('.view-more-btn');
    if (viewMoreButton) {
        viewMoreButton.style.display = filteredEvents.length > 3 ? 'block' : 'none';
    }

    console.log('Events HTML updated.');
}


function toggleVisibility() {
    console.log('Toggling visibility of additional events.');
    const events = document.querySelectorAll('.event-card');
    events.forEach((event, index) => {
        if (index >= 3) {
            event.style.display = event.style.display === 'none' ? 'block' : 'none';
        }
    });

    const hiddenEvents = Array.from(events).slice(3).every(event => event.style.display === 'block');
    if (hiddenEvents) {
        document.querySelector('.view-more-btn').style.display = 'none';
    }
    console.log('Visibility toggled.');
}


document.addEventListener('DOMContentLoaded', function() {
    console.log('Document loaded. Initializing events...');

    const citySelect = document.getElementById('city-select');
    const categoryButtons = document.querySelector('.category-buttons');

    if (citySelect) {
        citySelect.addEventListener('change', function() {
            const city = this.value;
            console.log(`City selected: ${city}`);
            updateEventsForCityAndCategory(city, currentCategory);
        });
    } else {
        console.error('City select element not found');
    }

    if (categoryButtons) {
        categoryButtons.addEventListener('click', function(event) {
            if (event.target.tagName === 'BUTTON') {
                currentCategory = event.target.textContent;
                console.log(`Category selected: ${currentCategory}`);
                updateEventsForCityAndCategory(currentCity, currentCategory);
            }
        });
    } else {
        console.error('Category buttons element not found');
    }

    
    updateEventsForCityAndCategory(currentCity, currentCategory);
});

@extends('layouts.app')

@section('title', 'Calendar')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="bg-white rounded-lg shadow-md p-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Interactive Calendar</h1>

        <!-- Calendar Header -->
        <div class="flex items-center justify-between mb-6">
            <button id="prevMonth" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                ← Previous
            </button>
            <h2 id="currentMonth" class="text-2xl font-semibold text-gray-800"></h2>
            <button id="nextMonth" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                Next →
            </button>
        </div>

        <!-- Calendar Grid -->
        <div class="grid grid-cols-7 gap-1 mb-6">
            <!-- Day headers -->
            <div class="text-center font-semibold text-gray-600 p-2">Sun</div>
            <div class="text-center font-semibold text-gray-600 p-2">Mon</div>
            <div class="text-center font-semibold text-gray-600 p-2">Tue</div>
            <div class="text-center font-semibold text-gray-600 p-2">Wed</div>
            <div class="text-center font-semibold text-gray-600 p-2">Thu</div>
            <div class="text-center font-semibold text-gray-600 p-2">Fri</div>
            <div class="text-center font-semibold text-gray-600 p-2">Sat</div>
        </div>

        <div id="calendarDays" class="grid grid-cols-7 gap-1">
            <!-- Calendar days will be generated here -->
        </div>

        <!-- Event Modal -->
        <div id="eventModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
            <div class="bg-white rounded-lg p-6 w-96">
                <h3 class="text-xl font-semibold mb-4">Add Event</h3>
                <form id="eventForm">
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Event Title</label>
                        <input type="text" id="eventTitle" class="w-full px-3 py-2 border rounded focus:outline-none focus:border-blue-500" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Date</label>
                        <input type="date" id="eventDate" class="w-full px-3 py-2 border rounded focus:outline-none focus:border-blue-500" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Time</label>
                        <input type="time" id="eventTime" class="w-full px-3 py-2 border rounded focus:outline-none focus:border-blue-500">
                    </div>
                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Description</label>
                        <textarea id="eventDescription" class="w-full px-3 py-2 border rounded focus:outline-none focus:border-blue-500" rows="3"></textarea>
                    </div>
                    <div class="flex justify-end space-x-2">
                        <button type="button" id="cancelEvent" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
                            Cancel
                        </button>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                            Add Event
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Add Event Button -->
        <div class="mt-6">
            <button id="addEventBtn" class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded">
                Add New Event
            </button>
        </div>

        <!-- Events List -->
        <div class="mt-8">
            <h3 class="text-xl font-semibold text-gray-800 mb-4">Upcoming Events</h3>
            <div id="eventsList" class="space-y-2">
                <!-- Events will be listed here -->
            </div>
        </div>
    </div>

    <!-- Code Example -->
    <div class="bg-gray-100 rounded-lg p-6 mt-8">
        <h2 class="text-xl font-semibold mb-4">JavaScript Code:</h2>
        <pre class="bg-gray-800 text-green-400 p-4 rounded overflow-x-auto"><code>
// Calendar Implementation
class Calendar {
    constructor() {
        this.currentDate = new Date();
        this.events = this.loadEvents();
        this.init();
    }

    init() {
        this.render();
        this.bindEvents();
    }

    render() {
        const year = this.currentDate.getFullYear();
        const month = this.currentDate.getMonth();

        // Update month display
        document.getElementById('currentMonth').textContent =
            this.currentDate.toLocaleDateString('en-US', { month: 'long', year: 'numeric' });

        // Clear previous days
        const calendarDays = document.getElementById('calendarDays');
        calendarDays.innerHTML = '';

        // Get first day of month and number of days
        const firstDay = new Date(year, month, 1).getDay();
        const daysInMonth = new Date(year, month + 1, 0).getDate();

        // Add empty cells for days before month starts
        for (let i = 0; i < firstDay; i++) {
            const emptyDay = document.createElement('div');
            emptyDay.className = 'h-24 border border-gray-200';
            calendarDays.appendChild(emptyDay);
        }

        // Add days of the month
        for (let day = 1; day <= daysInMonth; day++) {
            const dayElement = this.createDayElement(day, month, year);
            calendarDays.appendChild(dayElement);
        }
    }

    createDayElement(day, month, year) {
        const dayElement = document.createElement('div');
        dayElement.className = 'h-24 border border-gray-200 p-1 cursor-pointer hover:bg-gray-50';
        dayElement.innerHTML = `&lt;div class="font-semibold"&gt;${day}&lt;/div&gt;`;

        // Check for events on this day
        const dateStr = `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
        const dayEvents = this.events.filter(event => event.date === dateStr);

        if (dayEvents.length > 0) {
            dayElement.classList.add('bg-blue-50');
            dayEvents.forEach(event => {
                const eventElement = document.createElement('div');
                eventElement.className = 'text-xs bg-blue-500 text-white rounded px-1 mt-1 truncate';
                eventElement.textContent = event.title;
                dayElement.appendChild(eventElement);
            });
        }

        // Add click event
        dayElement.addEventListener('click', () => {
            document.getElementById('eventDate').value = dateStr;
            this.showModal();
        });

        return dayElement;
    }

    addEvent(event) {
        this.events.push(event);
        this.saveEvents();
        this.render();
        this.renderEventsList();
    }

    loadEvents() {
        const stored = localStorage.getItem('calendarEvents');
        return stored ? JSON.parse(stored) : [];
    }

    saveEvents() {
        localStorage.setItem('calendarEvents', JSON.stringify(this.events));
    }
}

const calendar = new Calendar();
        </code></pre>
    </div>
</div>

<script>
// Calendar Implementation
class Calendar {
    constructor() {
        this.currentDate = new Date();
        this.events = this.loadEvents();
        this.init();
    }

    init() {
        this.render();
        this.bindEvents();
        this.renderEventsList();
    }

    render() {
        const year = this.currentDate.getFullYear();
        const month = this.currentDate.getMonth();

        // Update month display
        document.getElementById('currentMonth').textContent =
            this.currentDate.toLocaleDateString('en-US', { month: 'long', year: 'numeric' });

        // Clear previous days
        const calendarDays = document.getElementById('calendarDays');
        calendarDays.innerHTML = '';

        // Get first day of month and number of days
        const firstDay = new Date(year, month, 1).getDay();
        const daysInMonth = new Date(year, month + 1, 0).getDate();

        // Add empty cells for days before month starts
        for (let i = 0; i < firstDay; i++) {
            const emptyDay = document.createElement('div');
            emptyDay.className = 'h-24 border border-gray-200';
            calendarDays.appendChild(emptyDay);
        }

        // Add days of the month
        for (let day = 1; day <= daysInMonth; day++) {
            const dayElement = this.createDayElement(day, month, year);
            calendarDays.appendChild(dayElement);
        }
    }

    createDayElement(day, month, year) {
        const dayElement = document.createElement('div');
        dayElement.className = 'h-24 border border-gray-200 p-1 cursor-pointer hover:bg-gray-50';
        dayElement.innerHTML = `<div class="font-semibold">${day}</div>`;

        // Check for events on this day
        const dateStr = `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
        const dayEvents = this.events.filter(event => event.date === dateStr);

        if (dayEvents.length > 0) {
            dayElement.classList.add('bg-blue-50');
            dayEvents.forEach(event => {
                const eventElement = document.createElement('div');
                eventElement.className = 'text-xs bg-blue-500 text-white rounded px-1 mt-1 truncate';
                eventElement.textContent = event.title;
                dayElement.appendChild(eventElement);
            });
        }

        // Add click event
        dayElement.addEventListener('click', () => {
            document.getElementById('eventDate').value = dateStr;
            this.showModal();
        });

        return dayElement;
    }

    bindEvents() {
        document.getElementById('prevMonth').addEventListener('click', () => {
            this.currentDate.setMonth(this.currentDate.getMonth() - 1);
            this.render();
        });

        document.getElementById('nextMonth').addEventListener('click', () => {
            this.currentDate.setMonth(this.currentDate.getMonth() + 1);
            this.render();
        });

        document.getElementById('addEventBtn').addEventListener('click', () => {
            this.showModal();
        });

        document.getElementById('cancelEvent').addEventListener('click', () => {
            this.hideModal();
        });

        document.getElementById('eventForm').addEventListener('submit', (e) => {
            e.preventDefault();
            this.addEvent({
                title: document.getElementById('eventTitle').value,
                date: document.getElementById('eventDate').value,
                time: document.getElementById('eventTime').value,
                description: document.getElementById('eventDescription').value
            });
            this.hideModal();
            this.clearForm();
        });

        // Close modal when clicking outside
        document.getElementById('eventModal').addEventListener('click', (e) => {
            if (e.target.id === 'eventModal') {
                this.hideModal();
            }
        });
    }

    showModal() {
        document.getElementById('eventModal').classList.remove('hidden');
        document.getElementById('eventModal').classList.add('flex');
    }

    hideModal() {
        document.getElementById('eventModal').classList.add('hidden');
        document.getElementById('eventModal').classList.remove('flex');
    }

    clearForm() {
        document.getElementById('eventForm').reset();
    }

    addEvent(event) {
        this.events.push(event);
        this.saveEvents();
        this.render();
        this.renderEventsList();
    }

    renderEventsList() {
        const eventsList = document.getElementById('eventsList');
        eventsList.innerHTML = '';

        const sortedEvents = this.events.sort((a, b) => new Date(a.date) - new Date(b.date));

        sortedEvents.forEach(event => {
            const eventElement = document.createElement('div');
            eventElement.className = 'bg-white border rounded-lg p-4';
            eventElement.innerHTML = `
                <div class="flex justify-between items-start">
                    <div>
                        <h4 class="font-semibold text-gray-800">${event.title}</h4>
                        <p class="text-sm text-gray-600">${new Date(event.date).toLocaleDateString()} ${event.time ? 'at ' + event.time : ''}</p>
                        ${event.description ? `<p class="text-sm text-gray-500 mt-1">${event.description}</p>` : ''}
                    </div>
                    <button onclick="calendar.deleteEvent('${event.date}', '${event.title}')" class="text-red-500 hover:text-red-700">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
            `;
            eventsList.appendChild(eventElement);
        });
    }

    deleteEvent(date, title) {
        this.events = this.events.filter(event => !(event.date === date && event.title === title));
        this.saveEvents();
        this.render();
        this.renderEventsList();
    }

    loadEvents() {
        const stored = localStorage.getItem('calendarEvents');
        return stored ? JSON.parse(stored) : [
            { title: 'Team Meeting', date: '2025-07-15', time: '10:00', description: 'Weekly team sync' },
            { title: 'Project Deadline', date: '2025-07-20', time: '', description: 'Final submission' }
        ];
    }

    saveEvents() {
        localStorage.setItem('calendarEvents', JSON.stringify(this.events));
    }
}

const calendar = new Calendar();
</script>
@endsection

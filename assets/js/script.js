// Function to load view into the content area
function loadView(view) {
    fetch(`views/${view}.php`)  // Fetching PHP file for view
        .then(response => response.text()) // Convert response to text
        .then(html => {
            const content = document.getElementById('content'); // Targeting the content area
            content.innerHTML = html;  // Injecting the fetched HTML into the content
        })
        .catch(error => console.error('Error loading view:', error));
}

// Workout plans array
const workoutPlans = [
    {
        id: 1, 
        name: "Full Body Strength", 
        details: "A full body strength workout that focuses on building muscle.",
        videoId: "dQw4w9WgXcQ", // Placeholder YouTube video ID
        briefing: "Strengthen your whole body with compound movements."
    },
    {
        id: 2, 
        name: "Upper Body Builder", 
        details: "Focuses on upper body strength, targeting chest, back, and arms.",
        videoId: "fR9tCjq_lC4", // Placeholder YouTube video ID
        briefing: "Build your upper body strength with focused exercises."
    },
    // Add more workout plans as needed...
];

// Function to fetch and display workout plans
function fetchWorkoutPlans() {
    let planOptionsHtml = "";
    workoutPlans.forEach(plan => {
        planOptionsHtml += `
            <div class="plan-option" onclick="showPlanDetails(${plan.id}, '${plan.name}', '${plan.details}', '${plan.videoId}', '${plan.briefing}')">
                <h4>${plan.name}</h4>
                <p>${plan.details}</p>
                <button>Select Plan</button>
            </div>
        `;
    });
    document.getElementById("plan-options").innerHTML = planOptionsHtml;
    document.getElementById("workout-plans-modal").style.display = "block";
}

// Close the workout plans modal
function closePlansModal() {
    document.getElementById("workout-plans-modal").style.display = "none";
}

// Show workout plan details in a modal
function showPlanDetails(id, name, details, videoId, briefing) {
    document.getElementById("workout-details").innerHTML = `
        <h4>${name}</h4>
        <p>${details}</p>
        <p><strong>Briefing:</strong> ${briefing}</p>
    `;

    // Use YouTube Data API to get the video URL and embed it
    const videoEmbedUrl = `https://www.youtube.com/embed/${videoId}`;
    document.getElementById("youtube-video").innerHTML = `
        <iframe width="560" height="315" src="${videoEmbedUrl}" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
    `;

    // Show the modal with plan details
    document.getElementById("workout-details-modal").style.display = "block";

    // Provide an option to select a date and time for the workout
    document.getElementById("set-date-time").style.display = "block"; // Show date-time selector
    document.getElementById("selected-plan-id").value = id; // Save the selected plan ID in a hidden input field
}

// Close the workout details modal
function closeModal() {
    document.getElementById("workout-details-modal").style.display = "none";
    document.getElementById("set-date-time").style.display = "none"; // Hide date-time selector
}

// Object to store workouts by date
const workouts = {};

// Function to render the calendar with workout data
function renderCalendar(currentDate = new Date()) {
    const calendarDates = document.getElementById('calendar-dates');
    const month = currentDate.getMonth();
    const year = currentDate.getFullYear();
    const firstDay = new Date(year, month, 1);
    const lastDay = new Date(year, month + 1, 0);

    calendarDates.innerHTML = ""; // Clear previous calendar dates

    const firstDayOfWeek = firstDay.getDay();
    for (let i = 0; i < firstDayOfWeek; i++) {
        const emptyDay = document.createElement('div');
        emptyDay.classList.add('empty');
        calendarDates.appendChild(emptyDay);
    }

    for (let i = 1; i <= lastDay.getDate(); i++) {
        const day = document.createElement('div');
        day.classList.add('calendar-day');
        day.textContent = i;
        day.dataset.date = `${year}-${month + 1}-${i}`;

        const workoutDetails = workouts[`${year}-${month + 1}-${i}`];
        if (workoutDetails) {
            day.classList.add('has-workout');
            const workoutInfo = document.createElement('div');
            workoutInfo.classList.add('workout-info');
            workoutInfo.textContent = workoutDetails;
            day.appendChild(workoutInfo);
        }

        day.addEventListener('click', () => {
            openWorkoutDetails(day.dataset.date);
        });

        calendarDates.appendChild(day);
    }

    document.getElementById('calendar-month-year').textContent = `${firstDay.toLocaleString('default', { month: 'long' })} ${year}`;
}

// Add a workout to the calendar
function addWorkoutToCalendar() {
    const workoutName = document.getElementById("workout-details").querySelector('h4').innerText;
    const selectedDate = document.getElementById('workout-date').value;
    const selectedTime = document.getElementById('workout-time').value;
    const planId = document.getElementById('selected-plan-id').value;

    if (!selectedDate || !selectedTime) {
        alert("Please select both date and time for the workout.");
        return;
    }

    // Store workout details in the workouts object
    const workoutDetails = `${workoutName} at ${selectedTime}`;
    workouts[selectedDate] = workoutDetails;

    // Re-render the calendar to reflect the new workout
    renderCalendar();

    // Close the modal after adding the workout
    closeModal();
    closePlansModal();
}

// Function to view the workout details for a specific date
function openWorkoutDetails(date) {
    const workoutDetails = workouts[date];
    if (workoutDetails) {
        alert(`Workout on ${date}: ${workoutDetails}`);
    } else {
        alert(`No workout scheduled for ${date}`);
    }
}

// Navigation functions for changing months
function prevMonth() {
    const currentDate = new Date();
    currentDate.setMonth(currentDate.getMonth() - 1); // Go back one month
    renderCalendar(currentDate); // Pass the updated date to renderCalendar
}

function nextMonth() {
    const currentDate = new Date();
    currentDate.setMonth(currentDate.getMonth() + 1); // Go forward one month
    renderCalendar(currentDate); // Pass the updated date to renderCalendar
}

// Initialize the calendar when the page loads
window.onload = () => renderCalendar(); // Render current month by default

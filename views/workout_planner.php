<!-- views/workout_planner.php -->
<h2>Workout Planner</h2>
<p>Select or customize a workout plan to reach your fitness goals.</p>

<div class="planner-options">
    <!-- Button to open the pre-made plans modal -->
    <button onclick="fetchWorkoutPlans()">View Pre-made Plans</button>
    <!-- Button for creating a custom workout plan -->
    <button onclick="createCustomPlan()">Create Custom Plan</button>
</div>

<!-- Modal to display pre-made plans -->
<div id="workout-plans-modal" class="modal" style="display: none;">
    <div class="modal-content">
        <span class="close" onclick="closePlansModal()">&times;</span>
        <h3>Select a Workout Plan</h3>
        <div id="plan-options"></div>
    </div>
</div>

<!-- Modal for showing workout plan details and setting the date/time -->
<div id="workout-details-modal" class="modal" style="display: none;">
    <div class="modal-content">
        <h3>Workout Plan Details</h3>
        <div id="workout-details"></div>
        <div id="youtube-video"></div> <!-- Embed YouTube video -->
        <div id="set-date-time" style="display: none;">
            <label for="workout-date">Date:</label>
            <input type="date" id="workout-date" />
            <label for="workout-time">Time:</label>
            <input type="time" id="workout-time" />
            <button onclick="addWorkoutToCalendar()">Add Workout</button>
        </div>
        <button onclick="closeModal()">Cancel</button>
    </div>
</div>

<!-- Calendar Section -->
<div id="calendar-container">
    <div id="calendar-header">
        <button id="prev-month" onclick="prevMonth()">&#10094;</button>
        <div id="calendar-month-year"></div>
        <button id="next-month" onclick="nextMonth()">&#10095;</button>
    </div>
    <div id="calendar-dates"></div> <!-- Days of the month -->
</div>

<script src="assets/js/script.js"></script>

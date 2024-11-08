<h2>BMI Calculator</h2>
<p>Enter your details to calculate your Body Mass Index (BMI).</p>
<form onsubmit="calculateBMI(event)">
    <label>Weight (kg): <input type="number" id="weight"></label>
    <label>Height (cm): <input type="number" id="height"></label>
    <button type="submit">Calculate BMI</button>
</form>
<div id="bmi-result"></div>
<script>
function calculateBMI(event) {
    event.preventDefault();
    const weight = document.getElementById('weight').value;
    const height = document.getElementById('height').value;
    const bmi = (weight / ((height / 100) ** 2)).toFixed(2);
    document.getElementById('bmi-result').innerText = `Your BMI is ${bmi}`;
}
</script>

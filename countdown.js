// Get the form and countdown container elements
var countdownForm = document.getElementById('countdown-form');
var countdownContainer = document.getElementById('countdown-container');

// Add event listener to handle form submission
countdownForm.addEventListener('submit', function(event) {
  event.preventDefault(); // Prevent default form submission behavior

  // Extract deadline from the input field
  var deadline = document.getElementById('deadline').value;


  // Store deadline in local storage
  localStorage.setItem('countdownDeadline', deadline);

  // Clear the countdown container 
  countdownContainer.innerHTML = "";

});

// Check for stored deadline on page load
var storedDeadline = localStorage.getItem('countdownDeadline');

if (storedDeadline) {
  // Initialize countdown timer with stored deadline
  var countdown = new CountdownTimer({
    container: countdownContainer,
    endDate: storedDeadline,
    units: ['months', 'days', 'hours'],
    labels: ['months', 'days', 'hours'],
    format: '{<M>}m {<D>}d {<H>}h',
  });
}

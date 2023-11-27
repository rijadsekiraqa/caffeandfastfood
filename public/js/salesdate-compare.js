
    document.addEventListener('DOMContentLoaded', function () {
    // Get the from date and to date input fields
    const fromDateInput = document.querySelector('input[name="fromdate"]');
    const toDateInput = document.querySelector('input[name="todate"]');

    // Add an event listener to the form submission
    const filterForm = document.getElementById('filter-form');
    filterForm.addEventListener('submit', function (event) {
    // Get the from date and to date values
    const fromDate = fromDateInput.value;
    const toDate = toDateInput.value;

    // Validate the dates
    if (!validateDates(fromDate, toDate)) {
    event.preventDefault();


    alert('Data e mbarimit nuk mund te jete me e vogel se data e fillimit ');
}
});

    // Function to validate the date range
    function validateDates(fromDate, toDate) {
    const fromDateObj = new Date(fromDate);
    const toDateObj = new Date(toDate);

    // Check if to date is greater than from date
    return toDateObj >= fromDateObj;
}
});

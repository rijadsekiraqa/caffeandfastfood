$(document).ready(function() {
    $('.table').each(function() {
        // Get the desired sorting order from the data-sort-order attribute
        var sortOrder = $(this).data('sort-order') || 'asc';

        // Get the number of columns in the current table
        var numColumns = $(this).find('thead th').length;

        // Determine which columns should be non-orderable based on your criteria
        var nonOrderableColumns = [];
        // For example, make the last column non-orderable (change this based on your criteria)
        nonOrderableColumns.push(numColumns - 1);

        // Initialize DataTable for the current table
        var table = $(this).DataTable({
            columnDefs: nonOrderableColumns.map(function(index) {
                return { orderable: false, targets: index };
            }),
            order: [0, sortOrder] // Set the initial sorting order based on the data-sort-order attribute
        });

        // Add classes to table cells (if needed)
        $('.dataTable td, .dataTable th', this).addClass('py-1 px-2 align-middle');


    });
});


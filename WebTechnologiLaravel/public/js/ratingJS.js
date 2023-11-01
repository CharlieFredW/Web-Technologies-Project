$('.star-rating .star').on('click', function () {
    const sampleId = $(this).parent().data('data-sample-id');
    const rating = $(this).data('data-rating');

    $.ajax({
        type: 'POST',
        url: '/rate-sample', // Create a route for this endpoint
        data: {
            sample_id: sampleId,
            rating: rating,
        },
        success: function (response) {
            // Handle success, e.g., update the UI
        },
    });
});

$(document).ready(function () {
    $(".star").click(function () {
        const sampleId = $(this).parent().data('sample-id');
        const rating = $(this).data('rating');

        console.log('Sample ID:', sampleId);
        console.log('Rating:', rating);

        $.ajax({
            type: 'POST',
            url: '/rate-sample', // Create a route for this endpoint
            data: {
                sample_id: sampleId,
                rating: rating,
            },

        });


})
});



// Copy URL to the users clipboard when you press the copy URL button & send Ajax call to update the total downloads
document.addEventListener('DOMContentLoaded', function () {
    const copyButtons= document.querySelectorAll('.copy-url-button');

    //add event listener for each button in the url section
    copyButtons.forEach(button => {
        button.addEventListener('click', () => {
            const urlToCopy = button.getAttribute('data-url');
            const sampleId = button.getAttribute('data-sample-id');

            //Get csrf for post method
            const csrf = document.head.querySelector('meta[name="csrf-token"]').content;

            navigator.clipboard.writeText(urlToCopy).then(function () {
                alert('URL has been copied to your clipboard');

                // Send Ajax request to update total downloads
                fetch(`/update-total-downloads/${sampleId}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrf,
                        'Content-Type': 'application/json',
                    },
                })
                    .then(response => response.json())
                    .then(data => {
                        //Updates the value when button is pressed directly in webpage (not database)
                        if (data.updatedCount !== undefined) {
                            const totalDownloadsElement = button.closest('.sample-items').querySelector('.sample-item:nth-child(4) p');
                            if (totalDownloadsElement) {
                                totalDownloadsElement.textContent = data.updatedCount;
                            }
                        }
                    })
            }).catch(function (error) {
                console.error('could not copy text', error);
            });
        });
    });
});



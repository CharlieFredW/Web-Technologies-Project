
// Expand area when button is pressed
function toggleExpand() {
    const expandArea = document.getElementById('expand-area');
    const expandButton = document.getElementById('expand-button');

    if (expandArea.style.display === 'none' || expandArea.style.display === '') {
        expandArea.style.display = 'block';
        expandButton.textContent = 'Hide';
    } else {
        expandArea.style.display = 'none';
        expandButton.textContent = 'Filter Results';
    }
}

function toggleDropdown(dropdownId, button) {
    const dropdown = document.getElementById(dropdownId);
    setDropdownPosition(dropdown, button);
    dropdown.style.display = (dropdown.style.display === "block") ? "none" : "block";

    hideOtherDropdowns(dropdownId);
}


function setDropdownPosition(dropdown, button) {
    const buttonRect = button.getBoundingClientRect();
    console.log(buttonRect);

    dropdown.style.position = "absolute";
    dropdown.style.left = buttonRect.left + window.scrollX + (buttonRect.width / 2) - (dropdown.offsetWidth / 2) - 87 + "px";
    dropdown.style.top = buttonRect.bottom + window.scrollY + "px";


    console.log(buttonRect.left);

}


function hideOtherDropdowns(currentDropdownId) {
    const dropdowns = document.querySelectorAll('.dropdown-content');
    dropdowns.forEach(function(dropdown) {
        if (dropdown.id !== currentDropdownId) {
            dropdown.style.display = "none";
        }
    });
}


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



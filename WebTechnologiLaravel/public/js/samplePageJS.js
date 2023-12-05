
//on click buttons
const expandArea = document.getElementById('expand-button');
expandArea.addEventListener("click", toggleExpand)

const expandDropdown = document.getElementById('expand-button');
expandArea.addEventListener("click", toggleExpand)

function attachEventListeners() {
    const sortHighestButton = document.getElementById('sort-highest');
    const sortLowestButton = document.getElementById('sort-lowest');

        sortHighestButton.addEventListener("click", function () {
            sortSamples('desc');
        });

        sortLowestButton.addEventListener("click", function () {
            sortSamples('asc');
        });
}

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


// Expand area when button is pressed
function toggleExpand() {
    const expandArea = document.getElementById('expand-area');
    const expandButton = document.getElementById('expand-button');

    if (expandArea.style.display === 'none' || expandArea.style.display === '') {
        expandArea.style.display = 'block';
        expandButton.textContent = 'Hide';

        attachEventListeners()
    } else {
        expandArea.style.display = 'none';
        expandButton.textContent = 'Filter Results';
    }
}

//dropdown for buttons
function toggleDropdown(dropdownId, button) {
    const dropdown = document.getElementById(dropdownId);
    setDropdownPosition(dropdown, button);
    dropdown.style.display = (dropdown.style.display === "block") ? "none" : "block";

    hideOtherDropdowns(dropdownId);
}

//get button position for dropdown
function setDropdownPosition(dropdown, button) {
    const buttonRect = button.getBoundingClientRect();
    console.log(buttonRect);

    dropdown.style.position = "absolute";
    dropdown.style.left = buttonRect.left + window.scrollX + (buttonRect.width / 2) - (dropdown.offsetWidth / 2) - 87 + "px";
    dropdown.style.top = buttonRect.bottom + window.scrollY + "px";


    console.log(buttonRect.left);

}

//hide other buttons dropdown if new is clicked
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

function sortSamples(sortType) {
    $.ajax({
        type: 'POST',
        url: '/sort-samples',
        data: { sortType: sortType },
        success: function (response) {
            console.log(response);
            const samples = response.samples;

            if (samples && samples.length) {
                console.log(samples);

                //get container div to clear
                const generatedHtmlContainer = document.getElementById('generated-html');

                //clear everything in the html div
                generatedHtmlContainer.innerHTML = '';

                //loop samples and append the html string to the document
                samples.forEach(sample => {
                    console.log(samples.length);
                    console.log('Sample ID:', sample.id);
                    const sampleHtml = `
                    <form method="POST" action="{{ route('sample.rate') }}">
                        <input type="hidden" name="sample_id" value="${sample.id}">
                        <input type="hidden" name="rating" id="rating_${sample.id}" value="">

                        <ul class="sample-items">
                            <li class="sample-item"><img class="sample-image" src="${sample.image_url}" alt="${sample.title}"></li>
                            <li class="sample-item"><h3>${sample.title}</h3></li>
                            <li class="sample-item">
                                <button class="copy-url-button" data-sample-id="${sample.id}" data-url="${sample.url}">Copy URL</button>
                            </li>
                            <li class="sample-item">
                                <div class="rating">
                                    <p>
                                        Average Rating:
                                        ${sample.averageRating !== null ? sample.averageRating : 'No Ratings Yet'}
                                    </p>
                                    <button class="star" data-value="1" onclick="assignValue(${sample.id}, 1)">&#9733</button>
                                    <button class="star" data-value="2" onclick="assignValue(${sample.id}, 2)">&#9733</button>
                                    <button class="star" data-value="3" onclick="assignValue(${sample.id}, 3)">&#9733</button>
                                    <button class="star" data-value="4" onclick="assignValue(${sample.id}, 4)">&#9733</button>
                                    <button class="star" data-value="5" onclick="assignValue(${sample.id}, 5)">&#9733</button>
                                </div>
                            </li>
                            <li class="sample-item"><p>${sample.total_downloads}</p></li>
                            <li class="sample-item"><p>${sample.bpm}</p></li>
                            <li class="sample-item"><p>${sample.key}</p></li>
                            <li class="sample-item"><p>${sample.genre}</p></li>
                            <li class="sample-item"><p>${sample.instrument}</p></li>
                        </ul>
                    </form>
                `;
                    //insert html into the selected div
                    console.log(sampleHtml)
                    generatedHtmlContainer.innerHTML += sampleHtml;
                });
            }
            else {
                console.error('Invalid or missing samples data in the response');
            }
        },
        error: function (error) {
            console.error('Error:', error);
        }
    });
}



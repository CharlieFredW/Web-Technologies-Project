
//on click buttons
const expandArea = document.getElementById('expand-button');
expandArea.addEventListener("click", toggleExpand)

const expandDropdown = document.getElementById('expand-button');
expandArea.addEventListener("click", toggleExpand)

function attachEventListeners() {
    //button listener for total downloads
    const sortHighestButton = document.getElementById('sort-highest');
    const sortLowestButton = document.getElementById('sort-lowest');

    //button listener for bpm
    const sortBPMButton = document.getElementById('bpm-button');
    const sortBPMInput = document.getElementById('bpm-input');

    //button listener for ket
    const sortC = document.getElementById('sortC');
    const sortCSharp = document.getElementById('sortC#');
    const sortD = document.getElementById('sortD');
    const sortDSharp = document.getElementById('sortD#');
    const sortE = document.getElementById('sortE');
    const sortF = document.getElementById('sortF');
    const sortFSharp = document.getElementById('sortF#');
    const sortG = document.getElementById('sortG');
    const sortGSharp = document.getElementById('sortG#');
    const sortA = document.getElementById('sortA');
    const sortASharp = document.getElementById('sortA#');
    const sortB = document.getElementById('sortB');

    //min keys
    const sortCM = document.getElementById('sortCm');
    const sortCSharpM = document.getElementById('sortC#m');
    const sortDM = document.getElementById('sortDm');
    const sortDSharpM = document.getElementById('sortD#m');
    const sortEM = document.getElementById('sortEm');
    const sortFM = document.getElementById('sortFm');
    const sortFSharpM = document.getElementById('sortF#m');
    const sortGM = document.getElementById('sortGm');
    const sortGSharpM = document.getElementById('sortG#m');
    const sortAM = document.getElementById('sortAm');
    const sortASharpM = document.getElementById('sortA#m');
    const sortBM = document.getElementById('sortBm');

    // genre listener
    const checkboxesGenre = document.querySelectorAll('.genre-dropdown-button');

    // Date listener
    const sortNewest = document.getElementById('sort-date-newest')
    const sortOldest = document.getElementById('sort-date-oldest')

    // instrument listener
    const checkboxesInstrument = document.querySelectorAll('.instrument-dropdown-button');


    sortHighestButton.addEventListener("click", function () {
            sortSamplesDownloads('desc');
        });

        sortLowestButton.addEventListener("click", function () {
            sortSamplesDownloads('asc');
        });

        sortBPMButton.addEventListener("click", function () {
          sortSamplesBPM(sortBPMInput.value);
        });

        //Key button listeners

        sortC.addEventListener("click", function () {
          sortSamplesKey('C major');
        })

        sortCSharp.addEventListener("click", function () {
           sortSamplesKey('C# major');
        })

        sortD.addEventListener("click", function () {
           sortSamplesKey('D major');
        })

        sortDSharp.addEventListener("click", function () {
           sortSamplesKey('D# major');
        })

        sortE.addEventListener("click", function () {
            sortSamplesKey('E major');
        })

        sortF.addEventListener("click", function () {
            sortSamplesKey('F major');
        })

        sortFSharp.addEventListener("click", function () {
            sortSamplesKey('F# major');
        })

        sortG.addEventListener("click", function () {
            sortSamplesKey('G major');
        })

        sortGSharp.addEventListener("click", function () {
            sortSamplesKey('G# major');
        })

        sortA.addEventListener("click", function () {
            sortSamplesKey('A major');
        })

        sortASharp.addEventListener("click", function () {
            sortSamplesKey('A# major');
        })

        sortB.addEventListener("click", function () {
            sortSamplesKey('B major');
        })

        sortCM.addEventListener("click", function () {
            sortSamplesKey('C minor');
        })

        sortCSharpM.addEventListener("click", function () {
            sortSamplesKey('C# minor');
        })

        sortDM.addEventListener("click", function () {
            sortSamplesKey('D minor');
        })

        sortDSharpM.addEventListener("click", function () {
            sortSamplesKey('D# minor');
        })

        sortEM.addEventListener("click", function () {
            sortSamplesKey('E minor');
        })

        sortFM.addEventListener("click", function () {
            sortSamplesKey('F minor');
        })

        sortFSharpM.addEventListener("click", function () {
            sortSamplesKey('F# minor');
        })

        sortGM.addEventListener("click", function () {
            sortSamplesKey('G minor');
        })

        sortGSharpM.addEventListener("click", function () {
            sortSamplesKey('G# minor');
        })

        sortAM.addEventListener("click", function () {
            sortSamplesKey('A minor');
        })

        sortASharpM.addEventListener("click", function () {
            sortSamplesKey('A# minor');
        })

        sortBM.addEventListener("click", function () {
            sortSamplesKey('B minor');
        })

        // Genre listener
    checkboxesGenre.forEach(function (checkbox) {
        checkbox.addEventListener('click', function () {
            handleGenreCheckbox();
        });
    });

        // date created listener
    sortNewest.addEventListener("click", function () {
        sortSamplesDate('desc')
    })

    sortOldest.addEventListener("click", function () {
        sortSamplesDate('asc')
    })

    //instrument listener
    checkboxesInstrument.forEach(function (checkbox) {
        checkbox.addEventListener('click', function () {
            handleInstrumentCheckbox()
        });
    });

}

function handleGenreCheckbox() {
    const checkedCheckboxes = document.querySelectorAll('.genre-dropdown-button:checked');

    const selectedGenres = Array.from(checkedCheckboxes).map(function (checkbox) {
        return checkbox.value;
    });

    sortSamplesGenre(selectedGenres.sort());
    console.log(selectedGenres);
}

function handleInstrumentCheckbox() {
    const selectedRadio = document.querySelector('.instrument-dropdown-button:checked');

    const selectedInstrument = selectedRadio.value;
    sortSamplesInstrument(selectedInstrument);

    console.log(selectedRadio);
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

//get original content in the samples div

const originalContent = document.getElementById('generated-html').innerHTML;

function clearAndReloadContent() {
    const generatedHtmlDiv = document.getElementById('generated-html');
    generatedHtmlDiv.innerHTML = '';

    generatedHtmlDiv.innerHTML = originalContent;
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

function sortSamplesDownloads(sortType, page = 1) {


    $.ajax({
        type: 'POST',
        url: '/sort-samples-downloads',
        data: { sortType: sortType, page: page},
        success: function (response) {

            console.log(response);
            const samples = response.samples.data;

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

function sortSamplesBPM(sortType) {
    $.ajax({
        type: 'POST',
        url: '/sort-samples-bpm',
        data: { sortType: sortType },
        success: function (response) {
            console.log(response);
            const samples = response.samples.data;

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

function sortSamplesKey(sortType) {
    $.ajax({
        type: 'POST',
        url: '/sort-samples-key',
        data: { sortType: sortType },
        success: function (response) {
            console.log(response);
            const samples = response.samples.data;

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

function sortSamplesGenre(sortType) {
    $.ajax({
        type: 'POST',
        url: '/sort-samples-genre',
        data: { sortType: sortType },
        success: function (response) {
            console.log(response);
            const samples = response.samples.data;

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
                clearAndReloadContent()
                console.error('Invalid or missing samples data in the response');
            }
        },
        error: function (error) {
            console.error('Error:', error);
        }
    });
}

function sortSamplesDate(sortType) {
    $.ajax({
        type: 'POST',
        url: '/sort-samples-date',
        data: { sortType: sortType },
        success: function (response) {
            console.log(response);
            const samples = response.samples.data;

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
                clearAndReloadContent()
                console.error('Invalid or missing samples data in the response');
            }
        },
        error: function (error) {
            console.error('Error:', error);
        }
    });
}

function sortSamplesInstrument(sortType) {
    $.ajax({
        type: 'POST',
        url: '/sort-samples-instrument',
        data: { sortType: sortType },
        success: function (response) {
            console.log(response);
            const samples = response.samples.data;

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
                clearAndReloadContent()
                console.error('Invalid or missing samples data in the response');
            }
        },
        error: function (error) {
            console.error('Error:', error);
        }
    });
}





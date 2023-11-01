
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


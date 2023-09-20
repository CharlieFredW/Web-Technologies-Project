

//Local storage is a web storage that stores key-value pairs (Almost like cookies)
function signOut() {
    // Clear the user's session information
    localStorage.removeItem('username');
    localStorage.removeItem('userType');
    console.log('Removed user information from local storage');

    // Add a state change to the history
    window.history.pushState({}, document.title, 'LoginPage.html');

    // Redirect to the login page
    window.location.href = 'LoginPage.html';
}




console.log('Adding click event listener to Sign Out button');
document.getElementById('sign-out-button').addEventListener('click', signOut);


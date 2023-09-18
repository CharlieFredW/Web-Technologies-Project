// Define user (Midlertidigt. De skal i en database (Fil eller noSQL))
const users = [
    { username: 'admin', password: 'admin', userType: 'admin' },
    { username: 'creator', password: 'creator', userType: 'creator' },
    { username: 'guest', password: 'guest', userType: 'guest' },
];

//Listens to if the submit function (Login button) is called.
document.getElementById("loginForm").addEventListener("submit", function (event) {
    event.preventDefault();

    // Get username and password from the login page
    const username = document.getElementById("username").value;
    const password = document.getElementById("password").value;

    // Check if the entered credentials match any user from the users array
    const matchedUser = users.find(user => user.username === username && user.password === password);

    if (matchedUser) {
        // User matched
        switch (matchedUser.userType) {
            case 'admin':
                // Go to adminPage
                window.location.href = 'PageOne.html';
                break;
            case 'creator':
                // Go to creatorPage
                window.location.href = 'YourPage.html';
                break;
            case 'guest':
                // Go to GuestPage
                window.location.href = 'LoginPage.html';
                break;
        }
    } else {
        // If no matches found
        alert("Invalid username or password.");
    }
});

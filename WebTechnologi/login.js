// Function to fetch from users.json
async function fetchUserData() {
    try {
        const response = await fetch('users.json'); // The Json file
        if (!response.ok) {
            throw new Error('Failed to fetch user data'); //If it cant find the Json file
        }

        //Returns the response from the Json
        const userData = await response.json();
        return userData;
    } catch (error) {
        console.error(error);
        return [];
    }
}

// Heres a listener that listens if the user has clicked the Login button (Or clicked the enter key)
document.getElementById("loginForm").addEventListener("submit", async function (event) {
    event.preventDefault();

    // Get username and password (Added a trim in case somebody accidentally added whitespace)
    const username = document.getElementById("username").value.trim();
    const password = document.getElementById("password").value;

    // Get the data from the json file
    const userData = await fetchUserData();

    // Check if the entered user info matches any users
    const matchedUser = userData.find(user => user.username === username && user.password === password);

    if (matchedUser) {
        // Matched with user
        switch (matchedUser.userType) {
            case 'creator':
                // Change to the page we want for creator
                window.location.href = 'PageOne.html';
                break;
            case 'guest':
                // Change to the page we want for guest
                window.location.href = 'YourPage.html';
                break;
            default:
                alert("Invalid user type.");
                break;
        }
    } else {
        // If no matches found
        alert("Invalid username or password.");
    }
});
